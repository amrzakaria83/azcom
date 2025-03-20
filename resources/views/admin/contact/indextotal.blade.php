@extends('admin.layout.master')

@section('css')
    <link href="{{asset('dash/assets/plugins/custom/datatables/datatables.bundle.rtl.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('dash/assets/plugins/custom/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
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
                <a  href="#" class="text-muted text-hover-primary">{{trans('lang.administrators')}}</a>
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
            <h1>{{trans('lang.total')}} {{trans('lang.degree')}}</h1>
            <div class="card no-border">
                <!--begin::Card header-->
                <div class="card-header border-0 pt-6">
                    <div class="card-title">
                        <!--begin::Search-->
                        <div class="d-flex align-items-center position-relative my-1">
                            <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                                    <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor" />
                                </svg>
                            </span>
                            <input type="text" data-kt-db-table-filter="search" id="search" name="search" class="form-control form-control-solid bg-light-dark text-dark w-250px ps-14" placeholder="Search user" />
                        </div>
                    </div>
                    <div class="card-toolbar">
                        <!--begin::Toolbar-->
                        <div class="d-flex justify-content-end dbuttons">
                            <!-- <a href="{{route('admin.list_contacs.create')}}" class="btn btn-sm btn-icon btn-primary btn-active-dark me-3 p-3">
                                <i class="bi bi-plus-square fs-1x"></i>
                            </a> -->
                            <!-- <button type="button" class="btn btn-sm btn-icon btn-primary btn-active-dark me-3 p-3" data-bs-toggle="modal" data-bs-target="#kt_modal_filter">
                                <i class="bi bi-funnel-fill fs-1x"></i>
                            </button> -->
                            <!-- <button type="button" class="btn btn-sm btn-icon btn-danger btn-active-dark me-3 p-3" id="btn_delete" data-token="{{ csrf_token() }}">
                                <i class="bi bi-trash3-fill fs-1x"></i>
                            </button> -->
                        </div>
                    </div>
                    <!--end::Card toolbar-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body py-4">
                    @if(isset($datalist))
                    <h1>{{$datalist->name_en}} - <span class="text-danger">{{$datalist->getemp->name_en}}</span></h1>
                    @endif
                    <div class="row mb-6">
                        
                        <div class="col-sm-4">
                            <label class="col-sm-8 fw-semibold fs-6 mb-2">{{trans('lang.name')}}-{{trans('lang.contact')}}</label>
                            <div class="col-sm-12 fv-row">
                                <select  data-placeholder="Select an option" class=" input-text form-control  form-select  mb-3 mb-lg-0 text-center" id="contact_id" name="contact_id" data-control="select2" >
                                    <option  disabled selected>Select an option</option>
                                        @foreach (\App\Models\Contact::where('status' , 0)->get() as $contac)
                                            <option value="{{$contac->id}}">{{$contac->name_en}}</option>
                                            @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <label class="col-sm-8 fw-semibold fs-6 mb-2"></label>
                            <div class="col-sm-8 d-flex align-items-center">
                                <button type="button" class="btn btn-success btn-lg " id="searchbtn" >
                                    Search
                                </button> 
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <label class="col-sm-8 fw-semibold fs-6 mb-2"></label>
                                <div class="col-sm-8 d-flex align-items-center">
                                    <a href="{{route('admin.contacts.indextotal')}}" class="btn btn-primary btn-lg " id="searchbtn" >
                                        refresh
                                    </a> 
                                </div> 
                        </div>
                        
                    </div>
                    <!--begin::Table-->
                    <table class="table align-middle table-rounded table-striped table-row-dashed fs-6" id="kt_datatable_table">
                        <!--begin::Table head-->
                        <thead class="bg-light-dark pe-3">
                            <!--begin::Table row-->
                            <tr class="text-start text-dark fw-bold fs-4 text-uppercase gs-0">
                                {{-- <th class="w-10px p-3">
                                    <div class="form-check form-check-sm form-check-custom form-check-solid ">
                                        <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_datatable_table .form-check-input" value="1" />
                                    </div>
                                </th> --}}
                                <th class="min-w-125px text-center">{{trans('lang.name')}} {{trans('lang.contact')}}</th>
                                <th class="min-w-125px text-center" >{{trans('lang.total')}} {{trans('lang.degree')}}</th>

                                {{-- <th class="min-w-125px text-start">{{trans('employee.action')}}</th> --}}
                            </tr>
                            <!--end::Table row-->
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody class="text-gray-600 fw-bold">
                            @if(isset($contact_ids))
                            @foreach ($contact_ids as $contact_id => $total_value)
                             <tr>
                                <td class="text-center">{{ \App\Models\Contact::find($contact_id)->name_en }}</td> 
                                <td class="text-center">{{ $total_value }}</td> 
                            </tr>
                            @endforeach
                            @elseif (isset($contact_id_value))
                            <tr>
                                <td class="text-center">{{ \App\Models\Contact::find($contact_id)->name_en }}</td> 
                                <td class="text-center">{{ $contact_id_value }}</td> 
                            </tr>
                            @endif
                        </tbody>
                        <!--end::Table body-->
                    </table>
                    <!--end::Table-->
                </div>
                <!--end::Card body-->

                

                


            </div>
    </div>
    <!--end::Container-->
@endsection

@section('script')
<script src="{{asset('dash/assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
<script src="{{asset('dash/assets/plugins/custom/datatables/dataTables.buttons.min.js')}}"></script>

<script>
$(document).ready(function() {
    $("#kt_datatable_table").DataTable({
        searching: false,
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excel',
                className: 'btn btn-sm btn-icon btn-success btn-active-dark mb-5 p-3',
                text: '<i class="bi bi-file-earmark-spreadsheet fs-1x"></i>'
            }
        ]
    });

    $('#searchbtn').click(function(){
        const contact_id = $('#contact_id option:selected').val() ;
        window.location = '{{route("admin.contacts.indextotalserch")}}' + '/' + contact_id;
        $('#searchbtn').prop('disabled', true);
    });
})
    </script>

@endsection