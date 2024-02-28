@extends('web.layouts.app')
@push('style')
<link rel="stylesheet" href="{{asset('web_files')}}/css/index.css" />
<link rel="stylesheet" href="{{asset('web_files')}}/css/contactus.css" />
@endpush
@section('content')
<!-- Contact Section -->
<section id="Contactus">
    <div class="container text-center my-5 pt-5  d-flex flex-column align-items-center">
      <div class="title d-flex align-items-center my-5 wow slideInUp duration-1s">
        <h3>تواصل معنا</h3>
        <img src="{{asset('web_files')}}/images/dna-icon.png" alt="">
        <img src="{{asset('web_files')}}/images/animal-cell.png" alt="">
      </div>
      <div class="row">
        <div class="col-md-6">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d27327.894472065647!2d30.960740740144853!3d31.11009866210714!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14f7ab78f233021f%3A0xc2cdebb004a208f8!2z2YPZgdixINin2YTYtNmK2K7YjCDZgtiz2YUg2YPZgdixINin2YTYtNmK2K7YjCDZg9mB2LEg2KfZhNi02YrYrtiMINmF2K3Yp9mB2LjYqSDYp9mE2LrYsdio2YrYqQ!5e0!3m2!1sar!2seg!4v1702801228281!5m2!1sar!2seg" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <div class="col-md-6">
            <form action="{{url('addMessage')}}" method="POST">
                @csrf
                <input class="w-100" type="text" placeholder="اسم المرسل" name="username" >
                <input class="w-100" type="number" placeholder="رقم التليفون" name="phone">
                <textarea class="w-100" type="textarea" rows="6" placeholder="اترك رسالتك هنا ..." name="message" required></textarea>
                <button class="contact-btn btn" type="submit">ارسال</button>
            </form>
        </div>
      </div>
    </div>
</section>
@endsection
