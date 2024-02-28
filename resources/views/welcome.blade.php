@extends('layouts.master')
@section('css')
@section('title')
    <?php echo $title = 'المواد الدراسية'; ?>
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">{{ $title }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">الرئيسية</a></li>
                <li class="breadcrumb-item active">{{ $title }}</li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
    أضافة
</button>
<br><br>
<div class="row">
    <div class="col-xl-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                @if ($errors->any())
                    <?php Alert::error($errors->all(), 'هناك خطأ في الحقول')->showConfirmButton('تم', '#c0392b'); ?>
                @endif
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered p-0 table-hover">
                        <thead>
                            <tr>
                                <th>الرقم</th>
                                <th>الرمز</th>
                                <th>الاسم</th>
                                <th>عدد الوحدات</th>
                                <th>القسم</th>
                                <th>الصف الدراسي</th>
                                <th>المرحلة</th>    
                                <th>تعديلات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($materials as $material)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $material->EN_name }}</td>
                                    <td>{{ $material->name }}</td>
                                    <td>{{ $material->number }}</td>
                                    <td>{{ $material->grades->name }}</td>
                                    <td>{{ $material->classrooms->name }}</td>
                                    <td>{{ $material->symesters->name }}</td>
                                    <td>
                                        <button type="button" data-toggle="modal"
                                            data-target="#edit{{ $material->id }}" title="تعديل"
                                            class="btn btn-info btn-sm" title="تعديل"><i
                                                class="fa fa-edit"></i></button>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                            data-target="#delete{{ $material->id }}" title="حذف"><i
                                                class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                </div>
                <!-- edit_modal_Section -->
                <div class="modal fade" id="edit{{ $material->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">
                                    تعديل بيانات المادة الدراسية
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('materials.update', $material->id) }}" method="post"
                                    enctype="multipart/form-data">
                                    {{ method_field('put') }}
                                    @csrf
                                    <label for="Name" class="mr-sm-2"> الاسم
                                        :</label>
                                    <input class="form-control" type="text" name="name"
                                        value="{{ $material->name }}" required />
                                    <label for="Name" class="mr-sm-2"> رمز المادة
                                        :</label>
                                    <input class="form-control" type="text" name="EN_name"
                                        value="{{ $material->EN_name }}" required />
                                    <label for="Name" class="mr-sm-2"> عدد الوحدات
                                        :</label>
                                    <input class="form-control" type="number" name="number"
                                        value="{{ $material->number }}" required />

                                    <label for="Name" class="mr-sm-2"> القسم :
                                        :</label>
                                    <select name="grade" class="form-control p-1" required>
                                        <option selected disabled>--اختر القسم--</option>
                                        @foreach ($grades as $grade)
                                            <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="Name" class="mr-sm-2">الفصل
                                        :</label>
                                    <select name="class" class="form-control p-1" required>
                                        <option selected disabled>--اختر الفصل--</option>

                                    </select>
                                    <br><br>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">رجوع</button>
                                <button type="submit" class="btn btn-success">حفظ</button>
                            </div>
                            </form>

                        </div>
                    </div>
                </div>
                <!-- delete_modal_Section -->
                <div class="modal fade" id="delete{{ $material->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">
                                    حذف المادة الدراسية
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('materials.destroy', $material->id) }}" method="post">
                                    {{ method_field('Delete') }}
                                    @csrf
                                    <h3 class="text-center">هل انت متأكد من عملية الحذف ؟</h3>
                                    <p class="text-center"> اذا تم الحذف سوف يتم حذف كل ماهو متعلق بهذا المادة الدراسية
                                    </p>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">رجوع</button>
                                        <button type="submit" class="btn btn-danger">حفظ</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>

