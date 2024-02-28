@extends('web.layouts.app')
@push('style')
<link rel="stylesheet" href="{{asset('web_files')}}/css/index.css" />
@endpush
@section('content')
<!-- Videos Section -->
<section id="Videos" class="pt-5 mt-5">
    <div class="container mt-5 d-flex flex-column align-items-center mb-5 ">
      <div class="title d-flex align-items-center mb-5 wow slideInUp duration-1s">
        <h3>الفيديوهات المجانية</h3>
        <img src="{{asset('web_files')}}/images/dna-icon.png" alt="">
        <img src="{{asset('web_files')}}/images/animal-cell.png" alt="">
      </div>
      <div class="row justify-content-center align-items-center mt-5 mb-5">
        <div class="col-12 p-3 col-md-6 col-lg-3 wow slideInUp duration-1s">
          <div class="video">
            <img src="{{asset('web_files')}}/images/bg.jpg" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">الخلية الحيوانية</h5>
              <p class="card-text">معلومات عن الخلايا الحيوانية</p>
              <a href="#" class="video-btn btn">شاهد الفيديو</a>
            </div>
          </div>
        </div>
        <div class="col-12 p-3 col-md-6 col-lg-3 wow slideInUp duration-1s">
          <div class="video">
            <img src="{{asset('web_files')}}/images/bg.jpg" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">الخلية الحيوانية</h5>
              <p class="card-text">معلومات عن الخلايا الحيوانية</p>
              <a href="#" class="video-btn btn">شاهد الفيديو</a>
            </div>
          </div>
        </div>
        <div class="col-12 p-3 col-md-6 col-lg-3 wow slideInUp duration-1s">
          <div class="video">
            <img src="{{asset('web_files')}}/images/bg.jpg" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">الخلية الحيوانية</h5>
              <p class="card-text">معلومات عن الخلايا الحيوانية</p>
              <a href="#" class="video-btn btn">شاهد الفيديو</a>
            </div>
          </div>
        </div>
        <div class="col-12 p-3 col-md-6 col-lg-3 wow slideInUp duration-1s">
          <div class="video">
            <img src="{{asset('web_files')}}/images/bg.jpg" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">الخلية الحيوانية</h5>
              <p class="card-text">معلومات عن الخلايا الحيوانية</p>
              <a href="#" class="video-btn btn">شاهد الفيديو</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
