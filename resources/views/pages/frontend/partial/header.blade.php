@php
$webcontent = App\Models\WebContent::where('id', 1)->first();
@endphp
    <!-- ====================== navbar start  =================  -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="{{route('index')}}"><img src="{{asset('upload/logo')}}/{{$webcontent->logo}}" alt=""></a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ route('frontend.login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ route('login') }}">Admin Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- ====================== navbar end  =================  -->