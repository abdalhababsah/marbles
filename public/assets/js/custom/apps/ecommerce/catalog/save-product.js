"use strict";

// Class definition
var KTAppEcommerceSaveProduct = function () {

    // Private functions

    // Init quill editor
    const initQuill = () => {
        // Define all elements for quill editor
        const elements = [
            '#kt_ecommerce_add_product_description_ar',
            '#kt_ecommerce_add_product_description_en',
            '#kt_ecommerce_add_product_meta_description'
        ];

        // Loop all elements
        elements.forEach(element => {
            // Get quill element
            let quill = document.querySelector(element);

            // Break if element not found6666
            if (!quill) {
                return;
            }

            // Init quill --- more info: https://quilljs.com/docs/quickstart/
            quill = new Quill(element, {
                modules: {
                    toolbar: [
                        [{
                            header: [1, 2, false]
                        }],
                        ['bold', 'italic', 'underline'],
                        ['image', 'code-block']
                    ]
                },
                placeholder: 'Type your text here...',
                theme: 'snow' // or 'bubble'
            });
        });
    }

    // Init tagify
    const initTagify = () => {
        // Define all elements for tagify
        const elements = [
            '#kt_ecommerce_add_product_category',
            '#kt_ecommerce_add_product_tags'
        ];

        // Loop all elements
        elements.forEach(element => {
            // Get tagify element
            const tagify = document.querySelector(element);

            // Break if element not found
            if (!tagify) {
                return;
            }

            // Init tagify --- more info: https://yaireo.github.io/tagify/
            new Tagify(tagify, {
                whitelist: ["new", "trending", "sale", "discounted", "selling fast", "last 10"],
                dropdown: {
                    maxItems: 20,           // <- mixumum allowed rendered suggestions
                    classname: "tagify__inline__suggestions", // <- custom classname for this dropdown, so it could be targeted
                    enabled: 0,             // <- show suggestions on focus
                    closeOnSelect: false    // <- do not hide the suggestions dropdown once an item has been selected
                }
            });
        });
    }

    // Init form repeater --- more info: https://github.com/DubFriend/jquery.repeater

    // Init condition select2
    const initConditionsSelect2 = () => {
        // Tnit new repeating condition types
        const allConditionTypes = document.querySelectorAll('[data-kt-ecommerce-catalog-add-product="product_option"]');
        allConditionTypes.forEach(type => {
            if ($(type).hasClass("select2-hidden-accessible")) {
                return;
            } else {
                $(type).select2({
                    minimumResultsForSearch: -1
                });
            }
        });
    }


    // Init noUIslider


    // Init DropzoneJS --- more info:




    // Category status handler
    const handleStatus = () => {
        const target = document.getElementById('kt_ecommerce_add_product_status');
        const select = document.getElementById('kt_ecommerce_add_product_status_select');
        const statusClasses = ['bg-success', 'bg-warning', 'bg-danger'];

        $(select).on('change', function (e) {
            const value = e.target.value;

            switch (value) {
                case "active": {
                    target.classList.remove(...statusClasses);
                    target.classList.add('bg-success');
                    hideDatepicker();
                    break;
                }

                case "inactive": {
                    target.classList.remove(...statusClasses);
                    target.classList.add('bg-danger');
                    hideDatepicker();
                    break;
                }

                default:
                    break;
            }
        });


        // Handle datepicker
        const datepicker = document.getElementById('kt_ecommerce_add_product_status_datepicker');

        // Init flatpickr --- more info: https://flatpickr.js.org/
        $('#kt_ecommerce_add_product_status_datepicker').flatpickr({
            enableTime: true,
            dateFormat: "Y-m-d H:i",
        });

        const showDatepicker = () => {
            datepicker.parentNode.classList.remove('d-none');
        }

        const hideDatepicker = () => {
            datepicker.parentNode.classList.add('d-none');
        }
    }

    // Condition type handler
    const handleConditions = () => {
        const allConditions = document.querySelectorAll('[name="method"][type="radio"]');
        const conditionMatch = document.querySelector('[data-kt-ecommerce-catalog-add-category="auto-options"]');
        allConditions.forEach(radio => {
            radio.addEventListener('change', e => {
                if (e.target.value === '1') {
                    conditionMatch.classList.remove('d-none');
                } else {
                    conditionMatch.classList.add('d-none');
                }
            });
        })
    }


    // Submit form handler
    const handleSubmit = () => {
        // Define variables
        let validator;

        // Get elements
        const form = document.getElementById('kt_ecommerce_add_product_form');
        const submitButton = document.getElementById('kt_ecommerce_add_product_submit');

        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        validator = FormValidation.formValidation(
            form,
            {
                fields: {
                    'product_name': {
                        validators: {
                            notEmpty: {
                                message: 'Product name is required'
                            }
                        }
                    },
                    'sku': {
                        validators: {
                            notEmpty: {
                                message: 'SKU is required'
                            }
                        }
                    },
                    'barcode': {
                        validators: {
                            notEmpty: {
                                message: 'Product barcode is required'
                            }
                        }
                    },
                    'quantity_sqm': {
                        validators: {
                            notEmpty: {
                                message: 'Quantity is required'
                            }
                        }
                    },
                    'price': {
                        validators: {
                            notEmpty: {
                                message: 'Product base price is required'
                            }
                        }
                    },
                    'tax': {
                        validators: {
                            notEmpty: {
                                message: 'Product tax class is required'
                            }
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: '.fv-row',
                        eleInvalidClass: '',
                        eleValidClass: ''
                    })
                }
            }
        );

        // Handle submit button
        submitButton.addEventListener('click', e => {
            e.preventDefault();

            // Init FormData with the form
            var formData = new FormData(form);

            // Append product variants dynamically
            $('div[data-repeater-item]').each(function() {
                formData.append('variants[]', $(this).find('input[name="product_option"]').val());
                formData.append('variant_values_en[]', $(this).find('input[name="product_option_value_en"]').val());
                formData.append('variant_values_ar[]', $(this).find('input[name="product_option_value_ar"]').val());
            });

            // Validate form before submit
            // Assuming you have a validation function or plugin initialized
            if (true) { // Replace this with your actual validation check
                submitButton.setAttribute('data-kt-indicator', 'on');
                submitButton.disabled = true;

                // Perform AJAX submission
                $.ajax({
                    url: '{{ route("catalog.products.store") }}', // Adjust URL as needed
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').val() // CSRF Token from form
                    },
                    success: function(response) {
                        Swal.fire({
                            text: "Product has been successfully submitted!",
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        });

                        // Handle after success (e.g., redirecting or resetting the form)
                        submitButton.removeAttribute('data-kt-indicator');
                        submitButton.disabled = false;
                    },
                    error: function(xhr, status, error) {
                        // Handle error
                        Swal.fire({
                            text: "Error occurred: " + error,
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Try again",
                            customClass: {
                                confirmButton: "btn btn-danger"
                            }
                        });

                        submitButton.removeAttribute('data-kt-indicator');
                        submitButton.disabled = false;
                    }
                });
            } else {
                // Handle validation failure
                Swal.fire({
                    text: "Please correct the errors in the form before submitting.",
                    icon: "error",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn btn-primary"
                    }
                });
            }
        });
    }

    // Public methods
    return {
        init: function () {
            // Init forms
            initQuill();
            initTagify();



            initConditionsSelect2();

            // Handle forms
            handleStatus();
            handleConditions();


            handleSubmit();
        }
    };
}();

// On document ready
$(document).ready(function() {
    KTAppEcommerceSaveProduct.init();
});
