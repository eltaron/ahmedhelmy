@extends('web.layouts.app2')
@push('style')
<link rel="stylesheet" href="{{asset('web_files')}}/css/articleDetail.css" />
@endpush
@section('content')
<main>
    <div class="cover" style="background-image: url('{{asset('web_files')}}/header/h1.jpg');">
        <div class="bg">
            <h2>{{$article->article_name}}</h2>
        </div>
    </div>
    <section id="main">
      <div class="container">
        <div class="card w-100 mt-5 mb-5">
          <div
            id="carouselExampleIndicators"
            class="carousel slide"
            data-bs-ride="carousel"
          >
            <div class="carousel-indicators">
                @foreach ($article->images as $k => $img)
                    <button
                        type="button"
                        data-bs-target="#carouselExampleIndicators"
                        data-bs-slide-to="{{$k}}"
                        class="{{$k == 0 ? 'active' : ''}}"
                        aria-label="Slide {{$k+1}}"
                    ></button>
                @endforeach
            </div>
            <div class="carousel-inner">
                @foreach ($article->images as $k => $img)
                    <div class="carousel-item {{$k == 0 ? 'active' : ''}}">
                        <img
                        src="{{$img->url}}"
                        class="d-block w-100"
                        alt="..."
                        loading="lazy"
                        />
                    </div>
                @endforeach
            </div>
            <button
              class="carousel-control-prev"
              type="button"
              data-bs-target="#carouselExampleIndicators"
              data-bs-slide="prev"
            >
              <span
                class="carousel-control-prev-icon"
                aria-hidden="true"
              ></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button
              class="carousel-control-next"
              type="button"
              data-bs-target="#carouselExampleIndicators"
              data-bs-slide="next"
            >
              <span
                class="carousel-control-next-icon"
                aria-hidden="true"
              ></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
          <div class="card-body" style="padding: 0 20px">
            <h2 class="card-title"> {{$article->article_name}}</h2>
            <p class="card-text">
                {{$article->article_description}}
            </p>
            <hr />
            <div class="comments" id="comments">
              <div class="row">
                <div class="col-12 p-0" style="padding: 0 20px">
                  <form action="{{url('articles/addComment')}}" method="POST">
                    @csrf
                    <textarea
                      name="comment"
                      id=""
                      rows="6"
                      placeholder="اضافة تعليق"
                    ></textarea>
                    <input type="hidden" name="article_id" value="{{$article->id}}">
                    <button type="submit" class="original-button">
                      تعليق
                    </button>
                  </form>
                </div>
              </div>
              <hr />
              @forelse ($article->comments as $c)
                <div class="comment row p-2 pt-3">
                    <div class="col-12">
                    <div class="info d-flex">
                        <h4><i class="fa-regular fa-user"></i> {{$c->user->name}} </h4>
                        <h5><i class="fa-regular fa-clock"></i> {{$c->time_ago}}  </h5>
                    </div>
                    </div>
                    <div class="col-12">
                    <p class="p-1">
                        {{$c->comment}}
                    </p>
                    </div>
                </div>
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
          </div>
        </div>
      </div>
    </section>
  </main>
@endsection
