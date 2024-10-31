<script>
    $(document).ready(function () {
        // Initialize select2 for the first load
        initSelect2();

        // Initialize the repeater
        initRepeater();

        // Function to initialize select2
        function initSelect2() {
            $('.variant').select2();
            $('.variant').on('change', function() {
                updateVariantNames();
            });
        }

        // Function to handle adding new variant
        function initRepeater() {
            $("[data-repeater-create]").click(function () {
                var repeaterList = $("[data-repeater-list]");
                var newItem = repeaterList.find("[data-repeater-item]:first").clone();

                newItem.find("input").val(""); // Reset input values
                newItem.find("select").prop("selectedIndex", 0); // Reset select values

                // Remove the duplicated select2 container if any and re-initialize select2
                newItem.find('.select2-container').remove();
                repeaterList.append(newItem);
                initSelect2(); // Reinitialize select2 for new dropdowns

                updateVariantNames();
                checkVariantDeletability();
            });

            // Handle deletion of a variant
            $(document).on("click", "[data-repeater-delete]", function () {
                if ($('[data-repeater-item]').length > 1) {
                    $(this).closest("[data-repeater-item]").remove();
                    updateVariantNames();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'At least one variant is required!',
                    });
                }
                checkVariantDeletability();
            });
        }
        function checkVariantDeletability() {
            if ($('[data-repeater-item]').length <= 1) {
                $('[data-repeater-delete]').prop('disabled', true).addClass('disabled');
            } else {
                $('[data-repeater-delete]').prop('disabled', false).removeClass('disabled');
            }
        }
        checkVariantDeletability();
        // Update variant input names based on their order in the list
        function updateVariantNames() {
            $('[data-repeater-list]').find('[data-repeater-item]').each(function(index, item) {
                $(item).find('[name]').each(function() {
                    var name = $(this).attr('name').replace(/variants\[\d+\]/, 'variants[' + index + ']');
                    $(this).attr('name', name);
                });
            });
        }
    });




    $(document).ready(function () {
        var myDropzone = new Dropzone("#kt_ecommerce_add_product_media", {
            url: "#", // Replace "#" with your actual submission script
            autoProcessQueue: false,
            uploadMultiple: true,
            paramName: "images",
            maxFiles: 10,
            maxFilesize: 10,
            addRemoveLinks: true,
        });

        $('#add_product_form').on('submit', function (e) {
            e.preventDefault(); // Prevent form from submitting immediately

            // Validate form inputs
            var isValid = true;
            var messages = [];

            // Additional validation for Dropzone (images)
            if (myDropzone.files.length === 0) {
                isValid = false;
                messages.push("At least one image is required.");
            }
            // Check product name in English and Arabic
            if ($('#name_en').val().trim() === '') {
                isValid = false;
                $('#name_en').addClass('is-invalid');
                messages.push('Product Name (English) is required.');
            } else {
                $('#name_en').removeClass('is-invalid');
            }
            if ($('#name_ar').val().trim() === '') {
                isValid = false;
                $('#name_ar').addClass('is-invalid');

                messages.push('اسم المنتج (Arabic) is required.');
            } else {
                $('#name_ar').removeClass('is-invalid');
            }

            // Check descriptions
            if ($('#kt_ecommerce_add_product_description_en').val().trim() === '') {
                isValid = false;
                $('#kt_ecommerce_add_product_description_en').addClass('is-invalid');
                messages.push('Description (English) is required.');
            } else {
                $('#kt_ecommerce_add_product_description_en').removeClass('is-invalid');
            }

            if ($('#kt_ecommerce_add_product_description_ar').val().trim() === '') {
                isValid = false;
                $('#kt_ecommerce_add_product_description_ar').addClass('is-invalid');
                messages.push('الوصف (Arabic) is required.');
            } else {
                $('#kt_ecommerce_add_product_description_ar').removeClass('is-invalid');
            }

            if ($('select[name="category_type"]').val() === '') {
                isValid = false;
                $('#kt_ecommerce_add_product_category_type_select').addClass('is-invalid');
                messages.push("Category type is required.");
            }else {
                $('#kt_ecommerce_add_product_category_type_select').removeClass('is-invalid');
            }
            // Check category selection
            if (!$('select[name="category_id"]').val()) {
                isValid = false;
                messages.push('Category is required.');
            }



            var variationsValid = true;
            $('select[name^="variants"]').each(function() {
                if (!$(this).val()) {
                    variationsValid = false;
                    $('#en_variation').addClass('is-invalid')
                    $('#ar_variation').addClass('is-invalid')

                }else {
                    $('#ar_variation').addClass('is-valid')
                    $('#en_variation').addClass('is-valid')
                }

            });
            if (!variationsValid) {
                isValid = false;
                messages.push("At least one variation is required.");
            }
            // Check status selection
            if (!$('select[name="status"]').val()) {
                isValid = false;
                messages.push('Status is required.');
            }

            // Dimensions validation
            ['width', 'height', 'length'].forEach(function (dimension) {
                var dimensionValue = parseFloat($('input[name="dimensions['+dimension+']"]').val());
                if ($('input[name="dimensions['+dimension+']"]').val().trim() === '' || isNaN(dimensionValue) || dimensionValue <= 0) {
                    isValid = false;
                    $('input[name="dimensions['+dimension+']"]').addClass('is-invalid'); // Add is-invalid class
                    messages.push(`Product ${dimension} is required and must be a positive number.`);
                } else {
                    $('input[name="dimensions['+dimension+']"]').removeClass('is-invalid'); // Remove is-invalid class if previously added
                }
            });


            // Check quantity - it must be numeric and a positive number
            var quantityAvailable = parseFloat($('#quantity_available').val());
            if ($('#quantity_available').val().trim() === '' || isNaN(quantityAvailable) || quantityAvailable <= 0) {
                isValid = false;
                $('#quantity_available').addClass('is-invalid'); // Add is-invalid class
                messages.push('Quantity (in square meters) is required, and must be a positive number.');
            } else {
                $('#quantity_available').removeClass('is-invalid'); // Remove is-invalid class if previously added
            }


            // Display validation errors or proceed to submit
            if (!isValid) {
                // Update messages with line numbers
                messages = messages.map((message, index) => (index + 1) + '. ' + message);

                Swal.fire({
                    icon: 'error',
                    title: 'Validation Error',
                    html: messages.join('<br>'),
                    customClass: {
                        htmlContainer: 'text-left'
                    },
                    didOpen: () => {
                        // This ensures the custom class styles are applied
                        const container = Swal.getHtmlContainer();
                        if (container) {
                            container.style.textAlign = 'left';
                        }
                    }
                });

            } else {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Do you want to proceed with these details?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, submit it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Form is valid, proceed to submit
                        var formData = new FormData(this);
                        myDropzone.files.forEach(function(file, index) {
                            formData.append('images[' + index + ']', file);
                        });

                        $.ajax({
                            url: '{{ route("catalog.products.store") }}',
                            type: 'POST',
                            data: formData,
                            contentType: false,
                            processData: false,
                            headers: {
                                'X-CSRF-TOKEN': $('input[name="_token"]').val()
                            },
                            success: function(response) {
                                Swal.fire({
                                    title: 'Submitted!',
                                    text: 'Product created successfully.',
                                    icon: 'success'
                                }).then((result) => {
                                    if (result.value) {
                                        window.location.href = '{{ route("catalog.products.index") }}'; // Specify the path to redirect
                                    }
                                });
                            },
                            error: function(xhr, status, error) {
                                // Check if there are validation errors
                                if (xhr.status === 422 || xhr.status === 500) {                                        var errors = xhr.responseJSON.errors;
                                    var errorMessages = Object.keys(errors).map(function(key) {
                                        return errors[key].join('<br>');
                                    }).join('<br>');

                                    Swal.fire('Validation Error', errorMessages, 'error');
                                } else {
                                    // Handle other errors
                                    Swal.fire('Error!', 'An error occurred. Please try again.', 'error');
                                }
                            }
                        });
                    }
                });
            }
        });
    });

</script>