@extends('admin.layouts.app')
@push('styles')
@endpush
@section('content')
<div class="page-header ">
    <h3 class="page-title ">
        <span class="page-title-icon bg-gradient-primary text-white mr-2 ">
            <i class="mdi mdi-home "></i>
        </span>&nbsp; المهام
    </h3>
    <button style="margin-right:150px; font-size:15px" type="button " class="btn btn-primary btn-lg" data-toggle="modal" data-target="#add">أضافة مهمة</button>
</div>
<div class="row ">
    <div class="col-12 grid-margin ">
        <div class="card ">
            <div class="card-body ">
                <h4 class="card-title ">المهام</h4>
                <div class="table-responsive ">
                    <table class="table" id="datatableid">
                        <thead>
                            <tr>
                                <th> رقم المهمة </th>
                                <th> اسم المهمة </th>
                                <th> تاريخ المهمة </th>
                                <th> ميعاد المهمة </th>
                                <th>القسم</th>
                                <th>لوحة التحكم</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($events as $event)
                                <tr>
                                    <td>{{$event->id}}</td>
                                    <td>{{$event->events_name}}</td>
                                    <td> {{$event->events_date}}</td>
                                    <td>{{$event->events_time}}</td>
                                    <td>{{$event->category->category_name}} <br><br> {{$event->category->mparent  ? $event->category->mparent->category_name : ''}}</td>
                                    <td>
                                        <button type="button " class="btn btn-outline-success btn-sm edit_event"
                                        data-id="{{$event->id}}" data-title="{{$event->events_name}}"
                                        data-description="{{$event->events_description}}" data-date="{{$event->events_date}}"
                                        data-time="{{$event->events_time}}"                                        >تعديل</button>
                                        <button type="button " class="btn btn-outline-danger btn-sm delete_event" data-id="{{$event->id}}">حذف</button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">لا يوجد مهام</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- ADD --}}
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="addlabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h2 class="text-light">اضافة مهمة</h2>
            </div>
            <form class="float-right" action="{{aurl('events/store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group ">
                        <h4>اسم المهمة</h4>
                        <input type="text" name="name" placeholder=" اسم المهمة " required class="form-control inputName ">
                    </div>
                    <div class="form-group ">
                        <h4>تفاصيل المهمة</h4>
                        <textarea class="form-control" placeholder="تفاصيل  المهمة" name="description" style="height: 150px;"></textarea>
                    </div>
                    <div class="form-group">
                        <h4>تاريخ المهمة</h4>
                        <input type="date" name="date" placeholder="تاريخ المهمة" required class="form-control inputName ">
                    </div>
                    <div class="form-group">
                        <h4>ميعاد المهمة</h4>
                        <input type="time" name="time" placeholder="ميعاد المهمة" required class="form-control inputName ">
                    </div>
                    <div class="form-group ">
                        <h4>القسم</h4>
                        <select class="custom-select form-control" name="category_id">
                                @foreach ($maincategories as $c)
                                <option class="text-primary" value="{{$c->id}}"> {{$c->category_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit " class="btn btn-info" name="add">اضافة مهمة</button>
                    <button type="button " class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- REMOVE --}}
<div class="modal fade" id="remove" tabindex="-1" aria-labelledby="removeLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h2 class="text-light">حذف المهمة</h2>
            </div>
            <form action="{{aurl('events/delete')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <h3 class="text-center">هل تريد حذف هذة المهمة</h3>
                </div>
                <div class="modal-footer">
                    <input type="hidden" value="" name="event_id" id="eventid_2">
                    <button type="submit" class="btn btn-danger" name="remove">حذف</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- UPDATE --}}
<div class="modal fade" id="edit" tabindex="-1" aria-labelledby="editLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h2 class="text-light">تعديل المهمة</h2>
            </div>
            <form class="float-right" action="{{aurl('events/update')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group ">
                        <h4>اسم المهمة</h4>
                        <input type="text" name="name" id="event_name" placeholder=" اسم المهمة" class="form-control inputName " required>
                    </div>
                    <div class="form-group ">
                        <h4>تفاصيل المهمة</h4>
                        <textarea class="form-control" name="description" id="event_description" style="height: 150px;" ></textarea>
                    </div>

                    <div class="form-group">
                        <h4>تاريخ المهمة</h4>
                        <input type="date" name="date" id="event_date" placeholder="تاريخ المهمة"  class="form-control inputName ">
                    </div>

                    <div class="form-group">
                        <h4>ميعاد المهمة</h4>
                        <input type="time" name="time" id="event_time" placeholder="ميعاد المهمة" class="form-control inputName ">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit " class="btn btn-success" name="edit">تعديل المهمة</button>
                    <input type="hidden" value="" name="event_id" id="eventid_3">
                    <button type="button " class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="{{asset('admin_files')}}//js/file-upload.js"></script>
<script>
    $(document).ready(function() {
        $(".delete_event").click(function() {
            var id = $(this).attr('data-id');
            $("#eventid_2").val(id);
            $("#remove").modal('toggle');
        });
        $(".edit_event").click(function() {
            var id          = $(this).attr('data-id');
            var title       = $(this).attr('data-title');
            var description = $(this).attr('data-description');
            var date        = $(this).attr('data-date');
            var time        = $(this).attr('data-time');
            $("#eventid_3").val(id);
            $("#event_name").val(title);
            $("#event_date").val(title);
            $("#event_time").val(title);
            $("#event_description").text(description);
            $("#edit").modal('toggle');
        });
    });
</script>
@endpush
