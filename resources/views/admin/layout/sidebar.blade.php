<!--begin::Sidebar-->
<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="250px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
    <!--begin::Wrapper-->
    <div id="kt_app_sidebar_wrapper" class="app-sidebar-wrapper hover-scroll-y my-5 my-lg-2 " data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_header" data-kt-scroll-wrappers="#kt_app_sidebar_wrapper" data-kt-scroll-offset="5px">
        <!--begin::Sidebar menu-->
        <div id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false" class="app-sidebar-menu-primary menu menu-column menu-rounded menu-sub-indention menu-state-bullet-primary px-6 mb-5">

            <!-- <div class="menu-item">
                <a class="menu-link" href="{{url('/admin')}}">
                    <span class="menu-icon">
                        <i class="fonticon-setting fs-2"></i>
                    </span>
                    <span class="menu-title">{{trans('lang.dashboard')}}</span>
                </a>
            </div> -->
            <div class="menu-item ">
                <button class="btn btn-primary rotate container fw-bold fs-2 justify-content-center"  data-kt-menu-trigger="hover">
                    <span class="menu-icon">
                        <!-- <i class="fonticon-setting fs-1"></i> -->
                    </span>
                    <span class="menu-title">{{trans('lang.visit')}}</span></button>
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-auto min-w-200 mw-300px" data-kt-menu="true">
                            <!--begin::Menu item-->
                            @can('visit plan')
                            <div class="menu-item px-3">
                                <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-1">
                                    <a class="menu-link" href="{{route('admin.plan_visits.index')}}">
                                    <span class="menu-icon"><i class="fonticon-setting fs-2"></i></span>
                                    <span class="menu-title">{{trans('lang.plan')}} {{trans('lang.visit')}}</span></a>
                                </div>
                            </div>
                            @endcan
                            @can('visit plan new')
                            <div class="menu-item px-3">
                                <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-1">
                                    <a class="menu-link" href="{{route('admin.plan_visits.create')}}">
                                    <span class="menu-icon"><i class="fonticon-setting fs-2"></i></span>
                                    <span class="menu-title">{{trans('lang.plan')}}-{{trans('lang.visit')}}-{{trans('employee.add_new')}}</span></a>
                                </div>
                            </div>
                            @endcan
                            @can('visit')
                            <div class="menu-item px-3">
                                <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-1">
                                    <a class="menu-link" href="{{route('admin.visits.index')}}">
                                    <span class="menu-icon"><i class="fonticon-setting fs-2"></i></span>
                                    <span class="menu-title">{{trans('lang.visit')}}-{{trans('lang.all')}}</span></a>
                                </div>
                            </div>
                            @endcan
                            @can('visit new')
                            <div class="menu-item px-3">
                                <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-1">
                                    <a class="menu-link" href="{{route('admin.visits.create')}}">
                                    <span class="menu-icon"><i class="fonticon-setting fs-2"></i></span>
                                    <span class="menu-title">{{trans('lang.visit')}}-{{trans('employee.add_new')}}</span></a>
                                </div>
                            </div>
                            @endcan
                            @can('report list')
                            <div class="menu-item px-3">
                                <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-1">
                                    <a class="menu-link" href="{{route('admin.visits.reportlist')}}">
                                    <span class="menu-icon"><i class="fonticon-setting fs-2"></i></span>
                                    <span class="menu-title">{{trans('lang.report')}}-{{trans('lang.nutrilist')}}</span></a>
                                </div>
                            </div>
                            @endcan
                            @can('report product')
                            <div class="menu-item px-3">
                                <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-1">
                                    <a class="menu-link" href="{{route('admin.visits.reportprod')}}">
                                    <span class="menu-icon"><i class="fonticon-setting fs-2"></i></span>
                                    <span class="menu-title">{{trans('lang.report')}}-{{trans('lang.products')}}</span></a>
                                </div>
                            </div>
                            @endcan
                            <!--end::Menu item-->
                        </div>
            </div> 
            @can('all list')
            <div class="menu-item">
                <button class="btn btn-primary rotate container fw-bold fs-2 justify-content-center"  data-kt-menu-trigger="hover">
                    <span class="menu-icon">
                        <!-- <i class="fonticon-setting fs-1"></i> -->
                    </span>
                    <span class="menu-title">{{trans('lang.nutrilist')}}</span></button>
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-auto min-w-200 mw-300px" data-kt-menu="true">
                            <!--begin::Menu item-->
                            @can('all list')
                            <div class="menu-item px-3">
                                <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-1">
                                    <a class="menu-link" href="{{route('admin.list_contacs.index')}}">
                                    <span class="menu-icon"><i class="fonticon-setting fs-2"></i></span>
                                    <span class="menu-title">{{trans('lang.nutrilist')}}-{{trans('lang.all')}}</span></a>
                                </div>
                            </div>
                            @endcan
                            @can('list new')
                            <div class="menu-item px-3">
                                <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-1">
                                    <a class="menu-link" href="{{route('admin.list_contacs.create')}}">
                                    <span class="menu-icon"><i class="fonticon-setting fs-2"></i></span>
                                    <span class="menu-title">{{trans('lang.nutrilist')}}-{{trans('lang.addnew')}}</span></a>
                                </div>
                            </div>
                            @endcan
                            <!--end::Menu item-->
                        </div>
            </div> 
            @endcan
            @can('all employee')
            <div class="menu-item ">
                <button class="btn btn-primary rotate container fw-bold fs-2 justify-content-center"  data-kt-menu-trigger="hover">
                    <span class="menu-icon">
                        <!-- <i class="fonticon-setting fs-1"></i> -->
                    </span>
                    <span class="menu-title">{{trans('employee.employees')}}</span></button>
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-auto min-w-200 mw-300px" data-kt-menu="true">
                            <!--begin::Menu item-->
                            @can('all employee')
                            <div class="menu-item px-3">
                                <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-1">
                                    <a class="menu-link" href="{{route('admin.employees.index')}}">
                                    <span class="menu-icon"><i class="fonticon-setting fs-2"></i></span>
                                    <span class="menu-title">{{trans('employee.employees')}}</span></a>
                                </div>
                            </div>
                            @endcan
                            @can('employee new')
                            <div class="menu-item px-3">
                                <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-1">
                                    <a class="menu-link" href="{{route('admin.employees.create')}}">
                                    <span class="menu-icon"><i class="fonticon-setting fs-2"></i></span>
                                    <span class="menu-title">{{trans('employee.employee')}}-{{trans('employee.add_new')}}</span></a>
                                </div>
                            </div>
                            @endcan
                            @can('all role')
                            <div class="menu-item px-3">
                                <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-1">
                                    <a class="menu-link" href="{{route('admin.roles.index')}}">
                                    <span class="menu-icon"><i class="fonticon-setting fs-2"></i></span>
                                    <span class="menu-title">{{trans('lang.role')}}</span></a>
                                </div>
                            </div>
                            @endcan
                            @can('all tool')
                            <div class="menu-item px-3">
                                <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-1">
                                    <a class="menu-link" href="{{route('admin.tools.index')}}">
                                    <span class="menu-icon"><i class="fonticon-setting fs-2"></i></span>
                                    <span class="menu-title">{{trans('lang.tools')}}</span></a>
                                </div>
                            </div>
                            @endcan
                            <!--end::Menu item-->
                        </div>
            </div> 
            @endcan

            <div class="menu-item">
                <button class="btn btn-danger rotate container fw-bold fs-2 justify-content-center"  data-kt-menu-trigger="hover">
                    <span class="menu-icon">
                        <!-- <i class="fonticon-setting fs-2"></i> -->
                    </span>
                    <span class="menu-title">{{trans('lang.contact')}}</span></button>
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-danger fw-semibold w-auto min-w-200 mw-300px" data-kt-menu="true">
                            <!--begin::Menu item-->
                            @can('all contact')
                            <div class="menu-item px-3">
                                <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-1">
                                    <a class="menu-link" href="{{route('admin.contacts.index')}}">
                                    <span class="menu-icon"><i class="fonticon-setting fs-2"></i></span>
                                    <span class="menu-title">{{trans('lang.contact')}}-{{trans('lang.all')}}</span></a>
                                </div>
                            </div>
                            @endcan
                            @can('contact new')
                            <div class="menu-item px-3">
                                <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-1">
                                    <a class="menu-link" href="{{route('admin.contacts.create')}}">
                                    <span class="menu-icon"><i class="fonticon-setting fs-2"></i></span>
                                    <span class="menu-title">{{trans('lang.contact')}}-{{trans('lang.addnew')}}</span></a>
                                </div>
                            </div>
                            @endcan
                            @can('contact rate')
                            <div class="menu-item px-3">
                                <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-1">
                                    <a class="menu-link" href="{{route('admin.ratingcontacts.index')}}">
                                    <span class="menu-icon"><i class="fonticon-setting fs-2"></i></span>
                                    <span class="menu-title">{{trans('lang.contact')}}-{{trans('lang.degree')}}-{{trans('lang.all')}}</span></a>
                                </div>
                            </div>
                            @endcan
                            @can('all contact place')
                            <div class="menu-item px-3">
                                <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-1">
                                    <a class="menu-link" href="{{route('admin.place_ws.index')}}">
                                    <span class="menu-icon"><i class="fonticon-setting fs-2"></i></span>
                                    <span class="menu-title">{{trans('lang.contact')}}-{{trans('lang.place')}}-{{trans('lang.all')}}</span></a>
                                </div>
                            </div>
                            @endcan
                            @can('contact place new')
                            <div class="menu-item px-3">
                                <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-1">
                                    <a class="menu-link" href="{{route('admin.place_ws.create')}}">
                                    <span class="menu-icon"><i class="fonticon-setting fs-2"></i></span>
                                    <span class="menu-title">{{trans('lang.contact')}}-{{trans('lang.place')}}-{{trans('lang.addnew')}}</span></a>
                                </div>
                            </div>
                            @endcan
                            @can('contact rate')
                            <div class="menu-item px-3">
                                <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-1">
                                    <a class="menu-link" href="{{route('admin.contacts.add_contact_rate')}}">
                                    <span class="menu-icon"><i class="fonticon-setting fs-2"></i></span>
                                    <span class="menu-title">{{trans('lang.ratings')}}-{{trans('lang.contact')}}-{{trans('lang.addnew')}}</span></a>
                                </div>
                            </div>
                            @endcan
                            @can('contact relative')
                            <div class="menu-item px-3">
                                <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-1">
                                    <a class="menu-link" href="{{route('admin.relativ_contacts.create')}}">
                                    <span class="menu-icon"><i class="fonticon-setting fs-2"></i></span>
                                    <span class="menu-title">{{trans('lang.relatives')}}-{{trans('lang.addnew')}}</span></a>
                                </div>
                            </div>
                            @endcan
                            @can('contact relative')
                            <div class="menu-item px-3">
                                <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-1">
                                    <a class="menu-link" href="{{route('admin.relativ_contacts.index')}}">
                                    <span class="menu-icon"><i class="fonticon-setting fs-2"></i></span>
                                    <span class="menu-title">{{trans('lang.relatives')}}-{{trans('lang.all')}}</span></a>
                                </div>
                            </div>
                            @endcan
                            @can('contact type new')
                            <div class="menu-item px-3">
                                <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-1">
                                    <a class="menu-link" href="{{route('admin.typecontacts.create')}}">
                                    <span class="menu-icon"><i class="fonticon-setting fs-2"></i></span>
                                    <span class="menu-title">{{trans('lang.type_type')}}-{{trans('lang.addnew')}}</span></a>
                                </div>
                            </div>
                            @endcan
                            @can('all contact type')
                            <div class="menu-item px-3">
                                <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-1">
                                    <a class="menu-link" href="{{route('admin.typecontacts.index')}}">
                                    <span class="menu-icon"><i class="fonticon-setting fs-2"></i></span>
                                    <span class="menu-title">{{trans('lang.type_type')}}-{{trans('lang.all')}}</span></a>
                                </div>
                            </div>
                            @endcan
                            
                            <!--end::Menu item-->
                    </div>
            </div>
            @can('all center')
            <div class="menu-item">
                <button class="btn btn-primary rotate container fw-bold fs-2 justify-content-center"  data-kt-menu-trigger="hover">
                    <span class="menu-icon">
                        <!-- <i class="fonticon-setting fs-1"></i> -->
                    </span>
                    <span class="menu-title">{{trans('lang.center')}}</span></button>
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-auto min-w-200 mw-300px" data-kt-menu="true">
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-1">
                                    <a class="menu-link" href="{{route('admin.centers.index')}}">
                                    <span class="menu-icon"><i class="fonticon-setting fs-2"></i></span>
                                    <span class="menu-title">{{trans('lang.center')}}-{{trans('lang.all')}}</span></a>
                                </div>
                            </div>
                            @can('center new')
                            <div class="menu-item px-3">
                                <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-1">
                                    <a class="menu-link" href="{{route('admin.centers.create')}}">
                                    <span class="menu-icon"><i class="fonticon-setting fs-2"></i></span>
                                    <span class="menu-title">{{trans('lang.center')}}-{{trans('lang.addnew')}}</span></a>
                                </div>
                            </div>
                            @endcan
                           <!--end::Menu item-->

                        </div>
            </div> 
            @endcan
            @can('sale')
            <div class="menu-item">
                <button class="btn btn-primary rotate container fw-bold fs-2 justify-content-center"  data-kt-menu-trigger="hover">
                    <span class="menu-icon">
                        <!-- <i class="fonticon-setting fs-1"></i> -->
                    </span>
                    <span class="menu-title">{{trans('lang.sales')}}</span></button>
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-auto min-w-200 mw-300px" data-kt-menu="true">
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-1">
                                    <a class="menu-link" href="{{route('admin.bill_sales.create')}}">
                                    <span class="menu-icon"><i class="fonticon-setting fs-2"></i></span>
                                    <span class="menu-title">{{trans('lang.request')}}-{{trans('lang.bill_of_sale')}}-{{trans('lang.addnew')}}</span></a>
                                </div>
                            </div>

                            <div class="menu-item px-3">
                                <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-1">
                                    <a class="menu-link" href="{{route('admin.bill_sales.index')}}">
                                    <span class="menu-icon"><i class="fonticon-setting fs-2"></i></span>
                                    <span class="menu-title">{{trans('lang.requests')}}-{{trans('lang.bills_of_sale')}}-{{trans('lang.all')}}</span></a>
                                </div>
                            </div>

                            <div class="menu-item px-3">
                                <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-1">
                                    <a class="menu-link" href="{{route('admin.bill_sales.indexall')}}">
                                    <span class="menu-icon"><i class="fonticon-setting fs-2"></i></span>
                                    <span class="menu-title">{{trans('lang.bills_of_sale')}}-{{trans('lang.all')}}</span></a>
                                </div>
                            </div>
