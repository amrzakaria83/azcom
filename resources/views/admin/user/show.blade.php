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
                <a  href="{{route('admin.users.index')}}" class="text-muted text-hover-primary">{{trans('lang.accounts')}}</a>
            </li>
            <li class="breadcrumb-item">
                <span class="bullet bg-gray-300 w-5px h-2px"></span>
            </li>
            <li class="breadcrumb-item text-muted px-2">
                {{trans('account.student_list')}}  
            </li>
        </ul>
    </div>
    <!--end::Page title-->
</div>
@endsection

@section('content')

<div id="kt_app_content_container" class="app-container container-fluid">
    <div class="card no-border">

        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
            
            <div class="card-toolbar">
                <!--begin::Toolbar-->
                <div class="d-flex justify-content-end dbuttons">
                    <a href="{{route('admin.users.edit', $data[0]['user_id'] )}}" class="btn btn-flex btn-primary h-40px fs-7 fw-bold">
                        {{trans('account.Edit_account')}}
                    </a>
                </div>
            </div>
            <div class="card-title">
            </div>
            <!--end::Card toolbar-->
        </div>
        <div class="card-body p-9">
            <div class="table-responsive">
                <table class="table table-rounded table-flush">
                    <thead>
                        <tr class="fs-7 text-danger border-bottom border-gray-200 py-4 fw-bold">
                            <th>{{trans('account.name')}}</th>
                            <th>{{trans('account.phone')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr class="py-5 fw-semibold  border-bottom border-gray-300 fs-6">
                                <td>
                                    <a href="{{route('admin.students.show', $item->id)}}" class="fs-6 text-gray-800 text-hover-primary" >{{$item->name}}</a>
                                </td>
                                <td>
                                    <a href="{{route('admin.students.show', $item->id)}}" class="fs-6 text-gray-800 text-hover-primary">{{$item->phone}}</a>
                                </td>
                            </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

@endsection

@section('script')
@endsection