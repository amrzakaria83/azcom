

<!-- <div class="row mb-6">
    <label class="col-lg-4 col-form-label required fw-semibold fs-6">{{trans('lang.name_ar')}}</label>
    <div class="col-lg-8 fv-row">
        <input type="text" name="name_ar" placeholder="{{trans('lang.name_ar')}}" value="{{old('name_ar',$data->name_ar ?? '')}}" class="text-center form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
    </div>
</div> -->


<div class="row mb-6">
    <label class="col-lg-4 col-form-label required fw-semibold fs-6">{{trans('lang.name_en')}}</label>
    <div class="col-lg-8 fv-row">
        <input type="text" name="name_en" placeholder="{{trans('lang.name_en')}}" value="{{old('name_en',$data->name_en ?? '')}}" class="text-center form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
    </div>
</div>
<div class="row mb-6">
    <label class="col-lg-4 col-form-label required fw-semibold fs-6">
        <span class="">{{trans('lang.type_type')}}</span>
    </label>
    <div class="col-lg-8 fv-row">
        <select class="form-select text-center" autofocus required aria-label="Select example" id="type_specialty"  name="type_specialty" >
            <option value="1">{{trans('lang.main')}}</option>
            <option value="0">{{trans('lang.sub')}}</option>
        </select>
    </div>
</div>

<div class="row mb-6" id="parent">
    <label class="col-lg-4 col-form-label required fw-semibold fs-6" >{{trans('lang.level')}}</label>
    <div class="col-lg-8 fv-row">
        <select  data-placeholder="Select an option"  class=" input-text form-control  form-select  mb-3 mb-lg-0" data-control="select2"  name="parent_id">
            <option  >Select an option</option>
            @foreach (\App\Models\Level_sequence::where('status' , 0)->get() as $item)
                <option value="{{$item->id}}">{{$item->name_en}}</option>
            @endforeach
        
        </select>
    </div>
</div>

<div class="row mb-6">
    <label class="col-lg-4 col-form-label fw-semibold fs-6">{{trans('lang.description')}}</label>
    <div class="col-lg-8 fv-row">
    <textarea name="description" placeholder="{{trans('lang.description')}}" rows="8" cols="4" class="form-control">{{old('description',$data->description ?? '')}}</textarea>
    </div>
</div>


<div class="row mb-6">
    <label class="col-lg-4 col-form-label fw-semibold fs-6">{{trans('lang.note')}}</label>
    <div class="col-lg-8 fv-row">
        <input type="text" id="note" name="note" placeholder="{{trans('lang.note')}}" value="{{old('note',$data->note ?? '')}}" class="text-center form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
    </div>
</div>


<div class="fv-row mb-6">
    <div class="form-check form-switch form-check-custom form-check-solid">
        <label class="col-lg-4 form-check-label required fw-semibold fs-6" for="flexSwitchDefault">{{trans('lang.status')}}</label>
        <div class="col-lg-8 fv-row">
        <select  data-placeholder="Select an option" class="newstype input-text form-control  form-select  mb-3 mb-lg-0"  name="status">
                <option value="0" @if(isset($data) && $data->status == "0") selected @endif>{{trans('lang.active')}}</option>
                <option value="1" @if(isset($data) && $data->status == "1") selected @endif>{{trans('lang.inactive')}}</option>

            </select>
        </div>
    </div>
</div>
