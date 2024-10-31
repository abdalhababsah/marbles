<x-default-layout>

    @section('title')
        Dashboard
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('dashboard') }}
    @endsection

    <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
        <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-10">
            <!--begin::Widget 3-->
            <div class="card bg-dark hoverable card-xl-stretch mb-5 mb-xl-8">
                <div class="card-body">
                    <i class="ki-duotone ki-chart-pie-simple text-white fs-2x ms-n1"><span class="path1"></span><span class="path2"></span></i>

                    <div class="text-white fw-bold fs-2 mb-2 mt-5">
                        {{ $productCount }}
                    </div>

                    <div class="fw-semibold text-white">
                        Total Products
                    </div>
                </div>
            </div>
            <!--end::Widget 3-->
        </div>

        <!--begin::Col for Widget 2-->
        <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-10">
            <!--begin::Widget 2-->
            <div class="card bg-warning hoverable card-xl-stretch mb-xl-8">
                <div class="card-body">
                    <i class="ki-duotone ki-briefcase text-white fs-2x ms-n1"><span class="path1"></span><span class="path2"></span></i>

                    <div class="text-white fw-bold fs-2 mb-2 mt-5">
                        {{ $nonActiveProductCount }}
                    </div>

                    <div class="fw-semibold text-white">
                       Active Products
                    </div>
                </div>
            </div>
            <!--end::Widget 2-->
        </div>
        <!--end::Col for Widget 2-->

        <!--begin::Col for Widget 3-->
        <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-10">
            <!--begin::Widget 3-->
            <div class="card bg-info hoverable card-xl-stretch mb-5 mb-xl-8">
                <div class="card-body">
                    <i class="ki-duotone ki-chart-pie-simple text-white fs-2x ms-n1"><span class="path1"></span><span class="path2"></span></i>

                    <div class="text-white fw-bold fs-2 mb-2 mt-5">
                        {{ $contactUsCount }}
                    </div>

                    <div class="fw-semibold text-white">
                        Contact Messages
                    </div>
                </div>
            </div>
            <!--end::Widget 3-->
        </div>
        <!--end::Col for Widget 3-->

        <!--begin::Col for Widget 4-->
        <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-10">
            <!--begin::Widget 4-->
            <div class="card bg-body hoverable card-xl-stretch mb-xl-8">
                <div class="card-body">
                    <i class="ki-duotone ki-chart-simple text-primary fs-2x ms-n1"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>

                    <div class="text-gray-900 fw-bold fs-2 mb-2 mt-5">
                        {{ $nonReadMessagesCount }}
                    </div>

                    <div class="fw-semibold text-gray-400">
                        Unread Messages
                    </div>
                </div>
            </div>
            <!--end::Widget 4-->
        </div>
        <!--end::Col for Widget 4-->


    </div>
    <!--end::Row-->



</x-default-layout>
