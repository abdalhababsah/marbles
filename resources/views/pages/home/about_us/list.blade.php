<x-default-layout>
    @section('title')
        About Us
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('about-us.index') }}
    @endsection

    <div class="card">
        <div class="card-header border-0 pt-6">
            <div class="card-title">
{{--                <div class="d-flex align-items-center position-relative my-1">--}}
{{--                    {!! getIcon('magnifier', 'fs-3 position-absolute ms-5') !!}--}}
{{--                    <input type="text" data-kt-user-table-filter="search"--}}
{{--                           class="form-control form-control-solid w-250px ps-13" placeholder="Search About Us"--}}
{{--                           id="mySearchInput"/>--}}
{{--                </div>--}}
            </div>

            <div class="card-toolbar">
                <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">

                </div>
            </div>
        </div>

        <div class="card-body py-4">
            <div class="table-responsive">
                {{ $dataTable->table(['class' => 'table align-middle table-row-dashed fs-6 gy-5']) }}
            </div>
        </div>
    </div>

        <div class="modal fade" id="contactUsModal" tabindex="-1" role="dialog" aria-labelledby="contactUsModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="contactUsModalLabel">Contact Message Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="contactUsDetails">
                            <!-- Contact message details will be loaded here via AJAX -->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

    @push('scripts')
        {{ $dataTable->scripts() }}

        <script>

            addModal('add_about_us', '{{ route('home.about-us.create') }}', 'Add About Us', 'aboutUsForm', 'aboutus-table');
            editModal('edit_btn', 'home/about-us', 'Edit About Us', 'aboutUsForm', 'aboutus-table');
            remove('remove_btn', 'home/about-us', 'aboutus-table', '{{ csrf_token() }}');

            document.getElementById('mySearchInput').addEventListener('keyup', function () {
                window.LaravelDataTables['aboutus-table'].search(this.value).draw();
            });
        </script>
    @endpush
</x-default-layout>
