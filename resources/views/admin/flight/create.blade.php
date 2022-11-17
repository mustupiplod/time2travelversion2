@extends('Admin.layout.master')

@push('plugin-styles')
    {{--    <!-- {!! Html::style('/assets/plugins/plugin.css') !!} -->--}}

@endpush

@section('content')
    <div class="breadcrumb-holder">
        <div class="container-fluid">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dash')}}">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="{{route('flight.list')}}">Flights</a></li>
                {{--                <li class="breadcrumb-item ">{{$title}}</li>--}}
            </ul>
        </div>
    </div>

    <section>
        <div class="container-fluid">
            <div class="card">
                <div class="card-body p-4">
                    <header>
                        <div class="row">
                            <div class="col-md-7">
                                {{--                                <h2 class="h3 display">{{$title}}</h2>--}}
                            </div>
                        </div>

                    </header>

                    @if($errors->any())
                        <div class="alert alert-danger  custom-alert-danger   alert-block  " id="successMessage">
                            <button type="button" class="close custom-alert-close" data-dismiss="alert">×</button>
                            <span>{!! implode('', $errors->all('<div>:message</div>')) !!}</span>
                        </div>
                    @endif
                    @if(session()->has('success'))
                        <div class="alert alert-success ">
                            <button type="button" class="close custom-alert-close" data-dismiss="alert">×</button>
                            <span>{{ session()->get('success') }}</span>
                        </div>
                    @endif
                    <br>
                    <form action="{{route('flight.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="form-group col-sm-6 col-md-4">
                                <label for="category_name">Airline name<span class="text-danger">*</span></label>
                                <input  type="text" class="form-control validate" required name="name" >

                            </div>
                            <div class="form-group col-sm-6 col-md-4">
                                <label for="category_name">City<span class="text-danger">*</span></label>
                                <input  type="text" class="form-control validate" required name="hotel_city" >

                            </div>
                            <div class="form-group col-sm-6 col-md-4">
                                <label for="category_name">Hotel Address<span class="text-danger">*</span></label>
                                <input  type="text" class="form-control validate" required name="hotel_address" >

                            </div>
                            <div class="form-group col-sm-6 col-md-4">
                                <label for="category_name">Starting Price<span class="text-danger">*</span></label>
                                <input  type="text" class="form-control validate" required name="starting_price" >

                            </div>
                            <div class="form-group col-sm-6 col-md-4">
                                <label for="category_image">Hotel Featured-Image<span class="text-danger">*</span></label>
                                <input  type="file" class="form-control validate" name="featured_image" >

                            </div>
                            <div class="form-group col-sm-6 col-md-4">
                                <label for="category_image">Hotel Images <span class="text-danger">*</span></label>
                                <input  type="file" class="form-control validate" name="hotel_images[]" multiple >

                            </div>

                        </div>
                        <div class="row">
                            <div class="form-group col-sm-12 col-md-12">
                                <label>Hotel Summary <span class="text-danger">*</span></label>
                                <textarea class="ckeditor form-control" name="hotel_summary" id="page_content" required>

                                </textarea>
                            </div>
                            <div class="form-group col-sm-12 col-md-12">
                                <label>Hotel Detail <span class="text-danger">*</span></label>
                                <textarea class="ckeditor form-control" name="hotel_detail" id="page_content" required>

                                </textarea>
                            </div>
                            <div class="form-group col-sm-12 col-md-12">
                                <label>Hotel Amneties <span class="text-danger">*</span></label>
                                <textarea class="ckeditor form-control" name="hotel_amneties" id="page_content" required>

                                </textarea>
                            </div>

                            {{--                            <div class="col-sm-6 col-md-4">--}}
                            {{--                                @if(!Session::get('image') == '')--}}
                            {{--                                    <img src="/images/categories/{{ Session::get('image') }}" style="width:150px;" class="mb-4">--}}
                            {{--                                    <br>--}}
                            {{--                                @elseif(isset($eimage) && $eimage != '')--}}
                            {{--                                    <img src="/images/categories/{{$eimage }}" style="width:150px;" class="mb-4">--}}
                            {{--                                    <br>--}}
                            {{--                                @endif--}}
                            {{--                            </div>--}}
                        </div>



                        <div class="row mt-4">
                            <div class="col-sm-12 ">
                                <button class="btn btn-primary mr-2" type="submit" name="action">
                                    <i class="fa fa-save"></i>
                                    Save
                                </button>
                                <button type="reset" class="btn btn-secondary  mb-1">
                                    <i class="fa fa-arrow-circle-left"></i>
                                    <a href="{{url()->previous()}}" class="text-white">Cancel</a>
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>





@endsection

@push('plugin-scripts')
    {!! Html::script('/assets/plugins/chartjs/chart.min.js') !!}
    {!! Html::script('/assets/plugins/jquery-sparkline/jquery.sparkline.min.js') !!}
@endpush

@push('custom-scripts')
    {!! Html::script('/assets/js/dashboard.js') !!}
@endpush

