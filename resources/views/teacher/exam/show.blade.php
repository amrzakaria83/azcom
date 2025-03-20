@extends('teacher.layout.master')

@php
    $route = 'teacher.exams';
    $viewPath = 'teacher.exam';
@endphp

@section('css')
    
@endsection

@section('style')
<style>
    @media print {
        #kt_app_header {
            display: none !important;
        }
        .hide {
            display: none !important;
        }
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
                <a  href="{{route($route. '.index')}}" class="text-muted text-hover-primary">{{trans('lang.exams')}}</a>
            </li>
            <li class="breadcrumb-item">
                <span class="bullet bg-gray-300 w-5px h-2px"></span>
            </li>
            <li class="breadcrumb-item text-muted px-2">
                {{trans('exam.answer')}}  
            </li>
        </ul>
    </div>
    <!--end::Page title-->
</div>
@endsection

@section('content')

<div id="kt_app_content_container" class="app-container container-fluid">
    <div class="card">
        <!--begin::Card body-->
        <div class="card-body">
            <!--begin::Layout-->
            <div class="d-flex flex-column flex-xl-row p-7">
                <!--begin::Content-->
                <div class="flex-lg-row-fluid me-xl-15 mb-20 mb-xl-0">
                    <!--begin::Tickets-->
                    <div class="mb-0">

                        <h1 class="text-dark mb-10">{{$data->name}}</h1>

                        <div class="mb-10">
                            <!--begin::Ticket-->
                            @foreach ($data->questions as $question)
                                <div class="d-flex mb-10">
                                    <span class="svg-icon svg-icon-2x me-5 ms-n1 mt-2 svg-icon-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-question-square-fill" viewBox="0 0 16 16">
                                            <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm3.496 6.033a.237.237 0 0 1-.24-.247C5.35 4.091 6.737 3.5 8.005 3.5c1.396 0 2.672.73 2.672 2.24 0 1.08-.635 1.594-1.244 2.057-.737.559-1.01.768-1.01 1.486v.105a.25.25 0 0 1-.25.25h-.81a.25.25 0 0 1-.25-.246l-.004-.217c-.038-.927.495-1.498 1.168-1.987.59-.444.965-.736.965-1.371 0-.825-.628-1.168-1.314-1.168-.803 0-1.253.478-1.342 1.134-.018.137-.128.25-.266.25h-.825zm2.325 6.443c-.584 0-1.009-.394-1.009-.927 0-.552.425-.94 1.01-.94.609 0 1.028.388 1.028.94 0 .533-.42.927-1.029.927"/>
                                        </svg>
                                    </span>
                                    <div class="d-flex flex-column">
                                        <div class="d-flex align-items-center mb-2">
                                            <a href="Javascript:;" class="text-dark text-hover-primary fs-4 me-3 mb-5 fw-semibold">{{$question->question->name}}</a>
                                        </div>

                                        @foreach ($question->question->answers as $answer)
                                            <span class="text-muted mb-3 fw-semibold fs-6">
                                                @if ($answer->is_correct == 'correct')
                                                    <span class="svg-icon svg-icon-1x me-2 ms-n1 mt-2 svg-icon-success">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                                          </svg>
                                                    </span>
                                                @else
                                                    <span class="svg-icon svg-icon-1x me-2 ms-n1 mt-2 svg-icon-danger">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dash-circle" viewBox="0 0 16 16">
                                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                                            <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8"/>
                                                        </svg>    
                                                    </span>
                                                @endif
                                                
                                                {{$answer->name}}
                                            </span>
                                        @endforeach
                                        

                                    </div>
                                </div>
                            @endforeach
                            <!--end::Ticket-->
                        </div>

                    </div>
                    <!--end::Tickets-->
                </div>
                <!--end::Content-->
                <!--begin::Sidebar-->
                <div class="flex-column flex-lg-row-auto w-100 mw-lg-300px mw-xxl-350px">
                    <div class="card-rounded bg-primary bg-opacity-5 p-10 mb-15">

                        <h2 class="text-dark fw-bold mb-11">{{trans('exam.additional_info')}}</h2>

                        <div class="d-flex align-items-center mb-10">
                            <!--begin::Icon-->
                            <i class="bi bi-stopwatch-fill text-primary fs-1 me-5"></i>
                            <!--end::SymIconbol-->
                            <!--begin::Info-->
                            <div class="d-flex flex-column">
                                <h5 class="text-gray-800 fw-bold">{{$data->duration}}</h5>
                                <!--begin::Section-->
                                <div class="fw-semibold">
                                    <!--begin::Desc-->
                                    <span class="text-muted">{{trans('exam.duration')}}</span>
                                    <!--end::Desc-->
                                </div>
                                <!--end::Section-->
                            </div>
                            <!--end::Info-->
                        </div>

                        <div class="d-flex align-items-center mb-10">
                            <!--begin::Icon-->
                            <i class="bi bi-eye-fill text-primary fs-1 me-5"></i>
                            <!--end::SymIconbol-->
                            <!--begin::Info-->
                            <div class="d-flex flex-column">
                                <h5 class="text-gray-800 fw-bold">
                                    @if ($data->is_active == 1)
                                            {{trans('exam.active')}}
                                        @else
                                            {{trans('exam.notactive')}}
                                        @endif
                                </h5>
                                <!--begin::Section-->
                                <div class="fw-semibold">
                                    <!--begin::Desc-->
                                    <span class="text-muted">
                                        {{trans('exam.is_active')}}
                                    </span>
                                    <!--end::Desc-->
                                </div>
                                <!--end::Section-->
                            </div>
                            <!--end::Info-->
                        </div>
                        
                        <div class="d-flex align-items-center mb-10">
                            <!--begin::Icon-->
                            <i class="bi bi-briefcase-fill text-primary fs-1 me-5"></i>
                            <!--end::SymIconbol-->
                            <!--begin::Info-->
                            <div class="d-flex flex-column">
                                <h5 class="text-gray-800 fw-bold">{{$data->classroom->name}}</h5>
                                <!--begin::Section-->
                                <div class="fw-semibold">
                                    <!--begin::Desc-->
                                    <span class="text-muted">{{trans('exam.classroom')}}</span>
                                    <!--end::Desc-->
                                </div>
                                <!--end::Section-->
                            </div>
                            <!--end::Info-->
                        </div>

                        <div class="d-flex align-items-center mb-10">
                            <!--begin::Icon-->
                            <i class="bi bi-thermometer-high text-primary fs-1 me-5"></i>
                            <!--end::SymIconbol-->
                            <!--begin::Info-->
                            <div class="d-flex flex-column">
                                <h5 class="text-gray-800 fw-bold">{{$data->subject->name}}</h5>
                                <!--begin::Section-->
                                <div class="fw-semibold">
                                    <!--begin::Desc-->
                                    <span class="text-muted">{{trans('exam.subject')}}</span>
                                    <!--end::Desc-->
                                </div>
                                <!--end::Section-->
                            </div>
                            <!--end::Info-->
                        </div>

                        <div class="d-flex align-items-center mb-10">
                            <!--begin::Icon-->
                            <i class="bi bi-pass-fill text-primary fs-1 me-5"></i>
                            <!--end::SymIconbol-->
                            <!--begin::Info-->
                            <div class="d-flex flex-column">
                                <h5 class="text-gray-800 fw-bold">{{$data->results->count()}}</h5>
                                <!--begin::Section-->
                                <div class="fw-semibold">
                                    <!--begin::Desc-->
                                    <span class="text-muted">{{trans('exam.count_student')}}</span>
                                    <!--end::Desc-->
                                </div>
                                <!--end::Section-->
                            </div>
                            <!--end::Info-->
                        </div>

                        <div class="d-flex align-items-center mb-10 hide">
                            <a class="btn btn-primary msgadd" href="javascript:;" onclick="window.print()">{{trans('exam.print')}}</a>
                        </div>
                    </div>
                </div>
                <!--end::Sidebar-->
            </div>
            <!--end::Layout-->
        </div>
        <!--end::Card body-->
    </div>
</div>

@endsection

@section('script')
@endsection