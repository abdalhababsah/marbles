<x-default-layout>

    @section('title')
        Products
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('products.index') }}
    @endsection
        <style>
            .product-image-hover {
                transition: transform .2s;
            }

            .product-image-hover:hover {
                transform: scale(1.5);
            }

        </style>
    <div class="card">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">
                <!--begin::Search-->
                <div class="d-flex align-items-center position-relative my-1">
                    {!! getIcon('magnifier', 'fs-3 position-absolute ms-5') !!}
                    <input type="text" data-kt-product-table-filter="search"
                           class="form-control form-control-solid w-250px ps-13" placeholder="Search product"
                           id="mySearchInput"/>
                </div>
                <!--end::Search-->
            </div>

            <div class="card-toolbar">
                <!--begin::Toolbar-->
                <div class="d-flex justify-content-end" data-kt-product-table-toolbar="base">
                    <!--begin::Add product-->
                   <a href="{{route('catalog.products.create')}}">
                    <button type="button" class="btn btn-primary" >
                        {!! getIcon('plus', 'fs-2', '', 'i') !!}
                        Add product
                    </button></a>
                    <!--end::Add product-->
                </div>

            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->

        <!--begin::Card body-->
        <div class="card-body py-4">
            <!--begin::Table-->
            <div class="table-responsive">
                {{ $dataTable->table() }}
            </div>
            <!--end::Table-->
        </div>
        <!--end::Card body-->
    </div>

    @push('scripts')
        {{ $dataTable->scripts() }}
        <script>
            document.getElementById('mySearchInput').addEventListener('keyup', function () {
                window.LaravelDataTables['product-table'].search(this.value).draw();
            });
            remove('remove_btn', 'catalog/products', 'product-table', '{{ csrf_token() }}');


        </script>
    @endpush

</x-default-layout>
