@extends('admin.layouts.app')
@push('styles')
@endpush
@section('content')
<div class="page-header ">
    <h3 class="page-title ">
        <span class="page-title-icon bg-gradient-primary text-white mr-2 ">
            <i class="mdi mdi-home "></i>
        </span>&nbsp; رسائل الصفحة
    </h3>
</div>
<div class="row ">
    <div class="col-12 grid-margin ">
        <div class="card ">
            <div class="card-body ">
                <h4 class="card-title "> رسائل الصفحة</h4>
                <h2 class="text-center text-light" style="margin: 15px;">رسائل من خارج المشتركين</h2>
                <div class="table-responsive ">
                    <table class="table " id="datatableid">
                        <thead>
                            <tr>
                                <th> رقم الرسالة</th>
                                <th> الرسالة</th>
                                <th>  تاريخ الرسالة</th>
                                <th> اسم المرسل</th>
                                <th>الايميل</th>
                                <th>لوحة التحكم</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($messages2 as $message)
                                <tr>
                                    <td>{{$message->id}}</td>
                                    <td>{{$message->message}}</td>
                                    <td>{{$message->time_ago}}</td>
                                    <td>{{$message->username}}</td>
                                    <td>{{$message->email}}</td>
                                    <td>
                                        <button type="button " class="btn btn-outline-danger btn-sm delete_message" data-id="{{$message->id}}">حذف</button>
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
                <hr class="p-3" style="border-top: 3px solid rgb(38 58 131);">
                <h2 class="text-center text-light" style="margin: 15px;">رسائل من المشتركين</h2>
                <div class="table-responsive ">
                    <table class="table " id="datatableid_2">
                        <thead>
                            <tr>
                                <th> رقم الرسالة</th>
                                <th> الرسالة</th>
                                <th>  تاريخ الرسالة</th>
                                <th> اسم المرسل</th>
                                <th>لوحة التحكم</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($messages1 as $message)
                                <tr>
                                    <td>{{$message->id}}</td>
                                    <td>{{$message->message}}</td>
                                    <td>{{$message->time_ago}}</td>
                                    <td>{{$message->user->name}}</td>
                                    <td>
                                        <button type="button " class="btn btn-outline-danger btn-sm delete_message" data-id="{{$message->id}}">حذف</button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5"> لا يوجد بيانات</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
<div class="modal fade" id="delete_message" tabindex="-1" aria-labelledby="removeLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h2 class="text-light">حذف الرسالة </h2>
            </div>
            <form action="{{aurl('messages/destroy')}}" method="post">
                @csrf
                <div class="modal-body">
                    <h3 class="text-center">هل تريد حذف الرسالة</h3>
                </div>
                <div class="modal-footer">
                    <input type="hidden" value="" name="message_id" id="message_id">
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
    $('#datatableid_2').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Arabic.json"
        }
    });
</script>
<script>
    $(document).ready(function() {
        $(".delete_message").click(function() {
            var id = $(this).attr('data-id');
            $("#message_id").val(id);
            $("#delete_message").modal('toggle');
        });
    });
</script>
@endpush
