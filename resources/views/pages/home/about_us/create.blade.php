<form action="{{ isset($aboutUs) ? route('home.about-us.update', ['aboutUs' => $aboutUs->id]) : route('home.about-us.store') }}" method="POST" id="aboutUsForm" enctype="multipart/form-data">
    @if(isset($aboutUs))
        @method('PUT')
    @endif
    @csrf
    <input type="hidden" name="id" value="{{ $aboutUs->id ?? '' }}">
    <div class="row">
        <div class="col-md-6 mb-7">
            <label class="required fw-semibold fs-6 mb-2">Content (English)</label>
            <textarea name="content_en" class="form-control form-control-solid-bg mb-2" placeholder="About Us Content in English" required>@if(isset($aboutUs)){{ trim($aboutUs->content_en) }}@endif</textarea>
        </div>

        <div class="col-md-6 mb-7">
            <label class="required fw-semibold fs-6 mb-2">Content (Arabic)</label>
            <textarea name="content_ar" class="form-control form-control-solid-bg mb-2" placeholder="About Us Content in Arabic" required dir="rtl">@if(isset($aboutUs)){{ trim($aboutUs->content_ar) }}@endif</textarea>
        </div>

        <div class="col-md-12 imgUp form-group">
            <label class="required fw-semibold d-block fs-6 mb-2">About Us Image</label>
            <div class="image-input shadow-sm " data-kt-image-input="true" style="background-image: url(/assets/media/svg/avatars/blank.svg)">
                <div class="image-input-wrapper w-125px h-125px" style="background-image: url('{{ isset($aboutUs) ? asset( $aboutUs->image_path) : '' }}');"></div>
                <label class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change image">
                    <i class="ki-duotone ki-pencil fs-6"><span class="path1"></span><span class="path2"></span></i>
                    <input type="file" name="image_path" accept="image/*"/>
                </label>
                @if(isset($aboutUs) && $aboutUs->image_path)
                    <span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove image">
                        <i class="ki-outline ki-trash fs-3"></i>
                    </span>
                @endif
            </div>
        </div>

        <div class="col-md-12 form-group">
            <input type="submit" class="btn btn-light-success btn-sm float-end" value="Submit" id="btn-submit">
        </div>
    </div>
</form>

<script>
    KTImageInput.createInstances();
</script>
