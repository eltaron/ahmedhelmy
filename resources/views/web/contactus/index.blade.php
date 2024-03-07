@extends('web.layouts.app')
@push('style')
<link rel="stylesheet" href="{{asset('web_files')}}/css/index.css" />
<link rel="stylesheet" href="{{asset('web_files')}}/css/contactus.css" />
@endpush
@section('content')
<!-- Contact Section -->
<section id="Contact" class="d-flex align-items-center ">
    <div class="container d-flex flex-column flex-md-row align-items-center justify-content-between gap-5 ">
      <div class="contactForm col-12 col-md-7 p-lg-5 ">
        <div class="card text-center text-md-end">
          <h2>تـــواصــل معــنا</h2>
          @include('web.includes.message')
          <form action="{{url('addMessage')}}" class="row justify-content-center align-items-center flex-column g-3">
            @csrf
            <input class="col-12" type="text" name="username" placeholder="اسم المستخدم">
            <input class="col-12" type="number" name="phone" placeholder="رقم التليفون">
            <textarea class="col-12" type="textarea" name="message" cols="60" rows="6" placeholder="اترك رسالتك هنا ..."></textarea>
            <button class="contact-btn btn" type="submit">ارسال</button>
          </form>
        </div>
      </div>
      <div class="contactIllustration col-12 col-md-5 ">
        <img src="{{asset('web_files')}}/images/contact.png" class="contactImg" alt="">
      </div>
    </div>
</section>
@endsection
