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
                <a  href="{{route('admin.emp_sales.index')}}" class="text-muted text-hover-primary">{{trans('lang.sales')}}</a>
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
            <!--begin::Content-->
            <div id="kt_account_settings_profile_details" class="collapse show">
                <form action="{{route('admin.emp_sales.store')}}" method="POST" enctype="multipart/form-data" id="kt_account_profile_details_form" class="form">
                    @csrf
                    <!--begin::Card body-->
                    <div class="card-body  p-9">

                    <div class="row mb-6">
                            <label class="col-lg-2 col-form-label required fw-semibold fs-6">{{trans('lang.name')}}-{{trans('lang.employee')}}</label>
                            <div class="col-lg-8 fv-row">
                                <select  data-placeholder="Select an option" class=" input-text form-control  form-select  mb-3 mb-lg-0 text-center" required id="empsaled_id" name="empsaled_id" data-control="select2" >
                                    <option  disabled selected>Select an option</option>
                                    @if(isset($dataemp))
                                        @foreach ($dataemp as $item)
                                                <option value="{{$item->id}}">{{$item->name_en}}</option>
                                            @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label required fw-semibold fs-6">{{trans('lang.name')}}-{{trans('lang.products')}}</label>
                            <div class="col-lg-8 fv-row">
                                <select  data-placeholder="Select an option" class=" input-text form-control  form-select  mb-3 mb-lg-0" id="prod_id" required  name="prod_id" data-control="select2" >
                                    <option  disabled selected>Select an option</option>
                                    @if(isset($dataprod))
                                        @foreach ($dataprod as $item)
                                                <option value="{{$item->id}}">{{$item->name_en}}</option>
                                            @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label required fw-semibold fs-6">{{trans('lang.name')}}-{{trans('lang.sales')}}-{{trans('lang.type_type')}}</label>
                            <div class="col-lg-8 fv-row">
                                <select  data-placeholder="Select an option" class=" input-text form-control  form-select  mb-3 mb-lg-0" required id="sale_type_id" name="sale_type_id" data-control="select2" >
                                    <option  disabled selected>Select an option</option>
                                    @if(isset($datasale_type))
                                        @foreach ($datasale_type as $item)
                                                <option value="{{$item->id}}">{{$item->name_en}}</option>
                                            @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label required fw-semibold fs-6">{{trans('lang.quantity')}} {{trans('lang.total')}}</label>
                            <div class="col-lg-4 fv-row">
                                <input type="text" name="total_quantity" id="total_quantity" placeholder="{{trans('lang.quantity')}} {{trans('lang.total')}}" required value="" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 text-center" />
                            </div>
                            <div class="col-lg-2 fv-row">
                                <input type="text" name="percent" id="percent" placeholder="" required value="" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 text-info text-center" />
                            </div>
                            <div class="col-lg-2 fv-row">
                                <span class="fs-2 text-info">%</span>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label required fw-semibold fs-6">{{trans('lang.sell_price')}} {{trans('lang.unit')}}</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="unit_sellprice" id="unit_sellprice" placeholder="{{trans('lang.sell_price')}}" required value="" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 text-center text-danger" />
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label required fw-semibold fs-6">{{trans('lang.valued_date')}}</label>
                            <div class="col-lg-8 fv-row">
                                <input type="date" name="value_at" placeholder="{{trans('lang.valued_date')}}" required value="{{ date('Y-m-d') }}" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 text-center" />
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">{{trans('lang.note')}}</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="note" placeholder="{{trans('lang.note')}}" value="" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 text-center" />
                            </div>
                        </div>

                        <div class="row mb-0">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6"> {{trans('lang.status')}}</label>
                            <div class="col-lg-8 d-flex align-items-center">
                            <select   data-placeholder="Select an option" class=" input-text form-control  form-select  mb-3 mb-lg-0 text-center"  name="status">
                                    <option value="0">{{trans('employee.active')}}</option>
                                    <option value="1">{{trans('employee.notactive')}}</option>
                                </select>
                            </div>
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
    $(document).ready(function() {
        $('#unit_sellprice').hide();
        $('#total_quantity').hide();
        $('#percent').hide();
        $('#sale_type_id').prop('disabled', true);
        $('#prod_id').prop('disabled', true);
        });

</script>
<script>
        $('#empsaled_id').on('change', function () {
            $('#prod_id').prop('disabled', false);

        })
    
    </script>
<script>
  $('#prod_id').on('change', function () {
    var prod_id =$('#prod_id').find(":selected").val();

    $.ajax({
            type: "GET",
            url: '{{ url('admin/emp_sales/getprod') }}',
            dataType: 'json',
            delay: 250,
            cache: true,
            data: { prod_id: prod_id },

            success: function (data3) {
            // Update the dropdown or select2 element with results
            $('#unit_sellprice').show();
            $('#unit_sellprice').val(data3['sell_price']); // Assuming first item as default
            $('#unit_sellprice').textContent = data3['sell_price']; // Assuming first item as default
            $('#sale_type_id').prop('disabled', false);
            },
            error: function (jqXHR, textStatus, errorThrown) {
            console.error("AJAX request failed:", textStatus, errorThrown);
            // Display error message or take alternative actions
            }
        });
        $('#sale_type_id').show();
    });
</script>
<script>
    $('#sale_type_id').on('change', function () {
        var empsaled_id = $('#empsaled_id').val();
        var prod_id = $('#prod_id').val();
        var sale_type_id = $('#sale_type_id').val();

        const data = {
            empsaled_id: empsaled_id,
            sale_type_id: sale_type_id,
            prod_id: prod_id
        };
        $.ajax({
                type: "GET",
                url: '{{ url('admin/emp_sales/getsale_type') }}',
                dataType: 'json',
                delay: 250,
                cache: true,
                data: data,

                success: function (data3) {
                $('#total_quantity').show();
                $('#percent').show();
                $('#percent').val(data3.percent);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                console.error("AJAX request failed:", textStatus, errorThrown);
                // Display error message or take alternative actions
                }
            });
        });
</script>

@endsection