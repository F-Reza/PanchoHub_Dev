<!DOCTYPE html>
<html lang="en">

<!-- index.html  01 Jan 2025 03:44:50 GMT -->

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">

    <!-- Set Page Title -->
    @isset($title)
        {{ $title }}
    @endisset
    <style>
        .dropdown-item.has-icon.text-danger:active {
            background-color: #f8f9fa;
        }
    </style>

    {{-- <title>| পঞ্চহাব - ড্যাশবোর্ড |</title> --}}
    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/app.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/bundles/datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/bundles/izitoast/css/iziToast.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">

    <<link rel="stylesheet" href="{{ asset('assets/dashboard/bundles/summernote/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/bundles/codemirror/lib/codemirror.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/bundles/codemirror/theme/duotone-dark.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/bundles/jquery-selectric/selectric.css') }}">

    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/components.css') }}">
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/custom.css') }}">
    <link rel='shortcut icon' type='image/x-icon' href="{{ asset('assets/dashboard/img/favicon.ico') }}" />
</head>

<body>
    <div class="loader"></div>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar sticky">
                <div class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li>
                            <a href="#" data-toggle="sidebar" class="nav-link nav-link-lg collapse-btn">
                                <i data-feather="align-justify"></i> <!-- Sidebar toggle icon -->
                            </a>
                        </li>
                        <li><a href="#" class="nav-link nav-link-lg fullscreen-btn">
                                <i data-feather="maximize"></i>
                            </a></li>
                        <li>
                            <form class="form-inline mr-auto">
                                <div class="search-element">
                                    <input class="form-control" type="search" placeholder="Search" aria-label="Search"
                                        data-width="200">
                                    <button class="btn" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </form>
                        </li>
                    </ul>
                </div>
                <ul class="navbar-nav navbar-right">
                    <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown"
                            class="nav-link nav-link-lg message-toggle"><i data-feather="mail"></i>
                            <span class="badge headerBadge1">
                                6 </span> </a>
                        <div class="dropdown-menu dropdown-list dropdown-menu-right pullDown">
                            <div class="dropdown-header">
                                Messages
                                <div class="float-right">
                                    <a href="#">Mark All As Read</a>
                                </div>
                            </div>
                            <div class="dropdown-list-content dropdown-list-message">
                                <a href="#" class="dropdown-item"> <span
                                        class="dropdown-item-avatar
											text-white"> <img alt="image"
                                            src="{{ asset('assets/dashboard/img/users/user-1.png') }}"
                                            class="rounded-circle">
                                    </span> <span class="dropdown-item-desc"> <span class="message-user">John
                                            Deo</span>
                                        <span class="time messege-text">Please check your mail !!</span>
                                        <span class="time">2 Min Ago</span>
                                    </span>
                                </a> <a href="#" class="dropdown-item"> <span
                                        class="dropdown-item-avatar text-white">
                                        <img alt="image" src="{{ asset('assets/dashboard/img/users/user-2.png') }}"
                                            class="rounded-circle">
                                    </span> <span class="dropdown-item-desc"> <span class="message-user">Sarah
                                            Smith</span> <span class="time messege-text">Request for leave
                                            application</span>
                                        <span class="time">5 Min Ago</span>
                                    </span>
                                </a> <a href="#" class="dropdown-item"> <span
                                        class="dropdown-item-avatar text-white">
                                        <img alt="image" src="{{ asset('assets/dashboard/img/users/user-5.png') }}"
                                            class="rounded-circle">
                                    </span> <span class="dropdown-item-desc"> <span class="message-user">Jacob
                                            Ryan</span> <span class="time messege-text">Your payment invoice is
                                            generated.</span> <span class="time">12 Min Ago</span>
                                    </span>
                                </a> <a href="#" class="dropdown-item"> <span
                                        class="dropdown-item-avatar text-white">
                                        <img alt="image" src="{{ asset('assets/dashboard/img/users/user-4.png') }}"
                                            class="rounded-circle">
                                    </span> <span class="dropdown-item-desc"> <span class="message-user">Lina
                                            Smith</span> <span class="time messege-text">hii John, I have upload
                                            doc
                                            related to task.</span> <span class="time">30
                                            Min Ago</span>
                                    </span>
                                </a> <a href="#" class="dropdown-item"> <span
                                        class="dropdown-item-avatar text-white">
                                        <img alt="image"
                                            src="{{ asset('assets/dashboard/img/users/user-3.png') }}"
                                            class="rounded-circle">
                                    </span> <span class="dropdown-item-desc"> <span class="message-user">Jalpa
                                            Joshi</span> <span class="time messege-text">Please do as specify.
                                            Let me
                                            know if you have any query.</span> <span class="time">1
                                            Days Ago</span>
                                    </span>
                                </a> <a href="#" class="dropdown-item"> <span
                                        class="dropdown-item-avatar text-white">
                                        <img alt="image"
                                            src="{{ asset('assets/dashboard/img/users/user-2.png') }}"
                                            class="rounded-circle">
                                    </span> <span class="dropdown-item-desc"> <span class="message-user">Sarah
                                            Smith</span> <span class="time messege-text">Client Requirements</span>
                                        <span class="time">2 Days Ago</span>
                                    </span>
                                </a>
                            </div>
                            <div class="dropdown-footer text-center">
                                <a href="#">View All <i class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </li>
                    <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown"
                            class="nav-link notification-toggle nav-link-lg"><i data-feather="bell"
                                class="bell"></i>
                        </a>
                        <div class="dropdown-menu dropdown-list dropdown-menu-right pullDown">
                            <div class="dropdown-header">
                                Notifications
                                <div class="float-right">
                                    <a href="#">Mark All As Read</a>
                                </div>
                            </div>
                            <div class="dropdown-list-content dropdown-list-icons">
                                <a href="#" class="dropdown-item dropdown-item-unread"> <span
                                        class="dropdown-item-icon bg-primary text-white"> <i
                                            class="fas
												fa-code"></i>
                                    </span> <span class="dropdown-item-desc"> Template update is
                                        available now! <span class="time">2 Min
                                            Ago</span>
                                    </span>
                                </a> <a href="#" class="dropdown-item"> <span
                                        class="dropdown-item-icon bg-info text-white"> <i
                                            class="far
												fa-user"></i>
                                    </span> <span class="dropdown-item-desc"> <b>You</b> and <b>Dedik
                                            Sugiharto</b> are now friends <span class="time">10 Hours
                                            Ago</span>
                                    </span>
                                </a> <a href="#" class="dropdown-item"> <span
                                        class="dropdown-item-icon bg-success text-white"> <i
                                            class="fas
												fa-check"></i>
                                    </span> <span class="dropdown-item-desc"> <b>Kusnaedi</b> has
                                        moved task <b>Fix bug header</b> to <b>Done</b> <span class="time">12
                                            Hours
                                            Ago</span>
                                    </span>
                                </a> <a href="#" class="dropdown-item"> <span
                                        class="dropdown-item-icon bg-danger text-white"> <i
                                            class="fas fa-exclamation-triangle"></i>
                                    </span> <span class="dropdown-item-desc"> Low disk space. Let's
                                        clean it! <span class="time">17 Hours Ago</span>
                                    </span>
                                </a> <a href="#" class="dropdown-item"> <span
                                        class="dropdown-item-icon bg-info text-white"> <i
                                            class="fas
												fa-bell"></i>
                                    </span> <span class="dropdown-item-desc"> Welcome to Otika
                                        template! <span class="time">Yesterday</span>
                                    </span>
                                </a>
                            </div>
                            <div class="dropdown-footer text-center">
                                <a href="#">View All <i class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </li>
                    <li class="dropdown"><a href="#" data-toggle="dropdown"
                            class="nav-link dropdown-toggle nav-link-lg nav-link-user">

                            @if (!empty(Auth::user()->image))
                                <img alt="image" src="{{ asset('uploads/admins/' . Auth::user()->image) }}"
                                    class="user-img-radious-style">
                            @else
                                <img alt="image" src="{{ asset('assets/dashboard/img/users/avatar.png') }}"
                                    class="user-img-radious-style">
                            @endif




                            <span class="d-sm-none d-lg-inline-block"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right pullDown">
                            <div class="dropdown-title">Hello {{ Auth::user()->name }}</div>
                            <a href="{{ route('admin.profile.edit') }}" class="dropdown-item has-icon"> <i
                                    class="far
										fa-user"></i> Profile
                            </a> <a href="#" class="dropdown-item has-icon"> <i class="fas fa-bolt"></i>
                                Activities
                            </a> <a href="#" class="dropdown-item has-icon"> <i class="fas fa-cog"></i>
                                Settings
                            </a>
                            <div class="dropdown-divider"></div>
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('admin.logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item has-icon text-danger"
                                    style="display: flex; align-items: center; font-size: 13px;">
                                    <i class="fas fa-sign-out-alt"></i>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </li>
                </ul>
            </nav>
            <div class="main-sidebar sidebar-style-2">
                <aside id="sidebar-wrapper">

                    <div class="sidebar-brand">
                        <a href="{{ route('admin.dashboard') }}">
                            <img alt="image" src="{{ asset('assets/dashboard/img/logo_0.png') }}" width="250px"
                                class="logo-name" />
                        </a>
                        <a href="{{ route('admin.dashboard') }}" class="applogo">
                            <img alt="image" src="{{ asset('assets/dashboard/img/logo_1.png') }}" height="60px"
                                width="60px" />
                        </a>
                    </div>

                    <ul class="sidebar-menu pt-4">
                        <li class="dropdown">
                            <a href="{{ route('admin.dashboard') }}" class="nav-link"><i
                                    data-feather="monitor"></i><span>ড্যাশবোর্ড</span></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="menu-toggle nav-link has-dropdown"><i
                                    data-feather="activity"></i><span>হেলথ সার্ভিস</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="{{ route('admin.doctors.index') }}">ডাক্তারগন</a></li>
                                <li><a class="nav-link" href="{{ route('admin.hospitals.index') }}">হাসপাতাল সমূহ</a></li>
                                <li><a class="nav-link" href="{{ route('admin.diagnostics.index') }}">ডায়াগনস্টিক সেন্টার</a></li>
                                <li><a class="nav-link" href="{{ route('admin.donors.index') }}">রক্তদাতা</a></li>
                                <li><a class="nav-link" href="{{ route('admin.needers.index') }}">রক্ত গ্রহীতা</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="menu-toggle nav-link has-dropdown"><i
                                    data-feather="tag"></i><span>নিউজ ডেস্ক</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="{{ route('admin.todaynews.index') }}">আজকের খবর</a></li>
                                <li><a class="nav-link" href="{{ route('admin.jobnews.index') }}">চাকরির খবর</a></li>
                                <li><a class="nav-link" href="{{ route('admin.notifications.index') }}"> নিজস্ব সংবাদ </a></li>
                                <li><a class="nav-link" href="{{ route('admin.sliders.index') }}"> স্লাইডার </a></li>
                                <li><a class="nav-link" href="{{ route('admin.scrolls.index') }}"> স্ক্রোল </a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="menu-toggle nav-link has-dropdown"><i
                                    data-feather="grid"></i><span>বিজনেস পয়েন্ট</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="{{ route('admin.hoteles.index') }}">হোটেল</a></li>
                                <li><a class="nav-link" href="{{ route('admin.restaurants.index') }}">রেস্টুরেন্ট </a></li>
                                <li><a class="nav-link" href="{{ route('admin.salon_parlour.index') }}">পার্লার-সেলুন</a></li>
                                <li><a class="nav-link" href="{{ route('admin.shopping.index') }}">কেনাকাটা</a></li>
                                <li><a class="nav-link" href="{{ route('admin.vehicle_rent.index') }}">গাড়ি ভাড়া</a></li>
                                <li><a class="nav-link" href="{{ route('admin.house_rent.index') }}">বাসা ভাড়া</a></li>
                                <li><a class="nav-link" href="{{ route('admin.plot_sales.index') }}">ফ্লাট ও জমি</a></li>
                                <li><a class="nav-link" href="{{ route('admin.technicians.index') }}">মিস্ত্রি</a></li>
                                <li><a class="nav-link" href="{{ route('admin.nursery.index') }}">নার্সারি</a></li>
                                <li><a class="nav-link" href="{{ route('admin.entrepreneurs.index') }}">উদ্যোক্তা</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="menu-toggle nav-link has-dropdown"><i
                                    data-feather="pen-tool"></i><span>এডুকেশন হাব</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="{{ route('admin.teachers.index') }}">শিক্ষক</a></li>
                                <li><a class="nav-link" href="{{ route('admin.institutions.index') }}">শিক্ষা প্রতিষ্ঠান</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="menu-toggle nav-link has-dropdown"><i
                                    data-feather="server"></i><span>পাবলিক সার্ভিস</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="avatar.html">বাসের সময়সূচি</a></li>
                                <li><a class="nav-link" href="card.html">ট্রেনের সময়সূচি</a></li>
                                <li><a class="nav-link" href="modal.html">জরুরী সেবা</a></li>
                                <li><a class="nav-link" href="sweet-alert.html">ওয়েব-সাইট </a></li>
                                <li><a class="nav-link" href="toastr.html">ফায়ার সার্ভিস </a></li>
                                <li><a class="nav-link" href="empty-state.html">থানা-পুলিশ</a></li>
                                <li><a class="nav-link" href="multiple-upload.html">বিদ্যুৎ অফিস </a></li>
                                <li><a class="nav-link" href="pricing.html">কুরিয়ার সার্ভিস</a></li>
                                <li><a class="nav-link" href="tabs.html"> দর্শনীয় স্থান</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="menu-toggle nav-link has-dropdown"><i
                                    data-feather="users"></i><span>ইউজার সমুহ</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="{{ route('admin.users.index') }}">লোকাল ইউজার</a></li>
                                <li><a class="nav-link" href="{{ route('admin.staff.index') }}">এডমিন স্টাফ</a></li>
                            </ul>
                        </li>

                        <li class="dropdown">
                            <a href="#" class="menu-toggle nav-link has-dropdown"><i
                                    data-feather="gift"></i><span>প্যাকেজ সমূহ</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="#"> বেসিক </a></li>
                                <li><a class="nav-link" href="#"> রেগুলার </a></li>
                                <li><a class="nav-link" href="#"> প্রিমিয়াম </a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="menu-toggle nav-link has-dropdown"><i
                                    data-feather="credit-card"></i><span>পেমেন্টস </span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="#"> ট্রানজেকশন হিস্ট্রি</a></li>
                                <li><a class="nav-link" href="#"> সকল লেনদেন </a></li>
                                <li><a class="nav-link" href="#"> পেমেন্ট গেটওয়ে সেটিংস </a></li>
                            </ul>
                        </li>

                        <li class="dropdown">
                            <a href="#" class="menu-toggle nav-link has-dropdown"><i
                                    data-feather="settings"></i><span>সেটিংস সমূহ</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="#"> যোগাযোগ </a></li>
                                <li><a class="nav-link" href="#"> প্রাইভেসি পলিসি </a></li>
                                <li><a class="nav-link" href="#"> টার্মস এন্ড কন্ডিশনস </a></li>
                            </ul>
                        </li>
                        <!-- Main END Point -->

                    </ul>
                </aside>
            </div>

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>

            <footer class="main-footer">
                <div class="footer-left">
                    <a href="https://www.facebook.com/NextDigitOfficial/">NextDigit</a></a>
                </div>
                <div class="footer-right">
                </div>
            </footer>
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="{{ asset('assets/dashboard/js/app.min.js') }}"></script>

    <!-- JS Libraies -->
    <script src="{{ asset('assets/dashboard/bundles/apexcharts/apexcharts.min.js') }}"></script>
    <!-- Page Specific JS File -->
    <script src="{{ asset('assets/dashboard/js/page/index.js') }}"></script>

    <!-- JS Libraries -->
    <script src="{{ asset('assets/dashboard/bundles/izitoast/js/iziToast.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/bundles/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/bundles/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/bundles/summernote/summernote-bs4.js') }}"></script>
    <script src="{{ asset('assets/dashboard/bundles/codemirror/lib/codemirror.js') }}"></script>

    <!-- Remove the CDN version of jQuery if it's already included in app.min.js -->
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> -->

    <!-- Ensure Popper.js and Bootstrap JS are included after jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- CKEditor 5 -->
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.0/classic/ckeditor.js"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('assets/dashboard/js/page/datatables.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/page/toastr.js') }}"></script>

    <!-- Template JS File -->
    <script src="{{ asset('assets/dashboard/js/scripts.js') }}"></script>

    <!-- Custom JS File -->
    <script src="{{ asset('assets/dashboard/js/custom.js') }}"></script>


</body>

@isset($script)
    {{ $script }}
@endisset
<!-- datatables.html  01 Jan 2025 03:55:25 GMT -->

</html>