<!--                             
                            <div class="menu-item px-3">
                                <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-1">
                                    <a class="menu-link" href="{{route('admin.emp_bill_sales.index')}}">
                                    <span class="menu-icon"><i class="fonticon-setting fs-2"></i></span>
                                    <span class="menu-title">{{trans('lang.sales')}}-{{trans('employee.employees')}}</span></a>
                                </div>
                            </div>
                            <div class="menu-item px-3">
                                <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-1">
                                <a class="menu-link" href="{{route('admin.emp_bill_sales.indexempsearch')}}">
                                    <span class="menu-icon"><i class="fonticon-setting fs-2"></i></span>
                                    <span class="menu-title">{{trans('lang.sales')}}-{{trans('employee.employees')}}-{{trans('lang.all')}}</span></a>
                                </div>
                            </div> -->
                            <div class="menu-item px-3">
                                <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-1">
                                    <a class="menu-link" href="{{route('admin.sale_types.create')}}">
                                    <span class="menu-icon"><i class="fonticon-setting fs-2"></i></span>
                                    <span class="menu-title">{{trans('lang.bills_of_sale')}}-{{trans('lang.type_type')}}-{{trans('lang.addnew')}}</span></a>
                                </div>
                            </div>

                            <div class="menu-item px-3">
                                <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-1">
                                    <a class="menu-link" href="{{route('admin.sale_types.index')}}">
                                    <span class="menu-icon"><i class="fonticon-setting fs-2"></i></span>
                                    <span class="menu-title">{{trans('lang.bills_of_sale')}}-{{trans('lang.type_type')}}-{{trans('lang.all')}}</span></a>
                                </div>
                            </div>
                            <!--end::Menu item-->
                    </div>
            </div>
            @endcan
            <div class="menu-item">
                <button class="btn btn-primary rotate container fw-bold fs-2 justify-content-center"  data-kt-menu-trigger="hover">
                    <span class="menu-icon">
                        <!-- <i class="fonticon-setting fs-2"></i> -->
                    </span>
                    <span class="menu-title">{{trans('lang.customers')}}</span></button>
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-auto min-w-200 mw-300px" data-kt-menu="true">
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-1">
                                    <a class="menu-link" href="{{route('admin.cut_sales.index')}}">
                                    <span class="menu-icon"><i class="fonticon-setting fs-2"></i></span>
                                    <span class="menu-title">{{trans('lang.customers')}}-{{trans('lang.all')}}</span></a>
                                </div>
                            </div>
                            
                            <div class="menu-item px-3">
                                <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-1">
                                    <a class="menu-link" href="{{route('admin.cut_sales.create')}}">
                                    <span class="menu-icon"><i class="fonticon-setting fs-2"></i></span>
                                    <span class="menu-title">{{trans('lang.customer')}}-{{trans('lang.addnew')}}</span></a>
                                </div>
                            </div>
                            
                            <!--end::Menu item-->
                    </div>
            </div>
            
            <div class="menu-item">
                <button class="btn btn-primary rotate container fw-bold fs-2 justify-content-center"  data-kt-menu-trigger="hover">
                    <span class="menu-icon">
                        <!-- <i class="fonticon-setting fs-1"></i> -->
                    </span>
                    <span class="menu-title">{{trans('lang.reports')}}- {{trans('lang.sales')}}</span></button>
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-auto min-w-200 mw-300px" data-kt-menu="true">

                            <div class="menu-item px-3">
                                <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-1">
                                    <a class="menu-link" href="{{route('admin.bill_sales.indexall')}}">
                                    <span class="menu-icon"><i class="fonticon-setting fs-2"></i></span>
                                    <span class="menu-title">{{trans('lang.bills_of_sale')}}-{{trans('lang.all')}}</span></a>
                                </div>
                            </div>
                            
                            <div class="menu-item px-3">
                                <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-1">
                                    <a class="menu-link" href="{{route('admin.emp_bill_sales.index')}}">
                                    <span class="menu-icon"><i class="fonticon-setting fs-2"></i></span>
                                    <span class="menu-title">{{trans('lang.sales')}}-{{trans('employee.employees')}}</span></a>
                                </div>
                            </div>
                            <div class="menu-item px-3">
                                <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-1">
                                <a class="menu-link" href="{{route('admin.emp_bill_sales.indexempsearch')}}">
                                    <span class="menu-icon"><i class="fonticon-setting fs-2"></i></span>
                                    <span class="menu-title">{{trans('lang.sales')}}-{{trans('employee.employees')}}-{{trans('lang.all')}}</span></a>
                                </div>
                            </div>
                            <!-- <div class="menu-item px-3">
                                <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-1">
                                    <a class="menu-link" href="{{route('admin.sale_types.create')}}">
                                    <span class="menu-icon"><i class="fonticon-setting fs-2"></i></span>
                                    <span class="menu-title">{{trans('lang.bills_of_sale')}}-{{trans('lang.type_type')}}-{{trans('lang.addnew')}}</span></a>
                                </div>
                            </div>

                            <div class="menu-item px-3">
                                <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-1">
                                    <a class="menu-link" href="{{route('admin.sale_types.index')}}">
                                    <span class="menu-icon"><i class="fonticon-setting fs-2"></i></span>
                                    <span class="menu-title">{{trans('lang.bills_of_sale')}}-{{trans('lang.type_type')}}-{{trans('lang.all')}}</span></a>
                                </div>
                            </div> -->
                            <!--end::Menu item-->
                    </div>
            </div>
            
            
            <div class="menu-item">
                <button class="btn btn-primary rotate container fw-bold fs-2 justify-content-center"  data-kt-menu-trigger="hover">
                    <span class="menu-icon">
                        <!-- <i class="fonticon-setting fs-1"></i> -->
                    </span>
                    <span class="menu-title">{{trans('lang.vacation')}}</span></button>
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-auto min-w-200 mw-300px" data-kt-menu="true">
                            <!--begin::Menu item-->
                            @can('all vacation')
                            <div class="menu-item px-3">
                                <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-1">
                                    <a class="menu-link" href="{{route('admin.vacationemps.create')}}">
                                    <span class="menu-icon"><i class="fonticon-setting fs-2"></i></span>
                                    <span class="menu-title">{{trans('lang.vacation')}}-{{trans('lang.addnew')}}</span></a>
                                </div>
                            </div>
                            @endcan
                            @can('vacation request')
                            <div class="menu-item px-3">
                                <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-1">
                                    <a class="menu-link" href="{{route('admin.vacationemps.index')}}">
                                    <span class="menu-icon"><i class="fonticon-setting fs-2"></i></span>
                                    <span class="menu-title">{{trans('lang.vacation')}}-{{trans('lang.request')}}</span></a>
                                </div>
                            </div>
                            @endcan
                            @can('vacation new')
                            <div class="menu-item px-3">
                                <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-1">
                                    <a class="menu-link" href="{{route('admin.vacationemps.indexall')}}">
                                    <span class="menu-icon"><i class="fonticon-setting fs-2"></i></span>
                                    <span class="menu-title">{{trans('lang.vacation')}}-{{trans('lang.all')}}</span></a>
                                </div>
                            </div>
                            @endcan
                            <!--end::Menu item-->
                        </div>
            </div> 
            @can('all expense')
            <div class="menu-item">
                <button class="btn btn-primary rotate container fw-bold fs-2 justify-content-center"  data-kt-menu-trigger="hover">
                    <span class="menu-icon">
                        <!-- <i class="fonticon-setting fs-1"></i> -->
                    </span>
                    <span class="menu-title">{{trans('lang.expense')}}</span></button>
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-auto min-w-200 mw-300px" data-kt-menu="true">
                            <!--begin::Menu item-->
                            @can('all expense')
                            <div class="menu-item px-3">
                                <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-1">
                                    <a class="menu-link" href="{{route('admin.expense_requests.index')}}">
                                    <span class="menu-icon"><i class="fonticon-setting fs-2"></i></span>
                                    <span class="menu-title">{{trans('lang.expense')}}-{{trans('lang.request')}}</span></a>
                                </div>
                            </div>
                            @endcan
                            @can('expense new')
                            <div class="menu-item px-3">
                                <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-1">
                                    <a class="menu-link" href="{{route('admin.expense_requests.create')}}">
                                    <span class="menu-icon"><i class="fonticon-setting fs-2"></i></span>
                                    <span class="menu-title">{{trans('lang.expense')}}-{{trans('lang.request')}}-{{trans('lang.addnew')}}</span></a>
                                </div>
                            </div>
                            @endcan
                            
                           <!--end::Menu item-->

                        </div>
            </div> 
            @endcan
            <div class="menu-item">
                <button class="btn btn-primary rotate container fw-bold fs-2 justify-content-center"  data-kt-menu-trigger="hover">
                    <span class="menu-icon">
                        <!-- <i class="fonticon-setting fs-1"></i> -->
                    </span>
                    <span class="menu-title">{{trans('lang.products')}}</span></button>
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-auto min-w-200 mw-300px" data-kt-menu="true">
                            <!--begin::Menu item-->
                            @can('all product')
                            <div class="menu-item px-3">
                                <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-1">
                                    <a class="menu-link" href="{{route('admin.products.index')}}">
                                    <span class="menu-icon"><i class="fonticon-setting fs-2"></i></span>
                                    <span class="menu-title">{{trans('lang.products')}}-{{trans('lang.all')}}</span></a>
                                </div>
                            </div>
                            @endcan
                            @can('product new')
                            <div class="menu-item px-3">
                                <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-1">
                                    <a class="menu-link" href="{{route('admin.products.create')}}">
                                    <span class="menu-icon"><i class="fonticon-setting fs-2"></i></span>
                                    <span class="menu-title">{{trans('lang.products')}}-{{trans('lang.addnew')}}</span></a>
                                </div>
                            </div>
                            @endcan
                            @can('all product msg')
                            <!--end::Menu item-->
                            <div class="menu-item px-3">
                                <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-1">
                                    <a class="menu-link" href="{{route('admin.cycle_msg_prods.index')}}">
                                    <span class="menu-icon"><i class="fonticon-setting fs-2"></i></span>
                                    <span class="menu-title">{{trans('lang.message')}}-{{trans('lang.products')}}-{{trans('lang.all')}}</span></a>
                                </div>
                            </div>
                            @endcan
                            @can('product msg new')
                        <div class="menu-item px-3">
                            <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-1">
                                <a class="menu-link" href="{{route('admin.cycle_msg_prods.create')}}">
                                <span class="menu-icon"><i class="fonticon-setting fs-2"></i></span>
                                <span class="menu-title">{{trans('lang.message')}}-{{trans('lang.products')}}-{{trans('lang.addnew')}}</span></a>
                            </div>
                        </div>
                        @endcan
                        <!--end::Menu item-->

                    </div>
            </div> 
            @can('all area')
            <div class="menu-item">
                <button class="btn btn-primary rotate container fw-bold fs-2 justify-content-center"  data-kt-menu-trigger="hover">
                    <span class="menu-icon">
                        <!-- <i class="fonticon-setting fs-1"></i> -->
                    </span>
                    <span class="menu-title">{{trans('lang.area')}}</span></button>
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-auto min-w-200 mw-300px" data-kt-menu="true">
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-1">
                                    <a class="menu-link" href="{{route('admin.areas.index')}}">
                                    <span class="menu-icon"><i class="fonticon-setting fs-2"></i></span>
                                    <span class="menu-title">{{trans('lang.area')}}-{{trans('lang.all')}}</span></a>
                                </div>
                            </div>
                            @can('area new')
                            <div class="menu-item px-3">
                                <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-1">
                                    <a class="menu-link" href="{{route('admin.areas.create')}}">
                                    <span class="menu-icon"><i class="fonticon-setting fs-2"></i></span>
                                    <span class="menu-title">{{trans('lang.area')}}-{{trans('lang.addnew')}}</span></a>
                                </div>
                            </div>
                            @endcan
                            <!--end::Menu item-->
                    </div>
            </div> 
            @endcan
            @can('all specialty')
            <div class="menu-item">
                <button class="btn btn-primary rotate container fw-bold fs-2 justify-content-center"  data-kt-menu-trigger="hover">
                    <span class="menu-icon">
                        <!-- <i class="fonticon-setting fs-1"></i> -->
                    </span>
                    <span class="menu-title">{{trans('lang.specialties')}}</span></button>
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-auto min-w-200 mw-300px" data-kt-menu="true">
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-1">
                                    <a class="menu-link" href="{{route('admin.specialtys.index')}}">
                                    <span class="menu-icon"><i class="fonticon-setting fs-2"></i></span>
                                    <span class="menu-title">{{trans('lang.specialties')}}-{{trans('lang.all')}}</span></a>
                                </div>
                            </div>
                            @can('specialty new')
                            <div class="menu-item px-3">
                                <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-1">
                                    <a class="menu-link" href="{{route('admin.specialtys.create')}}">
                                    <span class="menu-icon"><i class="fonticon-setting fs-2"></i></span>
                                    <span class="menu-title">{{trans('lang.specialties')}}-{{trans('lang.addnew')}}</span></a>
                                </div>
                            </div>
                            @endcan
                            <!--end::Menu item-->
                    </div>
            </div> 
            @endcan
            @can('all brand gift')
            <div class="menu-item">
                <button class="btn btn-primary rotate container fw-bold fs-2 justify-content-center"  data-kt-menu-trigger="hover">
                    <span class="menu-icon">
                        <!-- <i class="fonticon-setting fs-1"></i> -->
                    </span>
                    <span class="menu-title">{{trans('lang.brand_gifts')}}</span></button>
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-auto min-w-200 mw-300px" data-kt-menu="true">
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-1">
                                    <a class="menu-link" href="{{route('admin.brand_gifts.index')}}">
                                    <span class="menu-icon"><i class="fonticon-setting fs-2"></i></span>
                                    <span class="menu-title">{{trans('lang.brand_gifts')}}-{{trans('lang.all')}}</span></a>
                                </div>
                            </div>
                            @can('brand gift new')
                            <div class="menu-item px-3">
                                <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-1">
                                    <a class="menu-link" href="{{route('admin.brand_gifts.create')}}">
                                    <span class="menu-icon"><i class="fonticon-setting fs-2"></i></span>
                                    <span class="menu-title">{{trans('lang.brand_gifts')}}-{{trans('lang.addnew')}}</span></a>
                                </div>
                            </div>
                            @endcan
                            <!--end::Menu item-->
                    </div>
            </div>
            @endcan
            @can('all social style')
            <div class="menu-item">
                <button class="btn btn-primary rotate container fw-bold fs-2 justify-content-center"  data-kt-menu-trigger="hover">
                    <span class="menu-icon">
                        <!-- <i class="fonticon-setting fs-1"></i> -->
                    </span>
                    <span class="menu-title">{{trans('lang.social_styls')}}</span></button>
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-auto min-w-200 mw-300px" data-kt-menu="true">
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-1">
                                    <a class="menu-link" href="{{route('admin.social_styls.index')}}">
                                    <span class="menu-icon"><i class="fonticon-setting fs-2"></i></span>
                                    <span class="menu-title">{{trans('lang.social_styls')}}-{{trans('lang.all')}}</span></a>
                                </div>
                            </div>
                            @can('social style new')
                            <div class="menu-item px-3">
                                <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-1">
                                    <a class="menu-link" href="{{route('admin.social_styls.create')}}">
                                    <span class="menu-icon"><i class="fonticon-setting fs-2"></i></span>
                                    <span class="menu-title">{{trans('lang.social_styls')}}-{{trans('lang.addnew')}}</span></a>
                                </div>
                            </div>
                            @endcan
                            <!--end::Menu item-->
                    </div>
            </div>
            @endcan
            @can('all sale funnel')
            <div class="menu-item">
                <button class="btn btn-primary rotate container fw-bold fs-2 justify-content-center"  data-kt-menu-trigger="hover">
                    <span class="menu-icon">
                        <!-- <i class="fonticon-setting fs-1"></i> -->
                    </span>
                    <span class="menu-title">{{trans('lang.sale_funnel')}}</span></button>
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-auto min-w-200 mw-300px" data-kt-menu="true">
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-1">
                                    <a class="menu-link" href="{{route('admin.salefunnels.index')}}">
                                    <span class="menu-icon"><i class="fonticon-setting fs-2"></i></span>
                                    <span class="menu-title">{{trans('lang.sale_funnel')}}-{{trans('lang.all')}}</span></a>
                                </div>
                            </div>
                            @can('sale funnel new')
                            <div class="menu-item px-3">
                                <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-1">
                                    <a class="menu-link" href="{{route('admin.salefunnels.create')}}">
                                    <span class="menu-icon"><i class="fonticon-setting fs-2"></i></span>
                                    <span class="menu-title">{{trans('lang.sale_funnel')}}-{{trans('lang.addnew')}}</span></a>
                                </div>
                            </div>
                            @endcan
                            <!--end::Menu item-->
                    </div>
            </div>
            @endcan
            @can('all rating')
            <div class="menu-item">
                <button class="btn btn-primary rotate container fw-bold fs-2 justify-content-center"  data-kt-menu-trigger="hover">
                    <span class="menu-icon">
                        <!-- <i class="fonticon-setting fs-2"></i> -->
                    </span>
                    <span class="menu-title">{{trans('lang.ratings')}}</span></button>
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-auto min-w-200 mw-300px" data-kt-menu="true">
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-1">
                                    <a class="menu-link" href="{{route('admin.ratings.index')}}">
                                    <span class="menu-icon"><i class="fonticon-setting fs-2"></i></span>
                                    <span class="menu-title">{{trans('lang.ratings')}}-{{trans('lang.contact')}}-{{trans('lang.all')}}</span></a>
                                </div>
                            </div>
                            @can('rating new')
                            <div class="menu-item px-3">
                                <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-1">
                                    <a class="menu-link" href="{{route('admin.ratings.create')}}">
                                    <span class="menu-icon"><i class="fonticon-setting fs-2"></i></span>
                                    <span class="menu-title">{{trans('lang.ratings')}}-{{trans('lang.contact')}}-{{trans('lang.addnew')}}</span></a>
                                </div>
                            </div>
                            @endcan
                            <!--end::Menu item-->
                    </div>
            </div>
            @endcan
            @can('all event')
            <div class="menu-item">
                <button class="btn btn-primary rotate container fw-bold fs-2 justify-content-center"  data-kt-menu-trigger="hover">
                    <span class="menu-icon">
                        <!-- <i class="fonticon-setting fs-2"></i> -->
                    </span>
                    <span class="menu-title">{{trans('lang.events')}}</span></button>
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-auto min-w-200 mw-300px" data-kt-menu="true">
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-1">
                                    <a class="menu-link" href="{{route('admin.events.index')}}">
                                    <span class="menu-icon"><i class="fonticon-setting fs-2"></i></span>
                                    <span class="menu-title">{{trans('lang.events')}}-{{trans('lang.all')}}</span></a>
                                </div>
                            </div>
                            @can('event new')
                            <div class="menu-item px-3">
                                <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-1">
                                    <a class="menu-link" href="{{route('admin.events.create')}}">
                                    <span class="menu-icon"><i class="fonticon-setting fs-2"></i></span>
                                    <span class="menu-title">{{trans('lang.events')}}-{{trans('lang.addnew')}}</span></a>
                                </div>
                            </div>
                            @endcan
                            <!--end::Menu item-->
                    </div>
            </div>
            @endcan
            @can('all assistant')
            <div class="menu-item">
                <button class="btn btn-primary rotate container fw-bold fs-2 justify-content-center"  data-kt-menu-trigger="hover">
                    <span class="menu-icon">
                        <!-- <i class="fonticon-setting fs-1"></i> -->
                    </span>
                    <span class="menu-title">{{trans('lang.assistants')}}</span></button>
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-auto min-w-200 mw-300px" data-kt-menu="true">
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-1">
                                    <a class="menu-link" href="{{route('admin.assistants.index')}}">
                                    <span class="menu-icon"><i class="fonticon-setting fs-2"></i></span>
                                    <span class="menu-title">{{trans('lang.assistants')}}-{{trans('lang.all')}}</span></a>
                                </div>
                            </div>
                            @can('assistant new')
                            <div class="menu-item px-3">
                                <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-1">
                                    <a class="menu-link" href="{{route('admin.assistants.create')}}">
                                    <span class="menu-icon"><i class="fonticon-setting fs-2"></i></span>
                                    <span class="menu-title">{{trans('lang.assistants')}}-{{trans('lang.addnew')}}</span></a>
                                </div>
                            </div>
                            @endcan
                           <!--end::Menu item-->
                        </div>
            </div> 
            @endcan            
            <!-- <div class="menu-item">
                <button class="btn btn-primary rotate container fw-bold fs-2 justify-content-center"  data-kt-menu-trigger="hover">
                    <span class="menu-icon">
                    </span>
                    <span class="menu-title">{{trans('lang.contract_drs')}}</span></button>
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-auto min-w-200 mw-300px" data-kt-menu="true">
                            <div class="menu-item px-3">
                                <a class="menu-link" href="{{route('admin.contract_drs.index')}}">
                                <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-1">
                                    <span class="menu-icon"><i class="fonticon-setting fs-2"></i></span>
                                    <span class="menu-title">{{trans('lang.contract_drs')}}-{{trans('lang.all')}}</span></a>
                                </div>
                            </div>
                            
                            <div class="menu-item px-3">
                                <a class="menu-link" href="{{route('admin.contract_drs.create')}}">
                                <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-1">
                                    <span class="menu-icon"><i class="fonticon-setting fs-2"></i></span>
                                    <span class="menu-title">{{trans('lang.contract_drs')}}-{{trans('lang.addnew')}}</span></a>
                                </div>
                            </div>
                    </div>
            </div> -->

            <!-- <div class="menu-item">
                <a class="menu-link" href="{{route('admin.blogs.index')}}">
                    <span class="menu-icon">
                        <i class="fonticon-setting fs-2"></i>
                    </span>
                    <span class="menu-title">{{trans('lang.events')}}</span>
                </a>
            </div> -->

            <!-- <div class="menu-item">
                <a class="menu-link" href="{{route('admin.notifications.index')}}">
                    <span class="menu-icon">
                        <i class="fonticon-setting fs-2"></i>
                    </span>
                    <span class="menu-title">{{trans('lang.notifications')}}</span>
                </a>
            </div> -->

            <!-- <div class="menu-item">
                <a class="menu-link" href="{{route('admin.pages.index')}}">
                    <span class="menu-icon">
                        <i class="fonticon-setting fs-2"></i>
                    </span>
                    <span class="menu-title">{{trans('lang.pages')}}</span>
                </a>
            </div> -->
            
            <!-- <div class="menu-item">
                <a class="menu-link" href="{{route('admin.users.index')}}">
                    <span class="menu-icon">
                        <i class="fonticon-setting fs-2"></i>
                    </span>
                    <span class="menu-title">{{trans('lang.accounts')}}</span>
                </a>
            </div> -->

            <!-- <div class="menu-item">
                <a class="menu-link" href="{{route('admin.employees.index')}}">
                    <span class="menu-icon">
                        <i class="fonticon-setting fs-2"></i>
                    </span>
                    <span class="menu-title">{{trans('lang.administrators')}}</span>
                </a>
            </div> -->
            @can('setting')
            <div class="menu-item" style="padding-bottom: 100px;">
                <a class="menu-link" href="{{route('admin.settings.edit', 1)}}">
                    <span class="menu-icon">
                        <i class="fonticon-setting fs-2"></i>
                    </span>
                    <span class="menu-title">{{trans('lang.settings')}}</span>
                </a>
            </div>
            @endcan
        </div>

    </div>
    <!--end::Wrapper-->
</div>
<!--end::Sidebar-->