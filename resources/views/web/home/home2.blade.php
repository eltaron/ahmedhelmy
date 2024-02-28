@extends('web.layouts.app')
@push('style')
<link rel="stylesheet" href="{{asset('web_files')}}/css/index.css" />

@endpush
@section('content')
<main>
    <section id="hero">
      <div id="carouselExampleDark" class="carousel carousel-dark slide">
        <div class="carousel-indicators">
          <button
            type="button"
            data-bs-target="#carouselExampleDark"
            data-bs-slide-to="0"
            class="active"
            aria-current="true"
            aria-label="Slide 1"
          ></button>
          <button
            type="button"
            data-bs-target="#carouselExampleDark"
            data-bs-slide-to="1"
            aria-label="Slide 2"
          ></button>
          <button
            type="button"
            data-bs-target="#carouselExampleDark"
            data-bs-slide-to="2"
            aria-label="Slide 3"
          ></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active" data-bs-interval="10000">
            <picture>
                <source media="(max-width:768px)" srcset="{{asset('web_files')}}/images/m333.png">
                <img src="{{asset('web_files')}}/images/m33.png" class="d-block" align="center" loading="lazy">
            </picture>
            <div class="carousel-caption d-flex align-items-center justify-content-center">
                <div>
                   <h5>كورسات تأسيسية</h5>
                   <p>كورسات تأسيسة في القواعد والبلاغة</p>
                </div>
               </div>
          </div>
          <div class="carousel-item">
            <picture>
                <source media="(max-width:768px)" srcset="{{asset('web_files')}}/images/m222.png">
                <img src="{{asset('web_files')}}/images/m22.png" class="d-block" align="center" loading="lazy">
            </picture>
            <div class="carousel-caption d-flex align-items-center justify-content-center">
                <div>
                   <h5>Second slide label</h5>
                   <p>
                     Some representative placeholder content for the second slide.
                   </p>
                </div>
               </div>
          </div>
          <div class="carousel-item">
            <picture>
                <source media="(max-width:768px)" srcset="{{asset('web_files')}}/images/m111.png">
                <img src="{{asset('web_files')}}/images/m11.png" class="d-block" align="center" loading="lazy">
            </picture>
            <div class="carousel-caption d-flex align-items-center justify-content-center">
             <div>
                <h5>Second slide label</h5>
                <p>
                  Some representative placeholder content for the second slide.
                </p>
             </div>
            </div>
          </div>
        </div>
        <button
          class="carousel-control-prev"
          type="button"
          data-bs-target="#carouselExampleDark"
          data-bs-slide="prev"
        >
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button
          class="carousel-control-next"
          type="button"
          data-bs-target="#carouselExampleDark"
          data-bs-slide="next"
        >
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </section>
    <section id="about">
      <div class="container">
        <h2 class="main-title">نبذة تعريفية</h2>
        <div class="row">
          <div
            class="col-lg-6 col-md-12 order-2 order-md-1 p-0 d-flex justify-content-center align-items-center"
          >
            <div>
              <h2>
                <i class="fa-regular fa-user"></i> الأستاذ <i>/</i>
                <span>رأفت جابر</span>
              </h2>
              <p>خادم  اللغة العربية</p>
              <ul>
                <li>
                  <i class="fa-solid fa-check"></i>
                  ليسانس دار العلوم جامعة القاهرة
                </li>
                <li>
                  <i class="fa-solid fa-check"></i>
                  خبرة ٣٠ عاما فى تدريس اللغة العربية للمرحلة الثانوية
                </li>
                <li>
                    <i class="fa-solid fa-check"></i>
                    حاصل على دورات عديدة فى طرق تدريس ومناهج اللغة العرلية
                </li>
                <li>
                    <i class="fa-solid fa-check"></i>
                    الدرجة ( كبير معلمين)
                </li>
                <li>
                    <i class="fa-solid fa-check"></i>
                    دورات تأسيسية فى القواعد والبلاغة
                </li>
              </ul>
            </div>
          </div>
          <div class="col-lg-6 col-md-12 order-1 order-md-2 text-center my-3 mb-5">
            <img
              src="{{asset('web_files')}}/images/m1.png"
              alt=""
              width="80%"
              style="filter: drop-shadow(2px 4px 6px black);"
              loading="lazy"
            />
          </div>
        </div>
      </div>
    </section>
    <section id="freevideos">
      <div class="container">
        <h2 class="main-title">الفيديوهات المجانية</h2>
        <div class="row">
            <div class="col-lg-6 col-md-12" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <div class="imgcontainer">
                  <img src="{{asset('web_files')}}/m1.jpg" class="w-100" alt="" loading="lazy"/>
                  <div class="text">
                    <h3>كورس تأسيس النحو</h3>
                    <p>كورس تأسيس النحو | الإعراب و البناء | الدرس الأول
                    </p>
                  </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12" data-bs-toggle="modal" data-bs-target="#exampleModal2">
                <div class="imgcontainer">
                  <img
                    src="{{asset('web_files')}}/m3.jpg"
                    class="w-100"
                    alt=""
                    loading="lazy"
                  />
                  <div class="text">
                    <h3>كورس تأسيس النحو</h3>
                    <p>كورس تأسيس النحو | الأسماء المبنية وعلامات بناء الأفعال | الدرس الثاني
                    </p>
                  </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12" data-bs-toggle="modal" data-bs-target="#exampleModal3">
                <div class="imgcontainer">
                  <img src="{{asset('web_files')}}/m2.jpg" class="w-100" alt="" loading="lazy"/>
                  <div class="text">
                    <h3>البونبوناية </h3>
                    <p>البونبوناية | كيف أعرب أيها - أيتها وما بعدها
                    </p>
                  </div>
                </div>
            </div>
        </div>
      </div>
    </section>
    <section id="freearticles">
      <h2 class="main-title">بعض المقالات</h2>
      <div class="container">
        @forelse ($articles as $k => $article)
        <div class="row">
            <div
              class="col-lg-6 col-md-12 order-2 {{$k%2 == 0 ? 'order-md-1' :'order-md-2'}} d-flex justify-content-center align-items-center"
            >
              <div>
                <h3>{{ \Illuminate\Support\Str::limit($article->article_name, 36, $end='...') }}</h3>
                <p>
                    {{ \Illuminate\Support\Str::limit($article->article_description, 240, $end='...') }}
                </p>
                <a href="{{url('signupnow')}}">المزيد...</a>
              </div>
            </div>
            <div class="col-lg-6 col-md-12 two order-1 {{$k%2 == 0 ? 'order-md-2' :'order-md-1'}}">
              <img src="{{$article->image->url}}" alt="" class="img1" loading="lazy"/>
            </div>
          </div>
        @empty
            <div class="alert alert-primary w-100" role="alert">
                لا يوجد مقالات بعد
            </div>
        @endforelse
      </div>
    </section>
    @if ($tops)
        <section class="mb-4" id="studients">
            <h2 class="main-title">طلابنا المتميزون</h2>
            <div id="wrapper">
            <div id="carousel">
                <div id="content">
                @foreach ($tops as $top)
                    <div class="item">
                        <img
                            src="{{$top->user->avatar ? $top->user->avatar : asset('web_files/top.jpg')}}" loading="lazy"
                        />
                        <h2>{{$top->user->name}}</h2>
                    </div>
                @endforeach
                </div>
            </div>
            @if (count($tops) > 4)
            <button id="prev">
                <svg
                xmlns="http://www.w3.org/2000/svg"
                width="40"
                height="40"
                viewBox="0 0 24 24"
                >
                <path fill="none" d="M0 0h24v24H0V0z" />
                <path
                    d="M15.61 7.41L14.2 6l-6 6 6 6 1.41-1.41L11.03 12l4.58-4.59z"
                />
                </svg>
            </button>
            <button id="next">
                <svg
                xmlns="http://www.w3.org/2000/svg"
                width="40"
                height="40"
                viewBox="0 0 24 24"
                >
                <path fill="none" d="M0 0h24v24H0V0z" />
                <path
                    d="M10.02 6L8.61 7.41 13.19 12l-4.58 4.59L10.02 18l6-6-6-6z"
                />
                </svg>
            </button>
            @endif
            </div>
        </section>
    @endif
</main>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">كورس تأسيس النحو | الإعراب و البناء | الدرس الأول</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <iframe width="100%" height="400" src="https://www.youtube.com/embed/gX-WHgMsqys?si=MlpwTVwvIt732_eW" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">كورس تأسيس النحو | الأسماء المبنية وعلامات بناء الأفعال | الدرس الثاني</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <iframe width="100%" height="400" src="https://www.youtube.com/embed/gX-WHgMsqys?si=CgFZc_icNqA" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">البونبوناية | كيف أعرب أيها - أيتها وما بعدها</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <iframe width="100%" height="400" src="https://www.youtube.com/embed/gX-WHgMsqys?si=HpKeLvn4tUI&t=2s" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
            </div>
        </div>
    </div>
</div>
@push('script')
<script src="{{asset('web_files')}}/js/index.js"></script>
@endpush
@endsection
