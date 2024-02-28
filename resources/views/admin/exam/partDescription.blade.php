@extends('admin.layouts.app')
@push('styles')
@endpush
@section('content')
<div class="page-header ">
    <h3 class="page-title ">
        <span class="page-title-icon bg-gradient-primary text-white mr-2 ">
            <i class="mdi mdi-home "></i>
        </span>&nbsp;{{$part->part_name}}
    </h3>
    <div>
        <button type="button " class="btn btn-primary btn-lg"data-toggle="modal" data-target="#add">أضافة سؤال اختيارى</button>
        <button type="button " class="btn btn-primary btn-lg"data-toggle="modal" data-target="#add2">أضافة سؤال مقالى</button>
    </div>
</div>
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h3>{{$part->part_name}}</h3>
                <div class="w-100">
                    <div class="w-100 mb-2">
                        <span class="ml-2 badge badge-success">{{$part->exam->exam_name}}</span>
                    </div>
                    <div class="d-block align-items-center text-muted font-weight-light">
                        <i class="mdi mdi-clock icon-sm ml-2"></i>
                        <span>{{$part->time_ago}}</span>
                    </div>
                </div>
                @if ($part->photo)
                    <div class="row">
                        <img src="{{$part->photo}}" class="p-4" width="100%">
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="row ">
    <div class="col-12 grid-margin ">
        <div class="card ">
            <div class="card-body ">
                <h4 class="card-title ">الاسئلة الجزئية</h4>
                <div class="table-responsive ">
                    <table class="table "id="datatableid">
                        <thead>
                            <tr>
                                <th>رقم السؤال</th>
                                <th>السؤال</th>
                                <th>الاجابة الصحيحة</th>
                                <th>تاريخ الاضافة</th>
                                <th>لوحة التحكم</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($Questions as $Question)
                                <tr>
                                    <td>{{$Question->id}}</td>
                                    <td>{{$Question->question}}</td>
                                    <td>{{$Question->answer? $Question->answer: $Question->right_answer}}</td>
                                    <td>{{$Question->time_ago}}</td>
                                    <td>
                                        <button type="button " class="btn btn-outline-danger btn-sm delete_ques" data-id="{{$Question->id}}">حذف</button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5"> لا يوجد اسئلة بعد </td>
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
                <h2 class="text-light">اضافة الاسئلة </h2>
            </div>
            <form class="float-right" action="{{aurl('exams/storePQuestion1')}}"  method="post"  enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                        <input type="hidden" name="exam_id" value="{{$part->id}}">
                        <div class="form-group ">
                            <h4> اضافة السؤال</h4>
                            <input type="text" name="question" placeholder=" السؤال" required class="form-control" >
                        </div>
                        <div class="form-group ">
                            <h4> اضافة صورة</h4>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="image" >
                                <label class="custom-file-label text-center" for="inputGroupFile01">اختر ملف</label>
                            </div>
                        </div>
                        <div class="form-group ">
                            <h4> اضافة الاجابة الاولي</h4>
                            <input type="text" name="ans_1" placeholder="الاجابة الاول" class="form-control" required>
                        </div>
                        <div class="form-group ">
                            <h4> اضافة الاجابة الثانية</h4>
                            <input type="text" name="ans_2" placeholder="الاجابة الثانية" class="form-control" required>
                        </div>
                        <div class="form-group ">
                            <h4> اضافة الاجابة الثالثة</h4>
                            <input type="text" name="ans_3" placeholder="الاجابة الثالثة" class="form-control" required>
                        </div>
                        <div class="form-group ">
                            <h4> اضافة الاجابة الرابعة</h4>
                            <input type="text" name="ans_4" placeholder="الاجابة الرابعة" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <h4>الاجابة الصحيحة</h4>
                            <select name="rightAns" required class="form-control" >
                                <option value="1">الاجابة الاولى</option>
                                <option value="2">الاجابة الثانية</option>
                                <option value="3">الاجابة الثالثة</option>
                                <option value="4">الاجابة الرابعة</option>
                            </select>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit " class="btn btn-info" name="add">اضافة السؤال</button>
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
                <h2 class="text-light">اضافة الاسئلة المقالية </h2>
            </div>
            <form action="{{aurl('exams/storePQuestion2')}}" method="post">
                @csrf
                <input type="hidden" name="exam_id" value="{{$part->id}}">
                <div class="modal-body">
                        <div class="form-group ">
                            <h4> اضافة السؤال</h4>
                            <textarea name="question" placeholder=" السؤال" class="form-control" required></textarea>
                        </div>
                        <div class="form-group ">
                            <h4> اضافة الاجابة</h4>
                            <textarea name="ans_1" placeholder="الاجابة " class="form-control" required></textarea>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit " class="btn btn-info" name="add2">اضافة سؤال مقالى</button>
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
                <h2 class="text-light">حذف السؤال </h2>
            </div>
            <form action="{{aurl('exams/destroyQuestion')}}" method="post">
                @csrf
                <div class="modal-body">
                    <h3 class="text-center">هل تريد حذف هذا السؤال</h3>
                </div>
                <div class="modal-footer">
                    <input type="hidden" value="" name="ques_id" id="question_id_1">
                    <button type="submit" class="btn btn-danger" name="remove">حذف</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function() {
        $(".delete_ques").click(function() {
            var id = $(this).attr('data-id');
            $("#question_id_1").val(id);
            $("#remove").modal('toggle');
        });
    });
</script>
@endpush
