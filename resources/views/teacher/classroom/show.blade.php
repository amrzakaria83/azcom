@extends('teacher.layout.master')
@php
    $route = 'teacher.classrooms';
    $viewPath = 'teacher.classroom';
@endphp

@section('css')
    <link href="{{asset('dash/assets/plugins/custom/datatables/datatables.bundle.rtl.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('dash/assets/plugins/custom/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('dash/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('style')
    <style>
        .fc .fc-popover {
            background: #ffffff;
        }
    </style>
@endsection

@section('breadcrumb')
<div class="d-flex align-items-center" id="kt_header_nav">
    <!--begin::Page title-->
    <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_header_nav'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
        <a  href="{{url('/teacher')}}">
            <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">
                {{trans('lang.dashboard')}}
            </h1>
        </a>
        <span class="h-20px border-gray-300 border-start mx-4"></span>
        <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
            <li class="breadcrumb-item text-muted px-2">
                <a  href="#" class="text-muted text-hover-primary">{{trans('lang.classrooms')}}</a>
            </li>
            {{-- <li class="breadcrumb-item">
                <span class="bullet bg-gray-300 w-5px h-2px"></span>
            </li> --}}
            
        </ul>
    </div>
    <!--end::Page title-->
</div>
@endsection

@section('content')
    <!--begin::Container-->
    <div id="kt_app_content_container" class="app-container container-fluid">
        <div class="card-body">

            <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x border-transparent fs-4 fw-semibold mb-15">
                <!--begin:::Tab item-->
                <li class="nav-item">
                    <a class="nav-link text-dark text-active-primary pb-5 active" data-bs-toggle="tab" href="#dailyreport">
                        <i class="las la-comment text-primary fs-3"></i>
                        {{trans('classroom.archives')}}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark text-active-primary pb-5" onclick="copen()" data-bs-toggle="tab" href="#absence">
                        <i class="las la-hashtag text-primary fs-3"></i>
                        {{trans('classroom.absence')}}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark text-active-primary pb-5" data-bs-toggle="tab" href="#students">
                        <i class="las la-users text-primary fs-3"></i>
                        {{trans('lang.Students')}}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark text-active-primary pb-5" data-bs-toggle="tab" href="#schedules">
                        <i class="las la-image text-primary fs-3"></i>
                        {{trans('classroom.schedule')}}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark text-active-primary pb-5" data-bs-toggle="tab" href="#subjects">
                        <i class="las la-image text-primary fs-3"></i>
                        {{trans('lang.Subjects')}}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark text-active-primary pb-5" data-bs-toggle="tab" href="#teacher">
                        <i class="las la-map text-primary fs-3"></i>
                        {{trans('classroom.teachers')}}
                    </a>
                </li>
                <!--end:::Tab item-->
            </ul>
            <!--end:::Tabs-->
            <!--begin:::Tab content-->
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade" id="students" role="tabpanel">

                    <div class="card no-border">
                        <!--begin::Card header-->
                        <div class="card-header border-0">
                            <div class="card-toolbar">
                                <!--begin::Toolbar-->
                                <div class="d-flex justify-content-end dbuttons">
                                    <a href="{{route('teacher.classroomstudents.create', $data->id)}}" class="btn btn-sm btn-icon btn-primary btn-active-dark me-3 p-3">
                                        <i class="bi bi-plus-square fs-1x"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-icon btn-danger btn-active-dark me-3 p-3" id="btn_delete" data-token="{{ csrf_token() }}">
                                        <i class="bi bi-trash3-fill fs-1x"></i>
                                    </button>
                                </div>
                            </div>
                            <!--end::Card toolbar-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body">
                            <!--begin::Table-->
                            <table class="table align-middle table-rounded table-striped table-row-dashed fs-6" id="kt_datatable_table_student">
                                <!--begin::Table head-->
                                <thead class="bg-light-dark pe-3">
                                    <!--begin::Table row-->
                                    <tr class="text-start text-dark fw-bold fs-4 text-uppercase gs-0">
                                        <th class="w-10px p-3">
                                            <div class="form-check form-check-sm form-check-custom form-check-solid ">
                                                <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_datatable_table_student .form-check-input" value="1" />
                                            </div>
                                        </th>
                                        <th class="min-w-125px text-start">{{trans('classroom.name')}}</th>
                                        <th class="min-w-125px text-start">{{trans('classroom.phone')}}</th>
                                    </tr>
                                    <!--end::Table row-->
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody class="text-gray-600 fw-bold">
                                </tbody>
                                <!--end::Table body-->
                            </table>
                            <!--end::Table-->
                        </div>
                        <!--end::Card body-->

                    </div>
                </div>
                <div class="tab-pane fade" id="subjects" role="tabpanel">
                    <div class="card no-border">
                        <!--begin::Card header-->
                        <div class="card-header border-0">
                            <div class="card-toolbar">
                                <!--begin::Toolbar-->
                                <div class="d-flex justify-content-end dbuttonssubject">
                                    <button type="button" class="btn btn-sm btn-icon btn-primary btn-active-dark me-3 p-3" data-bs-toggle="modal" data-bs-target="#kt_modal_create_subject">
                                        <i class="bi bi-plus-square fs-1x"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-icon btn-danger btn-active-dark me-3 p-3" id="btn_delete_subject" data-token="{{ csrf_token() }}">
                                        <i class="bi bi-trash3-fill fs-1x"></i>
                                    </button>
                                </div>
                            </div>
                            <!--end::Card toolbar-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body">
                            <!--begin::Table-->
                            <table class="table align-middle table-rounded table-striped table-row-dashed fs-6" id="kt_datatable_table_subject">
                                <!--begin::Table head-->
                                <thead class="bg-light-dark pe-3">
                                    <!--begin::Table row-->
                                    <tr class="text-start text-dark fw-bold fs-4 text-uppercase gs-0">
                                        <th class="w-10px p-3">
                                            <div class="form-check form-check-sm form-check-custom form-check-solid ">
                                                <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_datatable_table_subject .form-check-input" value="1" />
                                            </div>
                                        </th>
                                        <th class="min-w-125px text-start">{{trans('classroom.subject')}}</th>
                                    </tr>
                                    <!--end::Table row-->
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody class="text-gray-600 fw-bold">
                                </tbody>
                                <!--end::Table body-->
                            </table>
                            <!--end::Table-->
                        </div>
                        <!--end::Card body-->

                    </div>

                    <div class="modal fade" id="kt_modal_create_subject" tabindex="-1" aria-hidden="true">
                        <!--begin::Modal dialog-->
                        <div class="modal-dialog modal-dialog-centered mw-650px">
                            <!--begin::Modal content-->
                            <div class="modal-content">
                                <!--begin::Modal header-->
                                <div class="modal-header" id="kt_modal_create_subject_header">
                                    <!--begin::Modal title-->
                                    <h2 class="fw-bold">{{trans('classroom.add_new')}}</h2>
                                    <!--end::Modal title-->
                                    <!--begin::Close-->
                                    <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                                        <span class="svg-icon svg-icon-1">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
                                                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </div>
                                    <!--end::Close-->
                                </div>
                                <!--end::Modal header-->
                                <!--begin::Modal body-->
                                <div class="modal-body scroll-y mx-5 mx-xl-15">
                                    <!--begin::Form-->
                                    <form action="{{route('teacher.classroomsubjects.store')}}" method="POST" enctype="multipart/form-data" id="kt_account_profile_details_form" class="form">
                                        @csrf
                                        <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">

                                            <input type="hidden" name="classroom_id" value="{{$data->id}}" />
                                            <div class="mb-6">
                                                <!--begin::Label-->
                                                <label class="col-lg-4 col-form-label fw-semibold fs-6"> {{trans('lang.Subjects')}} </label>
                                                <!--end::Label-->
                                                <div class="col-lg-8">
                                                    <select  data-control="select2" data-placeholder="Select an option" class=" input-text form-control  form-select  mb-3 mb-lg-0"  name="subject_id">
                                                        <option value="0">{{trans('classroom.choose')}}</option>
                                                        @foreach(\App\Models\Subject::all() as $subject)
                                                            <option @if(isset($data) && $data->subject_id == $subject->id) selected @endif value="{{$subject->id}}">
                                                                {{$subject->name}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <!--end::Input-->
                                            </div>

    
                                        </div>
    
                                        <div class="text-center pt-15">
                                            <button type="button" class="btn btn-light me-3" data-bs-dismiss="modal">{{trans('classroom.close')}}</button>
                                            <button type="submit" class="btn btn-primary" id="submit">
                                                <span class="indicator-label">{{trans('classroom.save')}}</span>
                                                <span class="indicator-progress">Please wait...
                                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                            </button>
                                        </div>
                                        <!--end::Actions-->
                                    </form>
                                    <!--end::Form-->
                                </div>
                                <!--end::Modal body-->
                            </div>
                            <!--end::Modal content-->
                        </div>
                        <!--end::Modal dialog-->
                    </div>
                </div>
                <div class="tab-pane fade" id="schedules" role="tabpanel">
                    <div class="card no-border">
                        <!--begin::Card header-->
                        <div class="card-header border-0">
                            <div class="card-toolbar">
                                <!--begin::Toolbar-->
                                <div class="d-flex justify-content-end dbuttonsschedule">
                                    <button type="button" class="btn btn-sm btn-icon btn-primary btn-active-dark me-3 p-3" data-bs-toggle="modal" data-bs-target="#kt_modal_create_schedule">
                                        <i class="bi bi-plus-square fs-1x"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-icon btn-danger btn-active-dark me-3 p-3" id="btn_delete_schedule" data-token="{{ csrf_token() }}">
                                        <i class="bi bi-trash3-fill fs-1x"></i>
                                    </button>
                                </div>
                            </div>
                            <!--end::Card toolbar-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body">
                            <!--begin::Table-->
                            <table class="table align-middle table-rounded table-striped table-row-dashed fs-6" id="kt_datatable_table_schedule">
                                <!--begin::Table head-->
                                <thead class="bg-light-dark pe-3">
                                    <!--begin::Table row-->
                                    <tr class="text-start text-dark fw-bold fs-4 text-uppercase gs-0">
                                        <th class="w-10px p-3">
                                            <div class="form-check form-check-sm form-check-custom form-check-solid ">
                                                <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_datatable_table_schedule .form-check-input" value="1" />
                                            </div>
                                        </th>
                                        <th class="min-w-125px text-start">{{trans('classroom.day')}}</th>
                                        <th class="min-w-125px text-start">{{trans('classroom.activity')}}</th>
                                        <th class="min-w-125px text-start">{{trans('classroom.from')}}</th>
                                        <th class="min-w-125px text-start">{{trans('classroom.to')}}</th>
                                    </tr>
                                    <!--end::Table row-->
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody class="text-gray-600 fw-bold">
                                </tbody>
                                <!--end::Table body-->
                            </table>
                            <!--end::Table-->
                        </div>
                        <!--end::Card body-->

                    </div>

                    <div class="modal fade" id="kt_modal_create_schedule" tabindex="-1" aria-hidden="true">
                        <!--begin::Modal dialog-->
                        <div class="modal-dialog modal-dialog-centered mw-650px">
                            <!--begin::Modal content-->
                            <div class="modal-content">
                                <!--begin::Modal header-->
                                <div class="modal-header" id="kt_modal_create_schedule_header">
                                    <!--begin::Modal title-->
                                    <h2 class="fw-bold">{{trans('classroom.add_new')}}</h2>
                                    <!--end::Modal title-->
                                    <!--begin::Close-->
                                    <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                                        <span class="svg-icon svg-icon-1">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
                                                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </div>
                                    <!--end::Close-->
                                </div>
                                <!--end::Modal header-->
                                <!--begin::Modal body-->
                                <div class="modal-body scroll-y mx-5 mx-xl-15">
                                    <!--begin::Form-->
                                    <form action="{{route('teacher.classroomschedules.store')}}" method="POST" enctype="multipart/form-data" id="kt_account_profile_details_form" class="form">
                                        @csrf
                                        <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">

                                            <input type="hidden" name="classroom_id" value="{{$data->id}}" />
                                            <div class="row mb-6">
                                                <!--begin::Label-->
                                                <label class="col-lg-2 col-form-label fw-semibold fs-6"> {{trans('classroom.day')}} </label>
                                                <!--end::Label-->
                                                <div class="col-lg-8 fv-row">
                                                    <select  data-control="select2" data-placeholder="Select an option" class=" input-text form-control  form-select  mb-3 mb-lg-0"  name="day">
                                                        <option value="">{{trans('classroom.choose')}}</option>
                                                        <option value="Saturday">Saturday</option>
                                                        <option value="Sunday">Sunday</option>
                                                        <option value="Monday">Monday</option>
                                                        <option value="Tuesday">Tuesday</option>
                                                        <option value="Wednesday">Wednesday</option>
                                                        <option value="Thursday">Thursday</option>
                                                        <option value="Friday">Friday</option>
                                                    </select>
                                                </div>
                                                <!--end::Input-->
                                            </div>

                                            <div class="row mb-6">
                                                <label class="col-lg-2 col-form-label required fw-semibold fs-6">{{trans('classroom.activity')}}</label>
                                                <div class="col-lg-8 fv-row">
                                                    <input type="text" name="name" placeholder="{{trans('classroom.activity')}}" value="" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                                                </div>
                                            </div>

                                            <div class="row mb-6">
                                                <label class="col-lg-2 col-form-label required fw-semibold fs-6">{{trans('classroom.from')}}</label>
                                                <div class="col-lg-8 fv-row">
                                                    <input type="time" name="from" placeholder="{{trans('classroom.from')}}" value="" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                                                </div>
                                            </div>

                                            <div class="row mb-6">
                                                <label class="col-lg-2 col-form-label required fw-semibold fs-6">{{trans('classroom.to')}}</label>
                                                <div class="col-lg-8 fv-row">
                                                    <input type="time" name="to" placeholder="{{trans('classroom.to')}}" value="" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                                                </div>
                                            </div>

    
                                        </div>
    
                                        <div class="text-center pt-15">
                                            <button type="button" class="btn btn-light me-3" data-bs-dismiss="modal">{{trans('classroom.close')}}</button>
                                            <button type="submit" class="btn btn-primary" id="submit">
                                                <span class="indicator-label">save</span>
                                                <span class="indicator-progress">Please wait...
                                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                            </button>
                                        </div>
                                        <!--end::Actions-->
                                    </form>
                                    <!--end::Form-->
                                </div>
                                <!--end::Modal body-->
                            </div>
                            <!--end::Modal content-->
                        </div>
                        <!--end::Modal dialog-->
                    </div>
                </div>
                <div class="tab-pane fade" id="teacher" role="tabpanel">

                    <div class="card no-border">
                        <!--begin::Card header-->
                        <div class="card-header border-0">
                            <div class="card-toolbar">
                                <!--begin::Toolbar-->
                                <div class="d-flex justify-content-end dbuttonsteacher">
                                    <button type="button" class="btn btn-sm btn-icon btn-danger btn-active-dark me-3 p-3" id="btn_delete_teacher" data-token="{{ csrf_token() }}">
                                        <i class="bi bi-trash3-fill fs-1x"></i>
                                    </button>
                                </div>
                            </div>
                            <!--end::Card toolbar-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body">
                            <!--begin::Table-->
                            <table class="table align-middle table-rounded table-striped table-row-dashed fs-6" id="kt_datatable_table_teacher">
                                <!--begin::Table head-->
                                <thead class="bg-light-dark pe-3">
                                    <!--begin::Table row-->
                                    <tr class="text-start text-dark fw-bold fs-4 text-uppercase gs-0">
                                        <th class="w-10px p-3">
                                            <div class="form-check form-check-sm form-check-custom form-check-solid ">
                                                <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_datatable_table_teacher .form-check-input" value="1" />
                                            </div>
                                        </th>
                                        <th class="min-w-125px text-start">{{trans('classroom.name')}}</th>
                                        <th class="min-w-125px text-start">{{trans('classroom.job_title')}}</th>
                                        <th class="min-w-125px text-start">{{trans('classroom.phone')}}</th>
                                    </tr>
                                    <!--end::Table row-->
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody class="text-gray-600 fw-bold">
                                </tbody>
                                <!--end::Table body-->
                            </table>
                            <!--end::Table-->
                        </div>
                        <!--end::Card body-->

                    </div>

                </div>
                <div class="tab-pane fade show active" id="dailyreport" role="tabpanel">
                    <div class="card no-border">
                        <!--begin::Card header-->
                        <div class="card-header border-0">
                            <div class="card-toolbar">
                                <!--begin::Toolbar-->
                                <div class="d-flex justify-content-end dbuttonsdailyreport">
                                    <button type="button" class="btn btn-sm btn-icon btn-primary btn-active-dark me-3 p-3" data-bs-toggle="modal" data-bs-target="#kt_modal_create_dailyreport">
                                        <i class="bi bi-plus-square fs-1x"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-icon btn-danger btn-active-dark me-3 p-3" id="btn_delete_dailyreport" data-token="{{ csrf_token() }}">
                                        <i class="bi bi-trash3-fill fs-1x"></i>
                                    </button>
                                </div>
                            </div>
                            <!--end::Card toolbar-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body">
                            <!--begin::Table-->
                            <table class="table align-middle table-rounded table-striped table-row-dashed fs-6" id="kt_datatable_table_dailyreport">
                                <!--begin::Table head-->
                                <thead class="bg-light-dark pe-3">
                                    <!--begin::Table row-->
                                    <tr class="text-start text-dark fw-bold fs-4 text-uppercase gs-0">
                                        <th class="w-10px p-3">
                                            <div class="form-check form-check-sm form-check-custom form-check-solid ">
                                                <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_datatable_table_dailyreport .form-check-input" value="1" />
                                            </div>
                                        </th>
                                        <th class="min-w-125px text-start">{{trans('classroom.date')}}</th>
                                        <th class="min-w-125px text-start">{{trans('classroom.title')}}</th>
                                        <th class="min-w-125px text-start">{{trans('classroom.subject')}}</th>
                                        <th class="min-w-125px text-start">{{trans('classroom.link')}}</th>
                                    </tr>
                                    <!--end::Table row-->
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody class="text-gray-600 fw-bold">
                                </tbody>
                                <!--end::Table body-->
                            </table>
                            <!--end::Table-->
                        </div>
                        <!--end::Card body-->

                    </div>

                    <div class="modal fade" id="kt_modal_create_dailyreport" tabindex="-1" aria-hidden="true">
                        <!--begin::Modal dialog-->
                        <div class="modal-dialog modal-dialog-centered mw-650px">
                            <!--begin::Modal content-->
                            <div class="modal-content">
                                <!--begin::Modal header-->
                                <div class="modal-header" id="kt_modal_create_dailyreport_header">
                                    <!--begin::Modal title-->
                                    <h2 class="fw-bold">{{trans('classroom.add_new')}}</h2>
                                    <!--end::Modal title-->
                                    <!--begin::Close-->
                                    <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                                        <span class="svg-icon svg-icon-1">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
                                                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </div>
                                    <!--end::Close-->
                                </div>
                                <!--end::Modal header-->
                                <!--begin::Modal body-->
                                <div class="modal-body scroll-y mx-5 mx-xl-15">
                                    <!--begin::Form-->
                                    <form action="{{route('teacher.dailyreports.store')}}" method="POST" enctype="multipart/form-data" id="kt_account_profile_details_form" class="form">
                                        @csrf
                                        <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">

                                            <input type="hidden" name="classroom_id" value="{{$data->id}}" />

                                            <div class="mb-6">
                                                <label class="col-lg-4 col-form-label fw-semibold fs-6">{{trans('classroom.file')}}</label>
                                                <div class="col-lg-8">

                                                    <input type="file" name="photo" accept=".png, .jpg, .jpeg, .mp4, .pdf, .docx" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                                                    <div class="form-text">{{trans('classroom.photo_type')}} png, jpg, jpeg, mp4.</div>
                                                </div>
                                            </div>

                                            <div class="mb-6">
                                                <label class="col-lg-4 col-form-label required fw-semibold fs-6">{{trans('classroom.date')}} </label>
                                                <div class="col-lg-8">
                                                    <input type="date" name="date" value="{{date('Y-m-d')}}" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                                                </div>
                                            </div>

                                            <div class="mb-6">
                                                <label class="col-lg-4 col-form-label required fw-semibold fs-6">{{trans('classroom.title')}}</label>
                                                <div class="col-lg-8">
                                                    <input type="text" name="name" placeholder="{{trans('classroom.title')}}" value="" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                                                </div>
                                            </div>

                                            <div class="mb-6">
                                                <!--begin::Label-->
                                                <label class="col-lg-4 col-form-label fw-semibold fs-6"> {{trans('classroom.subject')}} </label>
                                                <!--end::Label-->
                                                <div class="col-lg-8">
                                                    <select  data-control="select2" data-placeholder="{{trans('classroom.choose')}}" class=" input-text form-control  form-select  mb-3 mb-lg-0"  name="subject_id">
                                                        <option value="">عـام</option>
                                                        @foreach(\App\Models\ClassroomSubject::where('classroom_id', $data->id)->with('subject')->get() as $subject)
                                                            <option @if(isset($data) && $data->subject_id == $subject->subject->id) selected @endif value="{{$subject->subject->id}}">
                                                                {{$subject->subject->name}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <!--end::Input-->
                                            </div>

    
                                        </div>
    
                                        <div class="text-center pt-15">
                                            <button type="button" class="btn btn-light me-3" data-bs-dismiss="modal">{{trans('classroom.close')}}</button>
                                            <button type="submit" class="btn btn-primary" id="submit">
                                                <span class="indicator-label">{{trans('classroom.save')}}</span>
                                                <span class="indicator-progress">Please wait...
                                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                            </button>
                                        </div>
                                        <!--end::Actions-->
                                    </form>
                                    <!--end::Form-->
                                </div>
                                <!--end::Modal body-->
                            </div>
                            <!--end::Modal content-->
                        </div>
                        <!--end::Modal dialog-->
                    </div>
                </div>
                <div class="tab-pane fade " id="absence" role="tabpanel">
                    <div id="kt_docs_fullcalendar_selectable"></div>

                    <div class="modal fade" id="kt_modal_create_absence" tabindex="-1" aria-hidden="true">
                        <!--begin::Modal dialog-->
                        <div class="modal-dialog modal-dialog-centered mw-650px">
                            <!--begin::Modal content-->
                            <div class="modal-content">
                                <!--begin::Modal header-->
                                <div class="modal-header" id="kt_modal_create_absence_header">
                                    <!--begin::Modal title-->
                                    <h2 class="fw-bold">{{trans('classroom.add_new')}}</h2>
                                    <!--end::Modal title-->
                                    <!--begin::Close-->
                                    <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                                        <span class="svg-icon svg-icon-1">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
                                                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </div>
                                    <!--end::Close-->
                                </div>
                                <!--end::Modal header-->
                                <!--begin::Modal body-->
                                <div class="modal-body scroll-y mx-5 mx-xl-15">
                                    <!--begin::Form-->
                                    <form action="{{route('teacher.absences.store')}}" method="POST" enctype="multipart/form-data" id="kt_account_profile_details_form" class="form">
                                        @csrf
                                        <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">

                                            <input type="hidden" name="classroom_id" value="{{$data->id}}" />
                                            <input type="hidden" name="date" value="" id="absencedate" />
                                            <div class="mb-6">
                                                <!--begin::Label-->
                                                <label class="col-lg-4 col-form-label fw-semibold fs-6"> {{trans('lang.Students')}} </label>
                                                <!--end::Label-->
                                                <div class="col-lg-8">
                                                    <select  data-control="select2" data-placeholder="{{trans('classroom.choose')}}" class=" input-text form-control  form-select  mb-3 mb-lg-0" multiple name="student_id[]">
                                                        @foreach(\App\Models\ClassroomStudent::where('classroom_id', $data->id)->get() as $student)
                                                            <option value="{{$student->student->id}}">
                                                                {{$student->student->name}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <!--end::Input-->
                                            </div>

    
                                        </div>
    
                                        <div class="text-center pt-15">
                                            <button type="button" class="btn btn-light me-3" data-bs-dismiss="modal">{{trans('classroom.close')}}</button>
                                            <button type="submit" class="btn btn-primary" id="submit">
                                                <span class="indicator-label">{{trans('classroom.save')}}</span>
                                                <span class="indicator-progress">Please wait...
                                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                            </button>
                                        </div>
                                        <!--end::Actions-->
                                    </form>
                                    <!--end::Form-->
                                </div>
                                <!--end::Modal body-->
                            </div>
                            <!--end::Modal content-->
                        </div>
                        <!--end::Modal dialog-->
                    </div>
                </div>
            </div>

        </div>
        
    </div>
    <!--end::Container-->
@endsection

@section('script')
<script src="{{asset('dash/assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
<script src="{{asset('dash/assets/plugins/custom/datatables/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('dash/assets/plugins/custom/datatables/buttons.print.min.js')}}"></script>
<script src="{{asset('dash/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js')}}"></script>

<script>

    $(function () {
        
        ///////////// Students javascript  /////////////
        var table = $('#kt_datatable_table_student').DataTable({
            processing: false,
            serverSide: true,
            searching: false,
            autoWidth: false,
            responsive: true,
            pageLength: 10,
            sort: false,
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'excel',
                    className: 'btn btn-sm btn-icon btn-success btn-active-dark me-3 p-3',
                    text: '<i class="bi bi-file-earmark-spreadsheet fs-1x"></i>'
                }
            ],
            ajax: {
                url: "{{ route('teacher.classroomstudents.index') }}",
                data: function (d) {
                    d.classroom_id= '{{$data->id}}'
                }
            },
            columns: [
                {data: 'checkbox', name: 'checkbox'},
                {data: 'student', name: 'student'},
                {data: 'phone', name: 'phone'},
            ]
        });

        table.buttons().container().appendTo($('.dbuttons'));

        $("#btn_delete").click(function(event){
            event.preventDefault();
            var checkIDs = $("#kt_datatable_table_student input:checkbox:checked").map(function(){
            return $(this).val();
            }).get(); // <----

            if (checkIDs.length > 0) {
                var token = $(this).data("token");
                
                Swal.fire({
                    title: 'هل انت متأكد ؟',
                    text: "لا يمكن استرجاع البيانات المحذوفه",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger m-l-10',
                    confirmButtonText: 'موافق',
                    cancelButtonText: 'لا'
                }).then(function (isConfirm) {
                    if (isConfirm.value) {
                        $.ajax(
                        {
                            url: "{{route('teacher.classroomstudents.delete')}}",
                            type: 'post',
                            dataType: "JSON",
                            data: {
                                "id": checkIDs,
                                "_method": 'post',
                                "_token": token,
                            },
                            success: function (data) {
                                if(data.message == "success") {
                                    table.draw();
                                    toastr.success("", "تم الحذف بنجاح");
                                } else {
                                    toastr.success("", "عفوا لم يتم الحذف");
                                }
                            },
                            fail: function(xhrerrorThrown){
                                toastr.success("", "عفوا لم يتم الحذف");
                            }
                        });
                    } else {
                        console.log(isConfirm);
                    }
                });
            } else {
                toastr.error("", "حدد العناصر اولا");
            }        

        });

        ///////////// Subjects javascript /////////////
        var tableSubject = $('#kt_datatable_table_subject').DataTable({
            processing: false,
            serverSide: true,
            searching: false,
            autoWidth: false,
            responsive: true,
            pageLength: 10,
            sort: false,
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'excel',
                    className: 'btn btn-sm btn-icon btn-success btn-active-dark me-3 p-3',
                    text: '<i class="bi bi-file-earmark-spreadsheet fs-1x"></i>'
                }
            ],
            ajax: {
                url: "{{ route('teacher.classroomsubjects.index') }}",
                data: function (d) {
                    d.classroom_id= '{{$data->id}}'
                }
            },
            columns: [
                {data: 'checkbox', name: 'checkbox'},
                {data: 'subject', name: 'subject'},
            ]
        });

        tableSubject.buttons().container().appendTo($('.dbuttonssubject'));

        $("#btn_delete_subject").click(function(event){
            event.preventDefault();
            var checkIDsSubject = $("#kt_datatable_table_subject input:checkbox:checked").map(function(){
            return $(this).val();
            }).get(); // <----

            if (checkIDsSubject.length > 0) {
                var token = $(this).data("token");
                
                Swal.fire({
                    title: 'هل انت متأكد ؟',
                    text: "لا يمكن استرجاع البيانات المحذوفه",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger m-l-10',
                    confirmButtonText: 'موافق',
                    cancelButtonText: 'لا'
                }).then(function (isConfirm) {
                    if (isConfirm.value) {
                        $.ajax(
                        {
                            url: "{{route('teacher.classroomsubjects.delete')}}",
                            type: 'post',
                            dataType: "JSON",
                            data: {
                                "id": checkIDsSubject,
                                "_method": 'post',
                                "_token": token,
                            },
                            success: function (data) {
                                if(data.message == "success") {
                                    tableSubject.draw();
                                    toastr.success("", "تم الحذف بنجاح");
                                } else {
                                    toastr.success("", "عفوا لم يتم الحذف");
                                }
                            },
                            fail: function(xhrerrorThrown){
                                toastr.success("", "عفوا لم يتم الحذف");
                            }
                        });
                    } else {
                        console.log(isConfirm);
                    }
                });
            } else {
                toastr.error("", "حدد العناصر اولا");
            }        

        });

        ///////////// Schedule javascript /////////////
        var tableSubject = $('#kt_datatable_table_schedule').DataTable({
            processing: false,
            serverSide: true,
            searching: false,
            autoWidth: false,
            responsive: true,
            pageLength: 10,
            sort: false,
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'excel',
                    className: 'btn btn-sm btn-icon btn-success btn-active-dark me-3 p-3',
                    text: '<i class="bi bi-file-earmark-spreadsheet fs-1x"></i>'
                }
            ],
            ajax: {
                url: "{{ route('teacher.classroomschedules.index') }}",
                data: function (d) {
                    d.classroom_id= '{{$data->id}}'
                }
            },
            columns: [
                {data: 'checkbox', name: 'checkbox'},
                {data: 'day', name: 'day'},
                {data: 'activity', name: 'activity'},
                {data: 'from', name: 'from'},
                {data: 'to', name: 'to'},
            ]
        });

        tableSubject.buttons().container().appendTo($('.dbuttonsschedule'));

        $("#btn_delete_schedule").click(function(event){
            event.preventDefault();
            var checkIDsSubject = $("#kt_datatable_table_schedule input:checkbox:checked").map(function(){
            return $(this).val();
            }).get(); // <----

            if (checkIDsSubject.length > 0) {
                var token = $(this).data("token");
                
                Swal.fire({
                    title: 'هل انت متأكد ؟',
                    text: "لا يمكن استرجاع البيانات المحذوفه",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger m-l-10',
                    confirmButtonText: 'موافق',
                    cancelButtonText: 'لا'
                }).then(function (isConfirm) {
                    if (isConfirm.value) {
                        $.ajax(
                        {
                            url: "{{route('teacher.classroomschedules.delete')}}",
                            type: 'post',
                            dataType: "JSON",
                            data: {
                                "id": checkIDsSubject,
                                "_method": 'post',
                                "_token": token,
                            },
                            success: function (data) {
                                if(data.message == "success") {
                                    tableSubject.draw();
                                    toastr.success("", "تم الحذف بنجاح");
                                } else {
                                    toastr.success("", "عفوا لم يتم الحذف");
                                }
                            },
                            fail: function(xhrerrorThrown){
                                toastr.success("", "عفوا لم يتم الحذف");
                            }
                        });
                    } else {
                        console.log(isConfirm);
                    }
                });
            } else {
                toastr.error("", "حدد العناصر اولا");
            }        

        });

        ///////////// Teachers javascript  /////////////
        var tableTeacher = $('#kt_datatable_table_teacher').DataTable({
            processing: false,
            serverSide: true,
            searching: false,
            autoWidth: false,
            responsive: true,
            pageLength: 10,
            sort: false,
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'excel',
                    className: 'btn btn-sm btn-icon btn-success btn-active-dark me-3 p-3',
                    text: '<i class="bi bi-file-earmark-spreadsheet fs-1x"></i>'
                }
            ],
            ajax: {
                url: "{{ route('teacher.classroomteachers.index') }}",
                data: function (d) {
                    d.classroom_id= '{{$data->id}}'
                }
            },
            columns: [
                {data: 'checkbox', name: 'checkbox'},
                {data: 'teacher', name: 'teacher'},
                {data: 'job_title', name: 'job_title'},
                {data: 'phone', name: 'phone'},
            ]
        });

        tableTeacher.buttons().container().appendTo($('.dbuttonsteacher'));

        $("#btn_delete_teacher").click(function(event){
            event.preventDefault();
            var checkIDsTreacher = $("#kt_datatable_table_teacher input:checkbox:checked").map(function(){
            return $(this).val();
            }).get(); // <----

            if (checkIDsTreacher.length > 0) {
                var token = $(this).data("token");
                
                Swal.fire({
                    title: 'هل انت متأكد ؟',
                    text: "لا يمكن استرجاع البيانات المحذوفه",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger m-l-10',
                    confirmButtonText: 'موافق',
                    cancelButtonText: 'لا'
                }).then(function (isConfirm) {
                    if (isConfirm.value) {
                        $.ajax(
                        {
                            url: "{{route('teacher.classroomteachers.delete')}}",
                            type: 'post',
                            dataType: "JSON",
                            data: {
                                "id": checkIDsTreacher,
                                "_method": 'post',
                                "_token": token,
                            },
                            success: function (data) {
                                if(data.message == "success") {
                                    tableTeacher.draw();
                                    toastr.success("", "تم الحذف بنجاح");
                                } else {
                                    toastr.success("", "عفوا لم يتم الحذف");
                                }
                            },
                            fail: function(xhrerrorThrown){
                                toastr.success("", "عفوا لم يتم الحذف");
                            }
                        });
                    } else {
                        console.log(isConfirm);
                    }
                });
            } else {
                toastr.error("", "حدد العناصر اولا");
            }        

        });


        ///////////// Daily Reports javascript /////////////
        var tableDailyreport = $('#kt_datatable_table_dailyreport').DataTable({
            processing: false,
            serverSide: true,
            searching: false,
            autoWidth: false,
            responsive: true,
            pageLength: 10,
            sort: false,
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'excel',
                    className: 'btn btn-sm btn-icon btn-success btn-active-dark me-3 p-3',
                    text: '<i class="bi bi-file-earmark-spreadsheet fs-1x"></i>'
                }
            ],
            ajax: {
                url: "{{ route('teacher.dailyreports.index') }}",
                data: function (d) {
                    d.classroom_id= '{{$data->id}}'
                }
            },
            columns: [
                {data: 'checkbox', name: 'checkbox'},
                {data: 'date', name: 'date'},
                {data: 'name', name: 'name'},
                {data: 'subject', name: 'subject'},
                {data: 'link', name: 'link'},
            ]
        });

        tableDailyreport.buttons().container().appendTo($('.dbuttonsdailyreport'));

        $("#btn_delete_dailyreport").click(function(event){
            event.preventDefault();
            var checkIDsDailyReport = $("#kt_datatable_table_dailyreport input:checkbox:checked").map(function(){
            return $(this).val();
            }).get(); // <----

            if (checkIDsDailyReport.length > 0) {
                var token = $(this).data("token");
                
                Swal.fire({
                    title: 'هل انت متأكد ؟',
                    text: "لا يمكن استرجاع البيانات المحذوفه",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger m-l-10',
                    confirmButtonText: 'موافق',
                    cancelButtonText: 'لا'
                }).then(function (isConfirm) {
                    if (isConfirm.value) {
                        $.ajax(
                        {
                            url: "{{route('teacher.dailyreports.delete')}}",
                            type: 'post',
                            dataType: "JSON",
                            data: {
                                "id": checkIDsDailyReport,
                                "_method": 'post',
                                "_token": token,
                            },
                            success: function (data) {
                                if(data.message == "success") {
                                    tableDailyreport.draw();
                                    toastr.success("", "تم الحذف بنجاح");
                                } else {
                                    toastr.success("", "عفوا لم يتم الحذف");
                                }
                            },
                            fail: function(xhrerrorThrown){
                                toastr.success("", "عفوا لم يتم الحذف");
                            }
                        });
                    } else {
                        console.log(isConfirm);
                    }
                });
            } else {
                toastr.error("", "حدد العناصر اولا");
            }        

        });
       
    });

    ///////////// Absence javascript /////////////
    function copen() {
        var absences = '{{$absence}}';

        var calendarEl = document.getElementById("kt_docs_fullcalendar_selectable");

        var calendar = new FullCalendar.Calendar(calendarEl, {
            headerToolbar: {
                left: "prev,next today",
                center: "title",
                right: "dayGridMonth,timeGridWeek,timeGridDay"
            },
            initialDate: "{{date('Y-m-d')}}",
            locale: "{{App::getLocale()}}",
            navLinks: true, // can click day/week names to navigate views
            selectable: true,
            selectMirror: true,

            // Create new event
            select: function (arg) {
                $('#kt_modal_create_absence').modal('show');
                $('#absencedate').val(arg.end.toUTCString());
            },

            // Delete event
            eventClick: function (arg) {
                $('.fc-popover-close').click();

                Swal.fire({
                    text: "هل انت متأكد من حذف غياب الطالب ؟",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "تأكيد, الحذف !",
                    cancelButtonText: "لا",
                    customClass: {
                        confirmButton: "btn btn-primary",
                        cancelButton: "btn btn-active-light"
                    }
                }).then(function (result) {
                    if (result.value) {
                        arg.event.remove();
                        $.ajax(
                        {
                            url: "{{route('teacher.absences.delete')}}",
                            type: 'post',
                            dataType: "JSON",
                            data: {
                                "id": [arg.event.id],
                                "_method": 'post',
                                "_token": '{{ csrf_token() }}',
                            },
                            success: function (data) {
                                if(data.message == "success") {
                                    tableDailyreport.draw();
                                    toastr.success("", "تم الحذف بنجاح");
                                } else {
                                    toastr.success("", "عفوا لم يتم الحذف");
                                }
                            },
                            fail: function(xhrerrorThrown){
                                toastr.success("", "عفوا لم يتم الحذف");
                            }
                        });
                    } else if (result.dismiss === "cancel") {

                    }
                });
            },
            editable: true,
            dayMaxEvents: true, // allow "more" link when too many events
            events: JSON.parse(absences.replace(/&quot;/g,'"'))
        });

        calendar.render();
    
    }

</script>
@endsection