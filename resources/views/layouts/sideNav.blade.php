<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>My Business</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{asset('backend')}}/assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="{{asset('backend')}}/assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Layout styles -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('backend')}}/assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.1/css/dataTables.dataTables.min.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{asset('backend')}}/assets/images/favicon.png" />
    @toastifyCss
    @toastifyJs

    @yield('header')
</head>

<body>
    <div class="container-scroller">
        <!-- partial:../../partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
                <a class="sidebar-brand brand-logo" href="{{route('home')}}">MyBusiness</a>
            </div>
            <ul class="nav">

                <li class="nav-item nav-category">
                    <span class="nav-link">Navigation</span>
                </li>
                <li class="nav-item menu-items">
                    <a class="nav-link" href="{{route('home')}}">
                        <span class="menu-icon">
                            <i class="mdi mdi-speedometer"></i>
                        </span>
                        <span class="menu-title">Dashboard</span>
                    </a>
                </li>

                <li class="nav-item menu-items">
                    <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false"
                        aria-controls="ui-basic">
                        <span class="menu-icon">
                            <i class="mdi mdi-account"></i>
                        </span>
                        <span class="menu-title">Users</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="ui-basic">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="{{route('users')}}">Admin List</a></li>
                            <li class="nav-item"> <a class="nav-link" href="{{route('teachers')}}">Teacher List</a></li>
                            <li class="nav-item"> <a class="nav-link" href="{{route('students')}}">Student List</a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item menu-items">
                    <a class="nav-link" data-bs-toggle="collapse" href="#Notification" aria-expanded="false"
                        aria-controls="Notification">
                        <span class="menu-icon">
                            <i class="mdi mdi-bell"></i>
                        </span>
                        <span class="menu-title">Notification</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="Notification">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"><a class="nav-link" href="{{route('varify')}}">Varification List</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{route('withraw')}}">Wihrawal List</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{route('recharges')}}">Recharge List</a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item menu-items">
                    <a class="nav-link" data-bs-toggle="collapse" href="#microjobs" aria-expanded="false"
                        aria-controls="microjobs">
                        <span class="menu-icon">
                            <i class="mdi mdi-currency-usd"></i>
                        </span>
                        <span class="menu-title">Job & Payment</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="microjobs">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="{{route('add.microjob')}}">Job List</a></li>
                            <li class="nav-item"> <a class="nav-link" href="{{route('job.proof')}}">Job Proof</a></li>
                            <li class="nav-item"> <a class="nav-link" href="{{route('payment')}}">Payment</a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item menu-items">
                    <a class="nav-link" data-bs-toggle="collapse" href="#Product" aria-expanded="false"
                        aria-controls="Product">
                        <span class="menu-icon">
                            <i class="mdi mdi-shopping"></i>
                        </span>
                        <span class="menu-title">Product</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="Product">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="{{route('category')}}">Category</a></li>
                            <li class="nav-item"> <a class="nav-link" href="{{route('product')}}">Product List</a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item menu-items">
                    <a class="nav-link" data-bs-toggle="collapse" href="#order" aria-expanded="false"
                        aria-controls="order">
                        <span class="menu-icon">
                            <i class="mdi mdi-gift"></i>
                        </span>
                        <span class="menu-title">Orders</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="order">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="{{route('orders')}}">Order List</a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item menu-items">
                    <a class="nav-link" data-bs-toggle="collapse" href="#quiz" aria-expanded="false"
                        aria-controls="quize">
                        <span class="menu-icon">
                            <i class="mdi mdi-quicktime"></i>
                        </span>
                        <span class="menu-title">Quiz Question</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="quiz">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="{{route('view.quiz.list')}}">Quiz List</a></li>
                            <li class="nav-item"> <a class="nav-link" href="{{route('submission')}}">Quize Submission List</a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item menu-items">
                    <a class="nav-link" href="{{route('web.content')}}">
                        <span class="menu-icon">
                            <i class="mdi mdi-speedometer"></i>
                        </span>
                        <span class="menu-title">Web Content</span>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:../../partials/_navbar.html -->
            <nav class="navbar p-0 fixed-top d-flex flex-row">
                <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
                </div>
                <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
                    <button class="navbar-toggler navbar-toggler align-self-center" type="button"
                        data-toggle="minimize">
                        <span class="mdi mdi-menu"></span>
                    </button>
                    <ul class="navbar-nav w-100">

                    </ul>
                    <ul class="navbar-nav navbar-nav-right">
                        {{-- <li class="nav-item dropdown border-left">
                            <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#"
                                data-bs-toggle="dropdown">
                                <i class="mdi mdi-bank"></i>
                                <span class="count bg-danger"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                                aria-labelledby="notificationDropdown">
                                
                                @foreach (App\Models\JobProof::where('sts', 0)->latest()->take(5)->get() as $proof)
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item preview-item" href="{{route('job.proof')}}">
                                    <div class="preview-thumbnail">
                                        <div class="preview-icon bg-dark rounded-circle">
                                            <i class="mdi mdi-calendar text-success"></i>
                                        </div>
                                    </div>
                                   
                                    <div class="preview-item-content">
                                        <p class="text-muted ellipsis mb-0">{{$proof->student->name}} Completed a task.</p>
                                    </div>
                                    
                                </a>
                                @endforeach
                                
                                <div class="dropdown-divider"></div>
                            </div>
                        </li> --}}

                        <li class="nav-item dropdown border-left">
                            <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#"
                                data-bs-toggle="dropdown">
                                <i class="mdi mdi-cart"></i>
                                <span class="count bg-danger"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                                aria-labelledby="notificationDropdown">
                                
                                @foreach (App\Models\Order::where('sts', 0)->latest()->take(5)->get() as $order)
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item preview-item" href="{{route('orders')}}">
                                    <div class="preview-thumbnail">
                                        <div class="preview-icon bg-dark rounded-circle">
                                            <i class="mdi mdi-calendar text-success"></i>
                                        </div>
                                    </div>
                                   
                                    <div class="preview-item-content">
                                        <p class="text-muted ellipsis mb-0">{{$order->name}} left an order.</p>
                                    </div>
                                    
                                </a>
                                @endforeach
                                
                                <div class="dropdown-divider"></div>
                            </div>
                        </li>

                        <li class="nav-item dropdown border-left">
                            <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#"
                                data-bs-toggle="dropdown">
                                <i class="mdi mdi-account-plus"></i>
                                <span class="count bg-danger"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                                aria-labelledby="notificationDropdown">
                                
                                @foreach (App\Models\StudentVarify::where('sts', 0)->latest()->take(5)->get() as $varify)
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item preview-item" href="{{route('varify')}}">
                                    <div class="preview-thumbnail">
                                        <div class="preview-icon bg-dark rounded-circle">
                                            <i class="mdi mdi-calendar text-success"></i>
                                        </div>
                                    </div>
                                   
                                    <div class="preview-item-content">
                                        <p class="text-muted ellipsis mb-0">{{$varify->amount}} &#2547; Requested for Varify!</p>
                                    </div>
                                    
                                </a>
                                @endforeach
                                
                                <div class="dropdown-divider"></div>
                            </div>
                        </li>

                        <li class="nav-item dropdown border-left">
                            <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#"
                                data-bs-toggle="dropdown">
                                <i class="mdi mdi-cellphone-android"></i>
                                <span class="count bg-danger"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                                aria-labelledby="notificationDropdown">
                                
                                @foreach (App\Models\MobileRecharge::where('sts', 0)->latest()->take(5)->get() as $mobile)
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item preview-item" href="{{route('recharges')}}">
                                    <div class="preview-thumbnail">
                                        <div class="preview-icon bg-dark rounded-circle">
                                            <i class="mdi mdi-calendar text-success"></i>
                                        </div>
                                    </div>
                                   
                                    <div class="preview-item-content">
                                        <p class="text-muted ellipsis mb-0">{{$mobile->amount}} &#2547; Requested for Recharge!</p>
                                    </div>
                                    
                                </a>
                                @endforeach
                                
                                <div class="dropdown-divider"></div>
                            </div>
                        </li>
                        
                        <li class="nav-item dropdown border-left">
                            <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#"
                                data-bs-toggle="dropdown">
                                <i class="mdi mdi-bell"></i>
                                <span class="count bg-danger"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                                aria-labelledby="notificationDropdown">
                                
                                @foreach (App\Models\WithrawRequest::where('sts', 0)->latest()->take(5)->get() as $withraw)
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item preview-item" href="{{route('withraw')}}">
                                    <div class="preview-thumbnail">
                                        <div class="preview-icon bg-dark rounded-circle">
                                            <i class="mdi mdi-calendar text-success"></i>
                                        </div>
                                    </div>
                                   
                                    <div class="preview-item-content">
                                        <p class="text-muted ellipsis mb-0">{{$withraw->amount}} &#2547; Requested for Withrawal!</p>
                                    </div>
                                    
                                </a>
                                @endforeach
                                
                                <div class="dropdown-divider"></div>
                            </div>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link" id="profileDropdown" href="#" data-bs-toggle="dropdown">
                                <div class="navbar-profile">
                                    @if (Auth::user()->photo != null)
                                    <img style="object-fit: cover;" class="img-xs rounded-circle"
                                        src="{{asset('upload/user')}}/{{Auth::user()->photo}}" alt="profile">
                                    @else
                                    <img class="img-xs rounded-circle"
                                        src="{{ Avatar::create(Auth::user()->name)->toBase64() }}" />
                                    @endif
                                    <p class="mb-0 d-none d-sm-block navbar-profile-name">{{Auth::user()->name}}</p>
                                    <i class="mdi mdi-menu-down d-none d-sm-block"></i>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                                aria-labelledby="profileDropdown">
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item preview-item" href="{{route('profile')}}">
                                    <div class="preview-thumbnail">
                                        <div class="preview-icon bg-dark rounded-circle">
                                            <i class="mdi mdi-settings text-success"></i>
                                        </div>
                                    </div>
                                    <div class="preview-item-content">
                                        <p class="preview-subject mb-1">Profile</p>
                                    </div>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item preview-item" href="{{route('admin.logout')}}">
                                    <div class="preview-thumbnail">
                                        <div class="preview-icon bg-dark rounded-circle">
                                            <i class="mdi mdi-logout text-danger"></i>
                                        </div>
                                    </div>
                                    <div class="preview-item-content">
                                        <p class="preview-subject mb-1">Log out</p>
                                    </div>
                                </a>
                            </div>
                        </li>
                    </ul>
                    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                        data-toggle="offcanvas">
                        <span class="mdi mdi-format-line-spacing"></span>
                    </button>
                </div>
            </nav>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    @yield('content')
                </div>
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{asset('backend')}}/assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{asset('backend')}}/assets/js/off-canvas.js"></script>
    <script src="{{asset('backend')}}/assets/js/hoverable-collapse.js"></script>
    <script src="{{asset('backend')}}/assets/js/misc.js"></script>
    <script src="{{asset('backend')}}/assets/js/settings.js"></script>
    <script src="{{asset('backend')}}/assets/js/todolist.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.datatables.net/2.2.1/js/dataTables.min.js"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

    </script>

    @yield('footer_script')
    <!-- endinject -->
    <!-- Custom js for this page -->
    <!-- End custom js for this page -->
</body>

</html>