<!-- add_modal_Section -->

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    اضافة مادة جديد
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('materials.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label for="Name" class="mr-sm-2"> الاسم
                        :</label>
                    <input class="form-control" type="text" name="name" required />

                    <label for="Name" class="mr-sm-2"> رمز المادة
                        :</label>
                    <input class="form-control" type="text" name="EN_name" required />
                    <label for="Name" class="mr-sm-2"> عدد الوحدات
                        :</label>
                    <input class="form-control" type="number" name="number" required />

                    <label for="Name" class="mr-sm-2"> القسم
                        :</label>
                    <select name="grade" class="form-control p-1" required>
                        <option selected disabled>--اختر القسم--</option>
                        @foreach ($grades as $grade)
                            <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                        @endforeach
                    </select>
                    <label for="Name" class="mr-sm-2">الفصل
                        :</label>
                    <select name="class" class="form-control p-1" required>
                        <option selected disabled>--اختر الفصل--</option>

                    </select>
                    <label for="symester" class="mr-sm-2">المرحلة
                        :</label>
                    <select name="symester" class="form-control p-1" required>
                        <option selected disabled>--اختر المرحلة--</option>

                    </select>
                    <br><br>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">الرجوع</button>
                        <button type="submit" class="btn btn-success">حفظ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- row closed -->

@endsection
@section('js')
<script>
    $('select[name="grade"]').on('change', function() {
        var Grade_id = $(this).val();
        if (Grade_id) {
            $.ajax({
                url: "{{ URL::to('classes') }}/" + Grade_id,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    $('select[name="class"]').empty();
                      $('select[name="class"]').append('<option disabled selected>اختر القسم</option>');
                    $.each(data, function(key, value) {
                        $('select[name="class"]').append('<option value="' + key +
                            '">' +
                            value + '</option>');
                    });
                },
            });
        } else {
            console.log('AJAX load did not work');
        }
    });
    $('select[name="class"]').on('change', function() {
        var Grade_id = $(this).val();
        if (Grade_id) {
            $.ajax({
                url: "{{ URL::to('symestersm') }}/" + Grade_id,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    $('select[name="symester"]').empty();
                    $.each(data, function(key, value) {
                        $('select[name="symester"]').append('<option value="' + key +
                            '">' +
                            value + '</option>');
                    });
                }
            });
        } else {
            console.log('AJAX load did not work');
        }
    });
</script>
@endsection


function main($id)
{
    if ($id == '') {
        $data['classes'] = classroom::latest()->get();
        $data['main'] = $data['classes'][0];
        $data['materialsSuc'] = DB::table('results')
            ->whereRaw('(works + exam) > 49')
            ->where('std_class', $data['classes'][0]->id)
            ->count();
        $data['materialsfail'] = DB::table('results')
            ->whereRaw('(works + exam) < 50')
            ->where('std_class', $data['classes'][0]->id)
            ->count();
        $data['students'] =  DB::table('results')->distinct()->where('std_class', $data['main']['id'])->pluck('std')->count();
        $data['materials'] = material::where('class', $data['main']['id'])->count();
        $uniqueValues = DB::table('results')->distinct()->where('std_class', $data['main']['id'])->pluck('std');
        $data['stdSuc'] = 0;
        $data['stdFail'] = 0;
        foreach ($uniqueValues as $std) {
            $data['sucess'] = DB::table('results')
                ->whereRaw('(works + exam) > 49')
                ->where('std', $std)
                ->where('std_class', $data['classes'][0]->id)
                ->count();

            if ($data['sucess'] == $data['materials']) {
                $data['stdSuc']++;
            } else {
                $data['stdFail']++;
            }
        }
    } else {
        $id = Crypt::decrypt($id);
        $data['classes'] = classroom::latest()->get();
        $data['main'] = classroom::where('id', $id)->get();
        $data['materialsSuc'] = DB::table('results')
            ->whereRaw('(works + exam) > 49')
            ->where('std_class', $id)
            ->count();
        $data['materialsfail'] = DB::table('results')
            ->whereRaw('(works + exam) < 50')
            ->where('std_class', $id)
            ->count();
        $data['students'] =  DB::table('results')->distinct()->where('std_class', $data['main'][0]['id'])->pluck('std')->count();
        $data['materials'] = material::where('class', $data['main'][0]['id'])->count();
        $uniqueValues = DB::table('results')->distinct()->where('std_class', $data['main'][0]['id'])->pluck('std');
        $data['stdSuc'] = 0;
        $data['stdFail'] = 0;
        foreach ($uniqueValues as $std) {
            $data['sucess'] = DB::table('results')
                ->whereRaw('(works + exam) > 49')
                ->where('std', $std)
                ->where('std_class', $id)
                ->count();

            if ($data['sucess'] == $data['materials']) {
                $data['stdSuc']++;
            } else {
                $data['stdFail']++;
            }
        }
    }
    return $data;
}
