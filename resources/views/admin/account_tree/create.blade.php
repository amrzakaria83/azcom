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
                لوحة التحكم
            </h1>
        </a>
        <span class="h-20px border-gray-300 border-start mx-4"></span>
        <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
            <li class="breadcrumb-item text-muted px-2">
                <a  href="{{route('admin.employees.index')}}" class="text-muted text-hover-primary">الموظفين</a>
            </li>
            <li class="breadcrumb-item">
                <span class="bullet bg-gray-300 w-5px h-2px"></span>
            </li>
            <li class="breadcrumb-item text-muted px-2">
               اضف جديد  
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
                <form action="{{route('admin.account_trees.store')}}" method="POST" enctype="multipart/form-data" id="kt_account_profile_details_form" class="form">
                    @csrf
                    <!--begin::Card body-->
                    <div class="card-body  p-9">
                        <h1>اضافة بند محاسبى</h1>
                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label required fw-semibold fs-6">الاسم بالعربى</label>
                            <div class="col-lg-4 fv-row">
                                <input type="text" name="name_ar" required placeholder="الاسم بالعربى" value="" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                            </div>
                        <!-- </div>
                        <div class="row mb-6"> -->
                            <label class="col-lg-2 col-form-label  fw-semibold fs-6">الاسم بالانجليزية</label>
                            <div class="col-lg-3 fv-row">
                                <input type="text" name="name_en" placeholder="الاسم بالانجليزية" value="" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">
                                <span class="required">النوع</span>
                            </label>
                            <div class="col-sm-3 d-flex align-items-center text-center">
                                <select class="form-select text-center" autofocus required aria-label="Select example" id="type" name="type" >
                                    <option value="0">فرعى</option>
                                    <option value="1">رئيسى</option>
                                </select>
                            </div>
                        <!-- </div>
                        <div class="row mb-6"> -->
                            <label class="col-lg-2 col-form-label required fw-semibold fs-6">المستوى الحسابى</label>
                            <div class="col-lg-3 fv-row">
                                    <select class="form-select text-center" autofocus required aria-label="Select example" id="parent_id" name="parent_id"  data-control="select2" >
                                        <option>برجاء اختيار المستوى الحسابى</option>
                                        @foreach ($data as $asd)
                                        <option value="{{ $asd->id }}">{{ $asd->name_ar }}</option>
                                        @endforeach
                                    </select>
                                </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">
                                <span class="required">الحالة</span>
                            </label>
                            <div class="col-sm-3 d-flex align-items-center text-center">
                                <select class="form-select text-center" autofocus required aria-label="Select example" id="status" name="status" >
                                    <option value="0">مفعل</option>
                                    <option value="1">غير مفعل</option>
                                </select>
                            </div>
                        {{-- </div>
                        <div class="row mb-6"> --}}
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">
                                <span class="required">طبيعة الحساب</span>
                            </label>
                            <div class="col-sm-3 d-flex align-items-center text-center">
                                <select class="form-select text-center" autofocus required aria-label="Select example" id="type_account" name="type_account" >
                                    <option value="0">دائن</option>
                                    <option value="1">مدين</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label  fw-semibold fs-6">المستهدق</label>
                            <div class="col-lg-8 fv-row">
                                <input type="number" name="targete" placeholder="المستهدق" value="" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 text-center" />
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label  fw-semibold fs-6">ملاحظات</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="note" placeholder="ملاحظات" value="" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 text-center" />
                            </div>
                        </div>

                    </div>

                    <div class="card-footer d-flex justify-content-end py-6 px-9">
                        <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">حفظ</button>
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
$('#type').on('change', function() {
    const type = $("#type option:selected").val();
        if(type == 1){
            $("#parent_id").hide();
        } else{
            $("#parent_id").show();
        }
    });

    </script>
@endsection