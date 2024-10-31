<x-default-layout>

    @section('title')
        Variant Types
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('variant_types.index') }}
    @endsection

    <div class="card">
        <div class="card-header border-0 pt-6">
            <div class="card-title">
                <div class="d-flex align-items-center position-relative my-1">
                    {!! getIcon('magnifier', 'fs-3 position-absolute ms-5') !!}
                    <input type="text" data-kt-user-table-filter="search"
                           class="form-control form-control-solid w-250px ps-13" placeholder="Search Variant Type"
                           id="mySearchInput"/>
                </div>
            </div>

            <div class="card-toolbar">
                <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                    <a class="btn btn-light-primary" id="add_variant_type">
                        {!! getIcon('plus', 'fs-2', '', 'i') !!}
                        Add Variant Type
                    </a>
                </div>
            </div>
        </div>

        <div class="card-body py-4">
            <div class="table-responsive">
                {{ $dataTable->table() }}
            </div>
        </div>
    </div>

    @push('scripts')
        {{
            $dataTable->scripts()
        }}

        <script>

            addModal('add_variant_type', '{{ route('catalog.variant-types.create') }}', 'Add Variant Type', 'variantTypeForm', 'variant-types-table');
            editModal('edit_btn', 'catalog/variant-types', 'Edit Variant Type', 'variantTypeForm', 'variant-types-table');
            remove('remove_btn', 'catalog/variant-types', 'variant-types-table', '{{ csrf_token() }}');

            document.getElementById('mySearchInput').addEventListener('keyup', function () {
                window.LaravelDataTables['variant-types-table'].search(this.value).draw();
            });

        </script>
    @endpush

</x-default-layout>
