@extends('teacher.layout.master')

@php
    $route = 'teacher.exams';
    $viewPath = 'teacher.exam';
@endphp

@section('css')
<link href="{{ URL::asset('dash/assets/css/timepicker.min.css')}}" rel="stylesheet"/>
@endsection

@section('style')
    
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
                <a  href="{{route($route. '.index')}}" class="text-muted text-hover-primary">{{trans('lang.exams')}}</a>
            </li>
            <li class="breadcrumb-item">
                <span class="bullet bg-gray-300 w-5px h-2px"></span>
            </li>
            <li class="breadcrumb-item text-muted px-2">
                {{trans('exam.add_new')}}  
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
                <form action="{{route($route. '.store')}}" method="POST" enctype="multipart/form-data" id="kt_account_profile_details_form" class="form">
                    @csrf

                    <!--begin::Card body-->
                    <div class="card-body border-top p-9">

                        @include($viewPath. '.form')

                    </div>

                    <div class="card-footer d-flex justify-content-end py-6 px-9">
                        <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">{{trans('exam.save')}} </button>
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
    $('.subject').click(function(){
        var class_id = $('.classroom').val() ;

        if(!class_id){
            toastr.error("", "عفوا اختر فصل اولا");
        }
    });
    $('.classroom').change(function(){
        var class_id = $(this).val() ;

        if(class_id){
            $.ajax({
            type:"get",
            url:"{{url('/')}}"+"/teacher/classroomsubjects/show/"+class_id+"/",
            success:function(res)
            {    
                $('.subject').empty();
                $(".subject").append('<option value="0">اختر ماده</option>');
                if(res)
                {
                    $.each(res,function(key,value){
                        $('.subject').append($("<option/>", {
                        value: value.subject.id,
                        text: value.subject.name
                        }));
                    });
                }
            }

            });
        } else {
            toastr.error("", "عفوا اختر فصل اولا");
        }
    });
</script>
@endsection