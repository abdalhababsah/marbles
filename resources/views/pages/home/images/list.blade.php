<x-default-layout>
    @section('title')
        Home Images
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('home-images.index') }}
    @endsection

    <div class="card">
        <div class="card-header border-0 pt-6">
            <div class="card-title">
                <div class="d-flex align-items-center position-relative my-1">
                    {!! getIcon('magnifier', 'fs-3 position-absolute ms-5') !!}
                    <input type="text" data-kt-user-table-filter="search"
                           class="form-control form-control-solid w-250px ps-13" placeholder="Search Home Image"
                           id="mySearchInput"/>
                </div>
            </div>

            <div class="card-toolbar">
                <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                    <a id="add_home_image" class="btn btn-light-primary">
                        {!! getIcon('plus', 'fs-2', '', 'i') !!}
                        Add Home Image
                    </a>
                </div>
            </div>
        </div>

        <div class="card-body py-4">
            <div class="table-responsive">
                {{ $dataTable->table(['class' => 'table align-middle table-row-dashed fs-6 gy-5']) }}
            </div>
        </div>
    </div>

    @push('scripts')
        {{ $dataTable->scripts() }}

        <script>
            addModal('add_home_image', '{{ route('home.home-images.create') }}', 'Add Home Image', 'homeImageForm', 'homeimages-table');
            editModal('edit_btn', 'home/home-images', 'Edit Home Image', 'homeImageForm', 'homeimages-table');
            remove('remove_btn', 'home/home-images', 'homeimages-table', '{{ csrf_token() }}');

            document.getElementById('mySearchInput').addEventListener('keyup', function () {
                window.LaravelDataTables['homeimages-table'].search(this.value).draw();
            });
        </script>
    @endpush
</x-default-layout>
