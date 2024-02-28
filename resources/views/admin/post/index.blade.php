@extends('admin.layouts.app')
@push('styles')
@endpush
@section('content')
<div class="page-header ">
    <h3 class="page-title ">
        <span class="page-title-icon bg-gradient-primary text-white mr-2 ">
            <i class="mdi mdi-home "></i>
        </span>&nbsp; المنشورات
    </h3>
    <button style="margin-right:150px;font-size:15px" type="button " class="btn btn-outline-light btn-lg" data-toggle="modal" data-target="#add">أضافة منشور</button>
</div>
<div class="row ">
    <div class="col-12 grid-margin ">
        <div class="card ">
            <div class="card-body ">
                <h4 class="card-title ">المنشورات</h4>
                <div class="table-responsive ">
                    <table class="table" id="datatableid">
                        <thead>
                            <tr>
                                <th> رقم المنشور </th>
                                <th> اسم المنشور </th>
                                <th> تاريخ المنشور</th>
                                <th>القسم</th>
                                <th>لوحة التحكم</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($posts as $post)
                                <tr>
                                    <td>{{$post->id}}</td>
                                    <td>{{$post->post_name}}</td>
                                    <td>{{$post->time_ago}}</td>
                                    <td>{{$post->category->category_name}} <br><br> {{$post->category->mparent  ? $post->category->mparent->category_name : ''}} </td>
                                    <td>
                                        <a href="{{aurl('posts/show/'.$post->id.'')}}" class="btn btn-outline-secondary btn-sm">التفاصيل</a>
                                        <button type="button " class="btn btn-outline-success btn-sm edit_post"
                                        data-id="{{$post->id}}" data-title="{{$post->post_name}}"
                                        data-description="{{$post->post_description}}"
                                        >تعديل</button>
                                        <button type="button " class="btn btn-outline-danger btn-sm delete_post" data-id="{{$post->id}}">حذف</button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5"> لا يوجد منشورات</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="addlabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h2 class="text-light">اضافة منشور</h2>
            </div>
            <form class="float-right" action="{{aurl('posts/store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group ">
                        <h4>اسم المنشور</h4>
                        <input type="text" name="title" placeholder=" اسم المنشور " required class="form-control inputName ">
                    </div>
                    <div class="form-group ">
                        <h4>تفاصيل المنشور</h4>
                        <textarea class="form-control" placeholder="تفاصيل المنشور" name="description" style="height: 150px;"></textarea>
                    </div>
                    <div class="form-group ">
                        <h4>القسم</h4>
                        <select name="category_id" class="form-control inputName " required>
                            @foreach ($maincategories as $c)
                                <option class="text-primary" value="{{$c->id}}">  {{$c->category_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <h4>اختر صورة</h4>
                        <div class="form-group ">
                            <input type="file" class="file-upload-default" name="files[]" multiple/>
                            <div class="input-group col-xs-12" style="background-color: #fff;">
                                <input type="text" class="form-control file-upload-info" disabled placeholder="تحميل صورة">
                                <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-info" type="button" style="border-radius: 0;">تحميل</button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <h4>التعليقات</h4>
                        <div class="form-check">
                            <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="allow_comment" id="optionsRadios1" value="1"> تفعيل التعليقات <i class="input-helper"></i></label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="allow_comment" id="optionsRadios2" value="0" > الغاء تفعيل التعليقات <i class="input-helper"></i></label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit " class="btn btn-info" name="add">اضافة المنشور</button>
                    <button type="button " class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="remove" tabindex="-1" aria-labelledby="removeLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h2 class="text-light">حذف منشور</h2>
            </div>
            <form action="{{aurl('posts/delete')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <h3 class="text-center">هل تريد حذف هذا المنشور</h3>
                </div>
                <div class="modal-footer">
                    <input type="hidden" value="" name="article_id" id="article_id_1">
                    <button type="submit" class="btn btn-danger" name="remove">حذف</button>
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
                <h2 class="text-light">تعديل منشور</h2>
            </div>
            <form class="float-right" action="{{aurl('posts/update')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group ">
                        <h4>اسم المنشور</h4>
                        <input type="text" name="title" id="article_name" placeholder=" اسم المنشور" class="form-control inputName " required>
                    </div>
                    <div class="form-group ">
                        <h4>تفاصيل المنشور</h4>
                        <textarea class="form-control" name="description" id="article_description" name="description" style="height: 150px;" required></textarea>
                    </div>
                    <div class="form-group mb-3">
                        <h4>اختر صورة</h4>
                        <div class="form-group ">
                            <input type="file" class="file-upload-default" name="files[]" multiple/>
                            <div class="input-group col-xs-12" style="background-color: #fff;">
                                <input type="text" class="form-control file-upload-info" disabled placeholder="تحميل صورة">
                                <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-info" type="button" style="border-radius: 0;">تحميل</button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <h4>التعليقات</h4>
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
                    <button type="submit " class="btn btn-success" name="edit">تعديل المنشور</button>
                    <input type="hidden" value="" name="article_id" id="article_id_2">
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
        $(".delete_post").click(function() {
            var id = $(this).attr('data-id');
            $("#article_id_1").val(id);
            $("#remove").modal('toggle');
        });
        $(".edit_post").click(function() {
            var id          = $(this).attr('data-id');
            var title       = $(this).attr('data-title');
            var description = $(this).attr('data-description');
            $("#article_id_2").val(id);
            $("#article_name").val(title);
            $("#article_description").text(description);
            $("#edit").modal('toggle');
        });
    });
</script>
@endpush
