@if(isset($variantType))
    <form action="{{ route('catalog.variant-types.update', $variantType) }}" id="variantTypeForm" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <input type="hidden" name="id" value="{{ $variantType->id }}">
        @else
            <form action="{{ route('catalog.variant-types.store') }}" method="POST" id="variantTypeForm" enctype="multipart/form-data">
                @endif
                @csrf
                <div class="row">
                    <div class="col-md-12 mb-7">
                        <label class="required fw-semibold fs-6 mb-2">Name</label>
                        <input type="text" name="name_en" class="form-control form-control-solid-bg mb-2"
                               placeholder="Variant Type Name" @isset($variantType) value="{{ $variantType->name_en }}" @endisset>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="required fw-semibold fs-6 mb-2">Name (Arabic)</label>
                        <input type="text" name="name_ar" class="form-control form-control-solid-bg mb-2"
                               placeholder="اسم نوع المتغير" @isset($variantType) value="{{ $variantType->name_ar }}" @endisset>
                    </div>
                    <div class="col-md-12 form-group">
                        <input type="submit" class="btn btn-light-success btn-sm float-end" value="Submit" id="btn-submit">
                    </div>
                </div>
            </form>
