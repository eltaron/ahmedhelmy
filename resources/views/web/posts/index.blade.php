@extends('web.layouts.app2')
@push('style')
<link rel="stylesheet" href="{{asset('web_files')}}/css/posts.css" />
@endpush
@section('content')
<main>
    <div class="cover" style="background-image: url('{{asset('web_files')}}/header/h2.jpg');">
        <div class="bg">
            <h2>المنشورات</h2>
        </div>
    </div>
    <section id="main">
      <div class="container">
        @forelse ($posts as $k => $post)
            <article>
            <div class="text-center">
                <h3>{{$post->post_name}}</h3>
                <h5 class="text-left data_span mb-3" dir="ltr">{{$post->time_ago}} <i class="fa fa-calendar-alt"></i></h5>
            </div>
            <div class="row">
                <div
                id="carouselExampleIndicators{{$k}}"
                class="carousel slide"
                data-bs-ride="carousel"
                >
                    <div class="carousel-indicators">
                        @foreach ($post->images as $i => $item)
                        <button
                        type="button"
                        data-bs-target="#carouselExampleIndicators{{$k}}"
                        data-bs-slide-to="{{$i}}"
                        class="{{$i==0 ? 'active' : ''}}"
                        aria-label="Slide {{$i + 1}}"
                        ></button>
                        @endforeach

                    </div>
                    <div class="carousel-inner">
                        @foreach ($post->images as $i => $item)
                            <div class="carousel-item {{$i==0 ? 'active' : ''}}">
                            <img
                                src="{{$item->url}}"
                                class="d-block w-100"
                                alt="..."
                                loading="lazy"
                            />
                            </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators{{$k}}" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators{{$k}}" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
                <p>
                    {!!$post->post_description!!}
                </p>
            </div>
            @if($post->allow_comment == 1)
                <div class="d-flex lastrow" style="justify-content: space-between">
                    <div class="icon heart" data-id="{{$post->id}}">
                    <i class="fa-regular fa-heart"></i>
                    <h6>{{$post->likecount}}</h6>
                    </div>
                    <div class="icon" onclick="comment(this)">
                        <i class="fa-regular fa-comment"></i>
                        <h6>{{$post->comments_count}}</h6>
                    </div>
                </div>
                <div class="comments" id="comments" style="display: none">
                    <div class="row comment">
                    <div class="col-12">
                        <form action="{{url('posts/addComment')}}" method="post">
                            @csrf
                        <textarea
                            name="comment"
                            id=""
                            rows="6"
                            placeholder="اضافة تعليق"
                            required
                        ></textarea>
                        <input type="hidden" name="post_id" value="{{$post->id}}">
                        <button type="submit" class="original-button">تعليق</button>
                        </form>
                    </div>
                    </div>
                    @forelse ($post->comments as $c)
                        @if ($c->status == 1)
                            <div class="comment row p-2 pt-3">
                                <div class="col-12">
                                    <div class="info d-flex">
                                    <h4><i class="fa-regular fa-user"></i>{{$c->user->name}}</h4>
                                    <h5><i class="fa-regular fa-clock"></i> {{$c->time_ago}}</h5>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <p class="p-1">{{$c->comment}}
                                    </p>
                                </div>
                            </div>
                        @endif
                    @empty
                    <div class="p-4">
                        <div class="alert alert-primary text-right" role="alert">
                            لا يوجد تعليقات بعد
                        </div>
                    </div>
                    @endforelse
                </div>
            @endif
            </article>
        @empty
            <div class="alert alert-primary text-right" role="alert">
                لا يوجد منشورات بعد
            </div>
        @endforelse
      </div>
    </section>
  </main>
  @push('script')
  <script src="{{asset('web_files')}}/js/jquery-3.7.0.js"></script>
  <script>
    $(document).on("click", ".heart" ,function() {
        $(this).prop('disabled', true)
        var id = $(this).attr('data-id');
        $(this).toggleClass('heart');
        $(this).children('i').toggleClass('fa-regular fa-heart').toggleClass('fa-solid fa-heart');
        var x = $(this).children('i').next().text();
        $(this).children('i').next().text(Number(x)+1);
        $.ajax({
            type: 'POST',
            url: "{{ url('posts/like') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                _token: "{{ csrf_token() }}",
                blog_id: id,
            },
            beforeSend: function() {
            },
            success: function(msg) {

            }
        });
    });
  </script>
  <script>
     function comment(obj) {
        var mcomments = obj.parentNode.nextElementSibling;
        if (mcomments.style.display == "none") {
            mcomments.style.display = "block";
        } else {
            mcomments.style.display = "none";
        }
    }
  </script>
  @endpush
@endsection
