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
                <a  href="{{route('admin.contacts.index')}}" class="text-muted text-hover-primary">{{trans('lang.contact')}}</a>
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
        <h1>
            <span>{{trans('lang.contact')}}-{{trans('lang.editview')}}</span>
        </h1><br>
            <!--begin::Content-->
            <div id="kt_account_settings_profile_details" class="collapse show">
                <!--begin::Form-->
                <form action="{{route('admin.contacts.update')}}" method="POST" enctype="multipart/form-data" id="kt_account_profile_details_form" class="form">
                    @csrf
                    <input type="hidden" name="id" value="{{$data->id}}" />
                    <!--begin::Card body-->
                    <div class="card-body border-top p-9">

                    <div class="row mb-6">
                            <label class="col-lg-2 col-form-label required fw-semibold fs-6">{{trans('lang.name')}}</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="name_en" placeholder="{{trans('lang.name')}}" value="{{$data->name_en}}" required class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                            </div>
                        </div>

                        
                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label required text-info fw-semibold fs-6">{{trans('lang.phone')}}</label>
                            <div class="col-lg-8 fv-row">
                                <input type="tel" name="phone" placeholder="{{trans('lang.phone')}}" value="{{$data->phone}}" required class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">{{trans('lang.phone')}}2</label>
                            <div class="col-lg-8 fv-row">
                                <input type="tel" name="phone2" placeholder="{{trans('lang.phone')}}2" value="{{$data->phone2}}" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">{{trans('lang.landline')}}</label>
                            <div class="col-lg-8 fv-row">
                                <input type="tel" name="landline" placeholder="{{trans('lang.landline')}}" value="{{$data->landline}}" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">{{trans('lang.address')}}</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="address" placeholder="{{trans('lang.address')}}" value="{{$data->address}}" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">{{trans('employee.birth_date')}}</label>
                            <div class="col-lg-8 fv-row">
                                <input type="date" name="birth_date" placeholder="{{trans('employee.birth_date')}}" value="{{$data->birth_date}}" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label required text-info fw-semibold fs-6">{{trans('employee.gender')}} </label>
                            <div class="col-lg-8 fv-row">
                                <select   data-placeholder="Select an option" class=" input-text form-control  form-select  mb-3 mb-lg-0"  name="gender">
                                    <option value="">{{trans('employee.gender')}}</option>
                                    <option value="0" @if($data->gender == '0') selected @endif >{{trans('employee.male')}}</option>
                                    <option value="1" @if($data->gender == '1') selected @endif >{{trans('employee.female')}}</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label required text-info fw-semibold fs-6">{{trans('lang.marital_status')}} </label>
                            <div class="col-lg-8 fv-row">
                                <select   data-placeholder="Select an option" class=" input-text form-control  form-select  mb-3 mb-lg-0"  name="marital_status">
                                    <option value="0" @if($data->marital_status == '0') selected @endif >{{trans('lang.single')}}</option>
                                    <option value="1" @if($data->marital_status == '1') selected @endif >{{trans('lang.married')}}</option>
                                    <option value="2" @if($data->marital_status == '2') selected @endif >{{trans('lang.divorced')}}</option>
                                </select>
                            </div>
                        </div>

                        
                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label required text-info fw-semibold fs-6">{{trans('lang.contact')}} {{trans('lang.specialties')}} </label>
                            <div class="col-lg-8 fv-row">
                                <select  data-placeholder="Select an option" class=" input-text form-control  form-select  mb-3 mb-lg-0" multiple="multiple" name="speciality_id[]" data-control="select2" >
                                    @if(!empty(json_decode($data->speciality_id)))
                                            @foreach ($dataspe as $item)
                                                <option value="{{$item->id}}" @if(in_array($item->id, json_decode($data->speciality_id))) selected @endif> {{$item->name_en}}</option>
                                                @endforeach
                                            @else
                                        @foreach ($dataspe as $item)
                                            <option value="{{$item->id}}">{{$item->name_en}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">{{trans('employee.email')}}</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="email" placeholder="{{trans('employee.email')}}" value="{{$data->email}}" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">{{trans('lang.website')}}</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="website" placeholder="{{trans('lang.website')}}" value="{{$data->website}}" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label required text-info fw-semibold fs-6">{{trans('lang.contact')}} {{trans('lang.type_type')}} </label>
                            <div class="col-lg-8 fv-row">
                                <select  data-placeholder="Select an option" required class=" input-text form-control  form-select  mb-3 mb-lg-0" data-allow-clear="true"   name="typecont_id" data-control="select2" >
                                    <option disabled >Select an option</option>
                                        @if(isset($datatype))
                                            @foreach ($datatype as $item)
                                            <option value="{{$item->id}}" @if($data->typecont_id == $item->id) selected @endif>{{$item->name_en}}</option>
                                            @endforeach
                                        @endif
                                </select>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label required text-info fw-semibold fs-6">{{trans('lang.contact')}} {{trans('lang.social_styls')}} </label>
                            <div class="col-lg-8 fv-row">
                                <select  data-placeholder="Select an option" required class=" input-text form-control  form-select  mb-3 mb-lg-0" data-allow-clear="true"   name="social_id" data-control="select2" >
                                    <option disabled >Select an option</option>
                                        @if(isset($datasoc))
                                            @foreach ($datasoc as $item)
                                                    <option value="{{$item->id}}" @if($data->social_id == $item->id) selected @endif>{{$item->name_en}}</option>
                                                @endforeach
                                        @endif
                                </select>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label required fw-semibold fs-6">{{trans('lang.description')}}</label>
                            <div class="col-lg-10 fv-row">
                                <textarea name="description" id="kt_docs_tinymce_basic">{!! $data->description !!}
                                </textarea>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">{{trans('lang.product_photo')}}</label>
                            <div class="col-lg-8">
                                <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url('assets/media/svg/avatars/blank.svg')">
                                    @if ($data->getMedia('contact')->count())
                                    <div class="image-input-wrapper w-125px h-125px" style="background-image: url({{$data->getFirstMediaUrl('contact', 'thumb')}})"></div>
                                    @else
                                    <div class="image-input-wrapper w-125px h-125px" style="background-image: url({{asset('dash/assets/media/avatars/blank.png')}})"></div>
                                    @endif
                                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                                        <i class="bi bi-pencil-fill fs-7"></i>
                                        <input type="file" name="photo" accept=".png, .jpg, .jpeg" />
                                        <input type="hidden" name="avatar_remove" />
                                    </label>
                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                                        <i class="bi bi-x fs-2"></i>
                                    </span>
                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                                        <i class="bi bi-x fs-2"></i>
                                    </span>
                                </div>

                                <div class="form-text">{{trans('employee.photo_type')}} png, jpg, jpeg.</div>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">{{trans('lang.note')}}</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="note" placeholder="{{trans('lang.note')}}" value="{{$data->note}}" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                            </div>
                        </div>
                        
                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">{{trans('lang.contact')}} {{trans('lang.preferd_gift_brand')}} </label>
                            <div class="col-lg-8 fv-row">
                                <select  data-placeholder="Select an option" class=" input-text form-control  form-select  mb-3 mb-lg-0" data-allow-clear="true"  multiple="multiple" name="preferd_gift_brand[]" data-control="select2" >
                                    @if(!empty(json_decode($data->preferd_gift_brand)))
                                        @foreach ($databragif as $item)
                                            <option value="{{$item->id}}" @if(in_array($item->id, json_decode($data->preferd_gift_brand))) selected @endif> {{$item->name_en}}</option>
                                        @endforeach
                                    @else
                                        @foreach ($databragif as $item)
                                                <option value="{{$item->id}}" @if($data->typecont_id == $item->id) selected @else disabled @endif>{{$item->name_en}}</option>
                                            @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">{{trans('lang.name')}}-{{trans('lang.university_degree')}}</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="university_degree" placeholder="{{trans('lang.university_degree')}}" value="{{$data->university_degree}}" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">{{trans('lang.scientific_degree')}}</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="scientific_degree" placeholder="{{trans('lang.scientific_degree')}}" value="{{$data->scientific_degree}}" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">{{trans('lang.preferd_readding')}}</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="preferd_readding" placeholder="{{trans('lang.preferd_readding')}}" value="{{$data->preferd_readding}}" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                            </div>
                        </div>
                        
                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">{{trans('lang.preferd_gift')}}</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="preferd_gift" placeholder="{{trans('lang.preferd_gift')}}" value="{{$data->preferd_gift}}" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">{{trans('lang.preferd_service')}}</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="preferd_service" placeholder="{{trans('lang.preferd_service')}}" value="{{$data->preferd_service}}" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                            </div>
                        </div>

                        <div class="row mb-0">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6"> {{trans('lang.status')}}</label>
                            <div class="col-lg-8 d-flex align-items-center">
                            <select   data-placeholder="Select an option" class=" input-text form-control  form-select  mb-3 mb-lg-0"  name="status">
                            <option value="0" @if($data->status == '0') selected @endif >{{trans('employee.active')}}</option>
                            <option value="1" @if($data->status == '1') selected @endif >{{trans('employee.notactive')}}</option>                                   
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

<script src="{{ URL::asset('dash/assets/plugins/custom/tinymce/tinymce.bundle.js')}}"></script>

<script>
    var options = {selector: "#kt_docs_tinymce_basic,#kt_docs_tinymce_basic2,#kt_docs_tinymce_basic3,#kt_docs_tinymce_basic4"};

    tinymce.init(options);

</script>
@endsection