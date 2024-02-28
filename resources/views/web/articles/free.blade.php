@extends('web.layouts.app')
@push('style')
<link rel="stylesheet" href="{{asset('web_files')}}/css/index.css" />
@endpush
@section('content')
<!-- Articles Section -->
<section id="Articles" class="pt-5 mt-5">
    <div class="container mt-5 d-flex flex-column align-items-center mb-5 ">
      <div class="title d-flex align-items-center mb-5 wow slideInUp duration-1s">
        <h3>المقالات المجانية</h3>
        <img src="{{asset('web_files')}}/images/dna-icon.png" alt="">
        <img src="{{asset('web_files')}}/images/animal-cell.png" alt="">
      </div>
      <div class="row justify-content-center align-items-center mb-5 wow slideInUp duration-1s">
        <div class="col-12 col-lg-6 p-3">
          <div class="article d-flex align-items-center justify-content-between">
            <div class="article-img">
              <img src="{{asset('web_files')}}/images/article.jpg"  alt="">
            </div>
            <div class="article-content d-flex flex-column align-items-start justify-content-between me-5">
              <h3 class="article-title">الجهاز الدوري</h3>
              <p class="article-description">
                معلومات شيقة و مفيدة عن الجهاز الدوري.معلومات شيقة و مفيدة عن الجهاز الدوري.معلومات شيقة و مفيدة عن الجهاز الدوري
              </p>
              <button class="article-btn">إقرأ المزيد</button>
            </div>
          </div>
        </div>
        <div class="col-12 col-lg-6 p-3">
          <div class="article d-flex align-items-center justify-content-between">
            <div class="article-img w-50">
              <img src="{{asset('web_files')}}/images/article.jpg"  alt="">
            </div>
            <div class="article-content d-flex flex-column align-items-start justify-content-between me-5">
              <h3 class="article-title">الجهاز الدوري</h3>
              <p class="article-description">
                معلومات شيقة و مفيدة عن الجهاز الدوري.معلومات شيقة و مفيدة عن الجهاز الدوري.معلومات شيقة و مفيدة عن الجهاز الدوري
              </p>
              <button class="article-btn">إقرأ المزيد</button>
            </div>
          </div>
        </div>
        <div class="col-12 col-lg-6 p-3">
          <div class="article d-flex align-items-center justify-content-between">
            <div class="article-img w-50">
              <img src="{{asset('web_files')}}/images/article.jpg"  alt="">
            </div>
            <div class="article-content d-flex flex-column align-items-start justify-content-between me-5">
              <h3 class="article-title">الجهاز الدوري</h3>
              <p class="article-description">
                معلومات شيقة و مفيدة عن الجهاز الدوري.معلومات شيقة و مفيدة عن الجهاز الدوري.معلومات شيقة و مفيدة عن الجهاز الدوري
              </p>
              <button class="article-btn">إقرأ المزيد</button>
            </div>
          </div>
        </div>
        <div class="col-12 col-lg-6 p-3">
          <div class="article d-flex align-items-center justify-content-between">
            <div class="article-img w-50">
              <img src="{{asset('web_files')}}/images/article.jpg"  alt="">
            </div>
            <div class="article-content d-flex flex-column align-items-start justify-content-between me-5">
              <h3 class="article-title">الجهاز الدوري</h3>
              <p class="article-description">
                معلومات شيقة و مفيدة عن الجهاز الدوري.معلومات شيقة و مفيدة عن الجهاز الدوري.معلومات شيقة و مفيدة عن الجهاز الدوري
              </p>
              <button class="article-btn">إقرأ المزيد</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
