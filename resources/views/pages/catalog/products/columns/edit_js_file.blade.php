
<script >

    const initQuill = () => {
        const elements = [
            { selector: '#kt_ecommerce_add_product_description_ar', id: 'kt_ecommerce_add_product_description_ar' },
            { selector: '#kt_ecommerce_add_product_description_en', id: 'kt_ecommerce_add_product_description_en' },
            '#kt_ecommerce_add_product_meta_description'
        ];

        elements.forEach(element => {
            let textarea;
            let id;

            if (typeof element === 'object') {
                textarea = document.querySelector(element.selector);
                id = element.id;
            } else {
                textarea = document.querySelector(element);
                id = element.substring(1);
            }

            if (!textarea) {
                return;
            }

            let initialContent = textarea.value;

            let div = document.createElement('div');
            div.innerHTML = initialContent;

            div.id = id; // Set the id of the div

            textarea.parentNode.replaceChild(div, textarea);

            let quill = new Quill(div, {
                modules: {
                    toolbar: [
                        [{ header: [1, 2, false] }],
                        ['bold', 'italic', 'underline'],
                        ['image', 'code-block']
                    ]
                },
                placeholder: 'Type your text here...',
                theme: 'snow'
            });
        });
    };

    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#kt_ecommerce_add_product_status_select').on('change', function () {
            var status = $(this).val();
            var productId = '{{ $product->id }}';

            $.ajax({
                type: 'POST',
                url: "{{ route('catalog.catalog.products.update-status') }}",
                data: {
                    product_id: productId,
                    status: status
                },
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.message
                    });
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Failed to update status'
                    });
                }
            });
        });
        var myDropzone = new Dropzone("#kt_ecommerce_add_product_media", {
            url: "{{ route('catalog.product.updateImage') }}", // Use the route for updating images
            autoProcessQueue: false,
            uploadMultiple: true,
            paramName: "images",
            maxFiles: 10,
            maxFilesize: 10,
            addRemoveLinks: true,
        });

        function displayProductImages() {
            var product = '{{ $product->id }}';
            $.ajax({
                type: 'GET',
                url: `/catalog/products/${product}/get-images`,

                success: function(response) {
                    if (response.status === 200) {
                        var images = response.images;
                        images.forEach(function(imagePath) {
                            var mockFile = { name: imagePath, size: 12345 };
                            myDropzone.emit("addedfile", mockFile);
                            myDropzone.emit("thumbnail", mockFile, imagePath);
                            myDropzone.emit("complete", mockFile);
                        });
                    } else {
                        console.error('Failed to fetch product images:', response.error);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching product images:', xhr.responseText);
                }
            });

        }

        displayProductImages();

        myDropzone.on("removedfile", function(file) {
            var fileName = file.name;
            var imagePath = 'storage/images/' + fileName.substring(fileName.lastIndexOf('/') + 1);

            $.ajax({
                type: 'POST',
                url: "{{ route('catalog.product.updateImage') }}",
                data: {
                    action: 'delete',
                    product_id: '{{ $product->id }}',
                    image_path: imagePath
                },
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.message
                    });
                    // displayProductImages();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Failed to add image'
                    });
                }
            });
        });

        myDropzone.on("addedfile", function(file) {
            var formData = new FormData();
            formData.append('action', 'add');
            formData.append('product_id', '{{ $product->id }}');
            formData.append('image', file);

            $.ajax({
                type: 'POST',
                url: "{{ route('catalog.product.updateImage') }}",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.message
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.reload();
                        }
                    });
                    // displayProductImages();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });

        $('select[name="category_id"]').change(function () {
            // Get the selected category ID
            const categoryId = $(this).val();

            // Get the product ID from data attribute
            const productId = $(this).data('product-id');

            // Send AJAX request to update product category
            $.ajax({
                url: "{{ route('catalog.products.updateCategory') }}",
                type: "POST",
                data: {
                    product_id: productId,
                    category_id: categoryId,
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.message
                    });
                },
                error: function (xhr, status, error) {
                    console.error('Failed to update product category:', error);
                }
            });
        });
        $('#updateInventoryBtn').click(function(event) {
            event.preventDefault();

            const productId = "{{ $product->id }}";
            const quantityAvailable = $('#quantity_available').val();

            const formData = {
                'product_id': productId,
                'quantity_available': quantityAvailable
            };

            $.ajax({
                url: '{{ route("catalog.products.updateInventory") }}',
                type: 'POST',
                data: formData,
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.message
                    });
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });


        $('#updateDimentionBtn').click(function (event) {
            event.preventDefault();

            const productId = "{{ $product->id }}";
            const width = $('#width').val();
            const height = $('#height').val();
            const length = $('#length').val();
            const dimensionUnit = "{{ $product->dimension->dimension_unit ?? 'cm' }}";

            $.ajax({
                url: "{{ route('catalog.products.updateDimensions') }}",
                type: "POST",
                data: {
                    product_id: productId,
                    dimensions: {
                        width: width,
                        height: height,
                        length: length,
                        dimension_unit: dimensionUnit
                    },
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.message
                    });
                },
                error: function (xhr, status, error) {
                    console.error('Failed to update product dimensions:', error);
                }
            });
        });



        $('#update-variations-btn').click(function(event) {
            event.preventDefault();

            const productId = "{{ $product->id }}";
            const variations = [];

            $('[data-repeater-item]').each(function(index, element) {
                const variantId = $(element).find('.variant').attr('data-varient-db-id'); // Correctly retrieve the variant ID from the data attribute
                const variantValueEn = $(element).find('[name^="variants[' + index + '][variant_value_en]"]').val();
                const variantValueAr = $(element).find('[name^="variants[' + index + '][variant_value_ar]"]').val();
                const isNewVariantAttribute = $(element).attr("data-new-variant");
                const isNewVariant = isNewVariantAttribute ? (isNewVariantAttribute === "true") : (variantId === "" || variantId === null);

                // Add variant type ID for new variants
                let variantTypeId;
                if (isNewVariant) {
                    // If the variant is new, get the variant type ID from the selected option
                    variantTypeId = $(element).find('.variant option:selected').val();
                } else {
                    // If the variant is existing, get the variant type ID from the hidden input
                    variantTypeId = $(element).find('[name^="variants[' + index + '][variant_type_id]"]').val();
                }

                variations.push({
                    id: variantId,
                    variant_type_id: variantTypeId, // Add variant type ID here
                    variant_value_en: variantValueEn,
                    variant_value_ar: variantValueAr,
                    is_new_variant: isNewVariant
                });
            });

            const formData = {
                product_id: productId,
                variations: variations
            };

            $.ajax({
                url: '{{ route("catalog.products.updateVariations") }}',
                type: 'POST',
                data: formData,
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.message
                    });
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Failed to update product variations'
                    });
                }
            });
        });
        $('#update-general-btn').click(function(event) {
            event.preventDefault();

            const productId = "{{ $product->id }}";

            const descriptionEnEditor = document.querySelector('#kt_ecommerce_add_product_description_en  .ql-editor');
            const descriptionEn = descriptionEnEditor ? descriptionEnEditor.innerHTML.trim() : ''; // Use innerHTML instead of innerText
            const descriptionArEditor = document.querySelector('#kt_ecommerce_add_product_description_ar  .ql-editor');
            const descriptionAr = descriptionArEditor ? descriptionArEditor.innerHTML.trim() : ''; // Use innerHTML instead of innerText
            console.log(descriptionAr);

            var formData = {
                'product_id': productId,
                'name_en': $('#name_en').val(),
                'name_ar': $('#name_ar').val(),
                'description_en': descriptionEn,
                'description_ar': descriptionAr
            };

            $.ajax({
                url: '{{ route("catalog.products.updateGeneral") }}',
                type: 'POST',
                data: formData,
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.message
                    });
                },
                error: function(xhr, status, error) {
                    // Handle error response
                    console.error(xhr.responseText);
                }
            });
        });



    });





    function initRepeater() {
        $("[data-repeater-create]").click(function () {
            var repeaterList = $("[data-repeater-list]");
            var newItem = repeaterList.find("[data-repeater-item]:first").clone();

            newItem.find("input").val("");
            newItem.find("select").prop("selectedIndex", 0);
            newItem.attr("data-new-variant", "true");
            newItem.find('.select2-container').remove();
            repeaterList.append(newItem);

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
    const handleStatus = () => {
        const target = document.getElementById('kt_ecommerce_add_product_status');
        const select = document.getElementById('kt_ecommerce_add_product_status_select');
        const statusClasses = ['bg-success', 'bg-warning', 'bg-danger'];
        const selectedValue = select.value;

        switch (selectedValue) {
            case "active": {
                target.classList.remove(...statusClasses);
                target.classList.add('bg-success');
                break;
            }
            case "inactive": {
                target.classList.remove(...statusClasses);
                target.classList.add('bg-danger');
                break;
            }
            default:
                break;
        }

        $(select).on('change', function (e) {
            const value = e.target.value;

            switch (value) {
                case "active": {
                    target.classList.remove(...statusClasses);
                    target.classList.add('bg-success');
                    break;
                }
                case "inactive": {
                    target.classList.remove(...statusClasses);
                    target.classList.add('bg-danger');
                    break;
                }
                default:
                    break;
            }
        });
    }
    const handleCategoryType = () => {
        const select = document.getElementById('kt_ecommerce_add_product_category_type_select');

        $(select).on('change', function (e) {
            const productId = {{ $product->id }};
            const categoryType = e.target.value;

            $.ajax({
                url: "{{ route('catalog.products.updateCategoryType') }}",
                type: "POST",
                data: {
                    product_id: productId,
                    category_type: categoryType,
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.message
                    });
                },
                error: function (xhr, status, error) {
                    console.error('Failed to update product category type:', error);
                }
            });
        });
    }




    $(document).ready(function() {
        initQuill();
        initRepeater();
        handleStatus();
        handleCategoryType();
        // handleCategoryChange();

        // KTAppEcommerceSaveProduct.init();
        // initConditionsSelect2();
    });


</script>