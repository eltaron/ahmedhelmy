<p>{!!$trainer->description!!}</p>
        <hr class="mt-1 mb-2">
        <div class="d-flex">
            <div class="p-2">
                <img src="{{Auth::user()->profile ? Auth::user()->profile : asset('new/icons/person_perview.png')}}" alt="" style="width:80px;border-radius: 50%;height:80px">
            </div>
            <div class="p-2">
                <h4 class="mb-3">{{Auth::user()->name}}</h4> <br>
                 <div class="text-center mt-5 move-left">
            @php
                $condition = $trainer->id;
                $distinction = App\Distinction::where('user_id',Auth::user()->id)->whereHas('detail', function ($query) use ($condition) {
                    $query->where('trainer_id', $condition);
                })->first();
            @endphp
            @if($distinction)
                @if($distinction->status == 1)
                    <div class="mb-2 p-2 d-inline-block text-success" style="width:220px;height:45px"><b>انت مشترك حاليا</b></div>
                    <h6>تاريخ الاشتراك {{$distinction->detail->updated_at->format('d/m/Y')}}</h6>
                    <h6>تاريخ الانتهاء {{$distinction->detail->updated_at->addMonths($distinction->detail->monthes)->format('d/m/Y')}}</h6>
                    <h2>{{ \Carbon\Carbon::now()->locale('ar')->translatedFormat('l') }}</h2>
                    <!-- Button trigger modal -->

                    <div>
                        <button type="button" class="btn btn-success special" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        الرياضة
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">اختر الرياضة</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="post" action="{{url('sport')}}">
                                    @csrf
                                    <div class="modal-body">
                                <label for="exampleFormControlInput1" class="form-label"> الرياضة</label>

                                    <select name="sport" class="form-select" aria-label="Default select example">
                                        <option value="مشي">
                                        مشي</option>
                                        <option value="حرق">
                                        حرق</option>
                                        <option value="جهد">
                                        جهد</option>
                                        <option value="مقاومة">
                                        مقاومة </option>
                                        <option value="استطالة">
                                        استطالة</option>
                                        <option value="لياقة">
                                        لياقة</option>
                                        <option value="يوقا">
                                        يوقا</option>
                                        <option value="قفز">
                                        قفز</option>
                                        <option value="أثقال">
                                        أثقال</option>
                                    </select>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">الغاء</button>
                                    <button type="submit" class="btn btn-success"> تأكيد</button>
                                </div>
                                </form>
                            </div>
                        </div>
                        </div>
                        <button type="button" class="btn btn-success special" data-bs-toggle="modal" data-bs-target="#example">
                        النظام
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="example" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">اختر النظام</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form method="post" action="{{url('system')}}">
                                @csrf
                                <div class="modal-body">
                                <label for="exampleFormControlInput1" class="form-label">النظام</label>

                                    <select name="system" class="form-select" aria-label="Default select example">
                                        <option value="انقاص وزن">
                                        انقاص وزن</option>
                                        <option value="بناء جسم">
                                        بناء جسم </option>
                                        <option value="تثبيت">
                                        تثبيت</option>
                                        <option value="تنشيف">
                                        تنشيف </option>
                                        <option value="تحسين جسم">
                                        تحسين جسم </option>
                                        <option value="تحسين أعضاء الجسم">
                                        تحسين أعضاء الجسم</option>
                                    </select>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">الغاء</button>
                                    <button type="submit" class="btn btn-success"> تأكيد</button>
                                </div>
                            </form>
                            </div>
                        </div>
                        </div>


                        <button type="button" class="btn btn-success special" data-bs-toggle="modal" data-bs-target="#example4">
                        الوقت
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="example4" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel"> ادخل وقت ممارسة الرياضة</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form method="post" action="{{url('time')}}">
                                @csrf
                                <div class="modal-body">
                                <label for="exampleFormControlInput1" class="form-label"> الوقت</label>

                                    <select name='time' class="form-select" aria-label="Default select example">
                                        <option value="نصف ساعة">
                                        نصف ساعة</option>
                                        <option value="ساعة">
                                        ساعة</option>
                                        <option value="ساعة ونصف">
                                        ساعة ونصف</option>
                                        <option value="ساعتين">
                                        ساعتين </option>
                                        <option value="ساعتين ونصف">
                                        ساعتين ونصف</option>
                                        <option value="ثلاث ساعات">
                                        ثلاث ساعات</option>
                                    </select>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">الغاء</button>
                                    <button type="submit" class="btn btn-success">تأكيد </button>
                                </div>
                            </form>
                            </div>
                        </div>
                        </div>
                        <button type="button" class="btn btn-success special" data-bs-toggle="modal" data-bs-target="#example3">
                        الشعور
                        </button>

                        <!-- Modal -->
                        <div class="modal fade " id="example3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">الشعور </h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form method="post" action="{{url('feeling')}}">
                                @csrf
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">الشعور </label>
                                        <select name="feeling" class="form-select" aria-label="Default select example">
                                            <option value="سعيد جدا">
                                            سعيد جدا </option>
                                            <option value="سعيد">
                                            سعيد  </option>
                                            <option value="عادي">
                                            عادي</option>
                                            <option value="غير راضي">
                                            غير راضي </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">الغاء</button>
                                    <button type="submit" class="btn btn-success">تأكيد</button>
                                </div>
                            </form>
                            </div>
                        </div>
                        </div>
                    </div>
                    <br>
                    <form method="post" action="{{url('notes')}}">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">الملاحظات </label>
                            <textarea name="notes" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>
                        <button type="submit" class=" mt-4 btn btn-success">تأكيد</button>
                    </form>
                    <!-- Button trigger modal -->
                    <br>
                    <button type="button" class="btn btn-secondary mt-5" data-bs-toggle="modal" data-bs-target="#example5">
                    اظهار النتائج السابقة
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="example5" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel"> النتائج السابقة</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <table class="table table-success table-striped">
                                <thead>
                                    <tr>
                                    <th scope="col">اليوم</th>
                                    <th scope="col">الرياضة</th>
                                    <th scope="col">النظام</th>
                                    <th scope="col">الوقت</th>
                                    <th scope="col">الشعور</th>
                                    <th scope="col">الملاحظات</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($sports as $sport)
                                    <tr>
                                    <td scope="row">
                                    {{$sport->created_at->format('Y/m/d')}}
                                    {{ \Carbon\Carbon::parse($sport->created_at->format('Y/m/d'))->locale('ar')->translatedFormat('l') }}
                                        </td>
                                        <td>{{$sport->sport}}</td>
                                        <td>{{$sport->system}}</td>
                                        <td>{{$sport->time}}</td>
                                        <td>{{$sport->feeling}}</td>
                                        <td>{{$sport->notes}}</td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">الغاء</button>
                        </div>
                        </div>
                    </div>
                    </div>
                @else
                    <div class="mb-2 p-2 d-inline-block text-light" style="background-color:#f2af83;width:220px;height:45px">انتظار التفعيل</div>
                @endif
            @else
                <a href="#" onclick="category_id1.value = {{ $trainer->id }};category_id2.value = {{ $trainer->id }}" data-bs-toggle="modal" style="width:220px;height:45px" data-bs-target="#distinctionModal" class="btn btn-danger">{{ trans('web.distinction') }}</a>
            @endif

        </div>
