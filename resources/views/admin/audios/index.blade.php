@extends('admin.layouts.app')
@push('styles')
@endpush
@section('content')
<div class="page-header ">
    <h3 class="page-title ">
        <span class="page-title-icon bg-gradient-primary text-white mr-2 ">
            <i class="mdi mdi-home "></i>
        </span>&nbsp; الصوتيات
    </h3>
    <div class="">
        <button  type="button " class="btn btn-primary btn-lg" data-toggle="modal" data-target="#add">أضافة ملف صوتي</button>
    </div>
</div>
<div class="row ">
    <div class="col-12 grid-margin ">
        <div class="card ">
            <div class="card-body ">
                <h4 class="card-title ">أخر الملفات الصوتية</h4>
                <div class="table-responsive ">
                    <table class="table" id="datatableid">
                        <thead>
                            <tr>
                                <th> رقم الملف </th>
                                <th> اسم الملف الصوتي </th>
                                <th>الحالة</th>
                                <th>تاريخ الاضافة</th>
                                <th> القسم</th>
                                <th>لوحة التحكم</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($audios as $audio)
                                <tr>
                                    <td>{{$audio->id}}</td>
                                    <td>{{$audio->audio_name}}</td>
                                    <td>
                                        <label class="badge badge-gradient-primary"> مفعل</label>
                                    </td>
                                    <td>{{$audio->time_ago}}</td>
                                    <td>{{$audio->category->category_name}} <br><br> {{$audio->category->mparent  ? $audio->category->mparent->category_name : ''}} </td>
                                    <td>
                                        <button type="button " class="btn btn-outline-success btn-sm edit_audio"
                                        data-title="{{$audio->audio_name}}" data-description="{{$audio->description}}"
                                        data-id="{{$audio->id}}" >تعديل</button>
                                        <button type="button " class="btn btn-outline-danger btn-sm delete_audio" data-id="{{$audio->id}}">حذف</button>
                                        @if ($audio->status == 0)
                                            <button type="button " class="btn btn-outline-primary btn-sm activiate_lesson" data-id="{{$audio->id}}">تفعيل</button>
                                        @else
                                            <button type="button " class="btn btn-outline-dark btn-sm not_activiate_lesson" data-id="{{$audio->id}}">الغاء التفعيل</button>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5"> لا يوجد صوتيات</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- REMOVE --}}
<div class="modal fade" id="remove" tabindex="-1" aria-labelledby="removeLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h2 class="text-light">حذف الملف </h2>
            </div>
            <form action="{{aurl('audios/delete')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <h3 class="text-center">هل تريد حذف هذا الملف</h3>
                </div>
                <div class="modal-footer">
                    <input type="hidden" value="" name="audio_id" id="audio_id_1">
                    <button type="submit" class="btn btn-danger delete-audio" name="remove">حذف</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{--ACTIVATE --}}
<div class="modal fade" id="activiate" tabindex="-1" aria-labelledby="removeLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h2 class="text-light">تفعيل الملف الصوتي </h2>
            </div>
            <form action="{{aurl('audios/activate')}}" method="post">
                @csrf
                <div class="modal-body">
                    <h3 class="text-center">هل تريد تفعيل هذا الملف</h3>
                </div>
                <div class="modal-footer">
                    <input type="hidden" value="" name="audio_id" id="audio_id_3">
                    <button type="submit" class="btn btn-primary" name="activiate">تفعيل</button>
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
                <h2 class="text-light">تعديل الملف </h2>
            </div>
            <form class="float-right" action="{{aurl('audios/update')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body main_edit">
                    <div class="form-group ">
                        <h4>اسم الملف الصوتي</h4>
                        <input type="text" name="title" id="audio_name" placeholder=" اسم الملف الصوتي" class="form-control inputName " required>
                    </div>
                    <div class="form-group ">
                        <h4>تفاصيل الملف الصوتي</h4>
                        <textarea class="form-control" name="description" id="audio_description" name="description" style="min-height: 150px;"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit " class="btn btn-success " name="edit">تعديل الملف</button>
                    <input type="hidden" value="" name="audio_id" id="audio_id_2">
                    <button type="button " class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- DEACTIVATE --}}
<div class="modal fade" id="not_activiate" tabindex="-1" aria-labelledby="removeLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h2 class="text-light">الغاء تفعيل الملف</h2>
            </div>
            <form action="{{aurl('audios/notactivate')}}" method="post">
                @csrf
                <div class="modal-body">
                    <h3 class="text-center">هل تريد الغاء اظهار الملف </h3>
                </div>
                <div class="modal-footer">
                    <input type="hidden" value="" name="audio_id" id="audio_id_4">
                    <button type="submit" class="btn btn-dark" name="not_activiate">الغاء التفعيل</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- ADD --}}
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="addlabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h2 class="text-light">اضافة ملف صوتي </h2>
            </div>
            <form class="float-right" action="{{aurl('audios/store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                        <div class="form-group ">
                            <h4>عنوان الملف الصوتي</h4>
                            <input type="text" name="title" placeholder="اسم الدرس" class="form-control" required>
                        </div>
                        <div class="form-group ">
                            <h4>وصف الملف الصوتي</h4>
                            <textarea name="description" class="form-control" style="min-height: 100px;"></textarea>
                        </div>
                        <div class="form-group ">
                            <h4>الملف الصوتي</h4>
                            <input type="file" class="file-upload-default" name="audio" required/>
                            <div class="input-group col-xs-12" style="background-color: #fff;">
                                <input type="text" class="form-control file-upload-info" disabled placeholder="تحميل الملف">
                                <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-gradient-primary" type="button" style="border-radius: 0;">تحميل</button>
                                </span>
                            </div>
                        </div>
                        <div class="form-group ">
                            <h4>القسم</h4>
                            <select name="category_id" class="form-control">
                                @foreach ($maincategories as $c)
                                    <option class="text-primary" value="{{$c->id}}">  {{$c->category_name}}</option>
                                @endforeach
                            </select>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit " class="btn btn-info" name="add">اضافة ملف صوتي</button>
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
        $(".delete_audio").click(function() {
            var id = $(this).attr('data-id');
            $("#audio_id_1").val(id);
            $("#remove").modal('toggle');
        });
        $(".not_activiate_lesson").click(function() {
            var id = $(this).attr('data-id');
            $("#audio_id_4").val(id);
            $("#not_activiate").modal('toggle');
        });
        $(".activiate_lesson").click(function() {
            var id = $(this).attr('data-id');
            $("#audio_id_3").val(id);
            $("#activiate").modal('toggle');
        });
        $(".edit_audio").click(function() {
            var id          = $(this).attr('data-id');
            var title       = $(this).attr('data-title');
            var description = $(this).attr('data-description');
            $("#audio_id_2").val(id);
            $("#audio_name").val(title);
            $("#audio_description").text(description);
            $("#edit").modal('toggle');
        });
    });
</script>
@endpush

