@extends('new.layouts.store')
@push('style')
<link rel="stylesheet" href="{{asset('new')}}/css/store.css" />
<style>
.pagination{
    justify-content: center;
    margin-top: 30pxpx;
    direction: ltr;
}
.pagination .page-link{
  color: #59af5c;
}
.pagination .page-link{
  color: #59af5c;
}
.pagination .page-item.active .page-link{
    background-color: #59af5c;
    border-color: #59af5c;
}
.fa-heart{color:red}
.main .item .image h5{    z-index: 9;}
</style>
@endpush
@section('content')
<div class="col-md-8 col-lg-9 main">
    <div class="row">
        @foreach ($products as $product)
        <div class="col-6 col-md-6 col-lg-4">
            <div  class="item">
                <div class="image">
                    <img src="{{ $product->image ? $product->image->url : asset('new/background.png') }}" alt="" load="lazy"/>
                    <h5>{{ $product->title }}</h5>
                    <div class="overlay"></div>
                </div>

                <div class="d-flex">

                    @if(App\ProductLike::where('user_id',Auth::user() ? Auth::user()->id : 0)->where('product_id',$product->id)->first())
                       <a href="#"   data-id="{{ $product->id }}">
                        <i class="fa fa-heart"></i>
                        </a>
                    @else
                        <a href="#"  class="heart" data-id="{{ $product->id }}">
                        <i class="fa fa-heart-o"></i>
                        </a>
                    @endif

                    <p>{{ $product->offer? $product->offer->price : $product->price }}<sub>{{ $product->offer? $product->price : '' }}</sub>&nbsp;SAR </p>
                    <a class="addtocard" id="addToCart" data-size='@php foreach($product->sizes as $size ){echo `<option value="{{ $size->id }}">{{ $size->size }}</option>`} @endphp' data-color="{{ $product->colors?$product->colors:'' }}" data-id="{{ $product->id }}" data-image="{{ $product->image ? $product->image->url : asset('new/background.png') }}" data-title="{{ $product->title }}"><i class="fa fa-shopping-bag"></i></a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="row" id="load_here"></div>
</div>
<div class="modal fade" id="cartModal" tabindex="-1" role="dialog" aria-labelledby="cartModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="{{ url('carts/create') }}" method="POST">
                @csrf
                <div class="modal-body p-3">
                    <img style="max-height:150px;" class="img-thumbnail w-100" id="product_image">
                    <h2 class="text-center mt-2" id="product_title"></h2>
                    <br>

                    <div class="form-group">
                        <label for="quantity">{{ trans('web.quantity') }}</label>
                        <input type="number" value="1" id="quantity" class="form-control" name="quantity">
                    </div>

                        <div class="form-group">
                            <label for="color">{{ trans('web.color') }}</label>
                            <select class="form-control" name="color" id="color">

                            </select>
                        </div>

                        <div class="form-group">
                            <label for="size">{{ trans('web.size') }}</label>
                            <select class="form-control" name="size" id="size">

                            </select>
                        </div>

                    <input type="hidden" id="product_id" name="product_id" value="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger"
                        data-dismiss="modal">{{ trans('web.close') }}</button>&nbsp;

                    <button type="submit" class="btn btn-warning">{{ trans('web.add to cart') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@push('script')
<script src="{{ asset('web') }}/js/jquery.js"></script>
<script>
$(document).ready(function() {
    $(".addtocard").click(function() {
        console.log('sadsd')
        var id = $(this).attr('data-id');
        var image = $(this).attr('data-image');
        var title = $(this).attr('data-title');
        $("#product_id").val(id);
        $("#product_title").text(title);
        $("#product_image").attr("src",image);

        $("#cartModal").modal('toggle');
    });
});
</script>
<script>
 $(document).on("click", ".heart" ,function() {
    $(this).prop('disabled', true)
    var id = $(this).attr('data-id');
    $(this).children('i').toggleClass('fa-heart-o').toggleClass('heart').toggleClass('fa-heart');
    var x = $(this).children('i').next().text();
    $(this).children('i').next().text(Number(x)+1);
    $.ajax({
        type: 'POST',
        url: "{{ url('products/like') }}",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            _token: "{{ csrf_token() }}",
            product_id: id,
        },
        beforeSend: function() {
        },
        success: function(msg) {
            console.log(msg)

        }
    });
});
</script>
<script>
var ENDPOINT = "{{ url('/newsite') }}";
var page = 1;
infinteLoadMore(page);
$(window).scroll(function () {
    if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
        page++;

        infinteLoadMore(page);

    }
});
function infinteLoadMore(page) {
    $.ajax({
        url: ENDPOINT + "/store2/{{$type}}?page=" + page,
        datatype: "html",
        type: "get",
        beforeSend: function () {
            $('.auto-load').show();
        }
    })
    .done(function (response) {
        if (response.length == 0) {
            $('#load_here').html("We don't have more data to display :(");
            return;
        }
        $('.auto-load').hide();
        $("#load_here").append(response);
    })
    .fail(function (jqXHR, ajaxOptions, thrownError) {
        console.log(jqXHR);
        console.log(ajaxOptions);
        console.log(thrownError);
    });
}
</script>
@endpush
@endsection
