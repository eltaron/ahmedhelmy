@extends('admin.layouts.app')
@push('styles')
@endpush
@section('content')
<div class="page-header ">
    <h3 class="page-title ">
        <span class="page-title-icon bg-gradient-primary text-white mr-2 ">
            <i class="mdi mdi-home "></i>
        </span>&nbsp; الأمتحانات
    </h3>
    <div class="">
        <button style="font-size:15px " type="button " class="btn btn-primary btn-lg" data-toggle="modal" data-target="#add2"> إضافة إمتحان جزئي</button>
        <button style="font-size:15px " type="button " class="btn btn-primary btn-lg" data-toggle="modal" data-target="#add3"> إضافة إمتحان برابط</button>
        <button style="font-size:15px " type="button " class="btn btn-primary btn-lg" data-toggle="modal" data-target="#add"> إضافة إمتحان شامل</button>
    </div>
</div>
<div class="row">
    <div class="col-12 grid-margin ">
        <div class="card ">
            <div class="card-body ">
                <h4 class="card-title ">الامتحانات الجزئية</h4>
                <div class="table-responsive ">
                    <table class="table" id="datatableid">
                        <thead>
                            <tr>
                                <th> رقم الأمتحان </th>
                                <th> اسم الأمتحان </th>
                                <th> تاريخ الامتحان </th>
                                <th> القسم </th>
                                <th> عدد الاسئلة </th>
                                <th> وقت الامتحان </th>
                                <th>لوحة التحكم </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($partExams as $exam)
                            <tr>
                                <td> {{$exam->id}} </td>
                                <td> {{$exam->exam_name}}
                                    @if ($exam->lesson)
                                    <br><br>
                                    <a style="text-decoration: none" href="{{aurl('lessons/show/'.$exam->lesson->id)}}">{{$exam->lesson->lesson_name}}</a>
                                </td>
                                @endif

                                <td> {{$exam->time_ago}} </td>
                                <td>
                                    {{$exam->lesson->category->category_name}}
                                </td>
                                <td> {{$exam->number}} سؤال</td>
                                <td> {{$exam->time}} دقيقة</td>
                                <td>
                                    <a class="btn btn-outline-light btn-sm" href="{{aurl('exams/show/'.$exam->id)}}">تفاصيل</a>
                                    <button type="button " class="btn btn-outline-warning btn-sm main_view" data-id="{{$exam->id}}">اظهار النتائج</button>
                                    <button type="button " class="btn btn-outline-success btn-sm edit_exam" data-id="{{$exam->id}}" data-exam_name="{{$exam->exam_name}}" data-exam_desc="{{$exam->exam_desc}}" data-lesson_id="{{$exam->lesson_id }}" data-number="{{$exam->number}}" data-time="{{$exam->time}}">تعديل</button>
                                    <button type="button " class="btn btn-outline-danger btn-sm exam_delete" data-id="{{$exam->id}}">حذف</button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7"> لا يوجد امتحان جزئى </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 grid-margin ">
        <div class="card ">
            <div class="card-body ">
                <h4 class="card-title ">الامتحانات الشاملة</h4>
                <div class="table-responsive ">
                    <table class="table " id="datatableid2">
                        <thead>
                            <tr>
                                <th>رقم الأمتحان</th>
                                <th>اسم الأمتحان </th>
                                <th>تاريخ الامتحان</th>
                                <th>القسم</th>
                                <th>النوع</th>
                                <th> عدد الاسئلة</th>
                                <th> وقت الامتحان</th>
                                <th>لوحة التحكم</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($fullExams as $exam)
                            <tr>
                                <td> {{$exam->id}} </td>
                                <td> {{$exam->exam_name}} </td>
                                <td> {{$exam->time_ago}} </td>
                                <td>
                                    {{$exam->category->category_name}} <br><br>
                                    {{$exam->category->mparent ? $exam->category->mparent->category_name : ''}}
                                </td>
                                <td>
                                    {!! $exam->type == 2 ? '<span class="ml-2 badge badge-success">امتحان برابط</span>' : '<span class="ml-2 badge badge-primary">امتحان شامل</span>'!!}
                                </td>
                                <td>
                                    @if($exam->type == 1)
                                    {{$exam->number}} سؤال
                                    @endif
                                </td>
                                <td>
                                    @if($exam->type == 1)
                                    {{$exam->time}} دقيقة
                                    @endif
                                </td>
                                <td>
                                    @if($exam->type == 1)
                                    <a class="btn btn-outline-light btn-sm" href="{{aurl('exams/part/'.$exam->id)}}">تفاصيل</a>
                                    <button type="button " class="btn btn-outline-warning btn-sm main_view" data-id="{{$exam->id}}">اظهار النتائج</button>
                                    <button type="button " class="btn btn-outline-success btn-sm edit_exam2" data-id="{{$exam->id}}" data-exam_name="{{$exam->exam_name}}" data-exam_desc="{{$exam->exam_desc}}" data-category="{{$exam->category_id }}" data-number="{{$exam->number}}" data-time="{{$exam->time}}">تعديل</button>
                                    @else
                                    <a class="btn btn-outline-light btn-sm" href="{{$exam->exam_desc}}">تفاصيل</a>
                                    <button type="button " class="btn btn-outline-success btn-sm edit_exam3" data-id="{{$exam->id}}" data-exam_name="{{$exam->exam_name}}" data-exam_desc="{{$exam->exam_desc}}" data-category="{{$exam->category_id }}">تعديل</button>
                                    @endif
                                    <button type="button " class="btn btn-outline-danger btn-sm exam_delete" data-id="{{$exam->id}}">حذف</button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6"> لا يوجد امتحان جزئى </td>
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
                <h2 class="text-light">حذف الامتحان </h2>
            </div>
            <form action="{{aurl('exams/delete')}}" method="post">
                @csrf
                <div class="modal-body">
                    <h3 class="text-center">هل تريد حذف هذا الامتحان</h3>
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
<div class="modal fade" id="edit" tabindex="-1" aria-labelledby="editLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h2 class="text-light">تعديل الامتحان</h2>
            </div>
            <form class="float-right" action="{{aurl('exams/update')}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group ">
                        <h4>عنوان الامتحان</h4>
                        <input type="text" name="title" id="exam_name1" placeholder="اسم الامتحان" class="form-control">
                    </div>
                    <div class="form-group ">
                        <h4>وصف الامتحان</h4>
                        <textarea class="form-control" id="exam_desc1" name="description" style="min-height: 100px;"></textarea>
                    </div>
                    <div class="form-group">
                        <h4>الدرس المرتبط به</h4>
                        <select name="lesson" class="form-control" id="lesson_id1">
                            @foreach ($lessons as $lesson)
                            <option value="{{$lesson->id}}">{{$lesson->lesson_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group ">
                        <h4>عدد الاسئلة</h4>
                        <input type="number" name="number" id="number1" placeholder="عدد الاسئلة" class="form-control">
                    </div>
                    <div class="form-group ">
                        <h4>الوقت</h4>
                        <input type="number" name="time" id="time1" placeholder="وقت الامتحان  بالدقيقة" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit " class="btn btn-success" name="edit">تعديل امتحان</button>
                    <input type="hidden" value="" name="exam_id" id="exam_id_2">
                    <button type="button " class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="edit2" tabindex="-1" aria-labelledby="editLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h2 class="text-light">تعديل الامتحان</h2>
            </div>
            <form class="float-right" action="{{aurl('exams/update2')}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group ">
                        <h4>عنوان الامتحان</h4>
                        <input type="text" name="title" id="exam_name2" placeholder="اسم الامتحان" class="form-control">
                    </div>
                    <div class="form-group ">
                        <h4>وصف الامتحان</h4>
                        <textarea class="form-control" id="exam_desc2" name="description" style="min-height: 100px;"></textarea>
                    </div>
                    <div class="form-group">
                        <h4>القسم</h4>
                        <select name="category_id" class="form-control inputName " id="lesson_id2">
                            @foreach ($maincategories as $c)
                            <option class="text-primary" value="{{$c->id}}"> {{$c->category_name}}</option>

                            @endforeach
                        </select>
                    </div>
                    <div class="form-group ">
                        <h4>عدد الاسئلة</h4>
                        <input type="number" name="number" id="number2" placeholder="عدد الاسئلة" class="form-control">
                    </div>
                    <div class="form-group ">
                        <h4>الوقت</h4>
                        <input type="number" name="time" id="time2" placeholder="وقت الامتحان بالدقيقة " class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit " class="btn btn-success" name="edit">تعديل امتحان</button>
                    <input type="hidden" value="" name="exam_id" id="exam_id_3">
                    <button type="button " class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="edit3" tabindex="-1" aria-labelledby="editLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h2 class="text-light">تعديل الامتحان</h2>
            </div>
            <form class="float-right" action="{{aurl('exams/update3')}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group ">
                        <h4>عنوان الامتحان</h4>
                        <input type="text" name="title" id="exam_name3" placeholder="اسم الامتحان" class="form-control">
                    </div>
                    <div class="form-group ">
                        <h4>وصف الامتحان</h4>
                        <textarea class="form-control" id="exam_desc3" name="description" style="min-height: 100px;"></textarea>
                    </div>
                    <div class="form-group">
                        <h4>القسم</h4>
                        <select name="category_id" class="form-control inputName " id="lesson_id3">
                            @foreach ($maincategories as $c)
                            <option class="text-primary" value="{{$c->id}}"> {{$c->category_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit " class="btn btn-success" name="edit">تعديل امتحان</button>
                    <input type="hidden" value="" name="exam_id" id="exam_id_4">
                    <button type="button " class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade bd-example-modal-lg" id="mark" tabindex="-1" aria-labelledby="removeLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h2 class="text-light">جميع نتائج الامتحان</h2>
            </div>
            <div class="modal-body">
                <div class="table-responsive" id="divToPrint">
                    <table class="text-center table table-bordered table-dark">
                        <thead>
                            <tr>
                                <th> اسم الطالب </th>
                                <th> القسم </th>
                                <th> النتيجة </th>
                                <th> تاريخ الامتحان </th>
                            </tr>
                        </thead>
                        <tbody id="main_td">
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" value="print" onclick="PrintDiv();">اطبع الاجابات</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="add2" tabindex="-1" role="dialog" aria-labelledby="addlabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h2 class="text-light">اضافة امتحان </h2>
            </div>
            <form class="float-right" action="{{aurl('exams/store')}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group ">
                        <h4>عنوان الامتحان</h4>
                        <input type="text" name="title" placeholder="اسم الامتحان" class="form-control" required>
                    </div>
                    <div class="form-group ">
                        <h4>وصف الامتحان</h4>
                        <textarea class="form-control" name="description" style="min-height: 100px;"></textarea>
                    </div>
                    <div class="form-group">
                        <h4>الدرس المرتبط به</h4>
                        <select name="lesson" class="form-control" required>
                            @foreach ($lessons as $lesson)
                            <option value="{{$lesson->id}}">{{$lesson->lesson_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group ">
                        <h4>عدد الاسئلة</h4>
                        <input type="number" name="number" placeholder="عدد الاسئلة" class="form-control">
                    </div>
                    <div class="form-group ">
                        <h4>الوقت</h4>
                        <input type="number" name="time" placeholder="وقت الامتحان بالدقيقة " class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit " class="btn btn-info" name="add">اضافة امتحان</button>
                    <button type="button " class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="add3" tabindex="-1" role="dialog" aria-labelledby="addlabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h2 class="text-light"> اضافة امتحان برابط</h2>
            </div>
            <form class="float-right" action="{{aurl('exams/store2')}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group ">
                        <h4>عنوان الامتحان</h4>
                        <input type="text" name="title" placeholder="اسم الامتحان" class="form-control" required>
                    </div>
                    <div class="form-group ">
                        <h4>رابط الامتحان</h4>
                        <textarea class="form-control" name="link" style="min-height: 100px;" required></textarea>
                    </div>
                    <div class="form-group">
                        <h4>القسم</h4>
                        <select name="category_id" class="form-control inputName " required>
                            @foreach ($maincategories as $c)
                            <option class="text-primary" value="{{$c->id}}"> {{$c->category_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit " class="btn btn-info" name="add3">اضافة امتحان</button>
                    <button type="button " class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="addlabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h2 class="text-light">اضافة امتحان شامل</h2>
            </div>
            <form class="float-right" action="{{aurl('exams/store3')}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group ">
                        <h4>عنوان الامتحان</h4>
                        <input type="text" name="title" placeholder="اسم الامتحان" class="form-control" required>
                    </div>
                    <div class="form-group ">
                        <h4>وصف الامتحان</h4>
                        <textarea class="form-control" name="description" style="min-height: 100px;"></textarea>
                    </div>
                    <div class="form-group">
                        <h4>القسم</h4>
                        <select name="category_id" class="form-control inputName " required>
                            @foreach ($maincategories as $c)
                            <option class="text-primary" value="{{$c->id}}"> {{$c->category_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group ">
                        <h4>عدد الاسئلة</h4>
                        <input type="number" name="number" placeholder="عدد الاسئلة" class="form-control">
                    </div>
                    <div class="form-group ">
                        <h4>الوقت</h4>
                        <input type="number" name="time" placeholder="وقت الامتحان بالدقيقة " class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit " class="btn btn-info" name="add2">اضافة امتحان</button>
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
        $(".exam_delete").click(function() {
            var id = $(this).attr('data-id');
            $("#exam_id_1").val(id);
            $("#remove").modal('toggle');
        });
        $(".edit_exam").click(function() {
            var id = $(this).attr('data-id');
            var exam_name = $(this).attr('data-exam_name');
            var exam_desc = $(this).attr('data-exam_desc');
            var lesson_id = $(this).attr('data-lesson_id');
            var number = $(this).attr('data-number');
            var time = $(this).attr('data-time');
            $("#exam_id_2").val(id);
            $("#exam_name1").val(exam_name);
            $("#exam_desc1").text(exam_desc);
            $("#lesson_id1 option[value='" + lesson_id + "']").attr("selected", "selected");
            $("#number1").val(number);
            $("#time1").val(time);
            $("#edit").modal('toggle');
        });
        $(".edit_exam2").click(function() {
            var id = $(this).attr('data-id');
            var exam_name = $(this).attr('data-exam_name');
            var exam_desc = $(this).attr('data-exam_desc');
            var category = $(this).attr('data-category');
            var number = $(this).attr('data-number');
            var time = $(this).attr('data-time');
            $("#exam_id_3").val(id);
            $("#exam_name2").val(exam_name);
            $("#exam_desc2").text(exam_desc);
            $("#lesson_id2 option[value='" + category + "']").attr("selected", "selected");
            $("#number2").val(number);
            $("#time2").val(time);
            $("#edit2").modal('toggle');
        });
        $(".edit_exam3").click(function() {
            var id = $(this).attr('data-id');
            var exam_name = $(this).attr('data-exam_name');
            var exam_desc = $(this).attr('data-exam_desc');
            var category = $(this).attr('data-category');
            $("#exam_id_4").val(id);
            $("#exam_name3").val(exam_name);
            $("#exam_desc3").text(exam_desc);
            $("#lesson_id3 option[value='" + category + "']").attr("selected", "selected");
            $("#edit3").modal('toggle');
        });
    });
</script>
<script>
    $(".main_view").click(function() {
        $('#main_td').empty();
        $(this).prop('disabled', true);
        var id = $(this).attr('data-id');
        $.ajax({
            type: 'POST',
            url: "{{ aurl('exams/marks') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                _token: "{{ csrf_token() }}",
                exam_id: id,
            },
            beforeSend: function() {},
            success: function(response) {
                var data = '';
                for (var i = 0; i < response.answers.length; i++) {
                    data = data + `
                    <tr>
                        <td><a href="{{aurl('members/show')}}/` + response.answers[i]['user_id'] + `">` + response.answers[i]['name'] + `</a></td>
                        <td>` + response.answers[i]['team'] + `</td>
                        <td>` + response.answers[i]['mark'] + `</td>
                        <td>` + response.answers[i]['time_ago'] + `</td>
                    </tr>
                    `;
                }
                $('#main_td').append(data);
                $("#mark").modal('toggle');
                $(".main_view").prop('disabled', false)
            },
            error: function(err) {
                console.log(err);
            }
        });
    });
</script>
<script type="text/javascript">
    function PrintDiv() {
        var divToPrint = document.getElementById("divToPrint");
        newWin = window.open("");
        newWin.document.write(divToPrint.outerHTML);
        var css = `table, td, th {
        text-align:center;
        margin:auto;
        direction:rtl;
        }
        a{text-decoration:none}
        table{border: 1px solid #dee2e6;}
        th,td{
        padding: .75rem;
        vertical-align: top;
        border: 2px solid #dee2e6;border-bottom-width: 2px;
        }
        #printTable2 .row:first-child{display:none;}
        #printTable2 .row:last-child{display:none;}`;
        var div = $("<div />", {
            html: '&shy;<style>' + css + '</style>'
        }).appendTo(newWin.document.body);
        newWin.print();
        newWin.close();
    }
</script>
@endpush