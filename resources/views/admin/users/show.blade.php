@extends('admin.layouts.app')
@push('styles')
@endpush
@section('content')
<div class="page-header ">
    <h3 class="page-title ">
        <span class="page-title-icon bg-gradient-primary text-white mr-2 ">
            <i class="mdi mdi-home "></i>
        </span>&nbsp; تفاصيل العضو
    </h3>
    <div>
        <button id="print" style=" color:white;font-size:15px " type="button " class="btn btn-primary btn-lg" >طباعة</button>
    </div>
</div>
<div id="printTable">
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-6"><h3><i class="mdi mdi-account"></i> <small>الاسم : </small>{{$user->name}}</h3></div>
                        <div class="col-md-6"><h3><i class="mdi mdi-barcode-scan"></i> <small>الباركود : </small>{{$user->username}}</h3></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6"><h3><i class="mdi mdi-email"></i> <small>الايميل : </small>{{$user->email ? $user->email : 'لا يوجد ايميل'}}</h3></div>
                        <div class="col-md-6"><h3><i class="mdi mdi-cellphone"></i> <small>رقم الهاتف : </small>{{$user->phone ? $user->phone : 'لا يوجد رقم هاتف'}}</h3></div>
                    </div>
                    <div class="w-100 mb-2">
                        <div class="d-block align-items-center">
                            <h3>
                                <i class="mdi mdi-clock"></i>
                                <span>تاريخ انشاء الحساب</span>
                                <span>: {{$user->Time_ago}}</span>
                            </h3>
                        </div>
                    </div>
                    <div class="w-100">
                        <div class="w-100 mb-2">
                            @if($user->status == 1)
                                <span class="ml-2 badge badge-success">الحساب مفعل</span>
                            @else
                                <span class="ml-2 badge badge-danger">الحساب غير مفعل</span>
                            @endif
                            <span class="ml-2 badge badge-success">{{$user->category->category_name}} {{$user->category->mparent  ? " ==> " . $user->category->mparent->category_name : ''}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 grid-margin ">
            <div class="card ">
                <div class="card-body ">
                    <div class="row">
                        <div class="col-md-7">
                            <h4 class="card-title text-center">الدروس التي تم حضورها</h4>
                            <div class="table-responsive ">
                                <table class="table "id="datatableid">
                                    <thead>
                                        <tr>
                                            <th>الدرس</th>
                                            <th>وقت الحضور </th>
                                            <th>وقت الانتهاء</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($user->lessons as $lesson)
                                            <tr>
                                                <td>{{$lesson->lesson->lesson_name}}</td>
                                                <td>{{$lesson->created_at}}</td>
                                                <td>{{$lesson->end_at}}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3">لا يوجد دروس تم حضورها </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <h4 class="card-title text-center">الدروس التي تم الغياب عنها</h4>
                            <div class="table-responsive ">
                                <table class="table "id="datatableid2">
                                    <thead>
                                        <tr>
                                            <th>الدرس</th>
                                            <th>وقت الدرس </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($lessons as $l)
                                            <tr>
                                                <td>{{$l->lesson_name}}</td>
                                                <td>{{$l->time_ago}}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td>لا يوجد دروس</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 grid-margin ">
            <div class="card ">
                <div class="card-body ">
                    <div class="row">
                        <div class="col-md-8">
                            <h4 class="card-title text-center">الامتحان التي تم حضورها</h4>
                            <div class="table-responsive ">
                                <table class="table "id="datatableid3">
                                    <thead>
                                        <tr>
                                            <th>الامتحان</th>
                                            <th>النتيجة</th>
                                            <th>وقت الانتهاء</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($user->answers as $answer)
                                            <tr>
                                                <td>{{$answer->exam->exam_name}}</td>
                                                <td>{{$answer->mark}}</td>
                                                <td>{{$answer->time_ago}}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="2">لا يوجد امتحانات</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h4 class="card-title text-center">الامتحانات التي تم الغياب عنها</h4>
                            <div class="table-responsive ">
                                <table class="table "id="datatableid4">
                                    <thead>
                                        <tr>
                                            <th>الامتحان</th>
                                            <th>وقت الامتحان </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($exams as $exam)
                                            <tr>
                                                <td>{{$exam->exam_name}}</td>
                                                <td>{{$exam->time_ago}}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td>لا يوجد امتحانات</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 grid-margin ">
            <div class="card ">
                <div class="card-body ">
                    <h4 class="card-title ">التعليقات</h4>
                    <div class="table-responsive ">
                        <table class="table "id="datatableid5">
                            <thead>
                                <tr>
                                    <th>رقم التعليق</th>
                                    <th>التعليق</th>
                                    <th>نوع التعليق</th>
                                    <th>تاريخ الاضافة</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($user->comments as $comment)
                                    <tr>
                                        <td>{{$comment->id}}</td>
                                        <td>{{$comment->comment}}</td>
                                        <td>
                                            @if ($comment->post_id )
                                                <span class="ml-2 badge badge-success">منشور</span>
                                            @elseif($comment->lesson_id)
                                                <span class="ml-2 badge badge-primary">الدرس</span>
                                            @elseif($comment->article_id)
                                                <span class="ml-2 badge badge-danger">مقال</span>
                                            @endif
                                        </td>
                                        <td>{{$comment->time_ago}}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">لا يوجد تعليقات</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    function printData()
    {
        var divToPrint=document.getElementById("printTable");
        newWin= window.open("");
        newWin.document.write(divToPrint.outerHTML);
        var css =`
        body{text-align:right;direction:rtl}
        table, td, th {
            border: 1px solid black;
            direction:rtl;
        }
        #datatableid_wrapper .row:first-child,.dataTables_length,.dataTables_paginate {display:none;}
        #datatableid_wrapper .row:last-child,.dataTables_filter,.dataTables_info{display:none;}
        th {
            background-color: #7a7878;
            text-align:center
        }`;
    var div = $("<div />", {
        html: '&shy;<style>' + css + '</style>'
    }).appendTo( newWin.document.body);
        newWin.print();
        newWin.close();
    }
    $('#print').on('click',function(){
    printData();
    })
</script>
<script>
    $(document).ready(function() {
        $('#datatableid2').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Arabic.json"
            }
        });
        $('#datatableid3').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Arabic.json"
            }
        });
        $('#datatableid4').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Arabic.json"
            }
        });
        $('#datatableid5').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Arabic.json"
            }
        });
    });
</script>
@endpush
