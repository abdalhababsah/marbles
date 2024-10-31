@extends('layout.master')

@section('content')

    <!--begin::App-->
    <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
        <!--begin::Wrapper-->
        <div class="d-flex flex-column flex-lg-row flex-column-fluid">
            <!--begin::Body-->
            <div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 order-2 order-lg-1">
                <!--begin::Form-->
                <div class="d-flex flex-center flex-column flex-lg-row-fluid">
                    <!--begin::Wrapper-->
                    <div class="w-lg-500px p-10">
                        <!--begin::Page-->
                        {{ $slot }}
                        <!--end::Page-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Form-->

                <!--begin::Footer-->
                <div class="d-flex flex-center flex-wrap px-5">
                    <!--begin::Links-->
                    <div class="text-gray-900 order-2 order-md-1">
                        <span class="text-muted fw-semibold me-1">{{now()->year}}©</span>
                        <a href="#" target="_blank" class="text-gray-800 text-hover-primary">MARBLEX</a>
                    </div>
                    <!--end::Links-->
                </div>
                <!--end::Footer-->
            </div>
            <!--end::Body-->

            <!--begin::Aside-->
            <div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center order-1 order-lg-2"
                 style="background-image: url({{ asset('assets/media/auth/blackmarble.png') }})">
                <!--begin::Content-->
                <div class="d-flex flex-column flex-center py-7 py-lg-15 px-5 px-md-15 w-100">
                    <!--begin::Logo-->

                    <!--end::Logo-->

                    <!--begin::Image-->
{{--                    <img class="d-none d-lg-block mx-auto w-65px w-md-50 w-xl-90px mb-10 mb-lg-20"--}}
{{--                          src="{{ image('logos/stone-64.png') }}" alt=""/>--}}
                    <!--end::Image-->

                    <!--begin::Title-->
                    <h1 class="d-none d-lg-block text-white fs-2qx fw-bolder text-center mb-7">
                        MARBlEX
                    </h1>
                    <!--end::Title-->

                </div>
                <!--end::Content-->
            </div>
            <!--end::Aside-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::App-->

@endsection
