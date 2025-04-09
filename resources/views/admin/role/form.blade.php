@php
$permissions = new Spatie\Permission\Models\Permission ;

if (isset($data)) {
    $role = Spatie\Permission\Models\Role::find($data->id);
}
@endphp

<div class="fv-row mb-10">
    <!--begin::Label-->
    <label class="fs-5 fw-bold form-label mb-2">
        <span class="required">{{trans('lang.role')}}</span>
    </label>
    <!--end::Label-->
    <!--begin::Input-->
    <!--end::Input-->
</div>

<div class="row mb-6">
    <label class="col-lg-2 col-form-label required fw-semibold fs-6">{{trans('page.name')}}</label>
    <div class="col-lg-10 fv-row">
        <input type="text" name="name" placeholder="{{trans('page.name')}}" value="{{old('name',$data->name ?? '')}}" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
    </div>
</div>


<div class="fv-row">
    <!--begin::Label-->
    <label class="fs-5 fw-bold form-label mb-2"></label>
    <!--end::Label-->
    <!--begin::Table wrapper-->
    <div class="table-responsive">
        <!--begin::Table-->
        <table class="table align-middle table-row-dashed fs-6 gy-5">
            <!--begin::Table body-->
            <tbody class="text-gray-600 fw-semibold">
                <!--begin::Table row-->
                <tr>
                    <td class="text-gray-800">Administrator Access 
                    <span class="ms-1" data-bs-toggle="tooltip" title="Allows a full access to the system">
                        <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                        </i>
                    </span></td>
                    <td>
                        <!--begin::Checkbox-->
                        <label class="form-check form-check-sm form-check-custom form-check-solid me-9">
                            <input class="form-check-input" type="checkbox" value="" id="kt_roles_select_all" />
                            <span class="form-check-label" for="kt_roles_select_all">Select all</span>
                        </label>
                        <!--end::Checkbox-->
                    </td>
                </tr>
                <!--end::Table row-->
                <!--begin::Table row-->
                
                <tr>
                    <!--begin::Label-->
                    <td class="text-gray-800">Visit plan </td>
                    <!--end::Label-->
                    <!--begin::Input group-->
                    <td>
                        <!--begin::Wrapper-->
                        <div class="d-flex">
                            <!--begin::Checkbox-->
                            <label class="form-check form-check-sm form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('visit plan')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('visit plan')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">List</span>
                            </label>
                            <label class="form-check form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('visit plan new')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('visit plan new')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">Create</span>
                            </label>
                            <!--end::Checkbox-->
                        </div>
                        <!--end::Wrapper-->
                    </td>
                    <!--end::Input group-->
                </tr>
                <tr>
                    <!--begin::Label-->
                    <td class="text-gray-800">Visit </td>
                    <!--end::Label-->
                    <!--begin::Input group-->
                    <td>
                        <!--begin::Wrapper-->
                        <div class="d-flex">
                            <!--begin::Checkbox-->
                            <label class="form-check form-check-sm form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('visit')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('visit')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">List</span>
                            </label>
                            <label class="form-check form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('visit new')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('visit new')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">Create</span>
                            </label>
                            <!--end::Checkbox-->
                        </div>
                        <!--end::Wrapper-->
                    </td>
                    <!--end::Input group-->
                </tr>
                <tr>
                    <!--begin::Label-->
                    <td class="text-gray-800">Report </td>
                    <!--end::Label-->
                    <!--begin::Input group-->
                    <td>
                        <!--begin::Wrapper-->
                        <div class="d-flex">
                            <!--begin::Checkbox-->
                            <label class="form-check form-check-sm form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('report list')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('report list')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">report list</span>
                            </label>
                            <label class="form-check form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('report product')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('report product')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">report product</span>
                            </label>
                            <!--end::Checkbox-->
                        </div>
                        <!--end::Wrapper-->
                    </td>
                    <!--end::Input group-->
                </tr>
                <tr>
                    <!--begin::Label-->
                    <td class="text-gray-800">{{trans('lang.sales')}}</td>
                    <!--end::Label-->
                    <!--begin::Input group-->
                    <td>
                        <!--begin::Wrapper-->
                        <div class="d-flex">
                            <!--begin::Checkbox-->
                            <label class="form-check form-check-sm form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('sale')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('sale')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">List</span>
                            </label>
                            <!--end::Checkbox-->
                            <!--begin::Checkbox-->
                            <label class="form-check form-check-sm form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('sale_requests')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('sale_requests')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">{{trans('lang.all')}} {{trans('lang.requests')}} {{trans('lang.bills_of_sale')}}</span>
                            </label>
                            <!--end::Checkbox-->
                            <!--begin::Checkbox-->
                            <label class="form-check form-check-sm form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('sale_delivered')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('sale_delivered')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">{{trans('lang.all')}} {{trans('lang.bills_of_sale')}} - {{trans('lang.delivered')}}</span>
                            </label>
                            <!--end::Checkbox-->
                        </div>
                        <!--end::Wrapper-->
                    </td>
                    <!--end::Input group-->
                </tr>
                <tr>
                    <!--begin::Label-->
                    <td class="text-gray-800">{{trans('lang.customers')}}</td>
                    <!--end::Label-->
                    <!--begin::Input group-->
                    <td>
                        <!--begin::Wrapper-->
                        <div class="d-flex">
                            <!--begin::Checkbox-->
                            <label class="form-check form-check-sm form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('all customers')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('all customers')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">List</span>
                            </label>
                            <!--end::Checkbox-->
                            <!--begin::Checkbox-->
                            <label class="form-check form-check-sm form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('customer details')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('customer details')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">Show </span>
                            </label>
                            <!--end::Checkbox-->
                            <!--begin::Checkbox-->
                            <label class="form-check form-check-sm form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('customer new')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('customer new')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">Create </span>
                            </label>
                            <!--end::Checkbox-->
                            <!--begin::Checkbox-->
                            <label class="form-check form-check-sm form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('all trans customers')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('all trans customers')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">Show {{trans('lang.all')}} {{trans('lang.transactions')}}</span>
                            </label>
                            <!--end::Checkbox-->
                            <!--begin::Checkbox-->
                            <label class="form-check form-check-sm form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('cust collection')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('cust collection')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">{{trans('lang.addnew')}} {{trans('lang.cust_collection')}}</span>
                            </label>
                            <!--end::Checkbox-->
                            
                        </div>
                        <!--end::Wrapper-->
                    </td>
                    <!--end::Input group-->
                </tr>
                <tr>
                    <!--begin::Label-->
                    <td class="text-gray-800">{{trans('lang.returns')}} {{trans('lang.customers')}}</td>
                    <!--end::Label-->
                    <!--begin::Input group-->
                    <td>
                        <!--begin::Wrapper-->
                        <div class="d-flex">
                            <!--begin::Checkbox-->
                            <label class="form-check form-check-sm form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('all customers return')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('all customers return')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">List</span>
                            </label>
                            <label class="form-check form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('customers return details')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('customers return details')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">Show</span>
                            </label>
                            <label class="form-check form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('customers return new')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('customers return new')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">Create</span>
                            </label>
                            <label class="form-check form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('customers return edit')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('customers return edit')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">Update</span>
                            </label>
                            <!--end::Checkbox-->
                        </div>
                        <!--end::Wrapper-->
                    </td>
                    <!--end::Input group-->
                </tr>
                <tr>
                    <!--begin::Label-->
                    <td class="text-gray-800">{{trans('lang.reports')}}- {{trans('lang.sales')}}</td>
                    <!--end::Label-->
                    <!--begin::Input group-->
                    <td>
                        <!--begin::Wrapper-->
                        <div class="d-flex">
                            <!--begin::Checkbox-->
                            <label class="form-check form-check-sm form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('sale report')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('sale report')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">List</span>
                            </label>
                            <!--end::Checkbox-->
                            <!--begin::Checkbox-->
                            <label class="form-check form-check-sm form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('sale bills')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('sale bills')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">show {{trans('lang.all')}} {{trans('lang.bills_of_sale')}}</span>
                            </label>
                            <!--end::Checkbox-->
                            <!--begin::Checkbox-->
                            <label class="form-check form-check-sm form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('sale bills employee')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('sale bills employee')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">show {{trans('lang.sales')}} - {{trans('employee.employees')}}</span>
                            </label>
                            <!--end::Checkbox-->
                            <!--begin::Checkbox-->
                            <label class="form-check form-check-sm form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('all sale bills employee')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('all sale bills employee')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">show {{trans('lang.all')}} {{trans('lang.sales')}} {{trans('employee.employees')}}</span>
                            </label>
                            <!--end::Checkbox-->
                            
                        </div>
                        <!--end::Wrapper-->
                    </td>
                    <!--end::Input group-->
                </tr>
                <tr>
                    <!--begin::Label-->
                    <td class="text-gray-800">List </td>
                    <!--end::Label-->
                    <!--begin::Input group-->
                    <td>
                        <!--begin::Wrapper-->
                        <div class="d-flex">
                            <!--begin::Checkbox-->
                            <label class="form-check form-check-sm form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('all list')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('all list')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">List</span>
                            </label>
                            <label class="form-check form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('list details')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('list details')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">Show</span>
                            </label>
                            <label class="form-check form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('list new')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('list new')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">Create</span>
                            </label>
                            <label class="form-check form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('list edit')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('list edit')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">Update</span>
                            </label>
                            <!--end::Checkbox-->
                        </div>
                        <!--end::Wrapper-->
                    </td>
                    <!--end::Input group-->
                </tr>
                <tr>
                    <!--begin::Label-->
                    <td class="text-gray-800">Tool </td>
                    <!--end::Label-->
                    <!--begin::Input group-->
                    <td>
                        <!--begin::Wrapper-->
                        <div class="d-flex">
                            <!--begin::Checkbox-->
                            <label class="form-check form-check-sm form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('all tool')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('all tool')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">List</span>
                            </label>
                            <label class="form-check form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('tool new')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('tool new')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">Create</span>
                            </label>
                            <!--end::Checkbox-->
                        </div>
                        <!--end::Wrapper-->
                    </td>
                    <!--end::Input group-->
                </tr>
                <tr>
                    <!--begin::Label-->
                    <td class="text-gray-800">Contact </td>
                    <!--end::Label-->
                    <!--begin::Input group-->
                    <td>
                        <!--begin::Wrapper-->
                        <div class="d-flex">
                            <!--begin::Checkbox-->
                            <label class="form-check form-check-sm form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('all contact')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('all contact')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">List</span>
                            </label>
                            <label class="form-check form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('contact details')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('contact details')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">Show</span>
                            </label>
                            <label class="form-check form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('contact new')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('contact new')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">Create</span>
                            </label>
                            <label class="form-check form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('contact edit')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('contact edit')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">Update</span>
                            </label>
                            <!--end::Checkbox-->
                        </div>
                        <!--end::Wrapper-->
                    </td>
                    <!--end::Input group-->
                </tr>
                <tr>
                    <!--begin::Label-->
                    <td class="text-gray-800">Contact place</td>
                    <!--end::Label-->
                    <!--begin::Input group-->
                    <td>
                        <!--begin::Wrapper-->
                        <div class="d-flex">
                            <!--begin::Checkbox-->
                            <label class="form-check form-check-sm form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('all contact place')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('all contact place')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">List</span>
                            </label>
                            <label class="form-check form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('contact place details')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('contact place details')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">Show</span>
                            </label>
                            <label class="form-check form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('contact place new')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('contact place new')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">Create</span>
                            </label>
                            <label class="form-check form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('contact place edit')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('contact place edit')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">Update</span>
                            </label>
                            <!--end::Checkbox-->
                        </div>
                        <!--end::Wrapper-->
                    </td>
                    <!--end::Input group-->
                </tr>
                <tr>
                    <!--begin::Label-->
                    <td class="text-gray-800">Contact type</td>
                    <!--end::Label-->
                    <!--begin::Input group-->
                    <td>
                        <!--begin::Wrapper-->
                        <div class="d-flex">
                            <!--begin::Checkbox-->
                            <label class="form-check form-check-sm form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('all contact type')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('all contact type')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">List</span>
                            </label>
                            <label class="form-check form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('contact type details')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('contact type details')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">Show</span>
                            </label>
                            <label class="form-check form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('contact type new')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('contact type new')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">Create</span>
                            </label>
                            <label class="form-check form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('contact type edit')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('contact type edit')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">Update</span>
                            </label>
                            <!--end::Checkbox-->
                        </div>
                        <!--end::Wrapper-->
                    </td>
                    <!--end::Input group-->
                </tr>
                <tr>
                    <!--begin::Label-->
                    <td class="text-gray-800">Contact other</td>
                    <!--end::Label-->
                    <!--begin::Input group-->
                    <td>
                        <!--begin::Wrapper-->
                        <div class="d-flex">
                            <!--begin::Checkbox-->
                            <label class="form-check form-check-sm form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('contact relative')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('contact relative')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">contact relative</span>
                            </label>
                            <label class="form-check form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('contact rate')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('contact rate')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">contact rate</span>
                            </label>
                            <!--end::Checkbox-->
                        </div>
                        <!--end::Wrapper-->
                    </td>
                    <!--end::Input group-->
                </tr>
                <tr>
                    <!--begin::Label-->
                    <td class="text-gray-800">Center </td>
                    <!--end::Label-->
                    <!--begin::Input group-->
                    <td>
                        <!--begin::Wrapper-->
                        <div class="d-flex">
                            <!--begin::Checkbox-->
                            <label class="form-check form-check-sm form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('all center')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('all center')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">List</span>
                            </label>
                            <label class="form-check form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('center details')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('center details')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">Show</span>
                            </label>
                            <label class="form-check form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('center new')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('center new')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">Create</span>
                            </label>
                            <label class="form-check form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('center edit')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('center edit')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">Update</span>
                            </label>
                            <!--end::Checkbox-->
                        </div>
                        <!--end::Wrapper-->
                    </td>
                    <!--end::Input group-->
                </tr>
                <tr>
                    <!--begin::Label-->
                    <td class="text-gray-800">Assistant </td>
                    <!--end::Label-->
                    <!--begin::Input group-->
                    <td>
                        <!--begin::Wrapper-->
                        <div class="d-flex">
                            <!--begin::Checkbox-->
                            <label class="form-check form-check-sm form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('all assistant')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('all assistant')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">List</span>
                            </label>
                            <label class="form-check form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('assistant details')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('assistant details')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">Show</span>
                            </label>
                            <label class="form-check form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('assistant new')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('assistant new')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">Create</span>
                            </label>
                            <label class="form-check form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('assistant edit')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('assistant edit')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">Update</span>
                            </label>
                            <label class="form-check form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('assistant delete')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('assistant delete')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">Delete</span>
                            </label>
                            <!--end::Checkbox-->
                        </div>
                        <!--end::Wrapper-->
                    </td>
                    <!--end::Input group-->
                </tr>
                <tr>
                    <!--begin::Label-->
                    <td class="text-gray-800">Vacation </td>
                    <!--end::Label-->
                    <!--begin::Input group-->
                    <td>
                        <!--begin::Wrapper-->
                        <div class="d-flex">
                            <!--begin::Checkbox-->
                            <label class="form-check form-check-sm form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('all vacation')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('all vacation')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">List</span>
                            </label>
                            <label class="form-check form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('vacation request')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('vacation request')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">Show</span>
                            </label>
                            <label class="form-check form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('vacation new')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('vacation new')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">Create</span>
                            </label>
                            <label class="form-check form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('vacation edit')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('vacation edit')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">Update</span>
                            </label>
                            <!--end::Checkbox-->
                        </div>
                        <!--end::Wrapper-->
                    </td>
                    <!--end::Input group-->
                </tr>
                <tr>
                    <!--begin::Label-->
                    <td class="text-gray-800">Expense </td>
                    <!--end::Label-->
                    <!--begin::Input group-->
                    <td>
                        <!--begin::Wrapper-->
                        <div class="d-flex">
                            <!--begin::Checkbox-->
                            <label class="form-check form-check-sm form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('all expense')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('all expense')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">List</span>
                            </label>
                            <label class="form-check form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('expense details')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('expense details')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">Show</span>
                            </label>
                            <label class="form-check form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('expense new')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('expense new')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">Create</span>
                            </label>
                            <label class="form-check form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('expense edit')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('expense edit')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">Update</span>
                            </label>
                            <label class="form-check form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('expense delete')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('expense delete')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">Delete</span>
                            </label>
                            <!--end::Checkbox-->
                        </div>
                        <!--end::Wrapper-->
                    </td>
                    <!--end::Input group-->
                </tr>
                <tr>
                    <!--begin::Label-->
                    <td class="text-gray-800">product </td>
                    <!--end::Label-->
                    <!--begin::Input group-->
                    <td>
                        <!--begin::Wrapper-->
                        <div class="d-flex">
                            <!--begin::Checkbox-->
                            <label class="form-check form-check-sm form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('all product')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('all product')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">List</span>
                            </label>
                            <label class="form-check form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('product details')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('product details')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">Show</span>
                            </label>
                            <label class="form-check form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('product new')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('product new')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">Create</span>
                            </label>
                            <label class="form-check form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('product edit')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('product edit')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">Update</span>
                            </label>
                            <label class="form-check form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('product delete')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('product delete')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">Delete</span>
                            </label>
                            <!--end::Checkbox-->
                        </div>
                        <!--end::Wrapper-->
                    </td>
                    <!--end::Input group-->
                </tr>
                <tr>
                    <!--begin::Label-->
                    <td class="text-gray-800">product msg </td>
                    <!--end::Label-->
                    <!--begin::Input group-->
                    <td>
                        <!--begin::Wrapper-->
                        <div class="d-flex">
                            <!--begin::Checkbox-->
                            <label class="form-check form-check-sm form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('all product msg')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('all product msg')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">List</span>
                            </label>
                            <label class="form-check form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('product msg details')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('product msg details')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">Show</span>
                            </label>
                            <label class="form-check form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('product msg new')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('product msg new')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">Create</span>
                            </label>
                            <label class="form-check form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('product msg edit')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('product msg edit')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">Update</span>
                            </label>
                            <label class="form-check form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('product msg delete')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('product msg delete')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">Delete</span>
                            </label>
                            <!--end::Checkbox-->
                        </div>
                        <!--end::Wrapper-->
                    </td>
                    <!--end::Input group-->
                </tr>
                <tr>
                    <!--begin::Label-->
                    <td class="text-gray-800">Area </td>
                    <!--end::Label-->
                    <!--begin::Input group-->
                    <td>
                        <!--begin::Wrapper-->
                        <div class="d-flex">
                            <!--begin::Checkbox-->
                            <label class="form-check form-check-sm form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('all area')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('all area')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">List</span>
                            </label>
                            <label class="form-check form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('area details')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('area details')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">Show</span>
                            </label>
                            <label class="form-check form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('area new')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('area new')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">Create</span>
                            </label>
                            <label class="form-check form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('area edit')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('area edit')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">Update</span>
                            </label>
                            <label class="form-check form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('area delete')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('area delete')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">Delete</span>
                            </label>
                            <!--end::Checkbox-->
                        </div>
                        <!--end::Wrapper-->
                    </td>
                    <!--end::Input group-->
                </tr>
                <tr>
                    <!--begin::Label-->
                    <td class="text-gray-800">Specialty </td>
                    <!--end::Label-->
                    <!--begin::Input group-->
                    <td>
                        <!--begin::Wrapper-->
                        <div class="d-flex">
                            <!--begin::Checkbox-->
                            <label class="form-check form-check-sm form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('all specialty')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('all specialty')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">List</span>
                            </label>
                            <label class="form-check form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('specialty details')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('specialty details')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">Show</span>
                            </label>
                            <label class="form-check form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('specialty new')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('specialty new')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">Create</span>
                            </label>
                            <label class="form-check form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('specialty edit')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('specialty edit')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">Update</span>
                            </label>
                            <label class="form-check form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('specialty delete')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('specialty delete')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">Delete</span>
                            </label>
                            <!--end::Checkbox-->
                        </div>
                        <!--end::Wrapper-->
                    </td>
                    <!--end::Input group-->
                </tr>
                <tr>
                    <!--begin::Label-->
                    <td class="text-gray-800">brand gift </td>
                    <!--end::Label-->
                    <!--begin::Input group-->
                    <td>
                        <!--begin::Wrapper-->
                        <div class="d-flex">
                            <!--begin::Checkbox-->
                            <label class="form-check form-check-sm form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('all brand gift')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('all brand gift')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">List</span>
                            </label>
                            <label class="form-check form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('brand gift details')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('brand gift details')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">Show</span>
                            </label>
                            <label class="form-check form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('brand gift new')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('brand gift new')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">Create</span>
                            </label>
                            <label class="form-check form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('brand gift edit')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('brand gift edit')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">Update</span>
                            </label>
                            <label class="form-check form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('brand gift delete')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('brand gift delete')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">Delete</span>
                            </label>
                            <!--end::Checkbox-->
                        </div>
                        <!--end::Wrapper-->
                    </td>
                    <!--end::Input group-->
                </tr>
                <tr>
                    <!--begin::Label-->
                    <td class="text-gray-800">social style </td>
                    <!--end::Label-->
                    <!--begin::Input group-->
                    <td>
                        <!--begin::Wrapper-->
                        <div class="d-flex">
                            <!--begin::Checkbox-->
                            <label class="form-check form-check-sm form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('all social style')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('all social style')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">List</span>
                            </label>
                            <label class="form-check form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('social style details')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('social style details')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">Show</span>
                            </label>
                            <label class="form-check form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('social style new')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('social style new')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">Create</span>
                            </label>
                            <label class="form-check form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('social style edit')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('social style edit')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">Update</span>
                            </label>
                            <label class="form-check form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('social style delete')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('social style delete')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">Delete</span>
                            </label>
                            <!--end::Checkbox-->
                        </div>
                        <!--end::Wrapper-->
                    </td>
                    <!--end::Input group-->
                </tr>
                <tr>
                    <!--begin::Label-->
                    <td class="text-gray-800">sale funnel </td>
                    <!--end::Label-->
                    <!--begin::Input group-->
                    <td>
                        <!--begin::Wrapper-->
                        <div class="d-flex">
                            <!--begin::Checkbox-->
                            <label class="form-check form-check-sm form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('all sale funnel')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('all sale funnel')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">List</span>
                            </label>
                            <label class="form-check form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('sale funnel details')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('sale funnel details')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">Show</span>
                            </label>
                            <label class="form-check form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('sale funnel new')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('sale funnel new')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">Create</span>
                            </label>
                            <label class="form-check form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('sale funnel edit')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('sale funnel edit')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">Update</span>
                            </label>
                            <!--end::Checkbox-->
                        </div>
                        <!--end::Wrapper-->
                    </td>
                    <!--end::Input group-->
                </tr>
                <tr>
                    <!--begin::Label-->
                    <td class="text-gray-800">rating </td>
                    <!--end::Label-->
                    <!--begin::Input group-->
                    <td>
                        <!--begin::Wrapper-->
                        <div class="d-flex">
                            <!--begin::Checkbox-->
                            <label class="form-check form-check-sm form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('all rating')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('all rating')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">List</span>
                            </label>
                            <label class="form-check form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('rating details')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('rating details')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">Show</span>
                            </label>
                            <label class="form-check form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('rating new')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('rating new')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">Create</span>
                            </label>
                            <label class="form-check form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('rating edit')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('rating edit')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">Update</span>
                            </label>
                            <label class="form-check form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('rating delete')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('rating delete')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">Delete</span>
                            </label>
                            <!--end::Checkbox-->
                        </div>
                        <!--end::Wrapper-->
                    </td>
                    <!--end::Input group-->
                </tr>
                <tr>
                    <!--begin::Label-->
                    <td class="text-gray-800">event </td>
                    <!--end::Label-->
                    <!--begin::Input group-->
                    <td>
                        <!--begin::Wrapper-->
                        <div class="d-flex">
                            <!--begin::Checkbox-->
                            <label class="form-check form-check-sm form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('all event')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('all event')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">List</span>
                            </label>
                            <label class="form-check form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('event details')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('event details')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">Show</span>
                            </label>
                            <label class="form-check form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('event new')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('event new')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">Create</span>
                            </label>
                            <label class="form-check form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('event edit')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('event edit')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">Update</span>
                            </label>
                            <label class="form-check form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('event delete')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('event delete')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">Delete</span>
                            </label>
                            <!--end::Checkbox-->
                        </div>
                        <!--end::Wrapper-->
                    </td>
                    <!--end::Input group-->
                </tr>

                <tr>
                    <!--begin::Label-->
                    <td class="text-gray-800">Employee </td>
                    <!--end::Label-->
                    <!--begin::Input group-->
                    <td>
                        <!--begin::Wrapper-->
                        <div class="d-flex">
                            <!--begin::Checkbox-->
                            <label class="form-check form-check-sm form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('all employee')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('all employee')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">List</span>
                            </label>
                            <label class="form-check form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('employee details')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('employee details')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">Show</span>
                            </label>
                            <label class="form-check form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('employee new')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('employee new')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">Create</span>
                            </label>
                            <label class="form-check form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('employee edit')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('employee edit')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">Update</span>
                            </label>
                            <label class="form-check form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('employee delete')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('employee delete')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">Delete</span>
                            </label>
                            <!--end::Checkbox-->
                        </div>
                        <!--end::Wrapper-->
                    </td>
                    <!--end::Input group-->
                </tr>
                <tr>
                    <!--begin::Label-->
                    <td class="text-gray-800">Roles </td>
                    <!--end::Label-->
                    <!--begin::Input group-->
                    <td>
                        <!--begin::Wrapper-->
                        <div class="d-flex">
                            <!--begin::Checkbox-->
                            <label class="form-check form-check-sm form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('all role')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('all role')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">List</span>
                            </label>
                            <label class="form-check form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('role new')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('role new')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">Create</span>
                            </label>
                            <label class="form-check form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('role edit')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('role edit')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">Update</span>
                            </label>
                            <label class="form-check form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('role delete')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('role delete')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">Delete</span>
                            </label>
                            <!--end::Checkbox-->
                        </div>
                        <!--end::Wrapper-->
                    </td>
                    <!--end::Input group-->
                </tr>
                <tr>
                    <!--begin::Label-->
                    <td class="text-gray-800">Setting </td>
                    <!--end::Label-->
                    <!--begin::Input group-->
                    <td>
                        <!--begin::Wrapper-->
                        <div class="d-flex">
                            <!--begin::Checkbox-->
                            <label class="form-check form-check-sm form-check-custom form-check-solid me-3 me-lg-10">
                                <input class="form-check-input" type="checkbox" value="{{$permissions->findByName('setting')->id}}" {{ isset($data) ? $role->hasPermissionTo($permissions->findByName('setting')) ? 'checked' : '':'' }} name="permissions[]" />
                                <span class="form-check-label">Setting</span>
                            </label>
                            <!--end::Checkbox-->
                        </div>
                        <!--end::Wrapper-->
                    </td>
                    <!--end::Input group-->
                </tr>
                <!--end::Table row-->

            </tbody>
            <!--end::Table body-->
        </table>
        <!--end::Table-->
    </div>
    <!--end::Table wrapper-->
</div>
