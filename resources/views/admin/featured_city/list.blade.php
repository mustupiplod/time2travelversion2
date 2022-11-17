@extends('Admin.layout.master')

@section('style')

@endsection

@section('content')

    <div class="breadcrumb-holder">
        <div class="container-fluid">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dash')}}">Dashboard</a></li>
                {{--                <li class="breadcrumb-item active"><a href="{{route('manageasset')}}">Manage Asset </a></li>--}}
                <li class="breadcrumb-item active">Featured City</li>
            </ul>
        </div>
    </div>

    <section>
        <div class="container-fluid">
            <header>
                <div class="row">
                    <div class="col-md-7">
                        {{--                        <h2 class="h3 display">Work Order Of <u>{{$asset_name->Name}}</u></h2>--}}
                    </div>
                    <div class="col-md-5 text-right">
                        <a href="{{route('featured_city.create')}}" class="btn btn-primary rounded-pill ">Add Featured-City</a>
                    </div>
                </div>
            </header>
            <br>
            <div class="card">
                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table id="page-length-option" class="table table-striped table-hover multiselect">
                            <thead>
                            <tr>
                                <th>
                                    <center>No</center>
                                </th>
                                <th>City Name</th>
                                <th>City Section</th>
                                <th>City Status</th>
                                <th>City Image</th>
                                {{--                                <th>Action</th>--}}
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($details as $m => $detail)
                                <tr>
                                    <td>
                                        <center>{{$m +1}}</center>
                                    </td>
                                    <td>
                                        {{$detail->city_name}}
                                    </td>
                                    <td>
                                        {{ ($detail->section_name == '1') ? 'Recommended' : (($detail->section_name == '2') ? 'Offers' : (($detail->section_name == '3' ? 'Get Inspiration' : "")))}}
                                    </td>
                                    <td >
                                        @if($detail->is_active == 1)
                                            <a href="#" class="badge-danger rounded-lg p-1  bchoice" data-id="{{ $detail->id.'__'.$detail->is_active }}" title="Activate City" d_status="Activate">In-Active</a>
                                        @else
                                            <a href="#" class="badge-success rounded-lg p-1 bchoice" data-id="{{ $detail->id.'__'.$detail->is_active }}" title="DeActivate City" d_status="DeActivate">Active</a>
                                        @endif
                                    </td>

                                    <td>
                                        @if(!empty($detail->city_image))
                                            <img src="{{asset($detail->city_image)}}">
                                        @endif
                                    </td>
                                    {{--                                    <td width="6%">--}}

                                    {{--                                        <a href="{{ route('admin.categ_edit', $mv->id) }}"--}}
                                    {{--                                           class="p-2">--}}
                                    {{--                                            <span class="mdi mdi-pencil"></span>--}}
                                    {{--                                        </a>--}}
                                    {{--                                        @if($mv->id != 1 && $mv->id != 2)--}}
                                    {{--                                            <a href="#"--}}
                                    {{--                                               class="p-2 delete-record-click"--}}
                                    {{--                                               data-id="{{ $mv->id }}">--}}
                                    {{--                                                <span class="mdi mdi-delete"></span>--}}
                                    {{--                                            </a>--}}
                                    {{--                                        @endif--}}

                                    {{--                                    </td>--}}

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('custom-jquery')
    <script>
        $(document).ready(function () {
            $('#page-length-option').DataTable({
                // "scrollX": true
            });
        });

        $('.bchoice').on('click', function(){
            event.preventDefault();
            var set = $(this).attr("d_status");
            var id = $(this).data("id");
            // alert(id);
            var btn = 'btn-success';

            if(set == 'hidden'){
                btn = 'btn-danger';
            }


            swal({
                    title: "Are you sure? ",
                    text: "You want to "+set+" this Featured City!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonClass: btn,
                    confirmButtonText: "Yes, "+set+" it!",
                    closeOnConfirm: false
                },
                function (isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            url: "{{ route('featured_city.change_status') }}",
                            type: "get",
                            data: {
                                "id": id
                            },
                            success: function (result) {

                                swal({
                                    title: "City has been "+set+"d!",
                                    type: "success",
                                }, function () {
                                    location.reload();
                                });
                            }
                        });
                    }
                });
        });



        // $('.delete-record-click').click(function () {
        //     var id = $(this).data("id");
        //
        //     swal({
        //             title: "Are you sure? ",
        //             text: "You will not be able to recover this record!",
        //             type: 'warning',
        //             showCancelButton: true,
        //             confirmButtonClass: "btn-danger",
        //             confirmButtonText: "Yes, delete it!",
        //             closeOnConfirm: false
        //         },
        //         function (isConfirm) {
        //             if (isConfirm) {
        //                 $.ajax({
        //                     url: "/admin/category-delete",
        //                     type: "get",
        //                     data: {
        //                         "id": id
        //                     },
        //                     success: function (result) {
        //                         // alert(result);
        //                         if (result == 'error') {
        //                             swal({
        //                                 title: "Category cannot be deleted as products are listed under it!",
        //                                 type: "warning",
        //                                 showCancelButton: true,
        //                                 showConfirmButton: false,
        //                             }, function () {
        //                                 location.reload();
        //                             });
        //                         } else {
        //                             swal({
        //                                 title: "Category has been deleted!",
        //                                 type: "success",
        //                             }, function () {
        //                                 location.reload();
        //                             });
        //                         }
        //
        //                     }
        //                 });
        //             }
        //         });
        // });
    </script>
@endsection
