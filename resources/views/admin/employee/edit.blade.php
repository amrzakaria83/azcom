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
                {{trans('employee.edit')}}   
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
                <!--begin::Form-->
                <form action="{{route('admin.employees.update')}}" method="POST" enctype="multipart/form-data" id="kt_account_profile_details_form" class="form">
                    @csrf
                    <input type="hidden" name="id" value="{{$data->id}}" />
                    <!--begin::Card body-->
                    <div class="card-body border-top p-9">

                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">{{trans('employee.profile_picture')}}</label>
                            <div class="col-lg-8">
                                <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url('assets/media/svg/avatars/blank.svg')">
                                    @if ($data->getMedia('profile')->count())
                                    <div class="image-input-wrapper w-125px h-125px" style="background-image: url({{$data->getFirstMediaUrl('profile', 'thumb')}})"></div>
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

                                <div class="form-text">{{trans('employee.photo_type')}} png, jpg, jpeg.</div>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label required fw-semibold fs-6">{{trans('employee.name')}}</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="name_en" placeholder="{{trans('employee.name')}}" value="{{$data->name_en}}" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label required fw-semibold fs-3 text-info">{{trans('employee.organizational_level')}}</label>
                            <div class="col-lg-8 fv-row">
                                <select  data-placeholder="Select an option" class="input-text form-control form-select mb-3 mb-lg-0 text-center" id="level_id" name="level_id" data-control="select2" >
                                    <option  disabled selected>Select an option</option>
                                    @foreach (\App\Models\Level_sequence::where('status' , 0)->get() as $asd)
                                        <option value="{{$asd->id}}" @if(($asd->id, $data->level_id)) selected @endif>{{$asd->name_ar}}</option>
                                        @endforeach
                                </select>
                        </div>
                        <!--<div class="row mb-6">  
                            <label class="col-lg-2 col-form-label required fw-semibold fs-6">{{trans('employee.job_title')}}</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="job_title" placeholder="{{trans('employee.job_title')}}" value="{{$data->job_title}}" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                            </div>
                        </div> -->
                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label required fw-semibold fs-6">{{trans('employee.national_id')}}</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="national_id" placeholder="{{trans('employee.national_id')}}" value="{{$data->national_id}}" required class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label required fw-semibold fs-6">{{trans('employee.birth_date')}}</label>
                            <div class="col-lg-8 fv-row">
                                <input type="date" name="birth_date" placeholder="{{trans('employee.birth_date')}}" value="{{$data->birth_date}}" required class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label required fw-semibold fs-6">{{trans('employee.work_date')}}</label>
                            <div class="col-lg-8 fv-row">
                                <input type="date" name="work_date" placeholder="{{trans('employee.work_date')}}" value="{{$data->work_date}}" required class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">
                                <span class="required">{{trans('employee.phone')}}</span>
                            </label>
                            <div class="col-lg-8 fv-row">
                                <input type="tel" name="phone" placeholder="{{trans('employee.phone')}}" value="{{$data->phone}}" class="form-control form-control-lg form-control-solid" />
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label required fw-semibold fs-6">{{trans('employee.address')}}</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="address1" placeholder="{{trans('employee.address')}}" value="{{$data->address1}}" required class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label required fw-semibold fs-6">{{trans('employee.account_type')}} </label>
                            <div class="col-lg-8 fv-row">
                                <select   data-placeholder="Select an option" class=" input-text form-control  form-select  mb-3 mb-lg-0"  name="type">
                                    <option value="0" @if($data->type == '0') selected  @endif >{{trans('employee.admim')}}</option>
                                    <option value="dash" @if($data->type == 'dash') selected  @endif >{{trans('employee.administrator')}}</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label required fw-semibold fs-6">{{trans('employee.gender')}} </label>
                            <div class="col-lg-8 fv-row">
                                <select   data-placeholder="Select an option" class=" input-text form-control  form-select  mb-3 mb-lg-0"  name="gender">
                                    <option value="">{{trans('employee.gender')}}</option>
                                    <option value="0" @if($data->gender == '0') selected @endif >{{trans('employee.male')}}</option>
                                    <option value="1" @if($data->gender == '1') selected @endif >{{trans('employee.female')}}</option>
                                    <option value="2" @if($data->gender == '2') selected @endif >Other</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label required fw-semibold fs-6">{{trans('employee.method_for_payment')}} </label>
                            <div class="col-lg-8 fv-row">
                                <select   data-placeholder="Select an option" class=" input-text form-control  form-select  mb-3 mb-lg-0"  name="method_for_payment">
                                    <option value="0" @if($data->method_for_payment == '0') selected @endif >{{trans('employee.cash')}}</option>
                                    <option value="1" @if($data->method_for_payment == '1') selected @endif >{{trans('employee.bank_transfer')}}</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">{{trans('employee.acc_bank_no')}}</label>
                            <div class="col-lg-4 fv-row">
                                <input type="text" name="acc_bank_no" placeholder="{{trans('employee.acc_bank_no')}}" value="{{$data->acc_bank_no}}"  class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                            </div>
                            <div class="col-lg-4 fv-row">
                                <input type="text" name="bank_name" placeholder="{{trans('lang.bank_name')}}" value="{{$data->bank_name}}"  class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">
                                <span class="">{{trans('employee.phone')}}2</span>
                            </label>
                            <div class="col-lg-8 fv-row">
                                <input type="tel" name="phone2" placeholder="{{trans('employee.phone')}}2" value="{{$data->phone2}}" class="form-control form-control-lg form-control-solid" />
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">
                                <span class="">{{trans('employee.phone')}}3</span>
                            </label>
                            <div class="col-lg-8 fv-row">
                                <input type="tel" name="phone3" placeholder="{{trans('employee.phone')}}3" value="{{$data->phone3}}" class="form-control form-control-lg form-control-solid" />
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label required fw-semibold fs-6">{{trans('employee.role_id')}} </label>
                            <div class="col-lg-8 fv-row">
                                <select  data-control="select2" data-placeholder="Select an option" class=" input-text form-control  form-select  mb-3 mb-lg-0"  name="role_id">
                                    @foreach (Spatie\Permission\Models\Role::all() as $item=>$row)
                                        <option value="{{$row->id}}" @if($data->role_id == $row->id) selected @endif>{{$row->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label required fw-semibold fs-6">{{trans('employee.email')}} </label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="email" placeholder="{{trans('employee.email')}}" value="{{$data->email}}" class="form-control form-control-lg form-control-solid" />
                            </div>
                        </div>
                        
                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6 required">
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
                                <input type="text" name="note" placeholder="{{trans('lang.note')}}" value="{{$data->note}}" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                            </div>
                        </div> -->
                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">{{trans('lang.social_insurance_no')}}</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="social_insurance_no" placeholder="{{trans('lang.social_insurance_no')}}" value="{{$data->social_insurance_no}}" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">{{trans('lang.medical_insurance_no')}}</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="medical_insurance_no" placeholder="{{trans('lang.medical_insurance_no')}}" value="{{$data->medical_insurance_no}}" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">{{trans('lang.full_salary')}}</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="salary" placeholder="{{trans('lang.full_salary')}}" value="{{$data->salary}}" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label  fw-semibold fs-3 text-info">{{trans('lang.attach')}}</label>
                            <div class="col-lg-8 fv-row">
                                <input type="file" name="attach"  class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                            </div>
                        </div>

                        <div class="row mb-0">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6"> {{trans('employee.is_active')}}</label>
                            <div class="col-lg-8 d-flex align-items-center">
                            <select   data-placeholder="Select an option" class=" input-text form-control  form-select  mb-3 mb-lg-0"  name="is_active">
                                    <option value="0" @if($data->is_active == '0') selected @endif >{{trans('employee.notactive')}}</option>
                                    <option value="1" @if($data->is_active == '1') selected @endif >{{trans('employee.active')}}</option>
                                    <option value="2" @if($data->is_active == '2') selected @endif >{{trans('employee.suspended')}}</option>
                                    <option value="3" @if($data->is_active == '3') selected @endif >{{trans('employee.terminated')}}</option>
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
@endsection