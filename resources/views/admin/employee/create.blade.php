@extends('admin.layout.master')

@section('css')
@endsection

@section('style')
    
@endsection

@section('breadcrumb')
<div class="d-flex align-items-center" id="kt_header_nav">
    <!--begin::Page title-->
    <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_header_nav'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
        <a  href="{{url('/admin')}}">
            <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">
                {{trans('lang.dashboard')}}
            </h1>
        </a>
        <span class="h-20px border-gray-300 border-start mx-4"></span>
        <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
            <li class="breadcrumb-item text-muted px-2">
                <a  href="{{route('admin.employees.index')}}" class="text-muted text-hover-primary">{{trans('lang.administrators')}}</a>
            </li>
            <li class="breadcrumb-item">
                <span class="bullet bg-gray-300 w-5px h-2px"></span>
            </li>
            <li class="breadcrumb-item text-muted px-2">
                {{trans('employee.add_new')}}  
            </li>
        </ul>
    </div>
    <!--end::Page title-->
</div>
@endsection

@section('content')

    <div id="kt_app_content_container" class="app-container container-fluid">       

        <div class="card mb-5 mb-xl-10">
            <!--begin::Content-->
            <div id="kt_account_settings_profile_details" class="collapse show">
                <form action="{{route('admin.employees.store')}}" method="POST" enctype="multipart/form-data" id="kt_account_profile_details_form" class="form">
                    @csrf
                    <!--begin::Card body-->
                    <div class="card-body  p-9">

                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">{{trans('employee.profile_picture')}}</label>
                            <div class="col-lg-8">
                                <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url('assets/media/svg/avatars/blank.svg')">
                                    <div class="image-input-wrapper w-125px h-125px" style="background-image: url({{asset('dash/assets/media/avatars/blank.png')}})"></div>
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

                                <div class="form-text">{{trans('employee.photo_type')}} png, jpg, jpeg.</div>
                            </div>
                        </div> 

                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label required fw-semibold fs-3 text-info">{{trans('employee.name')}}</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="name_en" placeholder="{{trans('employee.name')}}" value="" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label required fw-semibold fs-3 text-info">{{trans('employee.organizational_level')}}</label>
                            <div class="col-lg-8 fv-row">
                                <select  data-placeholder="Select an option" class="input-text form-control form-select mb-3 mb-lg-0 text-center" id="level_id" name="level_id" data-control="select2" >
                                    <option  disabled selected>Select an option</option>
                                    @foreach (\App\Models\Level_sequence::where('status' , 0)->get() as $asd)
                                        <option value="{{$asd->id}}" >{{$asd->name_ar}}</option>
                                        @endforeach
                                </select>
                        </div>

                        <!-- <div class="row mb-6">
                            <label class="col-lg-2 col-form-label required fw-semibold fs-3 text-info">{{trans('employee.job_title')}}</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="job_title" placeholder="{{trans('employee.job_title')}}" value="" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                            </div>
                        </div> -->
                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">{{trans('employee.national_id')}}</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="national_id" id="national_id" placeholder="{{trans('employee.national_id')}}" value="" required class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label required fw-semibold fs-3 text-info">{{trans('employee.birth_date')}}</label>
                            <div class="col-lg-8 fv-row">
                                <input type="date" name="birth_date" id="birth_date" placeholder="{{trans('employee.birth_date')}}" value="" required class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label required fw-semibold fs-3 text-info">{{trans('employee.work_date')}}</label>
                            <div class="col-lg-8 fv-row">
                                <input type="date" name="work_date" placeholder="{{trans('employee.work_date')}}" value="" required class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-3 text-info">
                                <span class="required">{{trans('employee.phone')}}</span>
                            </label>
                            <div class="col-lg-8 fv-row">
                                <input type="tel" name="phone" placeholder="{{trans('employee.phone')}}" value="" class="form-control form-control-lg form-control-solid" />
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label required fw-semibold fs-3 text-info">{{trans('employee.address')}}</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="address1" placeholder="{{trans('employee.address')}}" value="" required class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                            </div>
                        </div>
                        
                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label required fw-semibold fs-3 text-info">{{trans('employee.account_type')}} </label>
                            <div class="col-lg-8 fv-row">
                                <select   data-placeholder="Select an option" class=" input-text form-control  form-select  mb-3 mb-lg-0"  name="type">
                                    <option value="">{{trans('employee.choose_type')}}</option>
                                    <option value="0">{{trans('employee.admim')}}</option>
                                    <option value="1">no dash</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label required fw-semibold fs-3 text-info">{{trans('employee.gender')}} </label>
                            <div class="col-lg-8 fv-row">
                                <select   data-placeholder="Select an option" class=" input-text form-control  form-select  mb-3 mb-lg-0"  name="gender">
                                    <option value="">{{trans('employee.gender')}}</option>
                                    <option value="0">{{trans('employee.male')}}</option>
                                    <option value="1">{{trans('employee.female')}}</option>
                                    <option value="2">Other</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label required fw-semibold fs-3 text-info">{{trans('employee.method_for_payment')}} </label>
                            <div class="col-lg-8 fv-row">
                                <select   data-placeholder="Select an option" class=" input-text form-control  form-select  mb-3 mb-lg-0"  name="method_for_payment">
                                    <option value="">{{trans('employee.method_for_payment')}}</option>
                                    <option value="0">{{trans('employee.cash')}}</option>
                                    <option value="1">{{trans('employee.bank_transfer')}}</option>
                                    <option value="2">Instapay</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">{{trans('employee.acc_bank_no')}}</label>
                            <div class="col-lg-4 fv-row">
                                <input type="text" name="acc_bank_no" placeholder="{{trans('employee.acc_bank_no')}}" value=""  class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                            </div>
                            <div class="col-lg-3 fv-row">
                                <input type="text" name="bank_name" placeholder="{{trans('lang.bank_name')}}" value=""  class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">
                                <span class="">{{trans('employee.phone')}}2</span>
                            </label>
                            <div class="col-lg-8 fv-row">
                                <input type="tel" name="phone2" placeholder="{{trans('employee.phone')}}2" value="" class="form-control form-control-lg form-control-solid" />
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">
                                <span class="">{{trans('employee.phone')}}3</span>
                            </label>
                            <div class="col-lg-8 fv-row">
                                <input type="tel" name="phone3" placeholder="{{trans('employee.phone')}}3" value="" class="form-control form-control-lg form-control-solid" />
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label required fw-semibold fs-3 text-info">{{trans('employee.role_id')}} </label>
                            <div class="col-lg-8 fv-row">
                                <select  data-control="select2" data-placeholder="Select an option" class=" input-text form-control  form-select  mb-3 mb-lg-0"  name="role_id">
                                    @foreach (Spatie\Permission\Models\Role::all() as $item=>$row)
                                        <option value="{{$row->id}}">{{$row->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label required fw-semibold fs-3 text-info">{{trans('employee.email')}} </label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="email" placeholder="{{trans('employee.email')}}" value="" id="email" class="form-control form-control-lg form-control-solid" />
                            </div>
                        </div>
                        
                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-3 text-info required">
                                {{trans('employee.password')}}
                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="{{trans('employee.least_6_letters')}}"></i>
                            </label>
                            <div class="col-lg-8 fv-row">
                                <input type="password" name="password" placeholder="{{trans('employee.password')}}" value="" class="form-control form-control-lg form-control-solid" />
                            </div>
                        </div>

                        <!-- <div class="row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">{{trans('lang.note')}}</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="note" placeholder="{{trans('lang.note')}}" value="" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                            </div>
                        </div> -->
                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label  fw-semibold fs-3 text-info">{{trans('lang.social_insurance_no')}}</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="social_insurance_no" placeholder="{{trans('lang.social_insurance_no')}}" value=""  class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label  fw-semibold fs-3 text-info">{{trans('lang.medical_insurance_no')}}</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="medical_insurance_no" placeholder="{{trans('lang.medical_insurance_no')}}" value=""  class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label  fw-semibold fs-3 text-info">{{trans('lang.full_salary')}}</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="salary" placeholder="{{trans('lang.full_salary')}}" value=""  class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label  fw-semibold fs-3 text-info">{{trans('lang.attach')}}</label>
                            <div class="col-lg-8 fv-row">
                                <input type="file" name="attach"  class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                            </div>
                        </div>

                        <div class="row mb-0">
                            <label class="col-lg-2 col-form-label required fw-semibold fs-3 text-info"> {{trans('employee.is_active')}}</label>
                            <div class="col-lg-8 d-flex align-items-center">
                            <select   data-placeholder="Select an option" class=" input-text form-control  form-select  mb-3 mb-lg-0"  name="is_active">
                                    <option value="1">{{trans('employee.active')}}</option>
                                    <option value="0">{{trans('employee.notactive')}}</option>
                                    <option value="2">{{trans('employee.suspended')}}</option>
                                    <option value="3">{{trans('employee.terminated')}}</option>
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="card-footer d-flex justify-content-end py-6 px-9">
                        <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">{{trans('employee.save')}}</button>
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Content-->

           
        </div>
    </div>

@endsection

@section('script')
<script>
// $('#is_active').on('change', function() {
//             if (this.value == 3) {
//                 $('#kt_modal').modal('show');
//             } 
//             // else if (this.value > 0) {
//             //         $('#largestunite_id, #mediumunite_id ,#smallestunite_id ').val(this.value); // Directly set the value
//             //     } else {
//             //         // Optionally clear largestunite_id if the selected value is invalid
//             //         $('#largestunite_id').val("");
//             //     }
//                 });
//     </script>
<!-- <script>
    
    $("#national_id").on('blur', function() {
        var national_no = $(this).val();
        var yb;
        var firstnational_no = national_no.toString().charAt(0);
        if (firstnational_no < '3') {yb = '19';} else {yb = '20';}
        var yearOfBirth = yb + national_no.substr(1, 2) ;
        var monthOfBirth = national_no.substr(3, 2);
        var dayOfBirth = national_no.substr(5, 2);
        var birthdate = yearOfBirth + '-' + monthOfBirth + '-' + dayOfBirth;
        document.getElementById("birth_date").value = birthdate;
        var gender = national_no.substr(12,1);
        if (gender % 2 == 0) {document.getElementById("gender").value = 1; // female
        } else {document.getElementById("gender").value = 0; // male
        }
        })

    </script> -->

@endsection