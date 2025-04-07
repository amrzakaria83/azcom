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
                <a  href="{{route('admin.refund_sales.index')}}" class="text-muted text-hover-primary">{{trans('lang.administrators')}}</a>
            </li>
            <li class="breadcrumb-item">
                <span class="bullet bg-gray-300 w-5px h-2px"></span>
            </li>
            <li class="breadcrumb-item text-muted px-2">
                {{trans('employee.profile')}}   
            </li>
        </ul>
    </div>
    <!--end::Page title-->
</div>
@endsection

@section('content')

<div id="kt_app_content_container" class="app-container container-fluid">
    <div class="card">


            <div class="card-body p-9">

           
                <div class="row mb-6">
                            <div class="table-responsive">
                                <table class="table align-middle table-rounded table-striped table-row-dashed fs-6" id="kt_datatable_tabletemp">
                                    <thead>
                                        <tr class="text-start text-dark fw-bold fs-4 text-uppercase gs-0">
                                            <th class="min-w-125px text-center">{{trans('lang.customer')}}</th>
                                            <th class="min-w-125px text-center">{{trans('lang.refund_cause')}}</th>
                                            <th class="min-w-125px text-center">{{trans('lang.note')}}</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody class="text-gray-600 fw-bold text-center" id="kt_datatable_tabletemptbody">
                                    @if(isset($datareffirst))
                                        <tr>
                                            <td>
                                                {{$datareffirst->getcust->name_en}}
                                            </td>
                                            <td>
                                            {{ $datareffirst->getrefcause->name_en ?? 'no' }}
                                            </td>
                                            <td>
                                                {{$datareffirst->note}}
                                            </td>
                                        </tr>
                                    @endif

                                    </tbody>
                                
                                </table>
                            </div>
                        </div>
                        <div class="separator separator-content border-dark my-15"><span class="w-250px fw-bold text-info fs-1">{{trans('lang.products')}}</span></div>

                        <div class="row mb-6">
                            <div class="table-responsive">
                                <table class="table align-middle table-rounded table-striped table-row-dashed fs-6" id="kt_datatable_tabletemp">
                                    <thead>
                                        <tr class="text-start text-dark fw-bold fs-4 text-uppercase gs-0">
                                            <th class="min-w-125px text-center">{{trans('lang.products')}}</th>
                                            <th class="min-w-125px text-center">{{trans('lang.quantity')}}</th>
                                            
                                        </tr>
                                    </thead>
                                    
                                    <tbody class="text-gray-600 fw-bold text-center" id="kt_datatable_tabletemptbody">
                                    @if(isset($datareffirst))
                                        <tr>
                                            <td>
                                                {{$datareffirst->getprod->name_en}}
                                            </td>
                                            <td>
                                                {{$datareffirst->approv_quantity_ref}}
                                            </td>
                                            
                                        </tr>
                                    @endif
                                    @if(isset($dataref))
                                    @foreach ($dataref as $item)
                                        <tr>
                                            <td>
                                                {{$item->getprod->name_en}}
                                            </td>
                                            <td>
                                                {{$item->approv_quantity_ref}}
                                            </td>
                                            
                                        </tr>
                                        @endforeach
                                    @endif

                                    </tbody>
                                
                                </table>
                            </div>
                        </div>







            </div>

    </div>
</div>

@endsection

@section('script')
@endsection