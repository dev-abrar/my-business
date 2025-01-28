
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'My Business')</title>
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/slick.css">
    <link rel="stylesheet" href="{{asset('frontend')}}/css/swiper-bundle.min.css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/style.css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/responsive.css">
    @toastifyCss
    @toastifyJs

    @yield('style')
    
</head>

<body>


    @yield('content')
 


    <script src="{{ asset('frontend') }}/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('frontend') }}/js/jquery-1.12.4.min.js"></script>
    <script src="{{ asset('frontend') }}/js/slick.min.js"></script>
    <script src="{{ asset('frontend') }}/js/particles.min.js"></script>
    <script src="{{asset('frontend')}}/js/swiper-bundle.min.js"></script>
    <script src="{{ asset('frontend') }}/js/typed.js"></script>
    <script src="{{ asset('frontend') }}/js/app.js"></script>
    <script src="{{ asset('frontend') }}/js/script.js"></script>
    <script src="{{ asset('frontend') }}/js/custom.js"></script>
   

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

    </script>
    <script src="{{ asset('frontend') }}/js/frontend.js"></script>

    @yield('footer_script')

</body>

</html>