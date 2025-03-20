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
                <a  href="{{route('admin.cut_sales.index')}}" class="text-muted text-hover-primary">{{trans('lang.cut_sales')}}</a>
            </li>
            <li class="breadcrumb-item">
                <span class="bullet bg-gray-300 w-5px h-2px"></span>
            </li>
            <li class="breadcrumb-item text-muted px-2">
                {{trans('employee.add_new')}}  
            </li>
        </ul>
    </div>
    <!--end::Page title-->
</div>
@endsection

@section('content')

    <div id="kt_app_content_container" class="app-container container-fluid">       

        <div class="card mb-5 mb-xl-10">
        <h1>
            <span>{{trans('lang.bill_of_sale')}}-{{trans('employee.add_new')}}</span>
        </h1><br>
            <!--begin::Content-->
            <div id="kt_account_settings_profile_details" class="collapse show">
                <form action="{{route('admin.bill_sales.store')}}" method="POST" enctype="multipart/form-data" id="kt_account_profile_details_form" class="form">
                    @csrf
                    <!--begin::Card body-->
                    <div class="card-body  p-9">

                        <div class="row mb-6">
                            <div class="col-sm-4">
                                <label class="col-sm-6 fw-semibold required fs-3 text-info mb-2">{{trans('lang.name')}}-{{trans('lang.customer')}}</label>
                                <div class="col-sm-6 fv-row">
                                    <select  data-placeholder="Select an option" class="input-text form-control form-select mb-3 mb-lg-0 text-center" id="cut_sale_id" name="cut_sale_id" data-control="select2" >
                                        <option  disabled selected>Select an option</option>
                                        

                                            @foreach (\App\Models\Cut_sale::where('status' , 0)->get() as $asd)
                                                <option value="{{$asd->id}}" >{{$asd->name_en}}</option>
                                                @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <label class="col-sm-6 fw-semibold required fs-3 text-info mb-2">{{trans('lang.sales')}}-{{trans('lang.type_type')}}</label>
                                <div class="col-sm-6 fv-row">
                                    <select  data-placeholder="Select an option" class="input-text form-control form-select mb-3 mb-lg-0 text-center" id="sale_type_id" name="sale_type_id" data-control="select2" >
                                        <option  disabled selected>Select an option</option>
                                            @foreach (\App\Models\Sale_type::where('status' , 0)->get() as $asd)
                                                <option value="{{$asd->id}}" >{{$asd->name_en}}</option>
                                                @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <label class="required fw-semibold fs-6 mb-2">{{trans('lang.valued_date')}}</label>
                                <div class="position-relative d-flex align-items-center">
                                    <span class="svg-icon svg-icon-2 position-absolute mx-4">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path opacity="0.3" d="M21 22H3C2.4 22 2 21.6 2 21V5C2 4.4 2.4 4 3 4H21C21.6 4 22 4.4 22 5V21C22 21.6 21.6 22 21 22Z" fill="currentColor" />
                                            <path d="M6 6C5.4 6 5 5.6 5 5V3C5 2.4 5.4 2 6 2C6.6 2 7 2.4 7 3V5C7 5.6 6.6 6 6 6ZM11 5V3C11 2.4 10.6 2 10 2C9.4 2 9 2.4 9 3V5C9 5.6 9.4 6 10 6C10.6 6 11 5.6 11 5ZM15 5V3C15 2.4 14.6 2 14 2C13.4 2 13 2.4 13 3V5C13 5.6 13.4 6 14 6C14.6 6 15 5.6 15 5ZM19 5V3C19 2.4 18.6 2 18 2C17.4 2 17 2.4 17 3V5C17 5.6 17.4 6 18 6C18.6 6 19 5.6 19 5Z" fill="currentColor" />
                                            <path d="M8.8 13.1C9.2 13.1 9.5 13 9.7 12.8C9.9 12.6 10.1 12.3 10.1 11.9C10.1 11.6 10 11.3 9.8 11.1C9.6 10.9 9.3 10.8 9 10.8C8.8 10.8 8.59999 10.8 8.39999 10.9C8.19999 11 8.1 11.1 8 11.2C7.9 11.3 7.8 11.4 7.7 11.6C7.6 11.8 7.5 11.9 7.5 12.1C7.5 12.2 7.4 12.2 7.3 12.3C7.2 12.4 7.09999 12.4 6.89999 12.4C6.69999 12.4 6.6 12.3 6.5 12.2C6.4 12.1 6.3 11.9 6.3 11.7C6.3 11.5 6.4 11.3 6.5 11.1C6.6 10.9 6.8 10.7 7 10.5C7.2 10.3 7.49999 10.1 7.89999 10C8.29999 9.90003 8.60001 9.80003 9.10001 9.80003C9.50001 9.80003 9.80001 9.90003 10.1 10C10.4 10.1 10.7 10.3 10.9 10.4C11.1 10.5 11.3 10.8 11.4 11.1C11.5 11.4 11.6 11.6 11.6 11.9C11.6 12.3 11.5 12.6 11.3 12.9C11.1 13.2 10.9 13.5 10.6 13.7C10.9 13.9 11.2 14.1 11.4 14.3C11.6 14.5 11.8 14.7 11.9 15C12 15.3 12.1 15.5 12.1 15.8C12.1 16.2 12 16.5 11.9 16.8C11.8 17.1 11.5 17.4 11.3 17.7C11.1 18 10.7 18.2 10.3 18.3C9.9 18.4 9.5 18.5 9 18.5C8.5 18.5 8.1 18.4 7.7 18.2C7.3 18 7 17.8 6.8 17.6C6.6 17.4 6.4 17.1 6.3 16.8C6.2 16.5 6.10001 16.3 6.10001 16.1C6.10001 15.9 6.2 15.7 6.3 15.6C6.4 15.5 6.6 15.4 6.8 15.4C6.9 15.4 7.00001 15.4 7.10001 15.5C7.20001 15.6 7.3 15.6 7.3 15.7C7.5 16.2 7.7 16.6 8 16.9C8.3 17.2 8.6 17.3 9 17.3C9.2 17.3 9.5 17.2 9.7 17.1C9.9 17 10.1 16.8 10.3 16.6C10.5 16.4 10.5 16.1 10.5 15.8C10.5 15.3 10.4 15 10.1 14.7C9.80001 14.4 9.50001 14.3 9.10001 14.3C9.00001 14.3 8.9 14.3 8.7 14.3C8.5 14.3 8.39999 14.3 8.39999 14.3C8.19999 14.3 7.99999 14.2 7.89999 14.1C7.79999 14 7.7 13.8 7.7 13.7C7.7 13.5 7.79999 13.4 7.89999 13.2C7.99999 13 8.2 13 8.5 13H8.8V13.1ZM15.3 17.5V12.2C14.3 13 13.6 13.3 13.3 13.3C13.1 13.3 13 13.2 12.9 13.1C12.8 13 12.7 12.8 12.7 12.6C12.7 12.4 12.8 12.3 12.9 12.2C13 12.1 13.2 12 13.6 11.8C14.1 11.6 14.5 11.3 14.7 11.1C14.9 10.9 15.2 10.6 15.5 10.3C15.8 10 15.9 9.80003 15.9 9.70003C15.9 9.60003 16.1 9.60004 16.3 9.60004C16.5 9.60004 16.7 9.70003 16.8 9.80003C16.9 9.90003 17 10.2 17 10.5V17.2C17 18 16.7 18.4 16.2 18.4C16 18.4 15.8 18.3 15.6 18.2C15.4 18.1 15.3 17.8 15.3 17.5Z" fill="currentColor" />
                                        </svg>
                                    </span>
                                    <input class="form-control form-control-solid ps-12" name="valued_time" placeholder="{{trans('lang.valued_date')}}" id="kt_datepicker_1" />
                                </div>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <!-- <label class="col-lg-2 col-form-label fw-semibold fs-6">{{trans('lang.note')}}</label> -->
                            <div class="col-sm-4">
                                <label class="form-label">{{trans('lang.note')}}</label>
                                <div class="col-lg-12 fv-row">
                                    <input type="text" name="note" placeholder="{{trans('lang.note')}}" value="" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <label class="form-label">{{trans('employee.method_for_payment')}}</label>
                                <div class="col-lg-12 fv-row">
                                    <input type="text" name="method_for_payment" placeholder="{{trans('employee.method_for_payment')}}" value="" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <label class="form-label">{{trans('lang.status')}}</label>
                                <div class="col-lg-12 fv-row">
                                    <input type="text" name="status_order" placeholder="{{trans('lang.status')}}" value="" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                                </div>
                            </div>
                        </div>
                        <div class="row mb-6">
                            <!-- <label class="col-lg-2 col-form-label fw-semibold fs-6">{{trans('lang.note')}}</label> -->
                            <div class="col-sm-4">
                                <label class="form-label">{{trans('lang.note')}}1</label>
                                <div class="col-lg-12 fv-row">
                                    <input type="text" name="note1" placeholder="{{trans('lang.note')}}1" value="" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                                </div>
                            </div>
                            <div class="col-sm-4">
                            <label class="form-label">{{trans('lang.note')}}2</label>
                                <div class="col-lg-12 fv-row">
                                    <input type="text" name="note2" placeholder="{{trans('lang.note')}}2" value="" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                                </div>
                            </div>
                            <div class="col-sm-4">
                            <label class="form-label">{{trans('lang.note')}}3</label>
                                <div class="col-lg-12 fv-row">
                                    <input type="text" name="note3" placeholder="{{trans('lang.note')}}3" value="" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                                </div>
                            </div>
                        </div>

                        <div class="row mb-6">
                           
                        </div>

                        <div class="row mb-6">
                            <!--begin::Repeater-->
                            <div id="kt_docs_repeater_basic">
                                    <!--begin::Form group-->
                                    <div class="form-group">
                                        <div data-repeater-list="kt_docs_repeater_basic">
                                            <div data-repeater-item>
                                                <div class="form-group row">
                                                    <div class="col-md-2">
                                                        <label class="form-label required">{{trans('lang.name')}}-{{trans('lang.products')}}:</label>
                                                        <select  data-placeholder="Select an option" required class=" input-text form-control  form-select  mb-3 mb-lg-0 text-center"  name="product_id" data-kt-repeater="select2" data-control="select2" >
                                                            <option  disabled selected>Select an option</option>
                                                                @foreach (\App\Models\Product::where('status' , 0)->get() as $contac)
                                                                    <option value="{{$contac->id}}">{{$contac->name_en}}</option>
                                                                @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <label class="form-label required">{{trans('lang.quantity')}}</label>
                                                        <input type="number" class="form-control mb-2 mb-md-0 text-center" required placeholder="Number" value="1" data-kt-repeater="quantityproduc" name="quantityproduc"/>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label class="form-label required">{{trans('lang.sell_price')}} {{trans('lang.public')}} {{trans('lang.unit')}}</label>
                                                        <input type="number" class="form-control mb-2 mb-md-0 text-center" required placeholder="Number" data-kt-repeater="sellpriceproduct" name="sellpriceproduct"/>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label class="form-label required">{{trans('lang.discount_rate')}} {{trans('lang.pharmacist')}}</label>
                                                         <!--begin::Input group-->
                                                            <div class="input-group  mb-5">
                                                                <span class="input-group-text"><i class="fas fa-percentage"></i>
                                                                </span>
                                                                <input type="number" class="form-control mb-2 mb-md-0 text-center" required placeholder="%" data-kt-repeater="percent" name="percent"/>
                                                                
                                                            </div>
                                                            <!--end::Input group-->
                                                        <!-- <input type="number" class="form-control mb-2 mb-md-0 text-center" required placeholder="Number" data-kt-repeater="percent" name="percent"/> -->
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label class="form-label required">{{trans('lang.sell_price')}} {{trans('lang.pharmacist')}} {{trans('lang.unit')}}</label>
                                                        <input type="number" class="form-control mb-2 mb-md-0 text-center" required placeholder="Number" data-kt-repeater="sellpriceph" name="sellpriceph"/>
                                                    </div>
                                                    
                                                    <div class="col-md-2">
                                                        <label class="form-label required">{{trans('lang.total')}} {{trans('lang.pharmacist')}}</label>
                                                        <input type="number" class="form-control mb-2 mb-md-0 text-center" required placeholder="Number" value="0" data-kt-repeater="sellpricetotal" name="sellpricetotal"/>
                                                    </div>
                                                    
                                                    <div class="col-md-1">
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


            <div class="">
                    <div class="modal fade" tabindex="-1" id="kt_modal" >
                        <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="modal-title" >ADD {{trans('lang.sale_funnel')}} {{trans('lang.contact')}}</h3>
                                            <!--begin::Close-->
                                            <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                                <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                                            </div>
                                            <!--end::Close-->
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{route('admin.cut_sales.store')}}" method="POST" enctype="multipart/form-data" id="kt_account_profile_details_form" class="form">
                                                @csrf
                                                <div class="row mb-6">
                                                    <label class="col-lg-2 col-form-label required fw-semibold fs-6">{{trans('lang.name')}}</label>
                                                    <div class="col-lg-8 fv-row">
                                                        <input type="text" name="name_en" placeholder="{{trans('lang.name')}}" value="" required class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                                                    </div>
                                                </div>

                                                <div class="row mb-6">
                                                    <label class="col-lg-2 col-form-label fw-semibold fs-6">{{trans('lang.phone')}}</label>
                                                    <div class="col-lg-8 fv-row">
                                                        <input type="text" name="phone" placeholder="{{trans('lang.phone')}}" value="" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                                                    </div>
                                                </div>

                                                <div class="row mb-6">
                                                    <label class="col-lg-2 col-form-label fw-semibold fs-6">{{trans('lang.address')}}</label>
                                                    <div class="col-lg-8 fv-row">
                                                        <input type="text" name="address" placeholder="{{trans('lang.address')}}" value="" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                                                    </div>
                                                </div>

                                                <div class="row mb-6">
                                                    <label class="col-lg-2 col-form-label fw-semibold fs-6">{{trans('lang.note')}}</label>
                                                    <div class="col-lg-8 fv-row">
                                                        <input type="text" name="note" placeholder="{{trans('lang.note')}}" value="" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
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


            </div>
    </div>

