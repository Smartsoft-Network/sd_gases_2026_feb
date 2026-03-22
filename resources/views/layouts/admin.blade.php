<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>@yield('title', 'Admin Dashboard') - {{ $generalData['site_name'] ?? 'Otika' }}</title>
    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('admin-assets/assets/css/app.min.css') }}">
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('admin-assets/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/assets/css/components.css') }}">
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="{{ asset('admin-assets/assets/css/custom.css') }}">
    <link rel="shortcut icon" href="{{ isset($generalData['favicon']) ? asset('storage/' . $generalData['favicon']) : asset('images/sdgases-logo.png') }}" type="image/png">
    <style>
        .headerBadge1 {
            position: absolute;
            top: -2px;
            right: -2px;
            padding: 2px 5px;
            font-size: 9px;
            border-radius: 50%;
            line-height: 1.2;
            min-width: 16px;
            min-height: 16px;
            display: inline-flex !important;
            align-items: center;
            justify-content: center;
            border: 2px solid #fff;
            background-color: #fc544b !important;
            color: #fff !important;
            font-weight: bold;
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
            width: auto !important;
            height: auto !important;
            aspect-ratio: 1/1;
        }
        .sidebar-badge {
            position: absolute;
            top: 10px;
            right: 15px;
            background-color: #fc544b;
            color: #fff;
            font-weight: bold;
            padding: 0px 4px;
            border-radius: 50%;
            font-size: 9px;
            min-width: 16px;
            min-height: 16px;
            width: auto !important;
            height: auto !important;
            display: inline-flex !important;
            align-items: center;
            justify-content: center;
            border: 1.5px solid #fff;
            box-shadow: 0 1px 3px rgba(0,0,0,0.2);
            line-height: 1;
            aspect-ratio: 1/1;
            z-index: 99;
            pointer-events: none;
        }
        .main-sidebar.sidebar-mini .sidebar-menu > li .sidebar-badge {
            display: inline-flex !important;
            left: 28px;
            top: 8px;
            right: auto;
        }
        .navbar .nav-link.nav-link-user .user-img-radious-style {
            border-radius: 50% !important;
            box-shadow: 0 0 6px 0 rgba(0, 0, 0, 0.2);
        }
    </style>
    @stack('styles')
</head>

