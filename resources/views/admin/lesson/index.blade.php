@extends('admin.layouts.app')
@push('styles')

@endpush
@section('content')
<div class="page-header">
    <h3 class="page-title ">
        <span class="page-title-icon bg-gradient-primary text-white mr-2 ">
            <i class="mdi mdi-home "></i>
        </span>&nbsp; الدروس
    </h3>
    <div class="">
        <button style="font-size:15px " type="button " class="btn btn-primary btn-lg" data-toggle="modal" data-target="#add">أضافة درس</button>
        <button style="font-size:15px " type="button " class="btn btn-primary btn-lg" data-toggle="modal" data-target="#add2">أضافة درس يوتيوب</button>
    </div>
</div>
<div class="row ">
    <div class="col-12 grid-margin ">
        <div class="card ">
            <div class="card-body ">
                <h4 class="card-title ">أخر الدروس</h4>
                <div class="table-responsive ">
                    <table class="table" id="datatableid">
                        <thead>
                            <tr>
                                <th> رقم الدرس </th>
                                <th> اسم الدرس </th>
                                <th> ملفات الدرس</th>
                                <th>النوع</th>
                                <th>تاريخ الاضافة</th>
                                <th> القسم</th>
                                <th>لوحة التحكم</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($lessons as $lesson)
                                <tr>
                                    <td> {{$lesson->id}} </td>
                                    <td> {{$lesson->lesson_name}} </td>
                                    <td>
                                        @if ($lesson->pdf)
                                            <a href="{{$lesson->pdf}}"><label class="badge badge-gradient-success">يوجد</label></a>
                                        @else
                                            <label class="badge badge-gradient-warning">لا يوجد</label>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($lesson->video_name)
                                            <label class="badge badge-gradient-danger">يوتيوب</label>
                                        @else
                                            <a href="{{$lesson->video}}"><label class="badge badge-gradient-success">علي المنصة</label></a>
                                        @endif
                                    </td>
                                    <td> {{$lesson->time_ago}} <br><br> {{$lesson->created_at}}</td>
                                    <td> {{$lesson->category->category_name}} <br><br> {{$lesson->category->mparent  ? $lesson->category->mparent->category_name : ''}} </td>
                                    <td>
                                        <a href="{{aurl('lessons/show/'.$lesson->id)}}" class="btn btn-outline-light btn-sm">تفاصيل</a>
                                        <button type="button " class="btn btn-outline-success btn-sm lesson_edit"
                                        data-id="{{$lesson->id}}" data-name="{{$lesson->lesson_name}}"
                                        data-description="{{$lesson->lesson_description}}"
                                        >تعديل</button>
                                        <button type="button " class="btn btn-outline-danger btn-sm lesson_delete" data-id="{{$lesson->id}}">حذف</button>
                                        @if ($lesson->status == 0)
                                            <button type="button " class="btn btn-outline-primary btn-sm activiate_lesson" data-id="{{$lesson->id}}">تفعيل</button>
                                        @else
                                            <button type="button " class="btn btn-outline-secondary btn-sm not_activiate_lesson" data-id="{{$lesson->id}}">الغاء التفعيل</button>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7"> لا يوجد دروس بعد </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="remove" tabindex="-1" aria-labelledby="removeLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h2 class="text-light">حذف الدرس </h2>
            </div>
            <form action="{{aurl('lessons/delete')}}" method="post">
                @csrf
                <div class="modal-body">
                    <h3 class="text-center">هل تريد حذف هذا الدرس</h3>
                </div>
                <div class="modal-footer">
                    <input type="hidden" value="" name="lesson_id" id="lesson_id_1">
                    <button type="submit" class="btn btn-danger" name="remove">حذف</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="activiate" tabindex="-1" aria-labelledby="removeLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h2 class="text-light">تفعيل الدرس </h2>
            </div>
            <form action="{{aurl('lessons/activate')}}" method="post">
                @csrf
                <div class="modal-body">
                    <h3 class="text-center">هل تريد تفعيل هذا الدرس</h3>
                </div>
                <div class="modal-footer">
                    <input type="hidden" value="" name="lesson_id" id="lesson_id_2">
                    <button type="submit" class="btn btn-primary" name="activiate">تفعيل</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="edit" tabindex="-1" aria-labelledby="editLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h2 class="text-light">تعديل الدرس </h2>
            </div>
            <form class="float-right" action="{{aurl('lessons/update')}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group ">
                        <h4>عنوان الدرس</h4>
                        <input type="text" name="name" id="article_name" placeholder="اسم الدرس" class="form-control" required>
                    </div>
                    <div class="form-group ">
                        <h4>وصف الدرس</h4>
                        <textarea name="description" class="form-control" id="article_description" style="min-height: 100px;"></textarea>
                    </div>
                    <div class="form-group ">
                        <h4> اظهار الدرس بدون امتحان</h4>
                        <div class="form-check">
                            <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="allow_exam" id="optionsRadios1" value="0" checked> اظهار بدون امتحان <i class="input-helper"></i></label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="allow_exam" id="optionsRadios2" value="1" > اظهار بامتحان <i class="input-helper"></i></label>
                        </div>
                    </div>
                    <div class="form-group ">
                        <h4> اظهار التعليقات</h4>
                        <div class="form-check">
                            <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="allow_comment" id="optionsRadios1" value="1" checked> تفعيل التعليقات <i class="input-helper"></i></label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="allow_comment" id="optionsRadios2" value="0" > الغاء تفعيل التعليقات <i class="input-helper"></i></label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit " class="btn btn-success" name="edit">تعديل الدرس</button>
                    <input type="hidden" value="" name="lesson_id" id="lesson_id_4">
                    <button type="button " class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="not_activiate" tabindex="-1" aria-labelledby="removeLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h2 class="text-light">الغاء تفعيل الدرس</h2>
            </div>
            <form action="{{aurl('lessons/not_activiate')}}" method="post">
                @csrf
                <div class="modal-body">
                    <h3 class="text-center">هل تريد الغاء اظهار الدرس </h3>
                </div>
                <div class="modal-footer">
                    <input type="hidden" value="" name="lesson_id" id="lesson_id_3">
                    <button type="submit" class="btn btn-dark" name="not_activiate">الغاء التفعيل</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="addlabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h2 class="text-light">اضافة درس </h2>
            </div>
            <form class="float-right" action="{{aurl('lessons/store')}}" id="fileUploadForm"  method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group ">
                        <h4>عنوان الدرس</h4>
                        <input type="text" name="name" placeholder="اسم الدرس" class="form-control" required>
                    </div>
                    <div class="form-group ">
                        <h4>وصف الدرس</h4>
                        <textarea name="description" class="form-control" style="min-height: 100px;"></textarea>
                    </div>
                    <div class="form-group ">
                        <h4>الفيديو</h4>
                        <input type="file" class="file-upload-default" name="video" accept="video/*" required="">
                        <div class="input-group col-xs-12" style="background-color: #fff;">
                            <input type="text" class="form-control file-upload-info" disabled="" placeholder="تحميل فيديو">
                            <span class="input-group-append">
                                <button class="file-upload-browse btn btn-gradient-primary" type="button" style="border-radius: 0;">تحميل</button>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                        </div>
                    </div>
                    <div class="form-group ">
                        <h4>اضافة صورة مصغرة</h4>
                        <input type="file" class="file-upload-default" name="imagethumb" accept="image/*"/>
                        <div class="input-group col-xs-12" style="background-color: #fff;">
                            <input type="text" class="form-control file-upload-info"  disabled placeholder="تحميل ملف">
                            <span class="input-group-append">
                                <button class="file-upload-browse btn btn-gradient-primary" type="button" style="border-radius: 0;">تحميل</button>
                            </span>
                        </div>
                    </div>
                    <div class="form-group ">
                        <h4>ورق الشرح</h4>
                        <input type="file" class="file-upload-default" name="file" />
                        <div class="input-group col-xs-12" style="background-color: #fff;">
                            <input type="text" class="form-control file-upload-info" disabled placeholder="تحميل ملف">
                            <span class="input-group-append">
                                <button class="file-upload-browse btn btn-gradient-primary" type="button" style="border-radius: 0;">تحميل</button>
                            </span>
                        </div>
                    </div>
                    <div class="form-group ">
                        <h4>القسم</h4>
                        <select name="category_id" class="form-control inputName " required>
                            @foreach ($maincategories as $c)
                                <option class="text-primary" disabled> كل {{$c->category_name}}</option>
                                @foreach ($c->subCategories as $p)
                                    <option value="{{$p->id}}">--- {{$p->category_name}}</option>
                                @endforeach
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group ">
                        <h4> اظهار الدرس بدون امتحان</h4>
                        <div class="form-check">
                            <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="allow_exam" id="optionsRadios1" value="0" checked> اظهار بدون امتحان <i class="input-helper"></i></label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="allow_exam" id="optionsRadios2" value="1" > اظهار بامتحان <i class="input-helper"></i></label>
                        </div>
                    </div>
                    <div class="form-group ">
                        <h4> اظهار التعليقات</h4>
                        <div class="form-check">
                            <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="allow_comment" id="optionsRadios1" value="1" checked> تفعيل التعليقات <i class="input-helper"></i></label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="allow_comment" id="optionsRadios2" value="0" > الغاء تفعيل التعليقات <i class="input-helper"></i></label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit " class="btn btn-info" name="add">اضافة درس</button>
                    <button type="button " class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="add2" tabindex="-1" role="dialog" aria-labelledby="addlabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h2 class="text-light">اضافة درس </h2>
            </div>
            <form class="float-right" action="{{aurl('lessons/store2')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group ">
                        <h4>عنوان الدرس</h4>
                        <input type="text" name="name" placeholder="اسم الدرس" class="form-control" required>
                    </div>
                    <div class="form-group ">
                        <h4>وصف الدرس</h4>
                        <textarea name="description" class="form-control" style="min-height: 100px;"></textarea>
                    </div>
                    <div class="form-group ">
                        <h4>لنك الفيديو</h4>
                        <textarea name="link" class="form-control" style="min-height: 100px;" reqired></textarea>
                    </div>
                    <div class="form-group ">
                        <h4>ورق الشرح</h4>
                        <input type="file" class="file-upload-default" name="video" />
                        <div class="input-group col-xs-12" style="background-color: #fff;">
                            <input type="text" class="form-control file-upload-info" disabled placeholder="تحميل فيديو">
                            <span class="input-group-append">
                                <button class="file-upload-browse btn btn-gradient-primary" type="button" style="border-radius: 0;">تحميل</button>
                            </span>
                        </div>
                    </div>
                    <div class="form-group ">
                        <h4>القسم</h4>
                        <select name="category_id" class="form-control inputName " required>
                            @foreach ($maincategories as $c)
                                <option class="text-primary" disabled> كل {{$c->category_name}}</option>
                                @foreach ($c->subCategories as $p)
                                    <option value="{{$p->id}}">--- {{$p->category_name}}</option>
                                @endforeach
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group ">
                        <h4> اظهار الدرس بدون امتحان</h4>
                        <div class="form-check">
                            <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="allow_exam" id="optionsRadios1" value="0" checked> اظهار بدون امتحان <i class="input-helper"></i></label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="allow_exam" id="optionsRadios2" value="1" > اظهار بامتحان <i class="input-helper"></i></label>
                        </div>
                    </div>
                    <div class="form-group ">
                        <h4> اظهار التعليقات</h4>
                        <div class="form-check">
                            <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="allow_comment" id="optionsRadios1" value="1" checked> تفعيل التعليقات <i class="input-helper"></i></label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="allow_comment" id="optionsRadios2" value="0" > الغاء تفعيل التعليقات <i class="input-helper"></i></label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit " class="btn btn-info" name="add2">اضافة درس</button>
                    <button type="button " class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="{{asset('admin_files')}}//js/file-upload.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>
