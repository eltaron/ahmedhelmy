@extends('admin.layouts.app')
@push('styles')
@endpush
@section('content')
<div class="page-header ">
    <h3 class="page-title ">
        <span class="page-title-icon bg-gradient-primary text-white mr-2 ">
            <i class="mdi mdi-home "></i>
        </span>&nbsp; الأقسام
    </h3>
    <button style="margin-right:150px;font-size:15px" type="button " class="btn btn-primary btn-lg" data-toggle="modal" data-target="#add">أضافة قسم</button>
</div>
<div class="row ">
    <div class="col-12 grid-margin ">
        <div class="card ">
            <div class="card-body ">
                <h4 class="card-title ">الأقسام</h4>
                <div class="table-responsive ">
                    <table class="table" id="datatableid">
                        <thead>
                            <tr>
                                <th>رقم القسم</th>
                                <th>اسم القسم</th>
                                <th>تفاصيل القسم</th>
                                <th> القسم الرئيسي</th>
                                <th>لوحة التحكم</th>
                            </tr>
                        </thead>
                        <tbody>
                                @foreach ($categories as $c)
                                    <tr>
                                        <td> {{$c->id}} </td>
                                        <td> {{$c->category_name}} </td>
                                        <td> {{$c->category_description}} </td>
                                        <td> {{$c->mparent ? $c->mparent->category_name : "قسم رئيسي"}} <td>
                                            @if ($c->parent == 0)
                                                <a href="{{aurl('categories/show/'.$c->id.'')}}" class="btn btn-outline-secondary btn-sm">التفاصيل</a>
                                            @endif
                                            <button type="button" class="btn btn-outline-success btn-sm edit_cat" data-name="{{$c->category_name}}" data-description="{{$c->category_description}}" data-id="{{$c->id}}">تعديل</button>
                                            <button type="button" class="btn btn-outline-danger btn-sm delete_cat" data-id="{{$c->id}}">حذف</button>
                                            @if ($c->Visibility == 0)
                                                <button type="button " class="btn btn-outline-primary btn-sm activiate" data-id="{{$c->id}}">تفعيل</button>
                                            @else
                                                <button type="button " class="btn btn-outline-light btn-sm not_activiate" data-id="{{$c->id}}">الغاء التفعيل</button>
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
</div>
<div class="modal fade" id="delete_cat" tabindex="-1" aria-labelledby="removeLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h2 class="text-light">حذف قسم </h2>
            </div>
            <form action="{{aurl('categories/delete')}}" method="post">
                @csrf
                <div class="modal-body">
                    <h3 class="text-center">هل تريد حذف هذا القسم</h3>
                </div>
                <div class="modal-footer">
                    <input type="hidden" value="" name="cat_id" id="cat_id_3">
                    <button type="submit" class="btn btn-danger" name="remove">حذف</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="edit_cat" tabindex="-1" aria-labelledby="editLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h2 class="text-light">تعديل قسم </h2>
            </div>
            <form class="float-right" action="{{aurl('categories/update')}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group ">
                        <h4>الاسم</h4>
                        <input type="text" name="name" id="cat_name" placeholder=" اسم القسم " class="form-control inputName ">
                    </div>
                    <div class="form-group ">
                        <h4>وصف القسم</h4>
                        <textarea class="form-control" id="cat_description" name="description" style="height: 100px;"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">اختار صورة</label>
                        <input type="file" class="form-control" name="file" id="" placeholder="" aria-describedby="fileHelpId">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit " class="btn btn-success" name="edit">تعديل القسم</button>
                    <input type="hidden" value="" name="cat_id" id="cat_id_4">
                    <button type="button " class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="activiate" tabindex="-1" aria-labelledby="removeLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h2 class="text-light">تفعيل القسم </h2>
            </div>
            <form action="{{aurl('categories/activate')}}" method="post">
                @csrf
                <div class="modal-body">
                    <h3 class="text-center">هل تريد اظهار القسم </h3>
                </div>
                <div class="modal-footer">
                    <input type="hidden" value="" name="cat_id" id="cat_id_1">
                    <button type="submit" class="btn btn-primary" name="activiate">تفعيل</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="not_activiate" tabindex="-1" aria-labelledby="removeLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h2 class="text-light">الغاء تفعيل القسم</h2>
            </div>
            <form action="{{aurl('categories/not_activate')}}" method="post">
                @csrf
                <div class="modal-body">
                    <h3 class="text-center">هل تريد الغاء اظهار القسم للجميع</h3>
                </div>
                <div class="modal-footer">
                    <input type="hidden" value="" name="cat_id" id="cat_id_2">
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
                <h2 class="text-light">اضافة قسم </h2>
            </div>
            <form class="float-right" action="{{aurl('categories/store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group ">
                        <h4>الاسم</h4>
                        <input type="text" name="category_name" placeholder=" اسم القسم " required class="form-control inputName ">
                    </div>
                    <div class="form-group ">
                        <h4>وصف القسم</h4>
                        <textarea class="form-control" name="description" style="height: 100px;"></textarea>
                    </div>
                    <div class="form-group ">
                        <h4>القسم الرئيسي؟</h4>
                        <select name="parent" class="form-control inputName ">
                            <option value="0">قسم رئيسي</option>
                            @foreach ($maincategories as $c)
                                <option value="{{$c->id}}">{{$c->category_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                      <label for="" class="form-label">اختار صورة</label>
                      <input type="file" class="form-control" name="file" id="" placeholder="" aria-describedby="fileHelpId">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit " class="btn btn-info" name="add">اضافة القسم</button>
                    <button type="button " class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function() {
        $(".activiate").click(function() {
            var id = $(this).attr('data-id');
            $("#cat_id_1").val(id);
            $("#activiate").modal('toggle');
        });
        $(".not_activiate").click(function() {
            var id = $(this).attr('data-id');
            $("#cat_id_2").val(id);
            $("#not_activiate").modal('toggle');
        });
        $(".delete_cat").click(function() {
            var id = $(this).attr('data-id');
            $("#cat_id_3").val(id);
            $("#delete_cat").modal('toggle');
        });
        $(".edit_cat").click(function() {
            var id = $(this).attr('data-id');
            var name = $(this).attr('data-name');
            var description = $(this).attr('data-description');
            $("#cat_id_4").val(id);
            $("#cat_name").val(name);
            $("#cat_description").text(description);
            $("#edit_cat").modal('toggle');
        });
    });
</script>
@endpush
