@extends('web.layouts.app')
@push('style')
<link rel="stylesheet" href="{{asset('web_files')}}/assets/Animate/css/animate.css">
@endpush
@section('content')
<main>
  <!-- Hero Section -->
  <section id="Hero" class="position-relative">
    <div class="container hero position-relative d-flex flex-column flex-md-row justify-content-center  justify-content-md-between align-items-center text-center text-md-end gap-5 gap-md-0">

      <div class="heroContent col-12 col-md-6">
        <h1>
          استعد لرحلة <div>تعلم الإنجليزية</div> بطرق ممتعة و مشوقة !
        </h1>
        <h3>
          انضم إلينا حيث يلتقي التعليم بالإلهام
        </h3>
        @if(Auth::user())
          <button class="heroBtn" onclick="window.location.href=`{{url('dashboard')}}`">
           الدخول للموقع
          </button>
        @else
          <button class="heroBtn" onclick="window.location.href=`{{url('login')}}`">
            أبدأ رحلتــك الآن
          </button>
        @endif
        
      </div>
      <div class="heroImg">
        <img src="{{asset('web_files')}}/images/hero.png" class="img-fluid" alt="let's learn english" />
      </div>
    </div>

  </section>

  <!-- About Section -->
  <section class="d-flex justify-content-center align-items-center pt-5" id="About">
    <div class="container d-flex flex-column flex-md-row justify-content-center justify-content-lg-between align-items-center gap-4">
      <div class="logo col-12 col-md-6 p-3">
        <img src="{{asset('web_files')}}/images/logoW.png" class="img-fluid" alt="Logo" />
      </div>
      <div class="aboutContent col-12 col-md-6 p-3">
        <h3 class="fw-bold mb-3">منصة التفوق</h3c>
          <h4 class="mb-3">هي منصة لتعليم اللغة الإنجليزية</h4>
          <h4 class="mb-3">تحت إشراف الأستاذ أحمد حلمي</h4>
          <ul class="mb-3">
            <li>الحاصل على ليسانس آداب اللغة الإنجليزية عام 1988</li>
            <li> خبرة أكثر من 20 عام في تدريس اللغة الإنجليزية لطلبة الثانوية العامة المصرية</li>
            <li>حاصل على دبلومة التدريس التفاعلي في اللغة الإنجليزية</li>
          </ul>
          <button onclick="window.location.href=`{{url('home#Contact')}}`">تواصل معنا</button>
      </div>
    </div>
  </section>

  <!-- Videos Section -->
  <section id="Videos">
    <h2>الفيديوهات المجانية</h2>
    <div class="container videos">
      <div class="row mt-5">
        <div class="col-12 col-md-6 col-lg-4">
          <div class="video d-flex flex-column justify-content-center align-items-center">
            <iframe width="100%" height="250" src="https://www.youtube.com/embed/7QdcfiNd9PU" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            <div class="videoData">
              <h3>
                المضارع البسيط
              </h3>
              <p>
                فيديو عن التصريف البسيط بالإنجليزية وأمثلة. انضموا لتحسين مهاراتكم اللغوية
              </p>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-6 col-lg-4">
          <div class="video d-flex flex-column justify-content-center align-items-center">
            <iframe width="100%" height="250" src="https://www.youtube.com/embed/7QdcfiNd9PU" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            <div class="videoData">
              <h3>
                المضارع البسيط
              </h3>
              <p>
                فيديو عن التصريف البسيط بالإنجليزية وأمثلة. انضموا لتحسين مهاراتكم اللغوية
              </p>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-6 col-lg-4">
          <div class="video d-flex flex-column justify-content-center align-items-center">
            <iframe width="100%" height="250" src="https://www.youtube.com/embed/7QdcfiNd9PU" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            <div class="videoData">
              <h3>
                المضارع البسيط
              </h3>
              <p>
                فيديو عن التصريف البسيط بالإنجليزية وأمثلة. انضموا لتحسين مهاراتكم اللغوية
              </p>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-6 col-lg-4">
          <div class="video d-flex flex-column justify-content-center align-items-center">
            <iframe width="100%" height="250" src="https://www.youtube.com/embed/7QdcfiNd9PU" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            <div class="videoData">
              <h3>
                المضارع البسيط
              </h3>
              <p>
                فيديو عن التصريف البسيط بالإنجليزية وأمثلة. انضموا لتحسين مهاراتكم اللغوية
              </p>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-6 col-lg-4">
          <div class="video d-flex flex-column justify-content-center align-items-center">
            <iframe width="100%" height="250" src="https://www.youtube.com/embed/7QdcfiNd9PU" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            <div class="videoData">
              <h3>
                المضارع البسيط
              </h3>
              <p>
                فيديو عن التصريف البسيط بالإنجليزية وأمثلة. انضموا لتحسين مهاراتكم اللغوية
              </p>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-6 col-lg-4">
          <div class="video d-flex flex-column justify-content-center align-items-center">
            <iframe width="100%" height="250" src="https://www.youtube.com/embed/7QdcfiNd9PU" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            <div class="videoData">
              <h3>
                المضارع البسيط
              </h3>
              <p>
                فيديو عن التصريف البسيط بالإنجليزية وأمثلة. انضموا لتحسين مهاراتكم اللغوية
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Contact Section -->
  <section id="Contact" class="d-flex align-items-center ">
    <div class="container d-flex flex-column flex-md-row align-items-center justify-content-between gap-5 ">
      <div class="contactForm col-12 col-md-7 p-lg-5 ">
        <div class="card text-center text-md-end">
          <h2>تـــواصــل معــنا</h2>
          <form action="" class="row justify-content-center align-items-center flex-column g-3">
            <input class="col-12" type="text" placeholder="اسم المستخدم">
            <input class="col-12" type="number" placeholder="رقم التليفون">
            <textarea class="col-12" type="textarea" cols="60" rows="6" placeholder="اترك رسالتك هنا ..."></textarea>
            <button class="contact-btn btn" type="submit">ارسال</button>
          </form>
        </div>
      </div>
      <div class="contactIllustration col-12 col-md-5 ">
        <img src="{{asset('web_files')}}/images/contact.png" class="contactImg" alt="">
      </div>
    </div>
  </section>
</main>
@push('script')
<script src="{{asset('web_files')}}/assets/Animate/js/wow.min.js"></script>
<script>
  new WOW().init();
</script>
@endpush
@endsection