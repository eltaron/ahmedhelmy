@extends('admin.layouts.app')
@push('styles')
@endpush
@section('content')
<div class="page-header ">
    <h3 class="page-title ">
        <span class="page-title-icon bg-gradient-primary text-white mr-2 ">
            <i class="mdi mdi-home "></i>
        </span>&nbsp; {{$lesson->lesson_name}}
    </h3>
</div>
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{$lesson->lesson_name}}</h4>
                <div class="d-flex">
                    <div class="d-flex align-items-center text-muted font-weight-light">
                        <i class="mdi mdi-clock icon-sm ml-2"></i>
                        <span> {{$lesson->time_ago}} </span>
                    </div>
                </div>
                <div class="row mt-3">
                    {!! $lesson->allow_comment == 1 ? '<span class="ml-2 badge badge-success">التعليقات مفعلة</span>' : '<span class="ml-2 badge badge-danger">التعليقات غير مفعلة</span>'!!}
                    {!! $lesson->pdf ? '<span class="ml-2 badge badge-success">يوجد ملف PDF</span>' : '<span class="ml-2 badge badge-danger">لا يوجد ملف PDF</span>'!!}
                    {!! $lesson->approve == 1 ? '<span class="ml-2 badge badge-success">يوجد امتحان علي الدرس</span>' : '<span class="ml-2 badge badge-danger">لا يوجد امتحان</span>'!!}
                </div>
                <div class="row mt-3">
                    <div class="col-12 pr-1">
                        @if ($lesson->video_name)
                            {!!$lesson->video_name!!}
                        @else
                            <video width="100%" controls autoplay controlsList="nodownload" oncontextmenu="return false;">
                                <source src="{{$lesson->video}}">
                            </video>
                        @endif
                    </div>
                </div>
                <div class="mt-5 align-items-top">
                    <h2>التفاصيل</h2>
                    <p>{{$lesson->lesson_description}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row ">
    <div class="col-lg-6 grid-margin ">
        <div class="card ">
            <div class="card-body ">
                <h4> الحضور</h4>
                <div class="table-responsive " id="printTable">
                    <table class="table" id="datatableid" >
                        <thead>
                            <tr>
                                <th>الرقم التعريفي</th>
                                <th>اسم الطالب</th>
                                <th>وقت الحضور</th>
                                <th>وقت الانتهاء</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($lesson->users as $user)
                                <tr>
                                    <td>{{$user->user->username}}</td>
                                    <td>{{$user->user->name}}</td>
                                    <td>{{$user->time_ago}}</td>
                                    <td>{{$user->end_at}}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">لم يحضر احد الدرس بعد</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <button id="print" class="btn btn-gradient-info mt-3 float-left">الطباعة</button>
            </div>
        </div>
    </div>
    <div class="col-lg-6 grid-margin ">
        <div class="card ">
            <div class="card-body ">
                <h4> الغياب</h4>
                <div class="table-responsive " id="printTable2">
                    <table class="table" id="datatableid2">
                        <thead>
                            <tr>
                                <th>الباركود</th>
                                <th>اسم الطالب</th>
                                <th>رقم الهاتف</th>
                                <th>المجموعة</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($mainusers as $u)
                                <tr>
                                    <td>{{$u->username}}</td>
                                    <td>{{$u->name}}</td>
                                    <td>{{$u->phone ? $u->phone : 'لا يوجد'}}</td>
                                    <td>{{$u->category->category_name}}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">لا يوجد طلبة بعد</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <button id="print2" class="btn btn-gradient-info mt-3 float-left">الطباعة</button>
            </div>
        </div>
    </div>
</div>
<div class="row ">
    <div class="col-12 grid-margin ">
        <div class="card ">
            <div class="card-body ">
                <h4 class="card-title ">تعليقات المقالات</h4>
                <div class="table-responsive ">
                    <table class="table " id="datatableid">
                        <thead>
                            <tr>
                                <th> رقم التعليق</th>
                                <th> التعليق</th>
                                <th> تاريخ التعليق</th>
                                <th> الطالب</th>
                                <th>لوحة التحكم</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($comments as $comment)
                                <tr>
                                    <td>{{$comment->id}}</td>
                                    <td>{{$comment->comment}}</td>
                                    <td>{{$comment->time_ago}}</td>
                                    <td>{{$comment->user->name}}</td>
                                    <td>
                                        @if ($comment->status == 0)
                                            <button type="button " class="btn btn-outline-primary btn-sm activiate" data-id="{{$comment->id}}">تفعيل</button>
                                        @endif
                                        <button type="button " class="btn btn-outline-danger btn-sm delete_comment" data-id="{{$comment->id}}">حذف</button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6"> لا يوجد بيانات</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="delete_comment" tabindex="-1" aria-labelledby="removeLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h2 class="text-light">حذف التعليق </h2>
            </div>
            <form action="{{aurl('articleComments/destroy')}}" method="post">
                @csrf
                <div class="modal-body">
                    <h3 class="text-center">هل تريد حذف التعليق</h3>
                </div>
                <div class="modal-footer">
                    <input type="hidden" value="" name="comment_id" id="comment_id">
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
                <h2 class="text-light">اظهار التعليق</h2>
            </div>
            <form action="{{aurl('articleComments/activate')}}" method="post">
                @csrf
                <div class="modal-body">
                    <h3 class="text-center">هل تريد اظهار التعليق</h3>
                </div>
                <div class="modal-footer">
                    <input type="hidden" value="" name="comment_id" id="comment_id_2">
                    <button type="submit" class="btn btn-primary" name="activiate">تفعيل</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                </div>
            </form>
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
        var css =`table, td, th {
            border: 1px solid black;
            text-align:center;
            margin:auto;
            direction:rtl;
        }
        #datatableid_wrapper .row:first-child{display:none;}
        #datatableid_wrapper .row:last-child{display:none;}
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
    function printData2()
    {
        var divToPrint=document.getElementById("printTable2");
        newWin= window.open("");
        newWin.document.write(divToPrint.outerHTML);
        var css =`table, td, th {
            border: 1px solid black;
            text-align:center;
            margin:auto;
            direction:rtl;
        }
        #printTable2 .row:first-child{display:none;}
        #printTable2 .row:last-child{display:none;}
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

    $('#print2').on('click',function(){
    printData2();
    })
</script>
<script>
    $(document).ready(function() {
        $('#datatableid2').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Arabic.json"
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $(".delete_comment").click(function() {
            var id = $(this).attr('data-id');
            $("#comment_id").val(id);
            $("#delete_comment").modal('toggle');
        });
        $(".activiate").click(function() {
            var id = $(this).attr('data-id');
            $("#comment_id_2").val(id);
            $("#activiate").modal('toggle');
        });
    });
</script>
@endpush
