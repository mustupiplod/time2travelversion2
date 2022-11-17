@extends('Admin.layout.master')

@section('style')

@endsection

@section('content')
    <div class="breadcrumb-holder">
        <div class="container-fluid">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dash')}}">Dashboard</a></li>
                {{--                <li class="breadcrumb-item active"><a href="{{route('manageasset')}}">Manage Asset </a></li>--}}
                <li class="breadcrumb-item active">CMS Pages List</li>
            </ul>
        </div>
    </div>

    <header>
        <div class="row">
            <div class="col-md-7">
                {{--                        <h2 class="h3 display">Work Order Of <u>{{$asset_name->Name}}</u></h2>--}}
            </div>
            <div class="col-md-5">
                <a href="{{route('admin.add_cms_page')}}" class="btn btn-primary pull-right rounded-pill">Add CMS Page</a>
            </div>
        </div>

    </header>
    <br>

    <section>
        <div class="container-fluid">

            <div class="card">
                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table id="page-length-option" class="table table-striped table-hover multiselect">
                            <thead>
                            <tr>
                                <th>
                                    <center>SNo.</center>
                                </th>
                                <th>Section Tag</th>
                                <th>Page Title</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($list as $key => $l)
                                <tr>
                                    <td width="10%">
                                        <center>{{$loop->iteration}}</center>
                                    </td>
                                    <td width="20%">
                                        {{$l->tag}}
                                    </td>
                                    <td width="60%">
                                        {{$l->title}}
                                    </td>
                                    <td width="10%">
                                        <a href="{{ route('admin.edit_cms_page', $l->id) }}"
                                               class="p-2">
                                            <span class="mdi mdi-pencil"></span>
                                        </a>

                                    </td>
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
            });
        });

    </script>
@endsection
