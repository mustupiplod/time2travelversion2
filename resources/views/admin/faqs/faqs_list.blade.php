@extends('Admin.layout.master')

@push('plugin-styles')
<style type="text/css">

</style>
@endpush

@section('content')
    <div class="breadcrumb-holder">
        <div class="container-fluid">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dash')}}">Dashboard</a></li>
                {{--                <li class="breadcrumb-item active"><a href="{{route('manageasset')}}">Manage Asset </a></li>--}}
                <li class="breadcrumb-item active">FAQs List</li>
            </ul>
        </div>
    </div>

    <header>
        <div class="row">
            <div class="col-md-7">
                {{--                        <h2 class="h3 display">Work Order Of <u>{{$asset_name->Name}}</u></h2>--}}
            </div>
            <div class="col-md-5">
                <a href="{{route('admin.add_faq')}}" class="btn btn-primary pull-right rounded-pill">Add FAQ</a>
            </div>
        </div>

    </header>
    <br>

    <section>
        <div class="container-fluid">

            <div class="card">
                <div class="card-body p-4">
                    <div class="table-responsive">
                      @if(isset($list) && !empty($list))
                      <table id="quest_list" class="table table-bordered">
                        <tbody>
                          @foreach ($list as $key => $l)
                            <tr>
                                <td>
                                    <div class="title_holder">
                                        <span class="action_buttons"><a class="btn btn-primary" data-bs-toggle="collapse" href="#collapse_{{$l->id}}" role="button" aria-expanded="false" aria-controls="collapse_{{$l->id}}">{{$l->title}} </a></span>
                                        <span class="actions" style="float-right !important;">
                                            <a href="{{ route('admin.edit_faq', [$l->id] ) }}" class="p-2 edit-record-click"><i class="mdi mdi-table-edit"></i></a>
                                            <a href="#" class="p-2 delete-record-click" data-id="{{$l->id}}"><i class="mdi mdi-delete"></i></a>
                                        </span>
                                    </div>
                                    <div class="collapse" id="collapse_{{$l->id}}">
                                      <div class="row mt-2">
                                        <div class="col-lg-12 text-wrap">
                                            {!! $l->details !!}
                                        </div>
                                      </div>
                                    </div>
                                </td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                      @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('plugin-scripts')
@endpush

@push('custom-scripts')
@endpush

@section('custom-jquery')
<meta name="csrf-token" content="{{ csrf_token() }}">
  <script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
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
                                url: "/admin/faq-delete",
                                type: "post",
                                data: {
                                    "id": id
                                },
                                success: function (result) {

                                    if (result == 'error')
                                    {
                                        swal({
                                            title: "Error in deleting FAQ!",
                                            type: "warning",
                                            showCancelButton: true,
                                            showConfirmButton: false,
                                        }, function () {
                                            location.reload();
                                        });
                                    }
                                    else
                                    {
                                        swal({
                                            title: "FAQ has been deleted!",
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
