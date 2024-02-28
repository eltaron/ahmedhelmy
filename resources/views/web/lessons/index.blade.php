@extends('web.layouts.app2')
@push('style')
<link rel="stylesheet" href="{{asset('web_files')}}/css/dash.css" />
<style>
    #main {
    margin-bottom: 140px !important;
}
</style>
@endpush
@section('content')
<main>
    <div class="cover" style="background-image: url('{{asset('web_files')}}/header/h4.jpg');">
        <div class="bg">
            <h2>{{$category->category_name}}</h2>
        </div>
    </div>
    <section id="main">
      <div class="container mt-5 mb-5">
        <div class="row">
            @forelse ($category->lessons as $lesson)
                <div class="col-md-4 p-2 text-center">
                    <div class="card" style="width: 100%">
                    <div class="card-body">
                        <h2 class="card-title">
                        <i class="fa-solid fa-circle-play"></i>
                        {{$lesson->lesson_name}}
                        </h2>
                        <p class="card-text">
                            {{ \Illuminate\Support\Str::limit($lesson->lesson_description, 80, $end='...') }}
                        </p>
                        @if ($lesson->approve == 1 && $lesson->exam)
                            <a href="{{url('exams/exam/'.$lesson->exam->id)}}" class="card-link">الامتحان</a>
                        @endif
                        <a href="{{url('lessons/show/'.$lesson->id)}}" class="card-link">الدخول للدرس</a>
                    </div>
                    </div>
                </div>
            @empty
                <div class="w-100 text-center alert alert-primary text-right" role="alert">
                    <h2> لا يوجد دروس بعد في هذا القسم</h2>
                </div>
            @endforelse
        </div>
      </div>
    </section>
  </main>
@endsection