<body class="{{ session('sidebar_mini') ? 'sidebar-mini' : '' }}">
    <div class="loader"></div>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar sticky">
                <div class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg
									collapse-btn">
                                <i data-feather="align-justify"></i></a></li>
                        <li><a href="#" class="nav-link nav-link-lg fullscreen-btn">
                                <i data-feather="maximize"></i>
                            </a></li>
                    </ul>
                </div>
                <ul class="navbar-nav navbar-right">
                    <li>
                        <a href="{{ route('admin.messages.index') }}" class="nav-link nav-link-lg" style="position: relative;">
                            <i data-feather="mail"></i>
                            @if($unreadMessagesCount > 0)
                                <span class="headerBadge1">
                                    {{ $unreadMessagesCount }}
                                </span>
                            @endif
                        </a>
                    </li>
                    <li class="dropdown"><a href="#" data-toggle="dropdown"
                            class="nav-link dropdown-toggle nav-link-lg nav-link-user"> <img alt="image"
                                src="{{ auth()->user()->photo ? asset('storage/' . auth()->user()->photo) : asset('admin-assets/assets/img/user.png') }}" class="user-img-radious-style">
                            <span class="d-sm-none d-lg-inline-block"></span></a>
                        <div class="dropdown-menu dropdown-menu-right pullDown">
                            <div class="dropdown-title">Hello {{ auth()->user()->name }}</div>
                            <a href="{{ route('admin.profile.edit') }}" class="dropdown-item has-icon"> <i class="far
										fa-user"></i>
                                Profile
                            </a>
                            <div class="dropdown-divider"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); this.closest('form').submit();"
                                    class="dropdown-item has-icon text-danger"> <i class="fas fa-sign-out-alt"></i>
                                    Logout
                                </a>
                            </form>
                        </div>
                    </li>
                </ul>
            </nav>
            <div class="main-sidebar sidebar-style-2">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="{{ route('admin.dashboard') }}">
                            <img src="{{ isset($generalData['logo']) ? asset('storage/' . $generalData['logo']) : asset('images/sdgases-logo.png') }}" alt="{{ $generalData['site_name'] ?? 'SD Gases' }}" class="h-12 md:h-14 w-auto"
                                style="height: 3rem; width: auto;">
                        </a>
                    </div>
                    <ul class="sidebar-menu">
                        <li class="menu-header">Main</li>
                        <li class="dropdown {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <a href="{{ route('admin.dashboard') }}" class="nav-link"><i
                                    data-feather="monitor"></i><span>Dashboard</span></a>
                        </li>
                        <li class="dropdown {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.products.index') }}" class="nav-link"><i
                                    data-feather="box"></i><span>Products</span></a>
                        </li>
                        <li class="dropdown {{ request()->routeIs('admin.services.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.services.index') }}" class="nav-link"><i
                                    data-feather="briefcase"></i><span>Services</span></a>
                        </li>
                        <li class="dropdown {{ request()->routeIs('admin.tutorial-videos.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.tutorial-videos.index') }}" class="nav-link"><i
                                    data-feather="video"></i><span>{{ $tutorialVideosPageData['page_title'] ?? 'Gallery' }}</span></a>
                        </li>
                        <li class="dropdown {{ request()->routeIs('admin.messages.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.messages.index') }}" class="nav-link"><i
                                    data-feather="mail"></i><span>Messages</span></a>
                            @if($unreadMessagesCount > 0)
                                <span class="sidebar-badge">{{ $unreadMessagesCount }}</span>
                            @endif
                        </li>
                        <li class="dropdown {{ request()->routeIs('admin.traffic.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.traffic.index') }}" class="nav-link"><i
                                    data-feather="bar-chart-2"></i><span>Traffic Analysis</span></a>
                        </li>
                        <li class="dropdown {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                            <a href="#" class="nav-link has-dropdown"><i
                                    data-feather="settings"></i><span>Settings</span></a>
                            <ul class="dropdown-menu">
                                <li class="{{ request()->routeIs('admin.settings.about') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('admin.settings.about') }}">About Page</a>
                                </li>
                                <li class="{{ request()->routeIs('admin.settings.product-main') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('admin.settings.product-main') }}">Product Main Page</a>
                                </li>
                                <li class="{{ request()->routeIs('admin.settings.services-main') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('admin.settings.services-main') }}">Services Main Page</a>
                                </li>
                                <li class="{{ request()->routeIs('admin.settings.tutorial-videos') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('admin.settings.tutorial-videos') }}">{{ $tutorialVideosPageData['page_title'] ?? 'Gallery' }} Page</a>
                                </li>
                                <li class="{{ request()->routeIs('admin.settings.general') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('admin.settings.general') }}">General Settings</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </aside>
            </div>

            <!-- Main Content -->
            <div class="main-content">
                @yield('content')
            </div>

            <footer class="main-footer">
                <div class="footer-left">
                    {{ config('app.name') }}
                </div>
                <div class="footer-right">
                </div>
            </footer>
        </div>
    </div>
    <!-- General JS Scripts -->
    <script src="{{ asset('admin-assets/assets/js/app.min.js') }}"></script>
    <!-- JS Libraries -->
    <script src="{{ asset('admin-assets/assets/bundles/apexcharts/apexcharts.min.js') }}"></script>
    <!-- CKEditor (full build so alignment and extra toolbar options are available) -->
    <script src="https://cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>
    <script src="{{ asset('admin-assets/assets/js/page/ckeditor.js') }}"></script>
    <!-- Page Specific JS File -->
    <script src="{{ asset('admin-assets/assets/js/page/index.js') }}"></script>
    <!-- Template JS File -->
    <script src="{{ asset('admin-assets/assets/js/scripts.js') }}"></script>
    <!-- Custom JS File -->
    <script src="{{ asset('admin-assets/assets/js/custom.js') }}"></script>
    <!-- SweetAlert2 for admin alerts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            // Helper function to update UI settings via AJAX
            function updateUiSetting(setting, value) {
                $.ajax({
                    url: "{{ route('admin.update-ui-setting') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        setting: setting,
                        value: value
                    },
                    success: function(response) {
                        console.log(setting + ' state saved');
                    },
                    error: function(xhr) {
                        console.error('Error saving ' + setting + ' state');
                    }
                });
            }

            // Sidebar toggle handler
            $("[data-toggle='sidebar']").on('click', function() {
                setTimeout(function() {
                    let isMini = $("body").hasClass("sidebar-mini");
                    updateUiSetting('sidebar_mini', isMini ? 1 : 0);
                }, 300);
            });

            // Fullscreen change handler (detects button click and Esc key exit)
            $(document).on('fullscreenchange webkitfullscreenchange mozfullscreenchange MSFullscreenChange', function() {
                let isFullscreen = !!(document.fullscreenElement || document.webkitFullscreenElement || document.mozFullScreenElement || document.msFullscreenElement);
                updateUiSetting('fullscreen_pref', isFullscreen ? 1 : 0);
            });
        });
    </script>
    @include('partials.alerts')
    @stack('scripts')
</body>

</html>