<script>
    $(function () {
        $(document).ready(function () {
            $('#fileUploadForm').ajaxForm({
                beforeSend: function () {
                    var percentage = '0';
                },
                uploadProgress: function (event, position, total, percentComplete) {
                    var percentage = percentComplete;
                    $('.progress .progress-bar').css("width", percentage+'%', function() {
                        return $(this).attr("aria-valuenow", percentage) + "%";
                    })
                },
                complete: function (xhr) {
                    window.location.replace("{{aurl('relodBack')}}");
                }
            });

        });
    });
</script>
<script>
    $(document).ready(function() {
        $(".lesson_delete").click(function() {
            var id = $(this).attr('data-id');
            $("#lesson_id_1").val(id);
            $("#remove").modal('toggle');
        });
        $(".activiate_lesson").click(function() {
            var id = $(this).attr('data-id');
            $("#lesson_id_2").val(id);
            $("#activiate").modal('toggle');
        });
        $(".not_activiate_lesson").click(function() {
            var id = $(this).attr('data-id');
            $("#lesson_id_3").val(id);
            $("#not_activiate").modal('toggle');
        });
        $(".lesson_edit").click(function() {
            var id          = $(this).attr('data-id');
            var name       = $(this).attr('data-name');
            var description = $(this).attr('data-description');
            $("#lesson_id_4").val(id);
            $("#article_name").val(name);
            $("#article_description").text(description);
            $("#edit").modal('toggle');
        });
    });
</script>
@endpush
