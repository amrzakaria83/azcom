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
                <a  href="{{route('admin.refund_sales.index')}}" class="text-muted text-hover-primary">{{trans('lang.returns')}}</a>
            </li>
            <li class="breadcrumb-item">
                <span class="bullet bg-gray-300 w-5px h-2px"></span>
            </li>
            <li class="breadcrumb-item text-muted px-2">
                {{trans('lang.returns')}}  
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
                <form action="{{route('admin.refund_sales.store')}}" method="POST" enctype="multipart/form-data" id="kt_account_profile_details_form" class="form">
                    @csrf
                    <!--begin::Card body-->
                    <div class="card-body  p-9">
                    <input type="hidden" id="parent_id" name="parent_id" value="" />
                    <input type="hidden" id="cust_id" name="cust_id" value="" />
                    <div class="row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6 text-info required">{{trans('lang.customer')}}</label>
                            <div class="col-lg-5 fv-row">
                                <select  data-placeholder="Select an option" class="input-text form-control form-select mb-3 mb-lg-0 text-center" id="cut_sale" name="cut_sale" data-control="select2" >
                                        <option  disabled selected>Select an option</option>
                                        @foreach (\App\Models\Cut_sale::where('status' , 0)->get() as $asd)
                                            <option value="{{$asd->id}}" data-custval="{{$asd->value}}" >{{$asd->name_en}}</option>
                                            @endforeach
                                </select>
                            </div>
                            <label class="col-sm-2 col-form-label fw-semibold fs-6 text-info required">{{trans('lang.refund_cause')}}</label>

                            <div class="col-lg-3 fv-row">
                                <select  data-placeholder="Select an option" class="input-text form-control form-select mb-3 mb-lg-0 text-center" id="refund_causes_id" name="refund_causes_id"  >
                                        <option  disabled selected>Select an option</option>
                                        @foreach (\App\Models\Refund_cause::where('status' , 0)->get() as $asd)
                                            <option value="{{$asd->id}}"  >{{$asd->name_en}}</option>
                                            @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">{{trans('lang.note')}}</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="note" placeholder="{{trans('lang.note')}}" value="" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6"> {{trans('lang.status')}}</label>
                            <div class="col-lg-8 d-flex align-items-center">
                            <select   data-placeholder="Select an option" class=" input-text form-control  form-select  mb-3 mb-lg-0"  name="status">
                                    <option value="0">{{trans('employee.active')}}</option>
                                    <option value="1">{{trans('employee.notactive')}}</option>                                    
                                </select>
                            </div>
                        </div>
                        <div class="row mb-6">
                           
                        </div>
                        <div class="separator separator-content border-dark my-15"><span class="w-250px fw-bold text-info fs-1">{{trans('lang.products')}}</span></div>

                        <div class="row mb-6" id="products_add" style="visibility: hidden;">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">{{trans('lang.name')}}</label>
                            <div class="col-lg-8 d-flex align-items-center">
                                <!--begin::Repeater-->
                                <div id="kt_docs_repeater_basic" class="container">
                                    <!--begin::Form group-->
                                    <div class="form-group">
                                        <div data-repeater-list="kt_docs_repeater_basic">
                                            <div data-repeater-item>
                                                <div class="form-group row">
                                                    <div class="col-md-5">
                                                        <select class="form-select text-center  prod_id" autofocus required aria-label="Select example" id="prod_id" name="prod_id" data-kt-repeater="select2" data-control="select2">
                                                        <option  disabled selected>Select an option</option>    
                                                        @foreach (\App\Models\Product::where('status' , 0)->get() as $asd)
                                                            <option value="{{ $asd->id }}"  data-prdsell_price="{{$asd->sell_price}}">{{ $asd->name_en }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <input class="form-control text-center" type="number" placeholder="الكمية" required name="approv_quantity_ref" />
                                                    </div>
                                                    <div class="col-md-2">
                                                        <input class="form-control text-center" type="number" placeholder="السعر" data-kt-repeater="approv_sellpriceproduct_ref" required name="approv_sellpriceproduct_ref" />
                                                        <input class="form-control text-center" type="hidden" placeholder="السعر" data-kt-repeater="approv_sellpriceproduct_ref_hidden" required name="approv_sellpriceproduct_ref_hidden" />
                                                    </div>
                                                    <div class="col-md-2">
                                                        <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger mt-3 mt-md-8">
                                                            <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                                                            Delete
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Form group-->

                                    <!--begin::Form group-->
                                    <div class="form-group mt-5">
                                        <a href="javascript:;" data-repeater-create class="btn btn-light-primary">
                                            <i class="ki-duotone ki-plus fs-3"></i>
                                            Add
                                        </a>
                                    </div>
                                    <!--end::Form group-->
                                </div>
                                <!--end::Repeater-->
                            <!-- </div>  -->
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
<script>
    $('#cut_sale').on('change', function() {
        // Get the selected value of the cust_id dropdown
        var cut_sale_value = $(this).val();

        // Get the selected option element
        var selectedOption = $(this).find('option:selected');
    
        // Get the data-custval attribute value from the selected option
        var custpaValue = selectedOption.data('custval');
        // Disable the cust_id dropdown
       
        // Set the value of cut_sale_id to the selected value of cust_id
        // $('#balance_befor').val(custpaValue);
        $('#cust_id').val(cut_sale_value);
        document.getElementById('products_add').style.visibility = 'visible';


        // $('#balance_befor_value').text(custpaValue);
        $(this).prop('disabled', true);
    });

    </script>
<script src="{{asset('dash/assets/plugins/custom/formrepeater/formrepeater.bundle.js')}}"></script>
    
<script>
    $('#kt_docs_repeater_basic').repeater({
        initEmpty: false,
        defaultValues: {
            'text-input': 'foo'
        },
        show: function () {
            $(this).slideDown();
            // Initialize Select2 for the new row
            $(this).find('[data-kt-repeater="select2"]').select2();
        },
        hide: function (deleteElement) {
            $(this).slideUp(deleteElement);
        },
        ready: function () {
            // Handle change event for select2
            $(document).on('change', '.prod_id', function () {
                // Get the selected option
                var selectedOption = $(this).find('option:selected');

                // Get the sell price from data attribute
                var sellPrice = selectedOption.data('prdsell_price');

                const currentItem = $(this).closest('[data-repeater-item]'); // Get the closest repeated item
                const sellpriceph = currentItem.find('[data-kt-repeater="approv_sellpriceproduct_ref"]');
                const sellpricephhidden = currentItem.find('[data-kt-repeater="approv_sellpriceproduct_ref_hidden"]');

                sellpricephhidden.val(sellPrice);
                sellpriceph.val(sellPrice);
                sellpriceph.prop('disabled', true);

            });
        }
    });
</script>

@endsection