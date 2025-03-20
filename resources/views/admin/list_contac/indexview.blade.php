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
            <h1>{{trans('lang.nutrilist')}}-{{trans('lang.all')}}</h1>
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
                                <th class="min-w-125px text-center">{{trans('lang.tareget')}}</th>
                                <th class="min-w-125px text-center">{{trans('lang.sale_funnel')}}</th>
                                <th class="min-w-125px text-center">{{trans('lang.degree')}}</th>
                                <th class="min-w-125px text-center">{{trans('lang.specialties')}}</th>
                                <th class="min-w-125px text-center">{{trans('lang.social_styls')}}</th>
                                <th class="min-w-125px text-center">{{trans('employee.birth_date')}}</th>
                                {{-- <th class="min-w-125px text-start">{{trans('employee.action')}}</th> --}}
                            </tr>
                            <!--end::Table row-->
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody class="text-gray-600 fw-bold">
                            @if(isset($datacont))
                                @foreach ( $datacont as $cont)
                                    <tr>
                                        {{-- <td class="text-center"></td> --}}
                                        <td class="text-center">
                                        <a href="{{route('admin.contacts.show', $cont->getcontact->id)}}" class="text-dark text-hover-primary mb-0">
                                            {{ $cont->getcontact->name_en }}<br>
                                            {{ trans('lang.last_visit_date') }}: <br>
                                            @php
                                                $rate = App\Models\Visit::where('contact_id', $cont->getcontact->id)
                                                                        ->where('empvisit_id', $cont->emplist_id)
                                                                        ->latest()
                                                                        ->first();
                                            @endphp
                                            @if ($rate)
                                                <span class="text-info">{{ $rate->end_time }}</span>
                                            @else
                                                <span class="text-danger">No previous visit</span>
                                            @endif
                                        </a>
                                        </td>
                                        <td class="text-center">{{$cont->taregetvisit}}</td>
                                        <td class="text-center">
                                            @if(isset($cont->getfunnel->name_en))
                                            <span class="text-info">{{$cont->getfunnel->name_en}}</span><br>
                                            <button type="button" class="btn btn-sm  btn-info btn-active-dark me-2" data-bs-toggle="modal" data-namefunnel-id="{{ $cont->getfunnel->name_en }}" data-namecont-id="{{ $cont->getcontact->name_en }}" data-item-id="{{ $cont->id }}" data-bs-target="#kt_modal1">
                                                {{trans('lang.editview')}}
                                            </button> 
                                            @else  <span class="text-info">
                                                <button type="button" class="btn btn-sm  btn-success btn-active-dark me-2" data-bs-toggle="modal" data-item-id="{{ $cont->id }}" data-bs-target="#kt_modal">
                                                    {{trans('lang.addnew')}}
                                                </button> 
                                            </span>
                                            @endif
                                            </td>
                                            <td class="text-center">
                                                @php
                                                    $rate = App\Models\Contact_rate::where('contact_id', $cont->getcontact->id)->where('status',0)->sum('value');
                                                    if ($rate) {
                                                        echo $rate;
                                                    } else {
                                                        echo 'No entry';
                                                    }
                                                @endphp
                                            </td>
                                            
                                            <td class="text-center">
                                                @php
                                                    $speciality = json_decode($cont->getcontact->speciality_id);
                                                    if ($speciality) {
                                                        $azsp = App\Models\Specialty::whereIn('id', $speciality)->get();
                                                        $info = implode(' - ', $azsp->pluck('name_en')->toArray());
                                                        echo $info;
                                                    } else {
                                                        echo 'No entry';
                                                    }
                                                @endphp
                                            </td>
                                            <td class="text-center">{{ $cont->getcontact->getsocial->name_en ?? 'No entry' }}</td>
                                            <td class="text-center">{{ $cont->getcontact->birth_date ?? 'No entry' }}</td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                        <!--end::Table body-->
                    </table>
                    <!--end::Table-->
                </div>
                <!--end::Card body-->

                <div class="">
                    <div class="modal fade" tabindex="-1" id="kt_modal" >
                        <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="modal-title" >{{trans('lang.addnew')}} {{trans('lang.sale_funnel')}} {{trans('lang.contact')}}</h3>
                                            <!--begin::Close-->
                                            <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                                <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                                            </div>
                                            <!--end::Close-->
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{route('admin.list_contacs.createfunnel')}}" method="POST" enctype="multipart/form-data" id="kt_account_profile_details_form" class="form">
                                                @csrf
                                                <div class="row mb-6">
                                                    <div class="col-lg-8 fv-row">
                                                    <input type="hidden" name="id" id="dataId" value="" />
                                                        <select  data-placeholder="Select an option" required class=" input-text form-control  form-select  mb-3 mb-lg-0 text-center"  name="sales_funel_id"  data-control="select2" >
                                                                <option  disabled selected>Select an option</option>
                                                                    @foreach (\App\Models\Sales_funel::where('status' , 0)->get() as $contac)
                                                                        <option value="{{$contac->id}}">{{$contac->name_en}}</option>
                                                                    @endforeach
                                                            </select>
                                                    </div>
                                                </div>
                                                
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" id="submit" class="btn btn-success">Add</button>
                                                </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="">
                    <div class="modal fade" tabindex="-1" id="kt_modal1" >
                        <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="modal-title" >{{trans('lang.editview')}} {{trans('lang.sale_funnel')}} {{trans('lang.contact')}}
                                                <span id="contactname" class="text-info"></span>
                                            </h3>
                                            <!--begin::Close-->
                                            <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                                <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                                            </div>
                                            <!--end::Close-->
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{route('admin.list_contacs.updatefunnel')}}" method="POST" enctype="multipart/form-data" id="kt_account_profile_details_form" class="form">
                                                @csrf
                                                <div class="row mb-6">
                                                    <label class="col-lg-3 col-form-label fw-semibold fs-6">{{trans('lang.sale_funnel')}}</label>
                                                    <div class="col-lg-8 fv-row">
                                                        <span id="funnlname" class="fs-1"></span>
                                                    </div>
                                                </div>

                                                <div class="row mb-6">
                                                    <div class="col-lg-8 fv-row">
                                                    <input type="hidden" name="id" id="dataId" value="" />
                                                        <select  data-placeholder="Select an option" required class=" input-text form-control  form-select  mb-3 mb-lg-0 text-center"  name="sales_funel_id"  data-control="select2" >
                                                                <option  disabled selected>Select an option</option>
                                                                    @foreach (\App\Models\Sales_funel::where('status' , 0)->get() as $contac)
                                                                        <option value="{{$contac->id}}">{{$contac->name_en}}</option>
                                                                    @endforeach
                                                            </select>
                                                    </div>
                                                </div>
                                                
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" id="submit" class="btn btn-primary">Save</button>
                                                </div>
                                    </form>
                                </div>
                            </div>
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

<script>
    $(document).ready(function() {
        $("#kt_datatable_table").DataTable({
            searching: false,
            dom: 'Bfrtip',
            pageLength: 30,
            buttons: [
                {
                    extend: 'excel',
                    className: 'btn btn-sm btn-icon btn-success btn-active-dark mb-5 p-3',
                    text: '<i class="bi bi-file-earmark-spreadsheet fs-1x"></i>'
                }
            ]
        });

        $('#kt_modal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var itemId = button.data('item-id'); // Use data attribute name
            var modal = $(this);
            modal.find('#dataId').val(itemId);
        });
        $('#kt_modal1').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var itemId = button.data('item-id'); // Use data attribute name
            var nameId = button.data('namecont-id'); // Use data attribute name
            var namefunnelId = button.data('namefunnel-id'); // Use data attribute name
            var modal = $(this);
            modal.find('#dataId').val(itemId);
            modal.find('#contactname').text(nameId);
            modal.find('#funnlname').text(namefunnelId);
        });

    });
    </script>



@endsection