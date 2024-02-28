@extends('web.layouts.app2')
@push('style')
<link rel="stylesheet" href="{{asset('web_files')}}/css/lesson.css" />
<style>
    iframe{
        display: block;
        width: 70%;
        margin: 50px auto;
        min-height: 600px
    }
    .main_video {
        background-color: rgb(255 255 255 / 80%);
        padding: 30px;
        text-align: center;
    }
    .main_video .original-button {
        margin: 8% auto;
        border-radius: 0;
        padding: 30px;
        font-weight: bold;
    }
</style>
@endpush
@section('content')
<main>
    <section id="mainbg">
      <h2 class="text-center">{{$lesson->lesson_name}}</h2>
    </section>
    <section id="main">
      <div class="">
        @if($lessonUser)
            @if ($lesson->video_name)
                <div class="embed-responsive embed-responsive-16by9">
                    {!!$lesson->video_name!!}
                </div>
            @endif
            @if ($lesson->video)
                <div class="player" dir="ltr">
                    <video
                      class="video-screen"
                      preload="auto"
                      src="{{$path}}"
                      type="video/mp4"
                      poster="{{$lesson->imagethumb ? $lesson->imagethumb : asset('web_files/images/logo.png')}}"
                      msallowfullscreen
                      webkitallowfullscreen
                      mozallowfullscreen
                      allowfullscreen
                      controlsList="nodownload"
                      oncontextmenu="return false;"
                    >
                      Sorry, your browser doesn't support HTML5 video playback.
                    </video>
                    <div class="controls active">
                      <button class="play start"></button>
                      <input
                        type="range"
                        class="volume-bar"
                        value="70"
                        min="0"
                        max="100"
                      />
                      <input type="range" class="time-bar" value="0" min="0" max="" />
                      <time class="time d-none d-md-block text-center">N/A</time>
                      <div class="speed text-center">
                        <select>
                          <option value=".25">.25</option>
                          <option value=".5">.5</option>
                          <option value=".75">.75</option>
                          <option value="1" selected>1</option>
                          <option value="1.25">1.25</option>
                          <option value="1.5">1.5</option>
                          <option value="1.75">1.75</option>
                          <option value="2">2</option>
                        </select>
                      </div>
                      <button class="fullscreen-button"></button>
                    </div>
                    <input class="file-chooser" type="hidden" />
                  </div>
            @endif
        @else
            <form class="main_video" action="{{url('lessons/startLesson')}}" method="post">
                @csrf
                <input type="hidden" name="lesson_id" value="{{$lesson->id}}">
                <button name="add" type="submit" class="original-button">بدء الدرس</button>
            </form>
        @endif

      </div>
      <div class="container" style="margin-top: -15px">
        <h2>{{$lesson->lesson_name}} </h2>
        @if ($lesson->lesson_description)
            <p class="mainp">{{$lesson->lesson_description}}</p>
        @endif
        <hr>
        @if($lessonUser)
            @if($lessonUser->end_at == Null)
                <h2 class="text-right pt-3"> انهاء الدرس</h2>
                <form class="text-right" action="{{url('lessons/endLesson')}}" method="post">
                    @csrf
                    <input type="hidden" name="lesson_id" value="{{$lesson->id}}">
                    <button name="end" type="submit" class="original-button mt-3" style="padding: 7px 46px;">انهاء</button>
                </form>
                <hr />
            @endif
        @endif
        @if ($lesson->pdf)
            <h2>تحميل الملف الخاص بالشرح</h2>
            <a class="original-button"  href="{{$lesson->pdf}}" >ورق الشرح</a>
            <hr>
        @endif
        @if ($lesson->allow_comment == 1)
        <h2>اضافة تعليق</h2>
        <div class="comments" id="comments">
          <div class="row">
            <div class="col-12">
                <form  action="{{url('lessons/addComment')}}" method="POST">
                    @csrf
                    <textarea
                    name="comment"
                    id=""
                    rows="6"
                    placeholder="اضافة تعليق"
                    ></textarea>
                    <input type="hidden" name="lesson_id" value="{{$lesson->id}}">
                    <button type="submit" class="original-button">تعليق</button>
                </form>
            </div>
          </div>
          <hr />
          <h2>التعليقات</h2>
            @forelse ($lesson->comments as $k=>$c)
                @if ($c->status == 1)
                    <div class="comment row pt-3">
                        <div class="col-12">
                        <div class="info d-flex">
                            <h4><i class="fa-regular fa-user"></i> {{$c->user->name}} </h4>
                            <h5><i class="fa-regular fa-clock"></i>{{$c->time_ago}}</h5>
                        </div>
                        </div>
                        <div class="col-12">
                        <p class="p-1">
                            {{$c->comment}}
                        </p>
                        </div>
                    </div>
                    @if ($k+1 != count($lesson->comments))
                        <hr>
                    @endif
                @endif
            @empty
                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-primary text-right" role="alert">
                            لا يوجد تعليقات بعد
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
        @endif
      </div>
    </section>
  </main>
  @push('script')
      <script src="{{asset('web_files')}}/js/video.js"></script>
  @endpush
@endsection
