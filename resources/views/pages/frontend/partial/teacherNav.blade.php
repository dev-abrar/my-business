   <!-- ====================== navbar start  =================  -->
   @php
    $webcontent = App\Models\WebContent::where('id', 1)->first();
    @endphp
   <nav class="navbar navbar-expand-lg">
       <i class="fa-solid fa-bars menu_toggle"></i>
       <i
           class="fa-regular fa-bell notification"><span>{{App\Models\FrontendNotify::where('teacher_id', Auth::guard('teacherlogin')->id())->where('sts', 0)->count()}}</span></i>
       @if (App\Models\FrontendNotify::where('teacher_id', Auth::guard('teacherlogin')->id())->where('sts', 0)->count()
       >
       0)
       <div class="notify_table">
           <i class="fa-solid fa-xmark notify_close"></i>
           @foreach (App\Models\FrontendNotify::where('teacher_id', Auth::guard('teacherlogin')->id())->where('sts',
           0)->latest()->take(1)->get() as $sl=>$notify)
           <a href="{{route('teacher.nitification', $notify->id)}}">{{$sl+1}}. {{$notify->title}}</a>
           @endforeach
       </div>
       @endif
   </nav>
   <!-- ====================== navbar end  =================  -->

   <!-- ====================== side nav Form Start=================  -->
   <section id="sideNav">
       <div class="side_bar">
           <div class="side_bar_top">
               <a class="navbar-brand" href="{{route('teacher.dashboard')}}"><img
                       src="{{asset('upload/logo')}}/{{$webcontent->logo}}" alt=""></a>
               <i class="fa-solid fa-xmark menu_close"></i>
               <div class="side_img">
                   @if (Auth::guard('teacherlogin')->user()->photo != null)
                   <img style="object-fit: cover;" class="w-100 img-fluid"
                       src="{{asset('upload/teacher')}}/{{Auth::guard('teacherlogin')->user()->photo}}" alt="profile">
                   @else
                   <img class="w-100 img-fluid"
                       src="{{ Avatar::create(Auth::guard('teacherlogin')->user()->name)->toBase64() }}" />
                   @endif
               </div>
               <h5>{{ Auth::guard('teacherlogin')->user()->name }}</h5>
           </div>
           <div class="side_bar_bottom">
               <ul class="side_nav_menu">
                   <li><a href="{{route('teacher.profile')}}"><i class="fa-regular fa-user"></i> Profile</a></li>
                   <li><a href="{{route('teacher.dashboard')}}"><i class="fa-solid fa-gauge"></i> Dashboard</a></li>
                   <li><a href="{{route('teacher.pass.book')}}"><i class="fa-solid fa-receipt"></i>Pass Book</a></li>
                   <li><a href="{{route('teacher.balance')}}"><i class="fa-solid fa-wallet"></i> My Balance</a></li>
                   <li><a href="{{route('teacher.logout')}}"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
                   </li>
               </ul>
           </div>
       </div>
   </section>
   <!-- ====================== side nav Form end=================  -->
