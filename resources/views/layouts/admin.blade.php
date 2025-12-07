<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Admin Dashboard') - Aplikasi Infaq</title>

    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0">

    <style>
        /* Tema Biru Muda - Layout Admin */
        body {
            background: #f0f9ff;
        }

        /* Sidebar Styling - Biru sampai bawah */
        #sidebar {
            background: linear-gradient(180deg, #0ea5e9 0%, #0284c7 100%) !important;
            box-shadow: 2px 0 10px rgba(14, 165, 233, 0.2);
            position: fixed !important;
            top: 0 !important;
            bottom: 0 !important;
            left: 0 !important;
            height: 100vh !important;
            min-height: 100vh !important;
            overflow-y: auto !important;
            overflow-x: hidden !important;
            z-index: 100 !important;
        }

        #sidebar-scroll {
            background: linear-gradient(180deg, #0ea5e9 0%, #0284c7 100%) !important;
            min-height: 100vh !important;
            height: 100% !important;
        }

        .sidebar-content {
            background: linear-gradient(180deg, #0ea5e9 0%, #0284c7 100%) !important;
            min-height: 100vh !important;
            height: 100% !important;
            padding-bottom: 20px !important;
        }

        .sidebar-brand {
            background: linear-gradient(135deg, #38bdf8 0%, #0ea5e9 100%) !important;
            color: white !important;
            padding: 15px 20px;
            font-weight: 700;
            font-size: 16px;
            border-bottom: 2px solid rgba(255, 255, 255, 0.2);
        }

        .sidebar-brand:hover {
            background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%) !important;
        }

        .sidebar-brand i {
            color: white !important;
        }

        .sidebar-brand span {
            color: white !important;
        }

        .sidebar-user {
            background: rgba(255, 255, 255, 0.1) !important;
            padding: 15px;
            margin: 10px 15px;
            border-radius: 10px;
        }

        .sidebar-user-name {
            color: white !important;
            font-weight: 600;
            margin-top: 8px;
            font-size: 14px;
        }

        .sidebar-user-links a {
            color: white !important;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            padding: 8px;
            transition: all 0.3s ease;
        }

        .sidebar-user-links a:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-2px);
        }

        .sidebar-nav {
            background: transparent !important;
        }

        .sidebar-nav li {
            background: transparent !important;
        }

        .sidebar-nav a {
            color: rgba(255, 255, 255, 0.9) !important;
            padding: 10px 15px !important;
            border-radius: 8px;
            margin: 3px 10px;
            transition: all 0.3s ease;
            background: transparent !important;
            font-size: 13px !important;
            line-height: 1.4 !important;
            white-space: nowrap !important;
            overflow: hidden !important;
            text-overflow: ellipsis !important;
        }

        .sidebar-nav a:hover {
            background: rgba(255, 255, 255, 0.15) !important;
            color: white !important;
        }

        .sidebar-nav a.active {
            background: linear-gradient(135deg, #38bdf8 0%, #0ea5e9 100%) !important;
            color: white !important;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .sidebar-nav-icon {
            color: white !important;
            font-size: 14px !important;
            margin-right: 8px !important;
        }

        .sidebar-nav-mini-hide {
            color: white !important;
            font-size: 13px !important;
        }

        /* Pastikan semua elemen sidebar menggunakan warna biru */
        #sidebar * {
            border-color: rgba(255, 255, 255, 0.2) !important;
        }

        #sidebar .sidebar-section {
            background: transparent !important;
        }

        /* Pastikan sidebar biru sampai bawah */
        #page-container {
            background: #f0f9ff !important;
        }

        #main-container {
            background: #f0f9ff !important;
        }

        /* Pastikan semua elemen dalam sidebar memiliki background biru */
        #sidebar>*,
        #sidebar-scroll>*,
        .sidebar-content>* {
            background: transparent !important;
        }

        /* Pastikan sidebar-nav juga transparan agar background biru terlihat */
        .sidebar-nav,
        .sidebar-nav li,
        .sidebar-nav ul {
            background: transparent !important;
        }

        /* Responsive untuk Mobile */
        @media (max-width: 768px) {
            #sidebar {
                width: 250px !important;
                position: fixed;
                z-index: 1000;
                left: -250px;
                transition: left 0.3s ease;
            }

            #sidebar.sidebar-visible-lg {
                left: 0;
            }

            #main-container {
                margin-left: 0 !important;
                width: 100% !important;
            }

            /* Overlay untuk menutup sidebar saat klik di luar */
            .sidebar-overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.5);
                z-index: 999;
            }

            .sidebar-overlay.active {
                display: block;
            }

            .navbar-default {
                padding: 10px 15px;
            }

            .content-header {
                padding: 20px 15px;
                margin-bottom: 20px;
            }

            .content-header h1 {
                font-size: 18px;
            }

            .block {
                margin: 0 10px 20px;
            }

            .block-title {
                padding: 15px;
            }

            .block-title h2 {
                font-size: 16px;
            }

            .block-options {
                width: 100%;
                margin-top: 10px;
            }

            .block-options form {
                width: 100%;
            }

            .block-content {
                padding: 15px;
            }

            .table-responsive {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }

            .table {
                font-size: 12px;
                min-width: 600px;
            }

            .table thead th {
                padding: 8px 5px;
                font-size: 11px;
            }

            .table tbody td {
                padding: 8px 5px;
                font-size: 11px;
            }

            footer {
                padding: 15px;
                font-size: 12px;
            }

            .sidebar-brand {
                padding: 15px;
                font-size: 16px;
            }

            .sidebar-user {
                padding: 15px;
                margin: 10px;
            }

            .sidebar-nav a {
                padding: 10px 15px;
                font-size: 12px;
            }
        }

        /* Header/Navbar Styling */
        .navbar-default {
            background: linear-gradient(135deg, #bae6fd 0%, #7dd3fc 100%);
            border-bottom: 2px solid #0ea5e9;
            box-shadow: 0 2px 10px rgba(14, 165, 233, 0.2);
        }

        .navbar-nav-custom a {
            color: #075985;
            transition: all 0.3s ease;
        }

        .navbar-nav-custom a:hover {
            color: #0ea5e9;
            background: rgba(255, 255, 255, 0.3);
        }

        .dropdown-menu {
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(14, 165, 233, 0.2);
            border: 1px solid #e2e8f0;
        }

        .dropdown-menu a {
            color: #0c4a6e;
            transition: all 0.3s ease;
        }

        .dropdown-menu a:hover {
            background: linear-gradient(135deg, #e0f2fe 0%, #bae6fd 100%);
            color: #075985;
        }

        /* Footer Styling */
        footer {
            background: linear-gradient(135deg, #bae6fd 0%, #7dd3fc 100%);
            color: #075985;
            padding: 20px;
            border-top: 2px solid #0ea5e9;
        }

        footer a {
            color: #0ea5e9;
            font-weight: 600;
        }

        footer a:hover {
            color: #0284c7;
        }

        /* Preloader */
        .themed-background {
            background: linear-gradient(135deg, #38bdf8 0%, #0ea5e9 100%);
        }

        /* To Top Button */
        #to-top {
            background: linear-gradient(135deg, #38bdf8 0%, #0ea5e9 100%);
            color: white;
            border-radius: 50%;
            box-shadow: 0 4px 15px rgba(14, 165, 233, 0.3);
        }

        #to-top:hover {
            background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%);
        }

        /* Avatar Border */
        .sidebar-user-avatar img,
        .navbar-nav-custom img {
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            transition: all 0.3s ease;
        }

        .sidebar-user-avatar img:hover,
        .navbar-nav-custom img:hover {
            border-color: white;
            transform: scale(1.05);
        }
    </style>

    @stack('css-custom')

    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0">

    <link rel="shortcut icon" href="{{ asset('admin-template/img/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('admin-template/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-template/css/plugins.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-template/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-template/css/themes.css') }}">

    <script src="{{ asset('admin-template/js/vendor/modernizr.min.js') }}"></script>
</head>

<body>
    <div id="page-wrapper">
        <div class="preloader themed-background">
            <h1 class="push-top-bottom text-light text-center"><strong>Pro</strong>UI</h1>
            <div class="inner">
                <h3 class="text-light visible-lt-ie10"><strong>Loading..</strong></h3>
                <div class="preloader-spinner hidden-lt-ie10"></div>
            </div>
        </div>

        <div id="page-container" class="sidebar-partial sidebar-visible-lg sidebar-no-animations">

            <div id="sidebar">
                <div id="sidebar-scroll">
                    <div class="sidebar-content">
                        <a href="{{ route('admin.dashboard') }}" class="sidebar-brand">
                            <i class="gi gi-flash"></i><span class="sidebar-nav-mini-hide"><strong>Infaq</strong>INKA</span>
                        </a>

                        <div class="sidebar-section sidebar-user clearfix sidebar-nav-mini-hide">
                            <div class="sidebar-user-avatar">
                                <a href="#">
                                    <img src="{{ asset('admin-template/img/placeholders/avatars/icon.jpg') }}" alt="avatar">
                                </a>
                            </div>
                            <div class="sidebar-user-name">{{ Auth::user()->name }}</div>

                        </div>
                        <ul class="sidebar-nav">
                            <li>
                                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                                    <i class="gi gi-stopwatch sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Dashboard</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.walimurid.index') }}" class="{{ request()->routeIs('admin.walimurid.*') ? 'active' : '' }}">
                                    <i class="fa fa-users sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Wali Murid</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.siswa.index') }}" class="{{ request()->routeIs('admin.siswa.*') ? 'active' : '' }}">
                                    <i class="fa fa-users sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Siswa</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.tagihan.index') }}" class="{{ request()->routeIs('admin.tagihan.*') ? 'active' : '' }}">
                                    <i class="gi gi-money sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Tagihan</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.laporan.index') }}" class="{{ request()->routeIs('admin.laporan.*') ? 'active' : '' }}">
                                    <i class="gi gi-charts sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Laporan</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div id="main-container">
                <header class="navbar navbar-default">
                    <ul class="nav navbar-nav-custom">
                        <li>
                            <a href="javascript:void(0)" onclick="App.sidebar('toggle-sidebar');this.blur();">
                                <i class="fa fa-bars fa-fw"></i>
                            </a>
                        </li>
                    </ul>

                    <ul class="nav navbar-nav-custom pull-right">
                        <li class="dropdown">
                            <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="{{ asset('admin-template/img/placeholders/avatars/avatar2.jpg') }}" alt="avatar"> <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-custom dropdown-menu-right">
                                <li class="dropdown-header text-center">Account</li>
                                <li>
                                    <a href="{{ route('profile.edit') }}">
                                        <i class="fa fa-user fa-fw pull-right"></i>
                                        Profile
                                    </a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form-header').submit();">
                                        <i class="fa fa-ban fa-fw pull-right"></i> Logout
                                    </a>
                                    <form id="logout-form-header" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </header>

                {{-- ================================================================ --}}
                {{-- PERBAIKAN: Tambahkan <div id="page-content"> di sini --}}
                <div id="page-content">
                    @yield('content')
                </div>
                {{-- ================================================================ --}}

                <footer class="clearfix">
                    <div class="pull-right">
                        Crafted with <i class="fa fa-heart text-danger"></i> by <a href="http://goo.gl/vNS3I" target="_blank">deputrira👋</a>
                    </div>
                    <div class="pull-left">
                        <span>{{ date('Y') }}</span> © <a href="#" target="_blank">Aplikasi Infaq INKA</a>
                    </div>
                </footer>
            </div>
        </div>
    </div>

    <a href="#" id="to-top"><i class="fa fa-angle-double-up"></i></a>

    <script src="{{ asset('admin-template/js/vendor/jquery.min.js') }}"></script>
    <script src="{{ asset('admin-template/js/vendor/bootstrap.min.js') }}"></script>
    {{-- Tambahkan countTo dari CDN jika tidak ada di plugins.js --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-countto/1.2.0/jquery.countTo.min.js"></script>
    <script src="{{ asset('admin-template/js/plugins.js') }}"></script>
    <script src="{{ asset('admin-template/js/app.js') }}"></script>

    {{-- JavaScript untuk toggle sidebar di mobile --}}
    <script>
        $(document).ready(function() {
            // Toggle sidebar di mobile
            function toggleSidebarMobile() {
                if ($(window).width() <= 768) {
                    var sidebar = $('#sidebar');
                    var overlay = $('.sidebar-overlay');

                    if (sidebar.hasClass('sidebar-visible-lg')) {
                        sidebar.removeClass('sidebar-visible-lg');
                        overlay.removeClass('active');
                    } else {
                        sidebar.addClass('sidebar-visible-lg');
                        overlay.addClass('active');
                    }
                }
            }

            // Override App.sidebar untuk mobile
            var originalSidebar = window.App ? window.App.sidebar : null;
            if (window.App) {
                var originalToggle = window.App.sidebar;
                window.App.sidebar = function(action) {
                    if ($(window).width() <= 768 && action === 'toggle-sidebar') {
                        toggleSidebarMobile();
                    } else if (originalToggle) {
                        originalToggle.call(this, action);
                    }
                };
            }

            // Toggle saat klik tombol hamburger
            $('a[onclick*="App.sidebar"]').on('click', function(e) {
                if ($(window).width() <= 768) {
                    e.preventDefault();
                    toggleSidebarMobile();
                }
            });

            // Tutup sidebar saat klik overlay
            $(document).on('click', '.sidebar-overlay', function() {
                $('#sidebar').removeClass('sidebar-visible-lg');
                $(this).removeClass('active');
            });

            // Tutup sidebar saat resize window kembali ke desktop
            $(window).on('resize', function() {
                if ($(window).width() > 768) {
                    $('#sidebar').removeClass('sidebar-visible-lg');
                    $('.sidebar-overlay').removeClass('active');
                }
            });
        });
    </script>

    {{-- Overlay untuk mobile --}}
    <div class="sidebar-overlay"></div>

    @stack('modal')
    @stack('js-custom')
</body>

</html>