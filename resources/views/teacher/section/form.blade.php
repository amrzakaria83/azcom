<div class="row mb-6">
    <label class="col-lg-2 col-form-label required fw-semibold fs-6">{{trans('section.name')}}</label>
    <div class="col-lg-8 fv-row">
        <input type="text" name="name" placeholder="{{trans('section.name')}}" value="{{old('name',$data->name ?? '')}}" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
    </div>
</div>

<div class="row mb-6">
    <!--begin::Label-->
    <label class="col-lg-2 col-form-label fw-semibold fs-6"> {{trans('lang.Subjects')}} </label>
    <!--end::Label-->
    <div class="col-lg-8 fv-row">
        <select  data-control="select2" data-placeholder="Select an option" class=" input-text form-control  form-select  mb-3 mb-lg-0"  name="subject_id" required>
            <option value="">{{trans('section.choose')}}</option>
            @foreach(\App\Models\Subject::all() as $subject)
                <option @if(isset($data) && $data->subject_id == $subject->id) selected @endif value="{{$subject->id}}">
                    {{$subject->name}}
                </option>
            @endforeach
        </select>
    </div>
    <!--end::Input-->
</div>