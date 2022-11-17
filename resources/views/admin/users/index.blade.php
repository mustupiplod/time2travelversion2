@extends('Admin.layout.master')

@section('style')

@endsection

@section('content')

    <div class="breadcrumb-holder">
        <div class="container-fluid">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dash')}}">Dashboard</a></li>
                {{--                <li class="breadcrumb-item active"><a href="{{route('manageasset')}}">Manage Asset </a></li>--}}
                <li class="breadcrumb-item active">Users Details</li>
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
                    <div class="col-md-5">
                        <a href="{{route('admin.user_export')}}" class="btn btn-primary pull-right rounded-pill">Export To Excel</a>
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
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>User Email</th>
                                <th>User Mobile</th>
                                <th>User DOB</th>
                                <th>User Gender</th>

                                <th>Status</th>
                                
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($user_detail as $key => $data)
                                <tr>
                                    <td width="2%">
                                        <center>{{$key+1}}</center>
                                    </td>
                                    <td width="15%">
                                        {{ $data->first_name}}
                                    </td>
                                    <td width="15%">
                                        {{ $data->last_name}}
                                    </td>
                                    <td width="15%">{{ $data->email }}</td>
                                    <td width="15%">{{ $data->phone }}</td>
                                    <td width="15%">{{ $data->dob }}</td>
                                    <td width="15%">{{ $data->gender }}</td>
                                    <td width="8%">
                                        @if($data->is_active == '0')
                                            <a href="#"
                                               class="p-2 make-active-click"
                                               data-id="{{ $data->id.'_0'}}" is_active ="yes" title="make this in-active">
                                                <span class="badge badge-success">Active</span>
                                            </a>
                                            
                                        @else
                                            <a href="#"
                                               class="p-2 make-active-click"
                                               data-id="{{ $data->id.'_1'}}" is_active="no" title="make this active">
                                                <span class="badge badge-danger">In Active</span>
                                            </a>
                                            
                                        @endif
                                    </td>


                                    <!-- <td width="6%">
                                        
{{--                                         @if( (!$user->hasRole(['Admin'])))--}}
{{--                                        @can('Edit Work-Order')--}}
{{--                                            <a href="{{ route('admin.user_edit', $data->id) }}" class="p-2">--}}
{{--                                                <span class="mdi mdi-pencil"></span>--}}
{{--                                            </a>--}}

{{--                                        <a href="#"--}}
{{--                                           class="p-2 delete-record-click"--}}
{{--                                           data-id="{{ $data->id }}">--}}
{{--                                            <span class="mdi mdi-delete"></span>--}}
{{--                                        </a>--}}

                                    </td> -->
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
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });

            $('.make-active-click').click(function () {
                event.preventDefault();

                var id = $(this).data("id");
                var status = $(this).attr("is_active");
                // alert(id+"___________"+status);

                if(status == 'yes'){
                    var btn = "btn-danger";
                    var setas = 'inactive';
                }
                else{
                    var btn = "btn-success";
                    var setas = 'active';
                }

                swal({
                        title: "Are you sure? ",
                        text: "You want to make this user account "+setas+"!",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonClass: btn,
                        confirmButtonText: "Yes, make it "+setas+"!",
                        closeOnConfirm: false
                    },
                    function (isConfirm) {
                        if (isConfirm) {
                            $.ajax({
                                url: "/admin/user-active",
                                type: "get",
                                data: {
                                    "id": id
                                },
                                success: function (result) {
                                    // console.log(result);
                                    if(result == 'success'){
                                        swal({
                                            title: "user account has been set "+setas+"!",
                                            type: "success",
                                        }, function () {
                                            location.reload();
                                        });
                                    }
                                    
                                }
                            });
                        }
                });
            });
        });

    </script>
@endsection
