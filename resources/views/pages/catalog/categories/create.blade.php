@if(isset($category))
    <form action="{{ route('catalog.categories.update', $category) }}" id="categoryForm" method="POST"
          enctype="multipart/form-data">
        @method('PUT')
        @else
            <form action="{{ route('catalog.categories.store') }}" method="POST" id="categoryForm"
                  enctype="multipart/form-data">
                @endif
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-7">
                        <label class="required fw-semibold fs-6 mb-2">Name</label>
                        <input type="text" name="name_en" class="form-control form-control-solid-bg mb-2"
                               placeholder="Category Name" @isset($category) value="{{ $category->name_en }}" @endisset>
                    </div>
                    <!-- Arabic Name -->
                    <div class="col-md-6 mb-7">
                        <label class="required fw-semibold fs-6 mb-2">Name (Arabic)</label>
                        <input type="text" name="name_ar" class="form-control form-control-solid-bg mb-2"
                               placeholder="إسم الفئة بالعربية" @isset($category) value="{{ $category->name_ar }}" @endisset>
                    </div>

                    <!-- English Description -->
                    <div class="col-md-6 mb-7">
                        <label class="fw-semibold fs-6 mb-2">Description (English)</label>
                        <textarea name="description_en" class="form-control form-control-solid-bg mb-2" placeholder="English Description">@isset($category){{ $category->description_en }}@endisset</textarea>
                    </div>

                    <!-- Arabic Description -->
                    <div class="col-md-6 mb-7">
                        <label class="fw-semibold fs-6 mb-2">Description (Arabic)</label>
                        <textarea name="description_ar" class="form-control form-control-solid-bg mb-2"
                                  placeholder="الوصف بالعربية">@isset($category){{ $category->description_ar }}@endisset</textarea>
                    </div>


                    <div class="col-md-2 imgUp form-group">
                        <label class="required fw-semibold d-block fs-6 mb-2">Category Icon</label>
                        <div class="image-input shadow-sm " data-kt-image-input="true"
                             style="background-image: url(/assets/media/svg/avatars/blank.svg)">
                            <!--begin::Image preview wrapper-->
                            <div class="image-input-wrapper w-125px h-125px"
                                 @if(isset($category)) style="background-image:url('{{ isset($category) ? asset( $category->icon_path) : '' }}');" @endif></div>
                            <!--end::Image preview wrapper-->

                            <!--begin::Edit button-->
                            <label
                                    class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                    data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change icon">
                                <i class="ki-duotone ki-pencil fs-6"><span class="path1"></span><span class="path2"></span></i>

                                <input type="file" name="icon_path" accept="image/*"
                                       style="width: 0px;height: 0px;overflow: hidden;"/>
                            </label>
                            <!--end::Edit button-->

                            <!--begin::Cancel button-->
                            <span
                                    class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                    data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel icon">
                                    <i class="ki-outline ki-cross fs-3"></i>
                                </span>
                            <!--end::Cancel button-->

                            <!--begin::Remove button-->
                            <span
                                    class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                    data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove icon">
                                <i class="ki-outline ki-cross fs-3"></i>
                            </span>
                            <!--end::Remove button-->
                        </div>
                        <!--end::Image input-->
                    </div>

                    <div class="col-md-12 form-group">
                        <input type="submit" class="btn btn-light-success btn-sm float-end" value="Submit"
                               id="btn-submit">
                    </div>
                </div>
            </form>
            <script>
                KTImageInput.createInstances();

            </script>
