<div class="row mb-6">
    <label class="col-lg-2 col-form-label required fw-semibold fs-6">{{trans('level.name')}}</label>
    <div class="col-lg-8 fv-row">
        <input type="text" name="name" placeholder="{{trans('level.name')}}" value="{{old('name',$data->name ?? '')}}" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
    </div>
</div>