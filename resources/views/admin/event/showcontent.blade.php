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
                <a  href="{{route('admin.visits.index')}}" class="text-muted text-hover-primary">{{trans('lang.type_type')}} {{trans('lang.visit')}}</a>
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
                
                    <!--begin::Card body-->
                    <div class="card-body border-top p-9">

                            <div class="row mb-6">
                                <h1>
                                    <span>{{$data->name_en}}</span> - 
                                    <span>{{$data->geteventtype->name_en}}</span> - 
                                
                                    <span class="text-info">{{trans('lang.start_from')}}</span> - <span class="text-success">{{$data->from_time}}</span>
                                    <span class="text-info">{{trans('lang.end_to')}}</span> - <span class="text-success">{{$data->to_time}}</span>
                                </h1>
                            </div>
                            @if(@isset($datacomment))
                                @foreach ( $datacomment as $comment)
                                <div class="row mb-8">
                                    <div class="col-xl-2">
                                        <div class="fs-6 fw-semibold">{{trans('lang.name')}} </div>
                                        <div class="fs-6 fw-semibold text-success">{{$comment->name_en}} </div>
                                        
                                    </div>
                                    
                                    <div class="col-xl-4">
                                        <div class="fs-6 fw-semibold">{{trans('lang.title')}} </div>
                                            <div class="col-xl-4 fv-row">
                                            @if($comment->type_event_content === 0)
                                            <div class="fs-6 fw-semibold text-info">{{ __('lang.schedule') }}</div>
                                            <div class="fs-6 fw-semibold">{{$comment->from_time}}</div>
                                            <div class="fs-6 fw-semibold">{{$comment->to_time}}</div>
                                            @elseif($comment->type_event_content === 1)
                                            <div class="fs-6 fw-semibold text-info">{{ __('lang.logistics') }}</div>
                                            @elseif($comment->type_event_content === 2)
                                            <div class="fs-6 fw-semibold text-info">{{ __('lang.point_discussion') }}</div>
                                            @elseif($comment->type_event_content === 3)
                                            <div class="fs-6 fw-semibold text-info">{{ __('lang.recommended_activities') }}</div>
                                            @elseif($comment->type_event_content === 4)
                                            <div class="fs-6 fw-semibold text-info">{{ __('lang.other') }}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-xl-3">
                                        <div class="fs-6 fw-semibold">{{trans('lang.note')}} </div>
                                        <div class="fs-6 fw-semibold">{{$comment->note}} </div>
                                        
                                    </div>

                                    
                                   
                                </div>
                                @endforeach
                            
                            @endif
                        </div>

            </div>
            <!--end::Content-->
        </div>
    </div>

@endsection

@section('script')

@endsection