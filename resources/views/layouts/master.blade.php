<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset('dist/main.css')}}">
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
<script src="{{asset('src/scss/vendors/plugin/js/jquery.nice-select.min.js')}}"></script>
<script src="{{asset('dist/main.js')}}"></script>

<script>
    function openNav() {

        document.getElementById("mySidenav").style.width = "350px";
        $('#overlayy').addClass("active");
    }

    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
        $('#overlayy').removeClass("active");
    }
</script>
</body>
</html>
