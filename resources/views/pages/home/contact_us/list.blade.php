<x-default-layout>
    @section('title', 'Contact Us')

    @section('breadcrumbs')
        {{ Breadcrumbs::render('contact-us.index') }}
    @endsection

    <div class="card">
        <div class="card-header border-0 pt-6">
            <div class="card-title">
                <div class="d-flex align-items-center position-relative my-1">
                    {!! getIcon('magnifier', 'fs-3 position-absolute ms-5') !!}
                    <input type="text" data-kt-user-table-filter="search"
                           class="form-control form-control-solid w-250px ps-13" placeholder="Search Contact Us"
                           id="mySearchInput"/>
                </div>
            </div>

            <div class="card-toolbar">
                <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">

                </div>
            </div>
        </div>

        <div class="card-body py-4">
            <div class="table-responsive">
                {!! $dataTable->table(['id' => 'contactus-table', 'class' => 'table align-middle table-row-dashed fs-6 gy-5']) !!}
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" id="kt_modal_1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Contact Us Details</h3>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                    <!--end::Close-->
                </div>

                <div class="modal-body" id="contactUsDetails">
                    <!-- Contact Us details will be displayed here -->
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary" data-bs-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>

    @push('scripts')
        {{ $dataTable->scripts() }}
        <script>
            document.getElementById('mySearchInput').addEventListener('keyup', function () {
                window.LaravelDataTables['contactus-table'].search(this.value).draw();
            });
            $(document).ready(function () {
                var dataTable;

                // Initialize DataTable
                if (!$.fn.DataTable.isDataTable('#contactus-table')) {
                    dataTable = $('#contactus-table').DataTable({
                        "drawCallback": function () {
                            if (dataTable) {
                                $('#contactus-table tbody').find('tr').each(function () {
                                    var rowData = dataTable.row(this).data();
                                    if (rowData && rowData.seen === 1) {
                                        $(this).addClass('bg-white');
                                    } else {
                                        $(this).addClass('bg-primary');
                                    }
                                });
                            }
                        }
                    });


                }


                $(document).on('click', '.view_btn', function (e) {
                    e.preventDefault();
                    var contactId = $(this).data('contact-id');

                    $.ajax({
                        url: '/home/contact-us/' + contactId,
                        type: 'GET',
                        success: function (response) {
                            var contactUs = response.contactUs;
                            var contactUsDetails = '<p class="h4">Name: ' + contactUs.name + '</p>' +
                                '<p class="h4">Email: ' + contactUs.email + '</p>' +
                                '<p class="h4">Number: ' + contactUs.number + '</p>' +
                                '<p class="h4">Description: ' + contactUs.description + '</p>';

                            $('#contactUsDetails').html(contactUsDetails);
                            $('#kt_modal_1').modal('show');
                        },
                        error: function (xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                });

            });
            remove('remove_btn', 'home/contact-us', 'contactus-table', '{{ csrf_token() }}');

        </script>
    @endpush
</x-default-layout>
