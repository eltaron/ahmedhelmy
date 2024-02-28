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
            <h4>{{$exam->time_ago}}</h4>
        </div>
    </div>
    <section id="section11" class="section11">
      <div class="container">
        <form action="{{url('exams/endFullExam/'.$exam->id)}}" id="myForm" method="post">
            <div class="row">
            <div class="card w-100">
                <div id="demoB" style="width: 100%"></div>
                <div class="card-body" >
                    @csrf
                    @php
                        $counter = 0;
                    @endphp
                    <input type="hidden" name="quesNumber" value="{{$exam->number}}">
                        <div class="accordion" id="accordionExample">
                            @forelse ($exam->parts as $l=>$part)
                            <div class="card text-right">
                                <div class="card-header" id="headingOne">
                                <h5
                                    class="mb-0 d-flex justify-space-between align-items-center"
                                    style="
                                    flex-wrap:wrap
                                    "
                                >
                                    @if ($part->photo)
                                        <img src="{{$part->photo}}" class="mb-2" width="100%" style="max-height: 200px">
                                    @endif
                                    <button
                                    class="btn btn-link w-100"
                                    type="button"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#collapse{{$part->id}}"
                                    aria-expanded="true"
                                    aria-controls="collapse{{$part->id}}"
                                    >
                                    {{$part->part_name}}
                                    </button>
                                </h5>
                                </div>
                                <div
                                    id="collapse{{$part->id}}"
                                    class="accordion-collapse collapse show"
                                    aria-labelledby="heading{{$part->id}}"
                                    data-bs-parent="#accordionExample"
                                    >
                                    <div class="card-body">
                                        @forelse ($part->questions as $k => $question)
                                            <input type="hidden" name="question{{$counter}}" value="{{$question->id}}">
                                            <div class="question">
                                                <h4>
                                                    {{$k+1}} ) {{$question->question}}
                                                </h4>
                                                @if ($question->image)
                                                    <img
                                                        src="{{$question->image}}"
                                                        class="mb-4"
                                                        width="100%"
                                                        height="200"
                                                    />
                                                @endif
                                                @if ($question->answer)
                                                    <input type="text" placeholder="اضافة اجابة" name="answer{{$counter}}"/>
                                                @else
                                                    <div class="q">
                                                        <input
                                                        type="radio"
                                                        id="chose1"
                                                        name="answer{{$counter}}"
                                                        value="{{$question->answer_1}}"
                                                        />
                                                        <label for="chose1">{{$question->answer_1}}</label>
                                                    </div>
                                                    <div class="q">
                                                        <input
                                                        type="radio"
                                                        id="chose2"
                                                        name="answer{{$counter}}"
                                                        value="{{$question->answer_2}}"
                                                        />
                                                        <label for="chose3">{{$question->answer_2}}</label>
                                                    </div>
                                                    <div class="q">
                                                        <input
                                                        type="radio"
                                                        id="chose3"
                                                        name="answer{{$counter}}" value="{{$question->answer_3}}"
                                                        />
                                                        <label for="chose2">{{$question->answer_3}}</label>
                                                    </div>
                                                    <div class="q">
                                                        <input
                                                        type="radio"
                                                        id="chose4"
                                                        name="answer{{$counter}}"
                                                        value="{{$question->answer_4}}"
                                                        />
                                                        <label for="chose4">{{$question->answer_4}}</label>
                                                    </div>
                                                @endif
                                                @php
                                                    $counter += 1;
                                                @endphp
                                                @if ($counter == $exam->number)
                                                    @break
                                                @endif
                                            </div>
                                            <hr />
                                        @empty
                                            <div class="alert alert-primary text-right" role="alert">
                                                لا يوجد اسئلة بعد
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
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
                <button class="submit">ارسال الامتحان</button>
                </div>
            </div>
            </div>
        </form>
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
