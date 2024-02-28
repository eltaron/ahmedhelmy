@extends('admin.layouts.app')
@push('styles')
@endpush
@section('content')
<div class="page-header ">
    <h3 class="page-title ">
        <span class="page-title-icon bg-gradient-primary text-white mr-2 ">
            <i class="mdi mdi-home "></i>
        </span>&nbsp;
        الامتحانات الشاملة
    </h3>
    <div>
        <button type="button " class="btn btn-primary btn-lg" data-toggle="modal" data-target="#add3">أضافة جزء</button>
    </div>
</div>
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h3>{{$exam->exam_name}}</h3>
                <div class="w-100">
                    <div class="w-100 mb-2">
                        <span class="ml-2 badge badge-success">{{$exam->category->category_name}}</span>
                    </div>
                    <div class="d-block align-items-center text-muted font-weight-light">
                        <i class="mdi mdi-clock icon-sm ml-2"></i>
                        <span>{{$exam->time_ago}}</span>
                    </div>
                </div>
                @if($exam->exam_desc)
                <div class="row mt-3">
                    <h3 class="w-100">التفاصيل</h3>
                    <div>
                        <p>{{$exam->exam_desc}}</p>
                    </div>
                </div>
                @endif
                <div class="row">
                    <div class="col-6 align-items-top">
                        <h3>وقت الامتحان</h3>
                        <p>{{$exam->time}} دقيقة</p>
                    </div>
                    <div class="col-6 align-items-top">
                        <h3>عدد الاسئلة</h3>
                        <p>{{$exam->number}} سؤال</p>
                    </div>
                </div>
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
                    <table class="table " id="datatableid">
                        <thead>
                            <tr>
                                <th>رقم الجزء</th>
                                <th>الجزء</th>
                                <th>تاريخ الاضافة</th>
                                <th>الأمتحان</th>
                                <th>لوحة التحكم</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($parts as $part)
                            <tr>
                                <td>{{$part->id}}</td>
                                <td>{{$part->part_name}}</td>
                                <td>{{$part->time_ago}}</td>
                                <td>{{$part->exam->exam_name}}</td>
                                <td>
                                    <a class="btn btn-outline-light btn-sm" href="{{aurl('exams/partDescription/'.$part->id)}}">تفاصيل</a>
                                    <button type="button " class="btn btn-outline-danger btn-sm delete_ques" data-id="{{$part->id}}">حذف</button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5"> لا يوجد اجزاء </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row ">
    <div class="col-12 grid-margin ">
        <div class="card ">
            <div class="card-body ">
                <h4 class="card-title ">حلول الطلبة</h4>
                <div class="table-responsive ">
                    <table class="table " id="datatableid">
                        <thead>
                            <tr>
                                <th> اسم الطالب </th>
                                <th> القسم </th>
                                <th> النتيجة </th>
                                <th> النتيجة الكلية </th>
                                <th> تاريخ الامتحان </th>
                                <th> اظهار الحلول </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($answers as $answer)
                            <tr>
                                <td>{{$answer->name}}</td>
                                <td>{{$answer->team}}</td>
                                <td>{{$answer->mark}}</td>
                                <td>{{$answer->fullmark}}</td>
                                <td>{{$answer->time_ago}}</td>
                                <td>
                                    <a class="btn btn-outline-danger btn-sm" href="{{aurl('exams/deleteAnswer')}}/{{$answer->id}}">حذف النتيجة</button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5"> لا يوجد حلول بعد </td>
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
                <h2 class="text-light">حذف الجزء </h2>
            </div>
            <form action="{{aurl('exams/destroyPart')}}" method="post">
                @csrf
                <div class="modal-body">
                    <h3 class="text-center">هل تريد حذف هذا الجزء</h3>
                </div>
                <div class="modal-footer">
                    <input type="hidden" value="" name="part_id" id="part_id_1">
                    <button type="submit" class="btn btn-danger" name="remove">حذف</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="add3" tabindex="-1" role="dialog" aria-labelledby="addlabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h2 class="text-light">اضافة الاجزاء </h2>
            </div>
            <form class="float-right" action="{{aurl('exams/storePart')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="exam_id" value="{{$exam->id}}">
                <div class="modal-body">
                    <div class="form-group ">
                        <h4> اضافة الجزء</h4>
                        <input type="text" name="part" placeholder="اضافة الجزء" class="form-control" required>
                    </div>
                    <div class="form-group ">
                        <h4> اضافة صورة</h4>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="image">
                            <label class="custom-file-label text-center" for="inputGroupFile01">اختر ملف</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit " class="btn btn-info" name="add3">اضافة الجزء</button>
                    <button type="button " class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="removeAnser" tabindex="-1" aria-labelledby="removeLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h2 class="text-light">حذف النتائج</h2>
            </div>
            <form action="{{aurl('exams/deleteAnswers/'.$exam->id)}}" method="post">
                @csrf
                <div class="modal-body">
                    <h3 class="text-center">هل تريد حذف النتائج</h3>
                </div>
                <div class="modal-footer">
                    <input type="hidden" value="" name="exam_id" id="exam_id_1">
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
            $("#part_id_1").val(id);
            $("#remove").modal('toggle');
        });
        $(".exam_delete").click(function() {
            var id = $(this).attr('data-id');
            $("#exam_id_1").val(id);
            $("#removeAnser").modal('toggle');
        });
    });
</script>
@endpush