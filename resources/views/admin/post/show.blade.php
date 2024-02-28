@extends('admin.layouts.app')
@push('styles')
@endpush
@section('content')
<div class="page-header ">
    <h3 class="page-title ">
        <span class="page-title-icon bg-gradient-primary text-white mr-2 ">
            <i class="mdi mdi-home "></i>
        </span>&nbsp;{{$post->post_name}}
    </h3>
</div>
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{$post->post_name}}</h4>
                <div class="d-flex">
                    <div class="d-flex align-items-center text-muted font-weight-light">
                        {!! $post->allow_comment == 1 ? '<span class="badge badge-success">التعليقات مفعلة</span>' : '<span class="badge badge-danger">التعليقات غير مفعلة</span>'!!}
                    </div>
                </div>
                <div class="mt-5 align-items-top">
                    <h2>التفاصيل</h2>
                    <p>{{$post->post_description}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 grid-margin ">
        <div class="card ">
            <div class="card-body ">
                <h3 class="card-title mb-3">جميع صور المنشور</h3>
                <div class="row">
                    @foreach ($post->images as $item)
                        <div class="col-md-4 p-2">
                            <div class="card bg-dark text-white">
                                <img class="card-img" src="{{$item->url}}" alt="Card image" width="100%" height="200">
                                <div class="card-img-overlay text-center">
                                    <button type="button " class="mt-5 btn btn-danger btn-lg delete_post" data-id="{{$item->id}}" data-post_id="{{$post->id}}">حذف</button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 grid-margin ">
        <div class="card ">
            <div class="card-body ">
                <h3 class="card-title mb-3">جميع تعليقات المنشور</h3>
                <div class="row">
                    @forelse ($post->comments as $comment)
                        <div class="col-md-4 grid-margin stretch-card">
                            <div class="card" style="background-color: #263a83 !important;">
                                <div class="card-body">
                                    <div class="media">
                                        <i class="mdi mdi-comment-text icon-md text-info d-flex align-self-start ml-3"></i>
                                        <div class="media-body">
                                            <h3>{{$comment->user->name}}</h3>
                                            <p class="card-text">{{$comment->comment}}</p>
                                        </div>
                                    </div>
                                    <h5 class="card-title text-left">{{$comment->time_ago}}</h5>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-md-4 grid-margin stretch-card">لا يوجد تعليقات</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="remove" tabindex="-1" aria-labelledby="removeLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h2 class="text-light">حذف منشور</h2>
            </div>
            <form action="{{aurl('posts/deleteImage')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <h3 class="text-center">هل تريد حذف الصورة</h3>
                </div>
                <div class="modal-footer">
                    <input type="hidden" value="" name="image_id" id="image_id_1">
                    <input type="hidden" value="" name="post_id" id="post_id_1">
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
        $(".delete_post").click(function() {
            var id          = $(this).attr('data-id');
            var post_id  = $(this).attr('data-post_id');
            $("#image_id_1").val(id);
            $("#post_id_1").val(post_id);
            $("#remove").modal('toggle');
        });
    });
</script>
@endpush