@endsection

@section('script')
<script>
    $("#kt_datepicker_1").flatpickr({
    defaultDate: new Date(new Date().setMonth(new Date().getMonth() - 0))
    // maxDate: new Date()
    });

</script>
<script>
$('#cut_sale_id').on('change', function() {
            if (this.value == "add") {
                $('#kt_modal').modal('show');
            } 
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
        $(this).find('[data-kt-repeater="select2"]').select2();
        $(this).find('[data-kt-repeater="quantityproduc"]').val(1);
        $(this).find('[data-kt-repeater="percent"]').val();
        $(this).find('[data-kt-repeater="sellpriceph"]').val();
        $(this).find('[data-kt-repeater="sellpriceproduct"]').val('');
        $(this).find('[data-kt-repeater="sellpricetotal"]').val(0);
    },

    hide: function (deleteElement) {
        $(this).slideUp(deleteElement);
    },

    ready: function () {
        // Initialize select2 on all instances
        $(this).find('[data-kt-repeater="select2"]').select2();

        // Handle change event for select2
        $(document).on('change', '[data-kt-repeater="select2"]', function () {
            const itemstock = $(this).val(); // Get the selected value
            const currentItem = $(this).closest('[data-repeater-item]'); // Get the closest repeated item

            $.ajax({
                url: "{{ route('admin.bill_sales.getprodname') }}/" + itemstock,
                type: 'GET',
                dataType: 'json',
                delay: 250,
                cache: true,
                success: function (data) {
                    console.log(data); // Log the total value for debugging
                    console.log(data.sell_price); // Log the total value for debugging

                    const percent = currentItem.find('[data-kt-repeater="percent"]');
                    const sellpriceph = currentItem.find('[data-kt-repeater="sellpriceph"]');

                    const selling = currentItem.find('[data-kt-repeater="sellpriceproduct"]');
                    const sellingtotal = currentItem.find('[data-kt-repeater="sellpricetotal"]');
                    selling.empty();
                    selling.append(data.sell_price);
                    selling.val(data.sell_price);
                    // selling.val(data[0].sell_price); // Set the sell price
                    sellingtotal.empty();
                    // sellingtotal.append(data.sell_price);
                    sellingtotal.val(data.sell_price * 1);
                    // Trigger the select2 change event to recalculate the total
                    currentItem.find('[data-kt-repeater="quantityproduc"]').trigger('change');
                },
                error: function (xhr, status, error) {
                    toastr.error("", "عفوا لم يتم الحذف");
                }
            });
        });

        // Handle change event for quantity and sell price
        $(document).on('change', '[data-kt-repeater="select2"], [data-kt-repeater="sellpriceproduct"], [data-kt-repeater="quantityproduc"]', function () {
            const currentItem = $(this).closest('[data-repeater-item]');
            const itemSellPrice = parseFloat(currentItem.find('[data-kt-repeater="sellpriceproduct"]').val()) || 0;
            const itemQuantity = parseFloat(currentItem.find('[data-kt-repeater="quantityproduc"]').val()) || 0;
            if (isNaN(itemSellPrice) || isNaN(itemQuantity)) {
                toastr.error("", "Please enter valid numbers for quantity and sell price.");
                return;
                }
            const totalValue = itemQuantity * itemSellPrice;
            const sellingtotal = currentItem.find('[data-kt-repeater="sellpricetotal"]');
            sellingtotal.val(totalValue);
            sellingtotal.prop('disabled', true);

            // console.log(totalValue); // Log the total value for debugging

            // Update any other fields if needed
            // currentItem.find('[data-kt-repeater="t_valutitem"]').val(totalValue);
        });
    }
});
</script>
<!-- <script>
$('#kt_docs_repeater_basic').repeater({
    initEmpty: false,

    defaultValues: {
        'text-input': 'foo'
    },

    show: function () {
        $(this).slideDown();
        $(this).find('[data-kt-repeater="select2"]').select2();
        $(this).find('[data-kt-repeater="quantityproduc"]').val();
        $(this).find('[data-kt-repeater="sellpriceproduct"]').val();
    },

    hide: function (deleteElement) {
        $(this).slideUp(deleteElement);
    },
    // ready: function(){
    //     // Init select2
    //     $('[data-kt-repeater="select2"]').select2();
    // }
    ready: function(){
        // Init select2
        $(this).find('[data-kt-repeater="select2"]').select2(); // Initialize select2 on all instances
        

    $(document).on('change', '[data-kt-repeater="select2"]', function() {
        const itemstock = $(this).val(); // Get the value from the current selected element
        const currentItem = $(this).closest('[data-repeater-item]'); // Get the closest repeated item
        // console.log(currentItem);
       $.ajax(
                {
                    url: "{{ route('admin.bill_sales.getprodname') }}/" + itemstock,
                    type: 'GET',
                    dataType: 'json',
                    delay: 250,
                    cache: true, // Consider caching behavior
                    success: function (data) {
                    const selling = currentItem.find('[data-kt-repeater="sellpriceproduct"]'); // Find the select within the current repeated item
                    selling.empty();
                    
                    selling.append(data[0].sellprice);
                    sellprice.val(data[0].sellprice);
                    
                    
                    // Trigger the select2 change event to recalculate the total
                    currentItem.find('[data-kt-repeater="select2"]').trigger('change');
                    },fail: function(xhrerrorThrown){
                        toastr.success("", "عفوا لم يتم الحذف");
                    }
                })
            })
    // $(document).on('change', '[data-kt-repeater="quantity"]', function() {
        $(document).on('change', '[data-kt-repeater="select2"],[data-kt-repeater="sellpriceproduct"],[data-kt-repeater="quantityproduc"]', function calculateTotal() {

        const itemquantity = $(this).val(); // Get the value from the current selected element
        const itemSellPrice = $(this).closest('[data-repeater-item]').find('[data-kt-repeater="sellpriceproduct"]').val();
        const itemquantityproduc = $(this).closest('[data-repeater-item]').find('[data-kt-repeater="quantityproduc"]').val();
        // const t_valutitem = $(this).closest('[data-repeater-item]').find('[data-kt-repeater="t_valutitem"]');
        // const i_valutitem = $(this).closest('[data-repeater-item]').find('[data-kt-repeater="perc_valu"]');
        // console.log(itemquantity);
        const totalvalue = itemquantityproduc * itemSellPrice;
        // t_valutitem.val(totalvalue);
        // const tvi = t_valutitem.val(totalvalue);
            console.log(totalvalue);
        // let total = 0;
        // $('[data-kt-repeater="select2"]').each(function() {
        //     total += parseFloat($(this).val());
        // });
        // // const tvalue = document.getElementById('tvalue').value;
        // var avevalu = (totalvalue / total) * 100 ;


        // Update average percentage for each repeated item
        // $('[data-kt-repeater="perc_valu"]').each(function() {
        //         const currentItem = $(this).closest('[data-repeater-item]');
        //         const tValutitem = currentItem.find('[data-kt-repeater="t_valutitem"]');
        //         const totalValue = parseFloat(tValutitem.val());

        //         const averagePercentage = (totalValue / total) * 100;
        //         $(this).val(averagePercentage.toFixed(2)); // Format to 2 decimal places
        //     });


        //     i_valutitem.val(avevalu.toFixed(2));
        //     // total += parseFloat($(this).val());
        //     // $(this).closest('[data-repeater-item]').find('[data-kt-repeater="quantity"]').prop('disabled' , true);
        // });
       
        
            })
});
</script> -->
@endsection