<!-- ====================== navbar start  =================  -->
@php
$webcontent = App\Models\WebContent::where('id', 1)->first();
@endphp
<nav class="navbar navbar-expand-lg">
    @if (Auth::guard('studentlogin')->id())
    <i class="fa-solid fa-bars menu_toggle"></i>
    <i
        class="fa-regular fa-bell notification"><span>{{App\Models\FrontendNotify::where('student_id', Auth::guard('studentlogin')->id())->where('sts', 0)->count()}}</span></i>
    @if (App\Models\FrontendNotify::where('student_id', Auth::guard('studentlogin')->id())->where('sts', 0)->count() >
    0)
    <div class="notify_table">
        <i class="fa-solid fa-xmark notify_close"></i>
        @foreach (App\Models\FrontendNotify::where('student_id', Auth::guard('studentlogin')->id())->where('sts',
        0)->latest()->take(1)->get() as $sl=>$notify)
        <a href="{{route('student.nitification', $notify->id)}}">{{$sl+1}}. {{$notify->title}}</a>
        @endforeach
    </div>
    @endif
    @endif
</nav>
<!-- ====================== navbar end  =================  -->

<!-- ====================== side nav Form Start=================  -->
@if (Auth::guard('studentlogin')->id())
<section id="sideNav">
    <div class="side_bar">
        <div class="side_bar_top">
            <a class="navbar-brand" href="{{route('student.dashboard')}}"><img
                    src="{{asset('upload/logo')}}/{{$webcontent->logo}}" alt=""></a>
            <i class="fa-solid fa-xmark menu_close"></i>
            <div class="side_img">
                @if (Auth::guard('studentlogin')->user()->photo != null)
                <img style="object-fit: cover;" class="w-100 img-fluid"
                    src="{{asset('upload/student')}}/{{Auth::guard('studentlogin')->user()->photo}}" alt="profile">
                @else
                <img class="w-100 img-fluid"
                    src="{{ Avatar::create(Auth::guard('studentlogin')->user()->name)->toBase64() }}" />
                @endif
            </div>
            <h5>{{Auth::guard('studentlogin')->user()->name}}</h5>
            <h6>Refer Code: <span id="refer_code">{{Auth::guard('studentlogin')->user()->refer_code}}</span>
                <i class="fa-regular fa-copy copy_code"></i>
                <span class="copied_message">Copied</span>
            </h6>

        </div>
        <div class="side_bar_bottom">
            <ul class="side_nav_menu">
                <li><a href="{{route('student.profile')}}"><i class="fa-regular fa-user"></i> Profile</a></li>
                <li><a href="{{route('student.dashboard')}}"><i class="fa-solid fa-gauge"></i> Dashboard</a></li>
                <li><a href="{{route('student.refered')}}"><i class="fa-brands fa-brave-reverse"></i> My Refered
                        Students</a></li>
                <li><a href="{{route('my.order')}}"><i class="fa-solid fa-cart-shopping"></i> My Order</a></li>
                <li><a href="{{route('student.pass.book')}}"><i class="fa-solid fa-receipt"></i>Pass Book</a></li>
                <li><a href="{{route('student.balance')}}"><i class="fa-solid fa-wallet"></i> My Balance</a></li>
                <li><a href="{{route('student.logout')}}"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
            </ul>
        </div>
    </div>
</section>
@endif
<!-- ====================== side nav Form end=================  -->
