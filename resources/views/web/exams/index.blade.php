@extends('web.layouts.app2')
@push('style')
<link rel="stylesheet" href="{{asset('web_files')}}/css/exam.css" />
<link rel="stylesheet" href="{{asset('web_files')}}/css/countdown-lights.css" />
@endpush
@section('content')
<main>
    <div class="cover" style="background-image: url('{{asset('web_files')}}/header/h4.jpg');">
        <div class="bg">
            <h2>{{$exam->exam_name}}</h2>
            <h4>{{$exam->number}} اسئلة</h4>
            <h4>{{$exam->time_ago}}</h4>
        </div>
    </div>
    <section id="section11" class="section11">
      <div class="container">
        <div class="row">
        <form id="myForm" action="{{url('exams/endFullExam/'.$exam->id)}}" method="post" style="width: 100%;">
            <input type="hidden" name="quesNumber" value="{{$exam->number}}">
            <div class="card w-100">
            <div id="demoB" style="width: 100%"></div>
            <div class="card-body">
                    @csrf
                    <div class="exam_content text-right">
                        @forelse ($exam->questions as $k => $question)
                            <input type="hidden" name="question{{$k}}" value="{{$question->id}}">
                            @if ($question->answer)
                                <div class="question">
                                    <h4>{{$k+1}} ) {{$question->question}}</h4>
                                    <input type="text" placeholder="اضافة اجابة" class="main_question" name="answer{{$k}}" required>
                                </div>
                            @else
                                <div class="question">
                                    <h4>{{$k+1}} ) {{$question->question}}</h4>
                                    @if ($question->image)
                                        <img
                                        src="{{$question->image}}"
                                        class="mb-4"
                                        width="100%"
                                        height="200"
                                        />
                                    @endif
                                    <div class="q">
                                        <input
                                            type="radio"
                                            name="answer{{$k}}"
                                            id="chose{{$k}}1"
                                            value="{{$question->answer_1}}"
                                        />
                                        <label for="chose{{$k}}1">{{$question->answer_1}}</label>
                                    </div>
                                    <div class="q">
                                    <input
                                        type="radio"
                                        name="answer{{$k}}"
                                        id="chose{{$k}}2"
                                        value="{{$question->answer_2}}"
                                    />
                                    <label for="chose{{$k}}2">{{$question->answer_2}}</label>
                                    </div>
                                    <div class="q">
                                    <input
                                        type="radio"
                                        name="answer{{$k}}"
                                        id="chose{{$k}}3"
                                        value="{{$question->answer_3}}"
                                    />
                                    <label for="chose{{$k}}3">{{$question->answer_3}}</label>
                                    </div>
                                    <div class="q">
                                    <input
                                        type="radio"
                                        name="answer{{$k}}"
                                        id="chose{{$k}}4"
                                        value="{{$question->answer_4}}"
                                    />
                                    <label for="chose{{$k}}4">{{$question->answer_4}}</label>
                                    </div>
                                </div>
                            @endif
                            <hr />
                        @empty
                            <div class="alert alert-primary text-right" role="alert">
                                لا يوجد اسئلة بعد
                            </div>
                        @endforelse
                    </div>
            </div>
          </div>
          <div class="content_control text-center">
            <div class="center_content">
              <button class="submit" name="exam">ارسال الامتحان</button>
            </div>
          </div>
        </form>
        </div>
      </div>
    </section>
</main>
@push('script')
<script src="{{asset('web_files/js')}}/countdowns.js"></script>
<script>
  window.addEventListener("load", function () {
        counter.init("demoB", '{{$exam->time * 60  }}', function(idx){
            document.getElementById("myForm").submit();
        });
    });
</script>
@endpush
@endsection
