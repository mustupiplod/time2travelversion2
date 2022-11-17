@extends('Admin.layout.master')

@push('plugin-styles')
  <!-- {!! Html::style('/assets/plugins/plugin.css') !!} -->

@endpush

@section('content')

<?php

if(isset($edit_cms) && !empty($edit_cms)){

  $epage_title = $edit_cms['title'];
  $epage_content = $edit_cms['details'];
  $choice = 'admin.update_cms_page';

  $eid = $edit_cms['id'];
  $title = 'View/Edit CMS Page';

}

else{

  $choice = 'admin.create_cms_page';

  $eid = '';
  $title = 'Add CMS Page';
}
?>

  <div class="breadcrumb-holder">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.dash')}}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{route('admin.list_cms_page')}}">CMS Pages</a></li>
        <li class="breadcrumb-item ">{{$title}}</li>
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
                                <h2 class="h3 display">{{$title}}</h2>
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
            <form action="{{ route($choice) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if($eid != '')
                    <input type="hidden" name="eid" value="{{$eid}}" />
                @endif
                <div class="row">
                  <div class="form-group col-sm-6 col-md-4">
                    <label for="page_title">Page Title<span class="text-danger">*</span></label><br>
                    <input type="text" class="form-control" name="page_title" placeholder="Page Title" value="{{ isset($epage_title) ? $epage_title : ''}}" required>
                  </div>

{{--                  <div class="form-group col-sm-6 col-md-4">--}}
{{--                    <label for="page_title">Section Tag<span class="text-danger">*</span></label><br>--}}
{{--                    <select name="tag"class="form-control p-0 pl-1" required>--}}
{{--                      <option value="" disabled>Select Section</option>--}}
{{--                      <option value="delivery_returns">DELIVERY & RETURNS</option>--}}
{{--                      <option value="legal_policies">LEGAL POLICIES</option>--}}
{{--                      <option value="terms_condition">TERMS & CONDITIONS</option>--}}
{{--                    </select>--}}
{{--                  </div>--}}
                </div>

                <div class="row">
                  <div class="form-group col-sm-12 col-md-12">
                    <label for="notification_type">Page Content<span class="text-danger">*</span></label>
                      <textarea class="ckeditor form-control" name="page_content" id="page_content" required>
                        {{ isset($epage_content) ? $epage_content : ''}}
                      </textarea>
                  </div>
                </div>

                <div class="row mt-4 pull-right">
                  <div class="col-sm-12 ">
                    <button class="btn btn-primary mr-2" type="submit" name="action">
                        <i class="fa fa-save"></i> Send
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

@section('custom-jquery')
<script>
  initSample();
</script>
@endsection
