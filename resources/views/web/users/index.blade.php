@extends('web.layouts.app2')
@push('style')
<link rel="stylesheet" href="{{asset('web_files')}}/css/dash.css" />
@endpush
@section('content')
<main>
    <div class="headerBG text-center p-5 d-flex align-items-center justigy-content-center">
        <div class="bg w-100">
            <h2>الحساب الشخصي</h2>
        </div>
    </div>
    <section id="main">
      <div class="row">
        <div class="col-md-12 col-lg-3 main_bg">
          <div
            class="nav flex-column nav-pills text-center"
            id="tablist"
            role="tablist"
            aria-orientation="vertical"
          >
            <div class="main">
              <img
                class=""
                src="{{Auth::user()->avatar ? Auth::user()->avatar : asset('web_files/images/avatar.jpg')}}"
                alt=""
                width="200"
                height="200"
                style="border-radius: 50% !important;"
              />
              <h2 class="text-light">{{Auth::user()->name}}</h2>
            </div>
            <a
              class="nav-link active"
              id="nav-home-tab"
              data-bs-toggle="tab"
              data-bs-target="#nav-home"
              type="button"
              role="tab"
              aria-controls="nav-home"
              aria-selected="true"
            >
              البيانات الشخصية</a
            >
            <a
              class="nav-link"
              id="nav-exams-tab"
              data-bs-toggle="tab"
              data-bs-target="#nav-exams"
              type="button"
              role="tab"
              aria-controls="nav-exams"
              aria-selected="false"
              >تعديل الحساب</a
            >
            <a
              class="nav-link"
              id="nav-avatar-tab"
              data-bs-toggle="tab"
              data-bs-target="#nav-avatar"
              type="button"
              role="tab"
              aria-controls="nav-avatar"
              aria-selected="false"
              > إضافة صورة شخصية</a
            >
            <a
              class="nav-link"
              id="nav-records-tab"
              data-bs-toggle="tab"
              data-bs-target="#nav-records"
              type="button"
              role="tab"
              aria-controls="nav-records"
              aria-selected="false"
              >نتائج الامتحانات</a
            >
            <a
              class="nav-link"
              id="nav-books-tab"
              data-bs-toggle="tab"
              data-bs-target="#nav-books"
              type="button"
              role="tab"
              aria-controls="nav-books"
              aria-selected="false"
            >
              تواصل معنا
            </a>
          </div>
        </div>
        <!-- slides -->
        <div
          class="pt-5 pb-5 col-md-12 col-lg-9 tab-content p-0"
          id="nav-tabContent"
        >
          <div
            class="tab-pane fade show active"
            id="nav-home"
            role="tabpanel"
            aria-labelledby="nav-home-tab"
            >
            <div class="container">
              <form
                class="sign"
                method="POST"
              >
                <label for="name"
                  ><i class="fa fa-user" aria-hidden="true"></i> اسم
                  المستخدم</label
                >
                <input value="{{Auth::user()->name}}" disabled="" />
                <label for="name"
                  ><i class="fa fa-barcode" aria-hidden="true"></i> الكود
                  الشخصي</label
                >
                <input value="{{Auth::user()->username}}" disabled="" />
                <label for="email"
                  ><i class="fa fa-envelope" aria-hidden="true"></i> البريد
                  الالكتروني</label
                >
                <input value="{{Auth::user()->email}}" disabled="" />
                <label for="phone"
                  ><i class="fa fa-phone" aria-hidden="true"></i> رقم
                  الهاتف</label
                >
                <input value="{{Auth::user()->phone}}" disabled="" />
              </form>
            </div>
          </div>
          <div
            class="tab-pane fade"
            id="nav-exams"
            role="tabpanel"
            aria-labelledby="nav-exams-tab"
            >
            <div class="container">
              <form class="sign" action="{{url('profile/update')}}" method="POST">
                @csrf
                <input type="hidden" name="user" value="{{encrypt(Auth::user()->id)}}">
                <label for="name"> اسم المستخدم</label>
                <input type="text" name="uname" value="{{Auth::user()->name}}"  >
                <label for="password"> كلمة المرور</label>
                <input type="password" name="password" placeholder="يرجي ادخال كلمة المرور" >
                <label for="email"> البريد الالكتروني</label>
                <input type="email" name="email" value="{{Auth::user()->email}}" >
                <label for="phone"> رقم الهاتف</label>
                <input type="number" name="phone" value="{{Auth::user()->phone}}">
                <button class="original-button" type="submit">تعديل</button>
              </form>
            </div>
          </div>
          <div
            class="tab-pane fade"
            id="nav-avatar"
            role="tabpanel"
            aria-labelledby="nav-avatar-tab"
            >
            <div class="container">
              <form class="sign" action="{{url('profile/avatar')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="user" value="{{encrypt(Auth::user()->id)}}">
                <label for="name" class="mb-4"> إضافة صورة</label>
                <input type="file" name="avatar" accept="image/*"  required style="background-color: transparent;height:auto">
                <button class="original-button" type="submit">إضافة</button>
              </form>
            </div>
          </div>
          <div
            class="tab-pane fade"
            id="nav-records"
            role="tabpanel"
            aria-labelledby="nav-records-tab"
          >
            <div class="container">
              <div class="container">
                <div class="table-responsive">
                  <table class="table table-bordered text-center">
                    <thead>
                      <tr>
                        <th scope="col">الامتحان</th>
                        <th scope="col">نوع الامتحان</th>
                        <th scope="col">تاريخ اداء الامتحان</th>
                        <th scope="col">النتيجة</th>
                        <th scope="col">النتيجة الكلية</th>
                      </tr>
                    </thead>
                    <tbody>
                        @forelse ($answers as $answer)
                        <tr>
                            <td>{{$answer->exam->exam_name}}</td>
                            <td>
                                @if ($answer->exam->type == 0)
                                    <label class="bg-primary text-light" style="font-size: 15px;">جزئي</label>
                                @else
                                    <label class="bg-success text-light" style="font-size: 15px;">شامل</label>
                                @endif
                            </td>
                            <td>{{$answer->time_ago}} </td>
                            <td>{{$answer->mark}}</td>
                            <td>{{$answer->fullmark}}</td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">لا توجد اي نتائج</td>
                        </tr>
                    @endforelse
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div
            class="tab-pane fade"
            id="nav-books"
            role="tabpanel"
            aria-labelledby="nav-books-tab"
          >
            <div class="container">
              <form action="{{url('profile/contact')}}" method="POST">
                @csrf
                <input type="hidden" name="user" value="{{encrypt(Auth::user()->id)}}">
                <textarea
                  placeholder="كتابة الرسالة"
                  name="message"
                  id="message"
                  class="p-3"
                  required=""
                  rows="10"
                ></textarea>
                <button class="original-button" type="submit">ارسال</button>
              </form>
            </div>
          </div>
          <div
            class="tab-pane fade"
            id="nav-lives"
            role="tabpanel"
            aria-labelledby="nav-lives-tab"
          >
            <div class="container">
              <h2 class="main-title">البث المباشر</h2>
              <div class="table-responsive">
                <table class="table table-bordered text-center">
                  <thead>
                    <tr>
                      <th scope="col">عنوان البث</th>
                      <th scope="col">تاريخ البث</th>
                      <th scope="col">الذهاب للبث</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>امتحان شامل 1</td>
                      <td>منذ 9 أشهر</td>
                      <td>
                        <a href="">الذهاب للبث</a>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
@endsection
