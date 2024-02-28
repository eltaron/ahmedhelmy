@extends('admin.layouts.app')
@push('styles')
@endpush
@section('content')
<div class="page-header ">
    <h3 class="page-title ">
        <span class="page-title-icon bg-gradient-primary text-white mr-2 ">
            <i class="mdi mdi-home "></i>
        </span>&nbsp;جميع الملخصات
    </h3>
    <button style="margin-right:150px;font-size:15px" type="button " class="btn btn-primary btn-lg" data-toggle="modal" data-target="#add">أضافة ملخص</button>
</div>
<div class="row" style="margin: auto;width:100%;">
    @forelse ($quotes as $quote)
        <div class="col-md-4">
            <div class="card mb-4">
                <p class="text-center mt-2 p-2" style="font-weight: bold;">{{$quote->description}}</p>
                <div class="d-flex">
                    <a href="{{$quote->image}}"  style="font-size: 25px;height: 60px;border-radius: 0;" class="w-50 m-0 btn btn-primary btn-sm">تنزيل الملف</a>
                    <button type="button " style="font-size: 25px;height: 60px;border-radius: 0;" class="w-50 m-0 btn btn-danger btn-sm delete_quote" data-id="{{$quote->id}}">حذف</button>
                </div>
            </div>
        </div>
    @empty
        <h2 class="p-5 text-danger text-center">لا يوجد ملخصات</h2>
    @endforelse
</div>
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="addlabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h2 class="text-light">اضافة ملخص</h2>
            </div>
            <form class="float-right"  action="{{aurl('books/store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group ">
                        <h4>اختر ملف</h4>
                        <div class="form-group ">
                            <input type="file" class="file-upload-default" name="file" />
                            <div class="input-group col-xs-12" style="background-color: #fff;">
                                <input type="text" class="form-control file-upload-info" disabled placeholder="تحميل ملف">
                                <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-info" type="button" style="border-radius: 0;">تحميل</button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group ">
                        <h4>التفاصيل</h4>
                        <textarea class="form-control" name="description" required placeholder="وصف الملف " style="min-height: 150px;"></textarea>
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
                    <button type="submit " class="btn btn-info" name="add"> اضافة ملف</button>
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
                <h2 class="text-light">حذف الملخص</h2>
            </div>
            <form action="{{aurl('books/delete')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <h3 class="text-center">هل تريد حذف الملخص</h3>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="quote_id" id="quote_id_1">
                    <button type="submit" class="btn btn-danger" name="remove">حذف</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
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
        $(".delete_quote").click(function() {
            var id = $(this).attr('data-id');
            $("#quote_id_1").val(id);
            $("#remove").modal('toggle');
        });
    });
</script>
@endpush
