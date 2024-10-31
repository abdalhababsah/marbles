<x-default-layout>
    @section('title') Products @endsection @section('breadcrumbs') {{
  Breadcrumbs::render('products.index') }} @endsection

    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <div class="d-flex flex-column flex-column-fluid">

            <div id="kt_app_content" class="app-content flex-column-fluid">
                <div id="kt_app_content_container" class="app-container container-xxl">
                    <form  class="form d-flex flex-column flex-lg-row" >
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
                            <div class="card card-flush py-4">
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>Status</h2>
                                    </div>
                                    <div class="card-toolbar">
                                        <div class="rounded-circle bg-success w-15px h-15px" id="kt_ecommerce_add_product_status"></div>
                                    </div>
                                </div>
                                <div class="card-body pt-0">
                                    <select name="status" class="form-select mb-2" data-control="select2" data-hide-search="true" data-placeholder="Select an option" id="kt_ecommerce_add_product_status_select" onchange="updateProductStatus()">
                                        <option value="active" {{ $product->status == 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="inactive" {{ $product->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    <div class="text-muted fs-7">Set the product status.</div>
                                </div>
                            </div>
                            <div class="card card-flush py-4">
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>Product Details</h2>
                                    </div>
                                </div>
                                <div class="card-body pt-0">
                                    <label class="form-label">Categories</label>
                                    <select name="category_id" class="form-select mb-2" data-control="select2" data-placeholder="Select an option" data-allow-clear="true" data-product-id="{{ $product->id }}">
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                                {{ $category->name_en }} , {{ $category->name_ar }}
                                            </option>
                                        @endforeach
                                    </select>

                                    <div class="text-muted fs-7 mb-7">
                                        Add product to a category.
                                    </div>

                                    <label class="form-label">Category Type</label>
                                    <select name="category_type" class="form-select mb-2" data-control="select2" data-hide-search="true" data-placeholder="Select an option" id="kt_ecommerce_add_product_category_type_select">
                                        <option value="normal" {{ $product->category_type == 'normal' ? 'selected' : '' }}>Normal</option>
                                        <option value="new" {{ $product->category_type == 'new' ? 'selected' : '' }}>New</option>
                                        <option value="hot" {{ $product->category_type == 'hot' ? 'selected' : '' }}>Hot</option>
                                        <option value="featured" {{ $product->category_type == 'featured' ? 'selected' : '' }}>Featured</option>
                                    </select>
                                    <div class="text-muted fs-7">Set the category type.</div>
                                </div>

                            </div>

                            <div class="card card-flush py-4">
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>Product Dimensions</h2>
                                    </div>
                                </div>
                                <div class="card-body pt-0">
                                    <div class="fv-row">
                                        <div class="d-flex flex-nowrap flex-lg-wrap flex-column flex-sm-nowrap flex-md-nowrap gap-3">
                                            <input type="number" step="any" id="width" name="dimensions[width]" class="form-control mb-2" placeholder="Width (w)" value="{{ $product->dimension->width ?? '' }}"/>
                                            <input type="number" step="any" id="height" name="dimensions[height]" class="form-control mb-2" placeholder="Height (h)" value="{{ $product->dimension->height ?? '' }}"/>
                                            <input type="number" step="any" id="length" name="dimensions[length]" class="form-control mb-2" placeholder="Thickness (T)" value="{{ $product->dimension->length ?? '' }}"/>
                                            <input type="hidden" step="any" name="dimensions[dimension_unit]" value="{{ $product->dimension->dimension_unit ?? 'cm' }}" />
                                        </div>
                                        <div class="text-muted fs-7">
                                            Enter the product dimensions in centimeters (cm).
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end mx-9">
                                    <button id="updateDimentionBtn" class="btn btn-sm btn-light-primary" >
                                        <span >Update Dimentions</span>
                                    </button>
                                </div>
                            </div>

                        </div>
                        <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general" role="tab-panel">
                                    <div class="d-flex flex-column gap-7 gap-lg-10">
                                        <div class="card card-flush py-4">
                                            <div class="card-header">
                                                <div class="card-title">
                                                    <h2>General</h2>
                                                </div>
                                            </div>
                                            <div class="card-body pt-0">
                                                <form id="update-general-form">

                                                <div class="row">
                                                    <div class="col-md-6 mb-10 fv-row">
                                                        <label class="required form-label">Product Name (English)</label>
                                                        <input id="name_en" type="text" name="name_en" class="form-control mb-2" placeholder="Product name in English" value="{{ $product->name_en }}"/>
                                                        <div class="text-muted fs-7">
                                                            A product name in English is required and
                                                            recommended to be unique.
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-10 fv-row">
                                                        <label class="required form-label">اسم المنتج (Arabic)</label>
                                                        <input id="name_ar" type="text" name="name_ar" class="form-control mb-2" placeholder="اسم المنتج بالعربية" value="{{ $product->name_ar }}"/>
                                                        <div class="text-muted fs-7">
                                                            اسم المنتج باللغة العربية مطلوب ويُنصح بأن يكون
                                                            فريدًا.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label class="form-label">Description (English)</label>
                                                        <textarea name="description_en" id="kt_ecommerce_add_product_description_en" class="form-control mb-2" placeholder="Description in English">{{ $product->description_en }}</textarea>
                                                        <div class="text-muted fs-7">
                                                            Set an English description for better visibility.
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label">الوصف (Arabic)</label>
                                                        <textarea
                                                                name="description_ar"
                                                                id="kt_ecommerce_add_product_description_ar"
                                                                class="form-control mb-2 "
                                                                placeholder="الوصف بالعربية"
                                                        >{{ $product->description_ar }}</textarea>
                                                        <div class="text-muted fs-7">
                                                            ضع وصفًا باللغة العربية لزيادة الوضوح.
                                                        </div>
                                                    </div>
                                                </div>
                                                    <div class="d-flex justify-content-end " style="margin-top: 100px">
                                                        <button id="update-general-btn" class="btn btn-sm btn-light-primary" >
                                                            <span >Update General</span>
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="card card-flush py-4">
                                            <div class="card-header">
                                                <div class="card-title">
                                                    <h2>Media</h2>
                                                </div>
                                            </div>
                                            <div class="card-body pt-0">
                                                <div class="fv-row mb-2">
                                                    <div class="dropzone" id="kt_ecommerce_add_product_media">
                                                        <div class="dz-message needsclick">
                                                            <i class="ki-duotone ki-file-up text-primary fs-3x">
                                                                <span class="path1"></span>
                                                                <span class="path2"></span>
                                                            </i>
                                                            <div class="ms-4">
                                                                <h3 class="fs-5 fw-bold text-gray-900 mb-1">
                                                                    Drop files here or click to upload.
                                                                </h3>
                                                                <span class="fs-7 fw-semi bold text-gray-500"
                                                                >Upload up to 10 files</span
                                                                >
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="text-muted fs-7">
                                                    Set the product media gallery.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card card-flush py-4">
                                            <div class="card-header">
                                                <div class="card-title">
                                                    <h2>Inventory</h2>
                                                </div>
                                            </div>
                                            <div class="card-body pt-0">

                                                <div class="mb-10 fv-row">
                                                    <!--begin::Label-->
                                                    <label class="required form-label">Quantity (in square meters)</label>
                                                    <div class="d-flex gap-3">
                                                        <input id="quantity_available" type="number" name="quantity_available" class="form-control mb-2" placeholder="Quantity in m²" value="{{$product->inventory->quantity_available}}"/>
                                                    </div>
                                                    <div class="text-muted fs-7">
                                                        Enter the product quantity in square meters.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-end mx-9">
                                                <button id="updateInventoryBtn" class="btn btn-sm btn-light-primary" >
                                                    <span >Update Inventory</span>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="card card-flush py-4">
                                            <div class="card-header">
                                                <div class="card-title">
                                                    <h2>Variations</h2>
                                                </div>
                                            </div>
                                            <div class="card-body pt-0">
                                                <div class="" data-kt-ecommerce-catalog-add-product="auto-options">
                                                    <label class="form-label">Add Product Variations</label>
                                                    <div id="kt_ecommerce_add_product_options">
                                                        <div class="form-group">
                                                            <div data-repeater-list="kt_ecommerce_add_product_options" class="d-flex flex-column gap-3">
                                                                @foreach($product->variants as $variantIndex => $variant)
                                                                    <div data-repeater-item="" class="form-group d-flex flex-wrap align-items-center gap-5">
                                                                        <div class="w-100 w-md-200px">
                                                                            <select class="variant form-select" data-varient-db-id="{{$variant->id}}" name="variants[{{$variantIndex}}][variant_type_id]" data-placeholder="Select a variation" data-kt-ecommerce-catalog-add-product="product_option">
                                                                                <option></option>
                                                                                @foreach($varientTypes as $innerVariantType)
                                                                                    <option value="{{ $innerVariantType->id }}" @if($variant->variantType->id == $innerVariantType->id) selected @endif>
                                                                                        {{ $innerVariantType->name_en }} , {{ $innerVariantType->name_ar }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <input id="en_variation_{{$variantIndex}}" name="variants[{{$variantIndex}}][variant_value_en]" type="text" class="form-control mw-100 w-200px" placeholder="Variation (English)" value="{{ $variant->variant_value_en }}"/>
                                                                        <input id="ar_variation_{{$variantIndex}}" type="text" class="form-control mw-100 w-200px" name="variants[{{$variantIndex}}][variant_value_ar]" placeholder="Variation (Arabic)" value="{{ $variant->variant_value_ar }}"/>
                                                                        <button type="button" data-repeater-delete="" class="btn btn-sm btn-icon btn-light-danger">
                                                                            <i class="ki-duotone ki-cross fs-1">
                                                                                <span class="path1"></span>
                                                                                <span class="path2"></span>
                                                                            </i>
                                                                        </button>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                        <div class="form-group mt-5">
                                                            <button type="button" data-repeater-create="" class="btn btn-sm btn-light-primary">
                                                                <i class="ki-duotone ki-plus fs-2"></i>Add another variation
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            <div class="d-flex justify-content-end " style="margin-top: 100px">
                                                <button id="update-variations-btn" class="btn btn-sm btn-light-primary" >
                                                    <span >Update Variations</span>
                                                </button>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

        @push('scripts')
            @include('pages.catalog.products.columns.edit_js_file')
        @endpush
</x-default-layout>
