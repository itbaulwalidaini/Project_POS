<!DOCTYPE html>
<html lang="zxx">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport" />

    <!-- Links Of CSS File -->
    <link href="{{ asset('assets/css/sidebar-menu.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/simplebar.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/prism.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/quill.snow.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/remixicon.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/swiper-bundle.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/jsvectormap.min.css') }}" rel="stylesheet" />

    <link href="{{ asset('assets/libs/choices/choices.min.css') }}" rel="stylesheet" />
    <!-- Sweet Alert-->
    <link href="{{ asset('assets/libs/sweetalert2/sweetalert2.css') }}" rel="stylesheet" type="text/css">

    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" />
    <!-- Favicon -->
    <link href="{{ asset('assets/images/favicon.png') }}" rel="icon" type="image/png" />

    <link href="{{ asset('assets/css/my-custom.css') }}" rel="stylesheet" />
    <!-- Title -->
    <title>@yield('tabs')</title>
    @livewireStyles
</head>

<body class="bg-body-bg">
    <!-- Start Preloader Area -->
    <div class="preloader" id="preloader">
        <div class="preloader">
            <div class="waviy position-relative">
                <span class="d-inline-block">
                    S
                </span>
                <span class="d-inline-block">
                    T
                </span>
                <span class="d-inline-block">
                    K
                </span>
                <span class="d-inline-block">
                    H
                </span>
            </div>
        </div>
    </div>
    <!-- End Preloader Area -->

    <!-- Start Sidebar Area -->
    @include('layout.sidebar')
    <!-- End Sidebar Area -->

    <!-- Start Main Content Area -->
    <div class="container-fluid">
        <div class="main-content d-flex flex-column">

            <!-- Start Header Area -->
            @include('layout.header')
            <!-- End Header Area -->

            <div class="main-content-container overflow-hidden">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4 mt-1">
                    <h3 class="mb-0">@yield('menu-opened')</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb align-items-center mb-0 lh-1">
                            <li class="breadcrumb-item">
                                <a class="d-flex align-items-center text-decoration-none" href="#">
                                    <span class="text-body fs-14 hover">
                                        Dashboard
                                    </span>
                                </a>
                            </li>
                            <li aria-current="page" class="breadcrumb-item active"><span>@yield('menu')</span></li>
                            <li aria-current="page" class="breadcrumb-item active"><span class="text-secondary">@yield('submenu')</span></li>
                        </ol>
                    </nav>
                </div>

                @yield('content')

            </div>
            <div class="flex-grow-1"></div>

            <!-- Start Footer Area -->
            @include('layout.footer')
            <!-- End Footer Area -->

        </div>
    </div>
    <div id="toast-container" style="position: fixed; top: 20px; left: 50%;  transform: translateX(-50%); z-index: 9999; width: 780px;"></div>
    <!-- Start Main Content Area -->
    <!-- Start Theme Setting Area -->
    <button aria-controls="offcanvasScrolling" class="btn btn-primary theme-settings-btn p-0 position-fixed z-2 text-center rounded-circle" data-bs-target="#offcanvasScrolling" data-bs-toggle="offcanvas" style="bottom: 24px; right: 24px; width: 56px; height: 56px; line-height: 54px;" type="button">
        <i class="text-white ri-settings-3-fill fs-28" data-bs-placement="left" data-bs-title="Click On Theme Settings" data-bs-toggle="tooltip">
        </i>
    </button>


    <!-- Start Theme Setting Area -->
    @include('layout.theme')
    <!-- End Theme Setting Area -->

    <!-- Link Of JS File -->
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/sidebar-menu.js') }}"></script>
    <script src="{{ asset('assets/js/quill.min.js') }}"></script>
    <script src="{{ asset('assets/js/prism.js') }}"></script>
    <script src="{{ asset('assets/js/clipboard.min.js') }}"></script>
    <script src="{{ asset('assets/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/js/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/js/echarts.min.js') }}"></script>
    <script src="{{ asset('assets/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/fullcalendar.main.js') }}"></script>
    <script src="{{ asset('assets/js/jsvectormap.min.js') }}"></script>
    <script src="{{ asset('assets/js/world-merc.js') }}"></script>
    <script src="{{ asset('assets/js/custom/apexcharts.js') }}"></script>
    <script src="{{ asset('assets/js/custom/echarts.js') }}"></script>
    <script src="{{ asset('assets/js/custom/maps.js') }}"></script>

    <script src="{{ asset('assets/libs/choices/choices.min.js') }}"></script>
    <!-- Sweet Alerts js -->
    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.js') }}"></script>

    <script src="{{ asset('assets/js/custom/custom.js') }}"></script>

    <script>
        let timeoutToastAktif = null;

        document.addEventListener('livewire:init', () => {
            Livewire.on('showToastValidasi', ({
                type,
                message
            }) => {
                tampilkanToast(type, message);
            });
        });

        function tampilkanToast(type, message) {
            const warnaMap = {
                success: 'alert-success text-success',
                error: 'alert-danger text-danger',
                warning: 'alert-warning text-warning',
            };

            const kelasWarna = warnaMap[type] ?? warnaMap.error;
            const container = document.getElementById('toast-container');

            if (timeoutToastAktif) {
                clearTimeout(timeoutToastAktif.fadeTimer);
                clearTimeout(timeoutToastAktif.removeTimer);
            }

            container.innerHTML = `
            <div class="alert ${kelasWarna} fs-18 shadow-sm" role="alert" style="transition: opacity 0.3s ease; opacity: 1;">
                ${message}
            </div>`;

            const elemen = container.firstElementChild;

            const fadeTimer = setTimeout(() => {
                elemen.style.opacity = '0';
            }, 2000);

            const removeTimer = setTimeout(() => {
                container.innerHTML = '';
            }, 3000);

            timeoutToastAktif = {
                fadeTimer,
                removeTimer
            };
        }
    </script>

    @yield('script')
    @livewireScripts
</body>

</html>