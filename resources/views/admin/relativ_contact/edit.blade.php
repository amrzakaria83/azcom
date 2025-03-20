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
                <a  href="{{route('admin.relativ_contacts.index')}}" class="text-muted text-hover-primary">{{trans('lang.relatives')}}</a>
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
                <form action="{{route('admin.relativ_contacts.update')}}" method="POST" enctype="multipart/form-data" id="kt_account_profile_details_form" class="form">
                    @csrf
                    <input type="hidden" name="id" value="{{$data->id}}" />
                    <!--begin::Card body-->
                    <div class="card-body border-top p-9">

                    <div class="row mb-6">
                            <label class="col-lg-2 col-form-label required text-danger fw-semibold fs-6">{{trans('lang.contact')}}-{{trans('lang.name')}}</label>
                            <div class="col-lg-8 fv-row">
                                <select  data-placeholder="Select an option" class=" input-text form-control  form-select  mb-3 mb-lg-0" required disabled  name="contact_id" data-control="select2" >
                                    <option value="" disabled selected>Select an option</option>
                                    @if(isset($datacont))
                                        @foreach ($datacont as $item)
                                                <option value="{{$item->id}}" @if($data->contact_id == $item->id) selected disabled @endif>{{$item->name_en}}</option>
                                            @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label required text-info fw-semibold fs-6">{{trans('lang.relatives')}} {{trans('lang.type_type')}}</label>
                            <div class="col-lg-8 fv-row">
                                <select   data-placeholder="Select an option" class=" input-text form-control  form-select  mb-3 mb-lg-0"  name="relative_status">
                                    <option value="0" @if($data->relative_status == '0') selected @endif>{{trans('lang.not_knowen')}}</option>
                                    <option value="1" @if($data->relative_status == '1') selected @endif>{{trans('lang.wife')}}</option>
                                    <option value="2" @if($data->relative_status == '2') selected @endif>{{trans('lang.husband')}}</option>
                                    <option value="3" @if($data->relative_status == '3') selected @endif>{{trans('lang.daughter')}}</option>
                                    <option value="4" @if($data->relative_status == '4') selected @endif>{{trans('lang.son')}}</option>
                                    <option value="5" @if($data->relative_status == '5') selected @endif>{{trans('lang.father')}}</option>
                                    <option value="6" @if($data->relative_status == '6') selected @endif>{{trans('lang.mather')}}</option>
                                    <option value="7" @if($data->relative_status == '7') selected @endif>{{trans('lang.grandson')}}</option>
                                    <option value="8" @if($data->relative_status == '8') selected @endif>{{trans('lang.grandfather')}}</option>
                                </select>
                            </div>
                        </div>


                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label required text-info fw-semibold fs-6">{{trans('lang.name')}}</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="name_en" placeholder="{{trans('lang.name')}}" value="{{$data->name_en}}" required class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">{{trans('lang.phone')}}</label>
                            <div class="col-lg-8 fv-row">
                                <input type="tel" name="phone" placeholder="{{trans('lang.phone')}}" value="{{$data->phone}}"  class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">{{trans('lang.address')}}</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="address" placeholder="{{trans('lang.address')}}" value="{{$data->address}}" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">{{trans('employee.birth_date')}}</label>
                            <div class="col-lg-8 fv-row">
                                <input type="date" name="birth_date" placeholder="{{trans('employee.birth_date')}}" value="{{$data->birth_date}}" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label required text-info fw-semibold fs-6">{{trans('employee.gender')}} </label>
                            <div class="col-lg-8 fv-row">
                                <select   data-placeholder="Select an option" class=" input-text form-control  form-select  mb-3 mb-lg-0"  name="gender">
                                    <option value="">{{trans('employee.gender')}}</option>
                                    <option value="0" @if($data->gender == '0') selected @endif>{{trans('employee.male')}}</option>
                                    <option value="1" @if($data->gender == '1') selected @endif>{{trans('employee.female')}}</option>
                                    <option value="2" @if($data->gender == '2') selected @endif>Other</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">{{trans('lang.marital_status')}} </label>
                            <div class="col-lg-8 fv-row">
                                <select   data-placeholder="Select an option" class=" input-text form-control  form-select  mb-3 mb-lg-0"  name="marital_status">
                                    <option value="0" @if($data->marital_status == '0') selected @endif>{{trans('lang.single')}}</option>
                                    <option value="1" @if($data->marital_status == '1') selected @endif>{{trans('lang.married')}}</option>
                                    <option value="2" @if($data->marital_status == '2') selected @endif>{{trans('lang.divorced')}}</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">{{trans('employee.email')}}</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="email" placeholder="{{trans('employee.email')}}" value="{{$data->email}}" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">{{trans('lang.website')}}</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="website" placeholder="{{trans('lang.website')}}" value="{{$data->website}}" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">{{trans('lang.note')}}</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="note" placeholder="{{trans('lang.note')}}" value="{{$data->note}}" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">{{trans('lang.description')}}</label>
                            <div class="col-lg-10 fv-row">
                                <textarea name="description" id="kt_docs_tinymce_basic">
                                </textarea>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">{{trans('lang.note')}}</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="note" placeholder="{{trans('lang.note')}}" value="{{$data->note}}" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                            </div>
                        </div>


                        <div class="row mb-0">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6"> {{trans('lang.status')}}</label>
                            <div class="col-lg-8 d-flex align-items-center">
                            <select   data-placeholder="Select an option" class=" input-text form-control  form-select  mb-3 mb-lg-0"  name="status">
                            <option value="0" @if($data->status == '0') selected @endif >{{trans('employee.active')}}</option>
                            <option value="1" @if($data->status == '1') selected @endif >{{trans('employee.notactive')}}</option>                                   
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

<script src="{{ URL::asset('dash/assets/plugins/custom/tinymce/tinymce.bundle.js')}}"></script>

<script>
    var options = {selector: "#kt_docs_tinymce_basic,#kt_docs_tinymce_basic2,#kt_docs_tinymce_basic3,#kt_docs_tinymce_basic4"};

    tinymce.init(options);

</script>
@endsection