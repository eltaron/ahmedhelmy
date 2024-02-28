@extends('web.layouts.app2')
@push('style')
<link rel="stylesheet" href="{{asset('web_files')}}/css/articles.css" />
@endpush
@section('content')
<main>
    <div class="cover" style="background-image: url('{{asset('web_files')}}/header/h1.jpg');">
        <div class="bg">
            <h2>المقالات</h2>
        </div>
    </div>
    <section id="main">
      <div class="container">
        @forelse ($articles as $article)
        <div class="row">
          <div class="col-md-3">
            <img
              src="{{$article->image->url}}"
              alt=""
            />
          </div>
          <div class="col-md-9">
            <h2>{{ \Illuminate\Support\Str::limit($article->article_name, 30, $end='...') }}</h2>
            <p>
                {{ \Illuminate\Support\Str::limit($article->article_description, 150, $end='...') }}
            </p>
            <a href="{{url('articles/show/'.$article->id)}}">الذهاب الى المقال</a>
          </div>
        </div>
        @empty
        <div class="row w-100">
                <div class="col-12">
                    <div class="alert alert-primary text-right" role="alert">
                        لا يوجد مقالات بعد
                    </div>
                </div>
            </div>
        @endforelse
      </div>
    </section>
  </main>
@endsection
