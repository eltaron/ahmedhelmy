@if ($errors->any())
<div class="col-md-12">
    <div class="toast mt-3 ml-2" data-autohide="false">
        <div class="toast-header ">
            <strong class="ml-auto text-danger">يوجد خطأ</strong>
            <button type="button" class="text-danger ml-2 mb-1 close" data-dismiss="toast">&times;</button>
        </div>
        <div class="toast-body p-4">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endif
<div class="col-md-12">
    @if(session()->has('success'))
        <div class="toast mt-3 ml-2" data-autohide="false">
            <div class="toast-header">
                <strong class="ml-auto text-success">تم بنجاح</strong>
                <button type="button" class="text-success ml-2 mb-1 close" data-dismiss="toast">&times;</button>
            </div>
            <div class="toast-body p-4">
                {{session('success')}}
            </div>
        </div>
    @endif
    @if(session()->has('faild'))
    <div class="toast mt-3 ml-2" data-autohide="false">
        <div class="toast-header">
            <strong class="ml-auto text-danger">يوجد خطأ</strong>
            <button type="button" class="text-danger ml-2 mb-1 close" data-dismiss="toast">&times;</button>
        </div>
        <div class="toast-body p-4">
            {{session('faild')}}
        </div>
    </div>
    @endif
</div>
