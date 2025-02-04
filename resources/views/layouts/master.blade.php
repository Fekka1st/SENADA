<!DOCTYPE html>
<html lang="id">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
<!-- Shortcut Icon (Legacy) -->
<link rel="shortcut icon" href="{{ asset('auth/img/logo_lldikti_iv.jpg') }}">

    <title>SENADA | LLDIKTI</title>

    <!-- plugins:css -->
    <link rel="stylesheet" href={{asset('asset/vendors/ti-icons/css/themify-icons.css')}}>
    <link rel="stylesheet" href={{asset('asset/vendors/css/vendor.bundle.base.css')}}>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css"> --}}
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/2.2.1/css/dataTables.bootstrap4.css"> --}}
    {{-- <link rel="stylesheet" type="text/css" href=cdn.datatables.net/2.2.1/css/dataTables.dataTables.min.css> --}}
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
    {{-- <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet"> --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.2.0/css/buttons.bootstrap5.css">
    <link rel="stylesheet" href={{asset('asset/vendors/feather/feather.css')}}>
    <link rel="stylesheet" href={{asset('asset/css/vertical-layout-light/style.css')}}>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.1/css/dataTables.bootstrap5.css">

    @yield('css')

</head>

<body class="sidebar-fixed">
    @include('sweetalert::alert')
    <div class="container-scroller">
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo mr-2" href="index.html">
                    <img src={{asset('logo/logo-lldikti.png')}} class="mr-2" alt="logo" />
                </a>
                <a class="navbar-brand brand-logo-mini" href="index.html"><img src={{asset('logo/logo-lldikti.png')}}
                        alt="logo" /></a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="icon-menu"></span>
                </button>
                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item dropdown">
                        <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#"
                            data-toggle="dropdown">
                            <i class="icon-bell mx-0"></i>
                            <span class="count"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                            aria-labelledby="notificationDropdown">
                            <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-success">
                                        <i class="ti-info-alt mx-0"></i>
                                    </div>
                                </div>
                                <div class="preview-item-content">
                                    <h6 class="preview-subject font-weight-normal">Application Error</h6>
                                    <p class="font-weight-light small-text mb-0 text-muted">
                                        Just now
                                    </p>
                                </div>
                            </a>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-warning">
                                        <i class="ti-settings mx-0"></i>
                                    </div>
                                </div>
                                <div class="preview-item-content">
                                    <h6 class="preview-subject font-weight-normal">Settings</h6>
                                    <p class="font-weight-light small-text mb-0 text-muted">
                                        Private message
                                    </p>
                                </div>
                            </a>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-info">
                                        <i class="ti-user mx-0"></i>
                                    </div>
                                </div>
                                <div class="preview-item-content">
                                    <h6 class="preview-subject font-weight-normal">New user registration</h6>
                                    <p class="font-weight-light small-text mb-0 text-muted">
                                        2 days ago
                                    </p>
                                </div>
                            </a>
                        </div>
                    </li>
                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                            <img src={{Auth()->user()->foto_url}} alt="profile" />
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown"
                            aria-labelledby="profileDropdown">
                            <a class="dropdown-item">
                                <i class="ti-user text-primary"></i>
                                {{Auth()->user()->name}}
                            </a>
                            <a class="dropdown-item">
                                <i class="ti-settings text-primary"></i>
                                Profile
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="dropdown-item" type="submit"><i
                                        class="ti-angle-double-left text-danger"></i>Logout</button>
                                {{-- <a class="dropdown-item" type="submit">
                                    <i class="ti-power-off text-primary"></i>
                                    Logout
                                </a> --}}
                            </form>
                        </div>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-toggle="offcanvas">
                    <span class="icon-menu"></span>
                </button>
            </div>
        </nav>

        <div class="container-fluid page-body-wrapper">
            @include('layouts.sidebar')
            @yield('content')
        </div>
    </div>

    {{-- <script>
        $(document).ready(function () {
            const currentPath = window.location.pathname;
            const menuMap = {
                '/dashboard': 'dashboard',
                '/data-kerjasama-lldikti': 'data-kerjasama',
                '/Data-KerjaSama-pts': 'data-pt',
                '/manajemen-user': 'manajemen-user',
                '/kelola-PT': 'kelola-pt',
                '/kelola': 'kelolamaster',

            };
            const activeMenuId = menuMap[currentPath];
            if (activeMenuId) {
                $(`#${activeMenuId}`).addClass('active');
            }
        });
    </script> --}}
    <script src={{asset('asset/vendors/js/vendor.bundle.base.js')}}></script>
    <script src="https://cdn.datatables.net/2.2.1/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.2.1/js/dataTables.bootstrap5.js"></script>
    <script src={{asset('asset/vendors/chart.js/Chart.min.js')}}></script>
    <script src={{asset('asset/js/off-canvas.js')}}></script>
    <script src={{asset('asset/js/hoverable-collapse.js')}}></script>
    {{-- <script src={{asset('asset/js/settings.js')}}></script> --}}
    <script src={{asset('asset/js/template.js')}}></script>
    <script src={{asset('asset/js/dashboard.js')}}></script>
    <script src={{asset('asset/js/Chart.roundedBarCharts.js')}}></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/js/all.min.js"
        integrity="sha512-b+nQTCdtTBIRIbraqNEwsjB6UvL3UEMkXnhzd8awtCYh0Kcsjl9uEgwVFVbhoj3uu1DO1ZMacNvLoyJJiNfcvg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @yield('script')
</body>

</html>
