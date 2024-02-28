@extends('admin.layouts.app')
@push('styles')
@endpush
@section('content')
<div class="page-header ">
    <h3 class="page-title ">
        <span class="page-title-icon bg-gradient-primary text-white mr-2 ">
            <i class="mdi mdi-home "></i>
        </span>&nbsp; الاعضاء
    </h3>
    <div>
        <button style=" color:white;font-size:15px " type="button " class="btn btn-primary btn-lg" data-toggle="modal" data-target="#editCurrentUser">تعديل المستخدم الحالي</button>
        <button style="color:white;font-size:15px " type="button " class="btn btn-primary btn-lg" data-toggle="modal" data-target="#disabled_all">الغاء تفعيل حساب الجميع</button>
        <button style=" color:white;font-size:15px " type="button " class="btn btn-primary btn-lg" data-toggle="modal" data-target="#add">أضافة عضو</button>
    </div>
</div>
<div class="row ">
    <div class="col-12 grid-margin ">
        <div class="card ">
            <div class="card-body ">
                <h4 class="card-title ">الطلاب </h4>
                <div class="table-responsive ">
                    <table class="table" id="datatableid">
                        <thead>
                            <tr>
                                <th>الرقم التعريفي</th>
                                <th>الباركود</th>
                                <th> اسم المستخدم </th>
                                <th>رقم الهاتف</th>
                                <th>تاريخ التسجيل</th>
                                <th> الصف</th>
                                <th>لوحة التحكم</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr>
                                    <td> {{$user->id}} </td>
                                    <td>{{$user->username}} </td>
                                    <td class="text-center">
                                        <a class="text-danger" style="text-decoration: none" href="{{aurl('members/show').'/'.$user->id}}">{{$user->name}}</a>
                                        <br>
                                        @if ($user->top)
                                            <button type="button " class="mt-2 btn btn-outline-dark btn-sm nottop" data-id="{{$user->id}}"> الغاء تعيين الطالب  </button>
                                        @else
                                            <button type="button " class="mt-2 btn btn-outline-light btn-sm top" data-id="{{$user->id}}"> تعيين من المتفوقين</button>
                                        @endif
                                    </td>
                                    <td> {{$user->phone}} </td>
                                    <td> {{$user->time_ago}} <br><br> {{$user->created_at}}</td>
                                    <td> {{$user->category->category_name}}</td>
                                    <td>
                                        <button type="button " class="btn btn-outline-success btn-sm edit"
                                        data-id="{{$user->id}}" data-name="{{$user->name}}" data-username="{{$user->username}}"
                                        data-email="{{$user->email}}" data-password="{{$user->password}}" data-phone="{{$user->phone}}"
                                        >تعديل</button>
                                        <button type="button " class="btn btn-outline-danger btn-sm delete" data-id="{{$user->id}}">حذف</button>
                                        @if ($user->status == 0)
                                            <button type="button " class="btn btn-outline-primary btn-sm activiate" data-id="{{$user->id}}">تفعيل</button>
                                        @else
                                            <button type="button " class="btn btn-outline-secondary btn-sm not_activiate" data-id="{{$user->id}}">الغاء التفعيل</button>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6"> لا يوجد مستخدمين بعد</td>
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
                <h2 class="text-light">اضافة عضو </h2>
            </div>
            <form class="float-right" action="{{aurl('members/store')}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group ">
                        <h4>الاسم</h4>
                        <input type="text" name="name" autocomplete="off" placeholder=" اسم المستخدم " class="form-control inputName ">
                    </div>
                    <div class="form-group ">
                        <h4>الباركود</h4>
                        <input type="text" name="username" autocomplete="off" placeholder="الباركود" required class="form-control inputName " >
                    </div>
                    <div class="form-group ">
                        <h4>كلمة المرور</h4>
                        <input type="password" name="password" class="form-control Description " autocomplete="new-password" placeholder="الرقم السرى يجب ان يكون صعب توقعة" required>
                    </div>
                    <div class="form-group ">
                        <h4>رقم الهاتف </h4>
                        <input type="tel" name="phone" class="form-control Description " placeholder="ادخل رقم الهاتف">
                    </div>
                    <div class="form-group ">
                        <h4>الصف</h4>
                        <select class="custom-select form-control" name="category" required>
                            @foreach ($maincategories as $c)
                                <option class="text-primary" value="{{$c->id}}">{{$c->category_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit " class="btn btn-info" name="add_member">اضافة عضو</button>
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
                <h2 class="text-light">حذف عضو </h2>
            </div>
            <form class="float-right" action="{{aurl('members/destroy')}}" method="post">
                @csrf
                <div class="modal-body">
                    <h3 class="text-center">هل تريد حذف هذاالشخص</h3>
                </div>
                <div class="modal-footer">
                    <input type="hidden" value="" name="user_id" id="user_id_3">
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
                <h2 class="text-light">تفعيل حساب عضو </h2>
            </div>
            <form class="float-right" action="{{aurl('members/activate')}}" method="post">
                @csrf
                <div class="modal-body">
                    <h3 class="text-center">هل تريد تفعيل حساب هذاالشخص</h3>
                </div>
                <div class="modal-footer">
                    <input type="hidden" value="" name="user_id" id="user_id_1">
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
                <h2 class="text-light">تعديل حساب عضو </h2>
            </div>
            <form class="float-right" action="{{aurl('members/update')}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group ">
                        <h4>الاسم</h4>
                        <input type="text" name="name" autocomplete="off" placeholder=" اسم المستخدم " class="form-control inputName " id="user_name">
                    </div>
                    <div class="form-group ">
                        <h4>الباركود</h4>
                        <input type="text" name="username" autocomplete="off" placeholder="الباركود" class="form-control inputName" id="user_username">
                    </div>
                    <div class="form-group ">
                        <h4>كلمة المرور</h4>
                        <input type="password" name="password" class="form-control Description " autocomplete="new-password" placeholder="الرقم السرى يجب ان يكون صعب توقعة" id="user_password" required>
                    </div>
                    <div class="form-group ">
                        <h4>رقم الهاتف </h4>
                        <input type="tel" name="phone" class="form-control Description " placeholder="ادخل رقم الهاتف" id="user_phone">
                    </div>
                    <div class="form-group ">
                        <h4>الصف</h4>
                        <select class="custom-select form-control" name="category" required>
                            @foreach ($maincategories as $c)
                                <option class="text-primary" value="{{$c->id}}">{{$c->category_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="edit" class="btn btn-success">تعديل</button>
                    <input type="hidden" value="" name="user_id" id="user_id_4">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="disabled_all" tabindex="-1" aria-labelledby="removeLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h2 class="text-light">الغاء تفعيل الجميع</h2>
            </div>
            <form class="float-right" action="{{aurl('members/disabled_all')}}" method="post">
                @csrf
                <div class="modal-body">
                    <h3 class="text-center">هل تريد الغاء تفعيل حساب الجميع</h3>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-dark" name="disabled_all">الغاء التفعيل</button>
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
                <h2 class="text-light">الغاء تفعيل العضو</h2>
            </div>
            <form class="float-right" action="{{aurl('members/not_activiate')}}" method="post">
                @csrf
                <div class="modal-body">
                    <h3 class="text-center">هل تريد الغاء اظهار العضو </h3>
                </div>
                <div class="modal-footer">
                    <input type="hidden" value="" name="user_id" id="user_id_2">
                    <button type="submit" class="btn btn-dark" name="not_activiate">الغاء التفعيل</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="top" tabindex="-1" aria-labelledby="removeLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h2 class="text-dark">تعيين من المتفوقين</h2>
            </div>
            <form class="float-right" action="{{aurl('members/top')}}" method="post">
                @csrf
                <div class="modal-body">
                    <h3 class="text-center">هل تريد تعيين الطالب من المتفوقين </h3>
                </div>
                <div class="modal-footer">
                    <input type="hidden" value="" name="user_id" id="user_id_5">
                    <button type="submit" class="btn btn-light" name="top"> تعيين</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="nottop" tabindex="-1" aria-labelledby="removeLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h2 class="text-light">الغاء تعيين الطالب من المتفوقين</h2>
            </div>
            <form class="float-right" action="{{aurl('members/nottop')}}" method="post">
                @csrf
                <div class="modal-body">
                    <h3 class="text-center">هل تريد الغاء تعيين الطالب من المتفوقين </h3>
                </div>
                <div class="modal-footer">
                    <input type="hidden" value="" name="user_id" id="user_id_6">
                    <button type="submit" class="btn btn-dark" name="nottop"> الغاء تعيين</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="editCurrentUser" tabindex="-1" role="dialog" aria-labelledby="addlabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h2 class="text-light">تعديل عضو </h2>
            </div>
            <form class="float-right" action="{{aurl('members/editCurrentUser')}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group ">
                        <h4>الصف</h4>
                        <select class="custom-select form-control" name="category" required>
                            @foreach ($maincategories as $c)
                                <option class="text-primary" value="{{$c->id}}">{{$c->category_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit " class="btn btn-info" name="group">تعديل</button>
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
        $(".activiate").click(function() {
            var id = $(this).attr('data-id');
            $("#user_id_1").val(id);
            $("#activiate").modal('toggle');
        });
        $(".not_activiate").click(function() {
            var id = $(this).attr('data-id');
            $("#user_id_2").val(id);
            $("#not_activiate").modal('toggle');
        });
        $(".delete").click(function() {
            var id = $(this).attr('data-id');
            $("#user_id_3").val(id);
            $("#remove").modal('toggle');
        });
        $(".top").click(function() {
            var id = $(this).attr('data-id');
            $("#user_id_5").val(id);
            $("#top").modal('toggle');
        });
        $(".nottop").click(function() {
            var id = $(this).attr('data-id');
            $("#user_id_6").val(id);
            $("#nottop").modal('toggle');
        });
        $(".edit").click(function() {
            var id          = $(this).attr('data-id');
            var name        = $(this).attr('data-name');
            var username    = $(this).attr('data-username');
            var email       = $(this).attr('data-email');
            var phone       = $(this).attr('data-phone');
            $("#user_id_4").val(id);
            $("#user_name").val(name);
            $("#user_username").val(parseInt(username));
            $("#user_email").val(email);
            $("#user_phone").val(parseInt(phone));
            $("#edit").modal('toggle');
        });
    });
</script>
@endpush
