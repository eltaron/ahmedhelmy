@extends('admin.layouts.app')
@push('styles')
@endpush
@section('content')
<div class="page-header ">
    <h3 class="page-title ">
        <span class="page-title-icon bg-gradient-primary text-white mr-2 ">
            <i class="mdi mdi-home "></i>
        </span>&nbsp; الصفحه الرئيسية
    </h3>
</div>
<div class="row">
    <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-darked card-img-holder text-white">
            <div class="card-body">
                <img src="{{asset('admin_files')}}/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image">
                <h4 class="font-weight-normal mb-3"> عدد الطلاب <i class="mdi mdi-account-multiple-plus mdi-24px float-right"></i>
                </h4>
                <h2 class="mb-5"> طالب </h2>

            </div>
        </div>
    </div>
    <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-darked card-img-holder text-white">
            <div class="card-body">
                <img src="{{asset('admin_files')}}/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image">
                <h4 class="font-weight-normal mb-3"> عدد الامتحانات <i class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
                </h4>
                <h2 class="mb-5"> امتحان</h2>

            </div>
        </div>
    </div>
    <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-darked card-img-holder text-white">
            <div class="card-body">
                <img src="{{asset('admin_files')}}/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image">
                <h4 class="font-weight-normal mb-3"> عدد الدروس <i class="mdi mdi-note-multiple-outline mdi-24px float-right"></i>
                </h4>
                <h2 class="mb-5"> درس </h2>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">احصائيات الطلاب</h4>
                <canvas id="areaChart" style="height:250px"></canvas>
                <input type="hidden" id="num_1" value="">
                <input type="hidden" id="num_2" value="">
                <input type="hidden" id="num_3" value="">
                <input type="hidden" id="num_4" value="">
                <input type="hidden" id="num_5" value="">
                <input type="hidden" id="num_6" value="">

                <input type="hidden" id="num_13" value="">
                <input type="hidden" id="num_14" value="">
                <input type="hidden" id="num_15" value="">
                <input type="hidden" id="num_16" value="">
                <input type="hidden" id="num_17" value="">
                <input type="hidden" id="num_18" value="">

                <input type="hidden" id="num_19" value="">
                <input type="hidden" id="num_20" value="">
                <input type="hidden" id="num_21" value="">
                <input type="hidden" id="num_22" value="">
                <input type="hidden" id="num_23" value="">
                <input type="hidden" id="num_24" value="">
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">احصائيات الموقع</h4>
                <canvas id="pieChart" style="height:250px"></canvas>
                <input type="hidden" id="num_7" value="">
                <input type="hidden" id="num_8" value="">
                <input type="hidden" id="num_9" value="">
            </div>
        </div>
    </div>
    <div class="col-lg-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">احصائيات الموقع</h4>
                <canvas id="pieChart2" style="height:250px"></canvas>
                <input type="hidden" id="num_10" value="">
                <input type="hidden" id="num_11" value="">
                <input type="hidden" id="num_12" value="">
            </div>
        </div>
    </div>
</div>
<div class="row ">
    <div class="col-12 grid-margin ">
        <div class="card ">
            <div class="card-body ">
                <h2> اخرالطلاب</h2>
                <div class="table-responsive ">
                    <table class="table ">
                        <thead>
                            <tr>
                                <th>الرقم التعريفي</th>
                                <th> اسم المستخدم </th>
                                <th> الايميل </th>
                                <th> تاريخ التسجيل</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->email}}</td>
                                <td>{{$item->time_ago}}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4">لا يوجد مستخدمين بعد</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 grid-margin ">
        <div class="card ">
            <div class="card-body ">
                <h4> اخر الدروس</h4>
                <div class="table-responsive ">
                    <table class="table ">
                        <thead>
                            <tr>
                                <th>الرقم التعريفي</th>
                                <th> اسم الدرس</th>
                                <th> تاريخ النشر</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($lessons as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->lesson_name}}</td>
                                <td>{{$item->time_ago}}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3">لا يوجد دروس بعد</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 grid-margin ">
        <div class="card ">
            <div class="card-body ">
                <h4> اخر الرسائل</h4>
                <div class="table-responsive ">
                    <table class="table ">
                        <thead>
                            <tr>
                                <th>كاتب الرسالة</th>
                                <th>الرسالة</th>
                                <th>التاريخ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($messages as $item)
                            <tr>
                                <td>{{$item->user? $item->user->name : ''}}</td>
                                <td>{{$item->message}}</td>
                                <td>{{$item->time_ago}}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3">لا يوجد رسايل بعد</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="{{asset('admin_files')}}/js/chart.min.js"></script>
<script src="{{asset('admin_files')}}/js/chart.js"></script>
<script src="{{asset('admin_files')}}/js/dashboard.js"></script>
<script src="{{asset('admin_files')}}/js/todolist.js"></script>
@endpush
