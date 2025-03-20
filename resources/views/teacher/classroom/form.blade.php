<div class="row mb-6">
    <label class="col-lg-4 col-form-label required fw-semibold fs-6">{{trans('classroom.name')}}</label>
    <div class="col-lg-8 fv-row">
        <input type="text" name="name" placeholder="{{trans('classroom.name')}}" value="{{old('name',$data->name ?? '')}}" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
    </div>
</div>

<div class="row mb-6">
    <!--begin::Label-->
    <label class="col-lg-4 col-form-label fw-semibold fs-6"> {{trans('lang.educational_levels')}}</label>
    <!--end::Label-->
    <div class="col-lg-8 fv-row">
        <select  data-control="select2" data-placeholder="Select an option" class=" input-text form-control  form-select  mb-3 mb-lg-0"  name="level_id">
            <option value="0">{{trans('classroom.choose')}}</option>
            @foreach(\App\Models\Level::all() as $level)
                <option @if(isset($data) && $data->level_id == $level->id) selected @endif value="{{$level->id}}">
                    {{$level->name}}
                </option>
            @endforeach
        </select>
    </div>
    <!--end::Input-->
</div>