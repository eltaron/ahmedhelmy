@extends('admin.layouts.app')
@push('styles')
@endpush
@section('content')
<div class="page-header ">
    <h3 class="page-title ">
        <span class="page-title-icon bg-gradient-primary text-white mr-2 ">
            <i class="mdi mdi-home "></i>
        </span>&nbsp; تعليقات المنشورات
    </h3>
</div>
<div class="row ">
    <div class="col-12 grid-margin ">
        <div class="card ">
            <div class="card-body ">
                <h4 class="card-title ">تعليقات المنشورات</h4>
                <div class="table-responsive ">
                    <table class="table " id="datatableid">
                        <thead>
                            <tr>
                                <th> رقم التعليق</th>
                                <th> التعليق</th>
                                <th>  تاريخ التعليق</th>
                                <th> الطالب</th>
                                <th>المنشور</th>
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
                                    <td>{{$comment->post->post_name}}</td>
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
            <form action="{{aurl('postComments/destroy')}}" method="post">
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
            <form action="{{aurl('postComments/activiate')}}" method="post">
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
