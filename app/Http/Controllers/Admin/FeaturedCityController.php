<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Web\FeaturedCity;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FeaturedCityController extends Controller
{
    //
    public function list()
    {
        $details = FeaturedCity::get();

        return view('admin.featured_city.list',['details' => $details]);
    }

    public function create()
    {
        return view('admin.featured_city.create');
    }

    public function store(Request $request)
    {

        $path = 'Admin/uploads/featured_city/';
        if($request->hasFile('city_image'))
        {
            $hotel_image = $request->file('city_image');
            $file = time() . '_' .$request->file('city_image')->getClientOriginalName();
            $hotel_image->move($path,$file);

        }

        $hotel_id = FeaturedCity::create([
            'city_name' => $request->city_name,
            'city_summary' => $request->city_summary,
            'section_name' => $request->section_name,
            'city_image' => $path.$file,
            'city_country' => $request->city_country,

        ]);

        return back()->with(['success' => 'City added successfully.']);
    }

    public function change_status(Request $request)
    {
        $id = $request->id;

        $ex = explode('__', $id);
        $city_id = $ex[0];
        $status = $ex[1];
        $set_status = 1;

        if($status == 1 || $status == '1'){
            $set_status = 0;
        }
//        else{
//            $set_status = 1;
//        }
        // return $set_status;
        $active = FeaturedCity::where('id', $city_id)->update(['is_active' => $set_status]);

        // return response($id);

        if($active){
            return response('success');
        }
        else{
            return response('error');
        }
    }
}
