@extends('admin.layouts.app')
@push('styles')
@endpush
@section('content')
<div class="page-header ">
    <h3 class="page-title ">
        <span class="page-title-icon bg-gradient-primary text-white mr-2 ">
            <i class="mdi mdi-home "></i>
        </span>&nbsp;{{$category->category_name}}
    </h3>
</div>
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{$category->category_name}}</h4>
                <div class="d-flex">
                    <div class="d-flex align-items-center text-muted font-weight-light">
                        <span class="badge badge-success">{{$category->mparent ? $category->mparent->category_name : "قسم رئيسي"}} </span>
                    </div>
                </div>
                <div class="mt-5 align-items-top">
                    <h2>التفاصيل</h2>
                    <p>{{$category->category_description}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row ">
    <div class="col-lg-12 grid-margin ">
        <div class="card ">
            <div class="card-body ">
                <h4> الطلبة بالقسم</h4>
                <div class="table-responsive " id="printTable">
                    <table class="table" id="datatableid" >
                        <thead>
                            <tr>
                                <th>الرقم التعريفي</th>
                                <th>اسم الطالب</th>
                                <th>رقم الهاتف</th>
                                <th>تاريخ الانضمام</th>
                                <th>الحالة</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($category->users as $u)
                                <tr>
                                    <td>{{$u->username }}</td>
                                    <td>{{$u->name }}</td>
                                    <td>{{$u->phone }}</td>
                                    <td>{{$u->time_ago }}</td>
                                    <td>
                                        @if ($u->status==1)
                                            <label class="badge badge-success">مفعل</label>
                                        @else
                                            <label class="badge badge-danger">غير مفعل</label>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">لا يوجد طلبة</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <button id="print" class="btn btn-gradient-info mt-3 float-left">الطباعة</button>
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
    </script>
@endpush
