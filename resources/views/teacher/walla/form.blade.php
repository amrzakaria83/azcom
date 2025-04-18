<div class="row mb-6">
    <label class="col-lg-2 col-form-label fw-semibold fs-6">{{trans('wall.photo')}}</label>
    <div class="col-lg-8">
        <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url({{asset('dash/assets/media/avatars/blank.png')}})">
            @if (isset($data) && $data->getMedia('photo')->count())
            <div class="image-input-wrapper w-125px h-125px" style="background-image: url({{$data->getFirstMediaUrl('photo', 'thumb')}})"></div>
            @else
            <div class="image-input-wrapper w-125px h-125px" style="background-image: url({{asset('dash/assets/media/avatars/blank.png')}})"></div>
            @endif
            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                <i class="bi bi-pencil-fill fs-7"></i>
                <input type="file" name="photo[]" accept=".png, .jpg, .jpeg, .mp4" multiple />
                <input type="hidden" name="avatar_remove" />
            </label>
            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                <i class="bi bi-x fs-2"></i>
            </span>
            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                <i class="bi bi-x fs-2"></i>
            </span>
        </div>

        <div class="form-text">{{trans('wall.photo_type')}} png, jpg, jpeg.</div>
    </div>
</div> 

<div class="row mb-6">
    <label class="col-lg-2 col-form-label fw-semibold fs-6">{{trans('wall.file')}}</label>
    <div class="col-lg-8 fv-row">
        <input type="file" name="video" placeholder="{{trans('wall.file')}}" value="{{old('video',$data->video ?? '')}}" accept=".mp4" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
    </div>
</div>

<div class="row mb-6">
    <!--begin::Label-->
    <label class="col-lg-2 col-form-label required fw-semibold fs-6">{{trans('lang.classrooms')}}</label>
    <!--end::Label-->
    <div class="col-lg-8 fv-row">
        <select  data-control="select2" data-placeholder="Select an option" class="input-text form-control  form-select  mb-3 mb-lg-0"  name="classroom_id">
            @foreach (App\Models\Classroom::whereIn('id', $class_ids)->get() as $class_item)
                <option value="{{$class_item->id}}" @if(isset($data) && $data->classroom_id == $class_item->id) selected @endif>{{$class_item->name}} </option>
            @endforeach
        </select>
    </div>
    <!--end::Input-->
</div>

<div class="row mb-6">
    <!--begin::Label-->
    <label class="col-lg-2 col-form-label required fw-semibold fs-6">{{trans('wall.type')}} </label>
    <!--end::Label-->
    <div class="col-lg-8 fv-row">
        <select  data-control="select2" data-placeholder="Select an option" class="newstype input-text form-control  form-select  mb-3 mb-lg-0"  name="type">
            <option value="news" @if(isset($data) && $data->type == "news") selected @endif>{{trans('wall.news')}} </option>
            <option value="gallery" @if(isset($data) && $data->type == "gallery") selected @endif>{{trans('wall.gallery')}} </option>
            <option value="video" @if(isset($data) && $data->type == "video") selected @endif>{{trans('wall.video')}} </option>
        </select>
    </div>
    <!--end::Input-->
</div>

<div class="row mb-6">
    <label class="col-lg-2 col-form-label required fw-semibold fs-6">{{trans('wall.title')}}</label>
    <div class="col-lg-8 fv-row">
        <input type="text" name="name" placeholder="{{trans('wall.title')}}" value="{{old('name',$data->name ?? '')}}" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
    </div>
</div>

<div class="row mb-6 show-news" @if(isset($data) && $data->type != "news") style="display: none" @endif>
    <label class="col-lg-2 col-form-label required fw-semibold fs-6">{{trans('wall.description')}}</label>
    <div class="col-lg-8 fv-row">
        <textarea name="description" id="kt_docs_tinymce_basic">
            {{old('description',$data->description ?? '')}}
        </textarea>
    </div>
</div>

<script src="{{ URL::asset('dash/assets/plugins/custom/tinymce/tinymce.bundle.js')}}"></script>

<script>
    var options = {selector: "#kt_docs_tinymce_basic, #kt_docs_tinymce_basic2"};

    tinymce.init(options);

</script>
