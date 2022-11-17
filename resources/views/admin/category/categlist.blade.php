{{--<?php--}}
{{--function gettree($p_id,$p_arr,$mdata)--}}
{{--{--}}

{{--    foreach($mdata as $m => $mv){--}}

{{--      if($p_id == $mv['parent_id'])--}}
{{--      {--}}
{{--        ?> <li ><span id="s_<?php echo $mv['id']; ?>">--}}

{{--        <?php echo $mv['categ_name']; ?>--}}
{{--        --}}
{{--        &nbsp;&nbsp;--}}
{{--        <!-- <span style="cursor:pointer; color:red;" onclick="dc(<?php echo $mv['id']; ?>);">Delete</span> -->--}}
{{--        <!-- <a href=""><i class="mdi mdi-table-edit"></i></a> -->--}}
{{--        <a href="{{ route('admin.categ_edit', [ $mv['id'] ]) }}" class="p-2 edit-record-click"><i class="mdi mdi-table-edit"></i></a>--}}
{{--        <a href="#" class="p-2 delete-record-click" data-id="{{ $mv['id'] }}"><i class="mdi mdi-delete"></i></a> --}}

{{--        </span>--}}
{{--        <?php--}}

{{--        if(in_array($mv['id'], $p_arr))--}}
{{--        {--}}
{{--          // echo $mv['m_id']."parent is".$mv['m_parent'];--}}
{{--          ?> <ul >--}}
{{--          <?php gettree($mv['id'], $p_arr, $mdata); ?>--}}
{{--          </ul> <?php--}}
{{--        }--}}
{{--        else--}}
{{--        {--}}
{{--          // echo $mv['m_id']." not in parent array.";--}}
{{--        } --}}
{{--        ?></li><?php--}}

{{--      }--}}
{{--    } --}}
{{--}--}}
{{--?>--}}
{{--@section('content')--}}

{{--<div class="row">--}}
{{--  <div class="col-md-12 grid-margin">--}}
{{--    <div class="card">--}}
{{--      <div class="card-body">--}}
{{--        <div class="row">--}}
{{--          <div class="col-md-4 mx-auto">--}}
{{--            <h1 class="title">Categories</h1>--}}
{{--            <div class="tree ">--}}
{{--                  <ul class=" categ_list">--}}
{{--                <?php gettree(0,$parent,$categ);?>--}}
{{--                --}}
{{--                  </ul>--}}
{{--            </div>  --}}
{{--          </div>--}}
{{--          --}}
{{--        </div>--}}
{{--      </div>--}}
{{--    </div>--}}
{{--  </div>--}}
{{--</div>--}}


{{--@endsection--}}


{{--@section('custom-jquery')--}}
{{--  <script type="text/javascript">--}}
{{--    $.ajaxSetup({--}}
{{--        headers: {--}}
{{--            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
{{--        }--}}
{{--    });--}}

{{--    $('.delete-record-click').click(function () {--}}
{{--                var id = $(this).data("id");--}}

{{--                swal({--}}
{{--                        title: "Are you sure? ",--}}
{{--                        text: "You will not be able to recover this record!",--}}
{{--                        type: 'warning',--}}
{{--                        showCancelButton: true,--}}
{{--                        confirmButtonClass: "btn-danger",--}}
{{--                        confirmButtonText: "Yes, delete it!",--}}
{{--                        closeOnConfirm: false--}}
{{--                    },--}}
{{--                    function (isConfirm) {--}}
{{--                        if (isConfirm) {--}}
{{--                            $.ajax({--}}
{{--                                url: "/admin/category-delete",--}}
{{--                                type: "post",--}}
{{--                                data: {--}}
{{--                                    "id": id--}}
{{--                                },--}}
{{--                                success: function (result) {--}}
{{--                                    // alert(result);--}}
{{--                                    if (result == 'error')--}}
{{--                                    {--}}
{{--                                        swal({--}}
{{--                                            title: "Category cannot be deleted as products are listed under it!",--}}
{{--                                            type: "warning",--}}
{{--                                            showCancelButton: true,--}}
{{--                                            showConfirmButton: false,--}}
{{--                                        }, function () {--}}
{{--                                            location.reload();--}}
{{--                                        });--}}
{{--                                    }--}}
{{--                                    else--}}
{{--                                    {--}}
{{--                                        swal({--}}
{{--                                            title: "Category has been deleted!",--}}
{{--                                            type: "success",--}}
{{--                                        }, function () {--}}
{{--                                            location.reload();--}}
{{--                                        });--}}
{{--                                    }--}}

{{--                                }--}}
{{--                            });--}}
{{--                        }--}}
{{--                    });--}}
{{--            });--}}
{{--  </script>--}}
{{--  --}}
{{--@endsection--}}

@extends('Admin.layout.master')

@section('style')

@endsection

@section('content')

    <div class="breadcrumb-holder">
        <div class="container-fluid">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dash')}}">Dashboard</a></li>
                {{--                <li class="breadcrumb-item active"><a href="{{route('manageasset')}}">Manage Asset </a></li>--}}
                <li class="breadcrumb-item active">Categories</li>
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
                             <a href="{{route('admin.categ_add')}}" class="btn btn-primary pull-right rounded-pill">Add Category</a>
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
                                <th>Category Name</th>
                                <th>Category Image</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($categ as $m => $mv)
                                <tr>
                                    <td>
                                        <center>{{$m +1}}</center>
                                    </td>
                                    <td>
                                        @if($mv->parent_id == 0)
                                            {{$mv->categ_name}}
                                        @else
                                            {{\App\Models\Category::whereId($mv->parent_id)->value('categ_name')}}
                                            | {{$mv->categ_name}}
                                        @endif
                                    </td>
                                    <td>
                                        @if($mv->image != '')
                                            <img src="/images/categories/{{$mv->image}}">
                                        @endif
                                    </td>
                                    <td width="6%">

                                        <a href="{{ route('admin.categ_edit', $mv->id) }}"
                                           class="p-2">
                                            <span class="mdi mdi-pencil"></span>
                                        </a>
                                        @if($mv->id != 1 && $mv->id != 2)
                                        <a href="#"
                                           class="p-2 delete-record-click"
                                           data-id="{{ $mv->id }}">
                                            <span class="mdi mdi-delete"></span>
                                        </a>
                                            @endif

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
                // "scrollX": true
            });
        });
        $('.delete-record-click').click(function () {
            var id = $(this).data("id");

            swal({
                    title: "Are you sure? ",
                    text: "You will not be able to recover this record!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes, delete it!",
                    closeOnConfirm: false
                },
                function (isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            url: "/admin/category-delete",
                            type: "get",
                            data: {
                                "id": id
                            },
                            success: function (result) {
                                // alert(result);
                                if (result == 'error') {
                                    swal({
                                        title: "Category cannot be deleted as products are listed under it!",
                                        type: "warning",
                                        showCancelButton: true,
                                        showConfirmButton: false,
                                    }, function () {
                                        location.reload();
                                    });
                                } else {
                                    swal({
                                        title: "Category has been deleted!",
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
    </script>
@endsection
