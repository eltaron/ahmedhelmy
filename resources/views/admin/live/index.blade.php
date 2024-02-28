@extends('admin.layouts.app')
@push('styles')
@endpush
@section('content')
<div class="page-header ">
    <h3 class="page-title ">
        <span class="page-title-icon bg-gradient-primary text-white mr-2 ">
            <i class="mdi mdi-home "></i>
        </span>&nbsp; البث المباشر
    </h3>
    <button style="margin-right:150px; font-size:22px" type="button " class="btn btn-primary btn-lg" data-toggle="modal" data-target="#add">أضافة بث مباشر</button>
</div>
<div class="row ">
    <div class="col-12 grid-margin ">
        <div class="card ">
            <div class="card-body ">
                <h4> البث المباشر</h4>
                <div class="table-responsive ">
                    <table class="table ">
                        <thead>
                            <tr>
                                <th>رقم البث</th>
                                <th>التاريخ</th>
                                <th>القسم</th>
                                <th>التحكم</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($lives as $live)
                                <tr>
                                    <td>{{$live->id}}</td>
                                    <td>{{$live->time_ago}} <br><br> {{$live->created_at}}</td>
                                    <td>{{$live->category->category_name}} </td>
                                    <td>
                                        <a href="{{$live->link}}" class="btn btn-outline-primary btn-sm">الذهاب للبث</a>
                                        <button type="button " class="btn btn-outline-danger btn-sm delete" data-id="{{$live->id}}">حذف</button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">لا يوجد بيانات</td>
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
            <div class="modal-header bg-danger">
                <h2 class="text-light">اضافة بث مباشر </h2>
            </div>
            <form action="{{aurl('live/store')}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group ">
                        <h4>اضافة لنك البث</h4>
                        <textarea class="form-control" name="description" required style="min-height: 100px;"></textarea>
                    </div>
                    <div class="form-group ">
                        <h4>القسم الرئيسي؟</h4>
                        <select name="parent" class="form-control inputName " required>
                            @foreach ($maincategories as $c)
                                <option class="text-primary" value="{{$c->id}}">{{$c->category_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit " class="btn btn-danger" name="add">اضافة بث مباشر</button>
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
                <h2 class="text-light">حذف البث </h2>
            </div>
            <form action="{{aurl('live/destroy')}}" method="post">
                @csrf
                <div class="modal-body">
                    <h3 class="text-center">هل تريد حذف هذا البث</h3>
                </div>
                <div class="modal-footer">
                    <input type="hidden" value="" name="live_id" id="live_id">
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
        $(".delete").click(function() {
            var id = $(this).attr('data-id');
            $("#live_id").val(id);
            $("#remove").modal('toggle');
        });
    });
</script>
@endpush
