<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HotelController extends Controller
{
    //
    public function list()
    {
        $hotel_detail = DB::table('hotels')->get();

        return view('admin.hotel.list',['details' => $hotel_detail]);

    }

    public function create()
    {
        return view('admin.hotel.create');
    }

    public function store(Request $request)
    {
        $hotel_id = DB::table('hotels')->insertGetId([
            'name' => $request->hotel_name,
            'city' => $request->hotel_city,
            'address' => $request->hotel_address,
            'starting_price' => $request->starting_price,
            'summary' => $request->hotel_summary,
            'details' => $request->hotel_detail,
            'amneties' => $request->hotel_amneties,
            'created_at' => Carbon::now()
        ]);

        $path = 'Admin/uploads/hotels/';
        if($request->hasFile('featured_image'))
        {
            $hotel_image = $request->file('featured_image');
            $file = time() . '_' .$request->file('featured_image')->getClientOriginalName();
            $hotel_image->move($path,$file);

            DB::table('hotels')->whereId($hotel_id)->update(['featured_image' => $file]);
        }
        if($request->hasFile('hotel_images'))
        {
            foreach ($request->file('hotel_images') as $image)
            {
                $hotel_image = $image;
                $file = time() . '_' .$image->getClientOriginalName();
                $hotel_image->move($path,$file);

                DB::table('hotel_images')->insert([
                    'hotel_id' => $hotel_id,
                    'image' => $file,
                    'type' => 'normal',
                    'created_at' => Carbon::now(),
                ]);
            }

        }

        return back()->with(['success' => 'Hotel added successfully.']);
    }
}
