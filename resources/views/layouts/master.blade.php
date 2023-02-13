<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset('dist/main.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>

<body>
@include('layouts.header')
@section('breadcrumb')
<!-- BreadCrumb Start-->
<section class="breadcrumb-area mt-15">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                @yield('breadcrumbAppend')
            </div>
        </div>
    </div>
</section>
@show

@yield('content')
@include('layouts.footer')

<script src="{{asset('src/js/jquery.min.js')}}"></script>
<script src="{{asset('src/js/bootstrap.min.js')}}"></script>
<script src="{{asset('src/scss/vendors/plugin/js/slick.min.js')}}"></script>
<script src="{{asset('src/scss/vendors/plugin/js/jquery.exzoom.js')}}"></script>
<script src="{{asset('src/scss/vendors/plugin/js/jquery.nice-select.min.js')}}"></script>
<script src="{{asset('dist/main.js')}}"></script>

<script type="text/javascript">
        function openNav() {

            document.getElementById("mySidenav").style.width = "350px";
            $('#overlayy').addClass("active");
        }

        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
            $('#overlayy').removeClass("active");
        }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $("#addCart").click(function(e){
        e.preventDefault();
        var number = $("input[name=number]").val();
        if(document.getElementsByClassName('sizes-all active').length == 0){
            document.getElementById('error-msg').innerHTML='Choose size of product';
        }else if(document.getElementsByClassName('colorall active').length == 0){
            document.getElementById('error-msg').innerHTML='Choose color of product';
        }else if(number==0 || number=="") {
            document.getElementById('error-msg').innerHTML='Choose quantity more than 0';
        }else{
            var size_id = document.getElementsByClassName('sizes-all active')[0].value;
            var color_id = document.getElementsByClassName('colorall active')[0].value;
            var product_id = $("input[name=product_id]").val();
            var userIP = $("input[name=userIP]").val();
            $.ajax({
                type:'POST',
                url:"{{ route('addCart') }}",
                data:{size_id:size_id,color_id:color_id,number:number,product_id:product_id,userIP:userIP},
                success:function(data){
                    var cartNumber =Number($("input[name=cartNumber]").val()) + 1;
                    $("input[name=cartNumber]").val(cartNumber);
                    document.getElementById('cartNumber').innerHTML=cartNumber;
                    alert('Selected product successfully added to cart.');
                },
                error: function () {
                    alert("Error");
                }
            });
            document.getElementById('error-msg').innerHTML='';
        }
    });

    $("#checkCoupon").click(function(e){
            e.preventDefault();
            var coupon = $("input[name=coupon]").val();
            if(coupon=="") {
                document.getElementById('error-msg').innerHTML='This field is required';
            }else{
                $.ajax({
                    type:'POST',
                    url:"{{ route('checkCoupon') }}",
                    data:{coupon:coupon},
                    success:function(data){
                        if (data.status==1) {
                            alert('Coupon successfully applied.');
                            document.getElementById('couponDiscount').innerHTML=data.discount;
                        }else{
                            alert('Error! Coupon is invalid.');
                            document.getElementById('couponDiscount').innerHTML=0;
                        }
                    },
                    error: function () {
                        alert("Error");
                    }
                });
                document.getElementById('error-msg').innerHTML='';
            }
        });

</script>

</body>
</html>
