@extends('web.layouts.app2')
@push('style')
<link rel="stylesheet" href="{{asset('web_files')}}/css/dash.css" />
@endpush
@section('content')
<main>
    <div class="cover text-center p-5" style="background-image: url('{{asset('web_files')}}/header/h4.jpg');">
        <div class="bg">
            <h2>الرئيسية</h2>
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
                class="p-2"
                src="{{asset('web_files')}}/biological.png"
                alt=""
                width="200"
              />
              <p>{{Auth::user()->category ? Auth::user()->category->category_name : ''}}</p>
            </div>
            <a
              class="nav-link active mt-4"
              id="nav-home-tab"
              data-bs-toggle="tab"
              data-bs-target="#nav-home"
              type="button"
              role="tab"
              aria-controls="nav-home"
              aria-selected="true"
            >
              اقسام المنهج</a
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
              >الامتحانات الشاملة</a
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
              >الصوتيات</a
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
              الملخصات
            </a>
            <a
              class="nav-link"
              id="nav-lives-tab"
              data-bs-toggle="tab"
              data-bs-target="#nav-lives"
              type="button"
              role="tab"
              aria-controls="nav-lives"
              aria-selected="false"
              >البث المباشر</a
            >
          </div>
        </div>
        <!-- slides -->
        <div
          class="p-1 p-md-2 p-lg-5 col-md-12 col-lg-9 tab-content p-0"
          id="nav-tabContent"
        >
          <div
            class="tab-pane fade show active"
            id="nav-home"
            role="tabpanel"
            aria-labelledby="nav-home-tab"
            >
            <div class="container">
              <div class="row text-center">
                @forelse ($categories as $category)
                <div class="col-md-6 col-lg-6 mb-2">
                  <div class="card w-100">
                    <img
                      src="{{$category->image}}"
                      class="card-img-top"
                      alt="..."
                    />
                    <div class="card-body">
                      <h4 class="card-title">{{$category->category_name}}</h4>
                      <p class="card-text">{{ \Illuminate\Support\Str::limit($category->category_description, 100, $end='...') }}</p>
                      <a class="original-button" href="{{url('lessons/lesson/'.$category->id)}}">الذهاب للقسم</a>
                    </div>
                  </div>
                </div>
                @empty
                <div class="alert alert-danger" role="alert">
                    لا يوجد اقسام بعد
                </div>
                @endforelse
              </div>
            </div>
          </div>
          <div
            class="tab-pane fade"
            id="nav-exams"
            role="tabpanel"
            aria-labelledby="nav-exams-tab"
            >
            <div class="container">
              <div class="table-responsive">
                <table class="table table-bordered text-center">
                  <thead>
                    <tr>
                      <th scope="col">الامتحان</th>
                      <th scope="col">تاريخ الامتحان</th>
                      <th scope="col">نوع الامتحان</th>
                      <th scope="col">الذهاب الامتحان</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($fullExams as $fullExam)
                        <tr>
                            <td> {{$fullExam->exam_name}}</td>
                            <td> {{$fullExam->time_ago}}</td>
                            <td>
                                @if ($fullExam->type == 1)
                                    <label class="bg-primary text-light" style="font-size: 15px;">على المنصة</label>
                                @else
                                    <label class="bg-success text-light" style="font-size: 15px;">امتحان برابط</label>
                                @endif
                            </td>
                            <td>
                                @if ($fullExam->type == 1)
                                    <a href="{{url('exams/full_exam/'.$fullExam->id)}}">الذهاب للامتحان</a>
                                @else
                                    <a href="{{$fullExam->exam_desc}}">الذهاب للامتحان</a>
                                @endif
                            </td>
                        </tr>
                    @empty
                    <tr>
                        <td colspan="4">لا يوجد امتحانات شاملة الان </td>
                    </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div
            class="tab-pane fade"
            id="nav-records"
            role="tabpanel"
            aria-labelledby="nav-records-tab"
            >
            <div class="container">
              <div class="row text-right">
                @forelse ($audios as $audio)
                <div class="col-lg-6 mb-2">
                    <div class="card w-100">
                      <div class="card-body text-center">
                        <h4 class="card-title">{{$audio->audio_name}}</h4>
                        <p>{{$audio->description}}</p>
                        <audio src="{{$audio->url}}" controls></audio>
                      </div>
                    </div>
                  </div>
                @empty
                <div class="col-lg-12 mb-2">
                    <div class="alert alert-danger" role="alert">
                        لا يوجد ملفات صوتية بعد
                    </div>
                </div>
                @endforelse
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
              <div class="table-responsive">
                <table class="table table-bordered text-center">
                  <thead>
                    <tr>
                      <th scope="col">اسم الملخص</th>
                      <th scope="col">تاريخ الملخص</th>
                      <th scope="col">الملخص</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($quotes as $quote)
                        <tr>
                            <td>{{$quote->description}}</td>
                            <td>{{$quote->time_ago}}</td>
                            <td>
                            <a href="{{$quote->image}}">تحميل</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3">لا يوجد ملخصات</td>
                        </tr>
                    @endforelse


                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div
            class="tab-pane fade"
            id="nav-lives"
            role="tabpanel"
            aria-labelledby="nav-lives-tab"
            >
            <div class="container">
              <div class="table-responsive">
                <table class="table table-bordered text-center">
                  <thead>
                    <tr>
                      <th scope="col">تاريخ البث</th>
                      <th scope="col">الذهاب للبث</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($lives as $live)
                        <tr>
                            <td> {{$live->time_ago}}</td>
                            <td><a href="{{$live->link}}">الذهاب للبث</a></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2"> لا يوجد بث مباشر</td>
                        </tr>
                    @endforelse
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
