@extends('Admin.layout.master')


@section('style')

@endsection

@section('content')
    <div class="breadcrumb-holder">
        <div class="container-fluid">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dash')}}">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="{{route('featured_city.list')}}">Featured City</a></li>
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
                    <form action="{{route('featured_city.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="form-group col-sm-6 col-md-4">
                                <label for="category_name">City Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control validate" required name="city_name">

                            </div>
                            <div class="form-group col-sm-6 col-md-4">
                                <label for="category_name">Country</label>
                                <select class="form-select" name="city_country">
                                    <option value="">Select Country</option>
                                    <option value="uae">UAE</option>
                                    <option value="usa">USA</option>
                                    <option value="ind">India</option>
                                    <option value="pak">Pakistan</option>
                                    <option value="aus">Australia</option>
                                </select>

                            </div>
                            <div class="form-group col-sm-6 col-md-4">
                                <label for="category_name">City Image<span class="text-danger">*</span></label>
                                <input type="file" class="form-control validate" required name="city_image">

                            </div>
                            <div class="form-group col-sm-6 col-md-4">
                                <label for="category_name">Section Name<span class="text-danger">*</span></label>
                                <select class="form-select" required name="section_name">
                                    <option value="">Select Section</option>
                                    <option value="1">Recommended</option>
                                    <option value="2">Offers</option>
                                    <option value="3">Get Inspiration</option>
                                </select>
                            </div>

                        </div>
                        <div class="row">
                            <div class="form-group col-sm-12 col-md-12">
                                <label>City Summary <span class="text-danger">*</span></label>
                                <textarea class="ckeditor form-control" name="city_summary" id="page_content" required>

                                </textarea>
                            </div>

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

@section('custom-jquery')

@endsection



