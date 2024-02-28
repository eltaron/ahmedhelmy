@if ($errors->any())
<div class="col-md-12">
    <div class="alert message mb-0 alert-danger" role="alert">
        <h4 class="text-danger">
            <strong>يوجد خطأ</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

        </h4>
        @foreach($errors->all() as $error)
        <p>* {{ $error }}</p>
        @endforeach
    </div>
</div>
@endif

<div class="col-md-12">
    @if(session()->has('success'))
    <div class="alert message mb-0 alert-info alert-dismissible fade show" role="alert">
         {{ session('success') }}.
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if(session()->has('faild'))
    <div class="alert message mb-0 alert-danger alert-dismissible fade show" role="alert">
         {{ session('faild') }}.
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
</div>
