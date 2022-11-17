@extends('Admin.layout.master')

@push('plugin-styles')
    <!-- {!! Html::style('/assets/plugins/plugin.css') !!} -->

@endpush

@section('content')

    <?php

    if (isset($edit_faqs) && !empty($edit_faqs)) {

        $ecateg_name = $edit_faqs[0]['title'];
        $equest_ans = $edit_faqs[0]['details'];
        $choice = 'admin.update_faq';

        $eid = $edit_faqs[0]['id'];
        $title = 'Edit FAQ';

    } else {

        $choice = 'admin.create_faq';

        $eid = '';
        $title = 'Add FAQ';
    }


    ?>
    <div class="breadcrumb-holder">
        <div class="container-fluid">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dash')}}">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="{{route('admin.list_faq')}}">FAQs</a></li>
                <li class="breadcrumb-item ">Add FAQ</li>
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
                                <h2 class="h3 display">Add FAQ</h2>
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
                            <input type="hidden" name="eid" value="{{$eid}}"/>
                        @endif
                        <div class="row">
                            <div class="form-group col-sm-6 col-md-6">
                                <label for="category_name">Question<span class="text-danger">*</span></label><br>
                                <input type="text" class="form-control" name="question" placeholder="Question" value="{{ isset($ecateg_name) ? $ecateg_name : ''}}" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-sm-6 col-md-12">
                                <label for="notification_type">Answers<span class="text-danger">*</span></label>
                                <textarea class="ckeditor form-control" name="quest_answer" id="quest_answer" required>
                        {{ isset($equest_ans) ? $equest_ans : ''}}
                      </textarea>
                            </div>
                        </div>

                        <div class="row mt-4 pull-right">
                            <div class="col-sm-12 ">
                                <button class="btn btn-primary mr-2" type="submit" name="action">
                                    <i class="fa fa-save"></i>
                                    Send
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
    <script>
        initSample();
    </script>
@endsection
