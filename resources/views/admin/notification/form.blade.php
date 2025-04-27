<div class="row mb-6">
    <!--begin::Label-->
    <label class="col-lg-2 col-form-label required fw-semibold fs-6">{{trans('lang.classrooms')}}</label>
    <!--end::Label-->
    <div class="col-lg-8 fv-row">
        <select  data-control="select2" data-placeholder="Select an option" class="input-text form-control  form-select  mb-3 mb-lg-0"  name="employee_id">
            @foreach (App\Models\Employee::all() as $class_item)
                <option value="{{$class_item->id}}" @if(isset($data) && $data->employee_id == $class_item->id) selected @endif>{{$class_item->name_en}} </option>
            @endforeach
        </select>
    </div>
    <!--end::Input-->
</div>

<div class="row mb-6">
    <label class="col-lg-2 col-form-label required fw-semibold fs-6">{{trans('notification.title')}}</label>
    <div class="col-lg-8 fv-row">
        <input type="text" name="title" placeholder="{{trans('notification.title')}}" value="{{old('title',$data->title ?? '')}}" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
    </div>
</div>

<div class="row mb-6">
    <label class="col-lg-2 col-form-label required fw-semibold fs-6">{{trans('notification.description')}}</label>
    <div class="col-lg-8 fv-row">
        <textarea name="body" id="" class="form-control">
            {{old('body',$data->body ?? '')}}
        </textarea>
    </div>
</div>

<script src="{{ URL::asset('dash/assets/plugins/custom/tinymce/tinymce.bundle.js')}}"></script>

<script>
    var options = {selector: "#kt_docs_tinymce_basic, #kt_docs_tinymce_basic2"};

    tinymce.init(options);

</script>
