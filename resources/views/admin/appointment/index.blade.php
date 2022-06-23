@extends('layouts.admin')
@section('content')
@can('product_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success add-value" href="#">
                Add Schedule
            </a>
        </div>
        
    </div>
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success set-time" href="#">
                Set Time
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        Schedule list
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <div>
            <input class="form-control form-control-navbar" type="search" name="search" placeholder="Search..." id="myInput" style="width: 100%;max-width: 90%; margin: auto;border-right-width: 1px;padding: 1.25rem;">
            </div>
            <table class="table table-bordered table-striped table-hover datatable">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            Date
                        </th>
                        <th>
                            Schedule Time
                        </th>

                        <th>
                            Name
                        </th>
                        <th>
                            Comment
                        </th>
                    
                        <th>
                           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $data)
                        <tr data-entry-id="{{ $data->id }}">
                            <td>

                            </td>
                            <td>
                                {{$data->date}}
                            </td>
                            <td>
                                {{$data->time}}
                            </td>
                            <td>
                                {{ $data->name }}
                            </td>
                            <td>
                                {{ $data->comment }}
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="set-time-form" style="display: none;">
   <a class="close-time" href="#">X</a>
    <form action="{{ route("admin.appointment.storeData") }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
                <label>Date</label>
                <input type="date" name="date" class="form-control" value="">
            </div>
            <div class="form-group">
                <label>Time Set</label>
                <input type="text" name="time" class="form-control" value="">
            </div>
            <input class="btn btn-danger ajax" type="submit" value="{{ trans('global.save') }}" style="float: right;margin-top: -7px;">
    </form>
</div>

@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
        $(".datatable tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
    
    $('.close-time').click(function(){
        $('.set-time-form').hide();
    });
    // $('.ajax').submit(function(e) {
    //     e.preventDefault();
    //     $.ajax({
    //         url: "{{ route('admin.appointment.storeData')}}",
    //         type: "post",
    //         data: { id : $(this).val() },
    //         success: function(data){
    //             $("#employees").html(data);
    //         }
    //     });
    // })
});
</script>