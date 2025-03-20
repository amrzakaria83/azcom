<div class="row">
    <div class="col-lg-4">
        <div class="mb-6">
            <label class="col-lg-12 col-form-label required fw-semibold fs-6">{{trans('exam.title')}}</label>
            <div class="col-lg-120 fv-row">
                <input type="text" name="name" placeholder="{{trans('exam.title')}}" value="{{old('name',$data->name ?? '')}}" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="mb-6">
            <label class="col-lg-12 col-form-label required fw-semibold fs-6">{{trans('exam.duration')}}</label>
            <div class="col-lg-120 fv-row">
                <input type="text" name="duration" id="time" placeholder="{{trans('exam.duration')}}" value="{{old('duration',$data->duration ?? '1:00')}}" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" autocomplete="off" />
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="mb-6">
            <div
                class="form-check form-switch form-check-custom form-check-solid">
                <label class="col-lg-2 form-check-label fw-semibold fs-6" for="flexSwitchDefault">{{trans('exam.is_active')}}</label>
                <div class="col-lg-8 fv-row">
                <input class="form-check-input" name="is_active" type="hidden"
                       value="0" id="flexSwitchDefault"/>
                <input class="form-check-input w-45px h-25px "
                       name="is_active" type="checkbox"    @if(isset($data) && $data->is_active == '1') checked @endif
                       value="1" id="flexSwitchDefault" />
                </div>
            </div>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-4">
        <div class="mb-6">
            <!--begin::Label-->
            <label class="col-lg-12 col-form-label required fw-semibold fs-6"> {{trans('lang.classrooms')}}  </label>
            <!--end::Label-->
            <div class="col-lg-12">
                <select  data-control="select2" data-placeholder="Select an option" class="classroom input-text form-control  form-select  mb-3 mb-lg-0"  name="classroom_id">
                    <option value="">{{trans('exam.choose')}}</option>
                    @foreach (App\Models\Classroom::whereIn('id', $class_ids)->get() as $class_item)
                        <option @if(isset($data) && $data->classroom_id == $class_item->id) selected @endif value="{{$class_item->id}}">{{$class_item->name}} </option>
                    @endforeach
                </select>
            </div>
            <!--end::Input-->
        </div>
    </div>
    <div class="col-lg-4">
        <div class="mb-6">
            <!--begin::Label-->
            <label class="col-lg-12 col-form-label required fw-semibold fs-6"> {{trans('lang.Subjects')}}  </label>
            <!--end::Label-->
            <div class="col-lg-12">
                <select  data-placeholder="Select an option" class="subject input-text form-control  form-select  mb-3 mb-lg-0"  name="subject_id">
                    <option value="">{{trans('exam.choose')}}</option>
                    @if(isset($data) && $data->subject_id)
                    @foreach(\App\Models\ClassroomSubject::where('classroom_id', $data->classroom_id)->with('subject')->get() as $subject)
                        <option @if(isset($data) && $data->subject_id == $subject->subject->id) selected @endif value="{{$subject->subject->id}}">
                            {{$subject->subject->name}}
                        </option>
                    @endforeach
                    @endif
                </select>
            </div>
            <!--end::Input-->
        </div>
    </div>
    <div class="col-lg-4">
        
    </div>
</div>


<script src="{{ URL::asset('dash/assets/js/custom/timepicker.min.js')}}"></script>
<script>
    var timepicker = new TimePicker('time', {
        lang: 'en',
        theme: 'dark'
    });

    var input = document.getElementById('time');

    timepicker.on('change', function(evt) {
        
        var value = (evt.hour || '00') + ':' + (evt.minute || '00');
        evt.element.value = value;

    });
</script>
<script src="{{ URL::asset('dash/assets/plugins/custom/tinymce/tinymce.bundle.js')}}"></script>
<script>
    var options = {selector: "#kt_docs_tinymce_basic"};

    tinymce.init(options);
</script>
