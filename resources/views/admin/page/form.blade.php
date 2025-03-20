<div class="row">
    <div class="col-lg-12">
        <div class="row mb-6">
            <label class="col-lg-2 col-form-label fw-semibold fs-6">{{trans('page.photo')}}</label>
            <div class="col-lg-10">
                <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url({{asset('dash/assets/media/avatars/blank.png')}})">
                    @if (isset($data) && $data->getMedia('photo')->count())
                    <div class="image-input-wrapper w-125px h-125px" style="background-image: url({{$data->getFirstMediaUrl('photo', 'thumb')}})"></div>
                    @else
                    <div class="image-input-wrapper w-125px h-125px" style="background-image: url({{asset('dash/assets/media/avatars/blank.png')}})"></div>
                    @endif
                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                        <i class="bi bi-pencil-fill fs-7"></i>
                        <input type="file" name="photo" accept=".png, .jpg, .jpeg" />
                        <input type="hidden" name="avatar_remove" />
                    </label>
                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                        <i class="bi bi-x fs-2"></i>
                    </span>
                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                        <i class="bi bi-x fs-2"></i>
                    </span>
                </div>
        
                <div class="form-text">{{trans('page.photo_type')}} png, jpg, jpeg.</div>
            </div>
        </div> 
        
        <div class="row mb-6">
            <label class="col-lg-2 col-form-label required fw-semibold fs-6">{{trans('page.name')}}</label>
            <div class="col-lg-10 fv-row">
                <input type="text" name="name" placeholder="{{trans('page.name')}}" value="{{old('name',$data->name ?? '')}}" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
            </div>
        </div>
        
        <div class="row mb-6">
            <label class="col-lg-2 col-form-label required fw-semibold fs-6">{{trans('page.description')}}</label>
            <div class="col-lg-10 fv-row">
                <textarea name="description" id="kt_docs_tinymce_basic">
                    {{old('description',$data->description ?? '')}}
                </textarea>
            </div>
        </div>
    </div>
</div>








<script src="{{ URL::asset('dash/assets/plugins/custom/tinymce/tinymce.bundle.js')}}"></script>

<script>
    var options = {selector: "#kt_docs_tinymce_basic"};

    tinymce.init(options);

</script>
