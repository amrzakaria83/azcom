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
                                    <span>{{$data->getemp->name_en}}</span> - 
                                    <span>{{$data->gettype->name_en}}</span> - 
                                    @if(@isset($data->getcenter->name_en))
                                    <span>{{$data->getcenter->name_en}}</span> - 
                                    @endif
                                    @if(@isset($data->getcontact->name_en))
                                    <span>{{$data->getcontact->name_en}}</span> - 
                                    @endif
                                    <span>{{trans('lang.start_from')}}</span> - <span>{{$data->from_time}}</span>
                                </h1>
                            </div>
                            @if(@isset($datacomment))
                                @foreach ( $datacomment as $comment)
                                <div class="row mb-8">
                                    <div class="col-xl-2">
                                        <div class="fs-6 fw-semibold">{{trans('lang.title')}} </div>
                                        <div class="fs-6 fw-semibold">{{$comment->getemp->name_en}} </div>
                                    </div>
                                    <div class="col-xl-4 fv-row">
                                        <div class="fw-bold fs-2">{{$comment->title}}</div>
                                        <div class="fs-5">{{$comment->created_at}}</div>
                                    </div>
                                    <div class="col-xl-2">
                                        <div class="fs-6 fw-semibold">{{trans('lang.comment')}} </div>
                                    </div>
                                    <div class="col-xl-4 fv-row">
                                        <div class="fw-bold fs-2">{{$comment->comment}}</div>
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