<div class="row">
    <div class="col-lg-12">
        <h3>{{trans('classroom.registered_students')}}</h3>
        <div class="row mb-6">
            <!--begin::Label-->
            <label class="col-lg-1 col-form-label fw-semibold fs-6"> {{trans('lang.Students')}} </label>
            <!--end::Label-->
            <div class="col-lg-4">
                <select  data-control="select2" data-placeholder="Select an option" class=" input-text form-control  form-select  mb-3 mb-lg-0"  name="student_id">
                    <option value="0">{{trans('classroom.choose')}}</option>
                    @foreach(\App\Models\Student::all() as $student)
                        <option @if(isset($data) && $data->student_id == $student->id) selected @endif value="{{$student->id}}">
                            {{$student->name}}
                        </option>
                    @endforeach
                </select>
            </div>
            <!--end::Input-->
        </div>
    </div>
    <div class="col-lg-6">
        <h3>{{trans('classroom.add_student')}}</h3>
        
        <input type="hidden" name="classroom_id" value="{{$classroom_id}}" /> 
        
        <div class="row mb-6">
            <label class="col-lg-2 col-form-label required fw-semibold fs-6">{{trans('classroom.name')}}</label>
            <div class="col-lg-10 fv-row">
                <input type="text" name="name" placeholder="{{trans('classroom.name')}}" value="{{old('name',$data->name ?? '')}}" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
            </div>
        </div>
        
        <div class="row mb-6">
            <label class="col-lg-2 col-form-label required fw-semibold fs-6">{{trans('classroom.phone')}}</label>
            <div class="col-lg-10 fv-row">
                <input type="text" name="phone" placeholder="{{trans('classroom.phone_validate')}}" value="{{old('phone',$data->phone ?? '')}}" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
            </div>
        </div>

        <div class="row mb-6">
            <label class="col-lg-2 col-form-label fw-semibold fs-6">{{trans('classroom.email')}}</label>
            <div class="col-lg-10 fv-row">
                <input type="text" name="email" placeholder="{{trans('classroom.email')}}" value="{{old('email',$data->email ?? '')}}" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
            </div>
        </div>

        <div class="row mb-6">
            <label class="col-lg-2 col-form-label fw-semibold fs-6"> {{trans('classroom.phone_mother')}}</label>
            <div class="col-lg-10 fv-row">
                <input type="text" name="mother_num" placeholder="{{trans('classroom.phone_mother')}}" value="{{old('mother_num',$data->mother_num ?? '')}}" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
            </div>
        </div>

        <div class="row mb-6">
            <label class="col-lg-2 col-form-label fw-semibold fs-6"> {{trans('classroom.phone_father')}}</label>
            <div class="col-lg-10 fv-row">
                <input type="text" name="father_num" placeholder="{{trans('classroom.phone_father')}}" value="{{old('father_num',$data->father_num ?? '')}}" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
            </div>
        </div>

        <div class="row mb-6">
            <label class="col-lg-2 col-form-label fw-semibold fs-6">{{trans('classroom.address')}}</label>
            <div class="col-lg-10 fv-row">
                <input type="text" name="address" placeholder="{{trans('classroom.address')}}" value="{{old('address',$data->address ?? '')}}" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
            </div>
        </div>

        <div class="fv-row mb-6">
            <div id="map" style="height: 300px;"></div>
        </div>

        <input type="hidden" name="lat" id="lat" placeholder="LAT" value="{{old('lat',$data->lat ?? '')}}" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
        <input type="hidden" name="lng" id="lng" placeholder="LNG" value="{{old('lng',$data->lng ?? '')}}" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
    </div>
    <div class="col-lg-6">
        <h3>{{trans('classroom.login_data')}}</h3>
        <div class="mb-6">
            <!--begin::Label-->
            <label class="col-lg-6 col-form-label fw-semibold fs-6"> {{trans('classroom.accounts')}} </label>
            <!--end::Label-->
            <div class="col-lg-10">
                <select  data-control="select2" data-placeholder="Select an option" class=" input-text form-control  form-select  mb-3 mb-lg-0"  name="user_id">
                    <option value="0">{{trans('classroom.choose_type')}}</option>
                    @foreach(\App\Models\User::all() as $user)
                        <option @if(isset($data) && $data->user_id == $user->id) selected @endif value="{{$user->id}}">
                            {{$user->name}}
                        </option>
                    @endforeach
                </select>
            </div>
            <!--end::Input-->
        </div>

        <div class="separator separator-content my-14">
            <span class="w-125px text-gray-500 fw-semibold fs-7">{{trans('classroom.login_data_add')}}</span>
        </div>

        <div class="mb-6">
            <label class="col-lg-6 col-form-label required fw-semibold fs-6">{{trans('classroom.phone')}}</label>
            <div class="col-lg-10">
                <input type="text" name="username" placeholder="{{trans('classroom.phone')}}" value="{{old('username',$data->user->phone ?? '')}}" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
            </div>
        </div>
        <div class=" mb-6">
            <label class="col-lg-6 col-form-label fw-semibold fs-6 required">
                {{trans('classroom.password')}}
                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="{{trans('classroom.least_6_letters')}}"></i>
            </label>
            <div class="col-lg-10">
                <input type="password" name="password" placeholder="{{trans('classroom.password')}}" value="" class="form-control form-control-lg form-control-solid" />
            </div>
        </div>

        <div class="mb-6">
            <label class="col-lg-6 col-form-label fw-semibold fs-6">{{trans('classroom.photo')}}</label>
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
        
                <div class="form-text">{{trans('student.photo_type')}} png, jpg, jpeg.</div>
            </div>
        </div> 
    </div>
</div>








<script src="{{ URL::asset('dash/assets/plugins/custom/tinymce/tinymce.bundle.js')}}"></script>

<script>
    var options = {selector: "#kt_docs_tinymce_basic,#kt_docs_tinymce_basic2,#kt_docs_tinymce_basic3,#kt_docs_tinymce_basic4"};

    tinymce.init(options);

</script>
