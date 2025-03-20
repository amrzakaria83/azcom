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
                {{trans('employee.profile')}}   
            </li>
        </ul>
    </div>
    <!--end::Page title-->
</div>
@endsection

@section('content')

<div id="kt_app_content_container" class="app-container container-fluid">
    <div class="card">


            <div class="card-body p-9">

                <div class="row mb-8">
                    <div class="col-xl-3">
                        <div class="symbol symbol-100px">
                            @if ($data->getMedia('contact')->count())
                            <img src="{{$data->getFirstMediaUrl('contact')}}" >
                            @else
                            <img src="{{asset('dash/assets/media/svg/avatars/blank.svg')}}" >
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-8">
                        
                    </div>
                </div>
                
                <div class="row mb-8">
                    <div class="col-xl-2">
                        <div class="fs-6 fw-semibold">{{trans('lang.name')}} </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="fw-bold fs-5">{{$data->name_en}}</div>
                    </div>
                </div>

                @if(isset($dataconrate) && $dataconrate->count() > 0)
                <div class="row mb-8">
                    <div class="col-xl-2">
                        <div class="fs-6 fw-semibold">{{trans('lang.total')}} {{trans('lang.degree')}}</div>
                    </div>
                    <div class="col-lg-9">
                        <div class="fw-bold fs-1 text-success">({{$dataconrate->sum('value')}})</div>
                    </div>
                </div>
                    @foreach ($dataconrate as $rate)
                        <div class="row mb-8">
                            <div class="col-xl-2">
                                <div class="fs-6 fw-semibold">{{trans('lang.name')}} {{trans('lang.rate')}}</div>
                            </div>
                            <div class="col-lg-9">
                                <div class="fw-bold fs-5"><span class="fs-1 text-info">{{$rate->getrate->name_en}}</span> {{trans('lang.rate')}}:(<span class="fs-1 text-success">{{$rate->value}}</span>) {{trans('lang.largestdegree')}}({{$rate->getrate->largestdegree}})</div>
                            </div>
                        </div>
                    @endforeach
                    @else
                    <div class="row mb-8">
                        <div class="col-xl-9">
                            <span class="fs-1 text-danger" >No score </span>
                        </div>
                    </div>
                @endif

                <div class="row mb-8">
                    <div class="col-xl-2">
                        <div class="fs-6 fw-semibold">{{trans('employee.birth_date')}} </div>
                    </div>
                    <div class="col-xl-9 fv-row">
                        <div class="fw-bold fs-5">{{$data->birth_date}}</div>
                    </div>
                </div>

                
                    <div class="row mb-8">
                        <div class="col-xl-2">
                            <div class="fs-6 fw-semibold">{{trans('lang.name')}} {{trans('lang.social_styls')}}</div>
                        </div>
                        <div class="col-lg-9">
                            @if(isset($data) && $data->social_id != null)
                            <div class="fw-bold fs-5">{{$data->getsocial->name_en}}</div>
                            @else
                            <div class="fw-bold fs-5">No {{trans('lang.social_styls')}}</div>
                            @endif
                        </div>
                    </div>
                

                <div class="row mb-8">
                    <div class="col-xl-2">
                        <div class="fs-6 fw-semibold">{{trans('lang.description')}} </div>
                    </div>
                    <div class="col-xl-9 fv-row">
                        <div class="fw-bold fs-5">{!! $data->description !!}</div>
                    </div>
                </div>

                <div class="row mb-8">
                    <div class="col-xl-2">
                        <div class="fs-6 fw-semibold">{{trans('lang.note')}} </div>
                    </div>
                    <div class="col-xl-9 fv-row">
                        <div class="fw-bold fs-5">{{$data->note}}</div>
                    </div>
                </div>

                <div class="row mb-8">
                    <div class="col-xl-2">
                        <div class="fs-6 fw-semibold">{{trans('employee.is_active')}} </div>
                    </div>
                    <div class="col-lg-9">
                        <!-- <div class="fw-bold fs-5">{{$data->is_active}}</div> -->
                        @if($data->status === 0)
                                <div class="badge badge-light-success fw-bold">{{trans('employee.active')}}</div>
                            
                                @else 
                                <div class="badge badge-light-danger fw-bold">{{trans('employee.notactive')}} </div>

                            @endif 
                    </div>
                </div>

                @if(isset($dataplace) && $dataplace->count() > 0)
                    @foreach ($dataplace as $work)
                        <div class="row mb-8">
                            <div class="col-xl-2">
                                <div class="fs-6 fw-semibold">{{trans('lang.work')}} {{trans('lang.place')}}</div>
                            </div>
                            <div class="col-lg-9">
                                <div class="fw-bold fs-5">
                                    <span class="fs-1 text-info">{{$work->getcenter->name_en}}</span>
                                    @if($work->dynamic_work == 2)
                                    <span class="fs-1 text-danger">24 Hours</span>
                                    @else
                                     {{trans('lang.start_from')}}:(<span class="fs-1 text-success">{{ $work->from_time ? date('h:i A', strtotime($work->from_time)) : '12:00 AM' }}</span>)
                                     {{trans('lang.end_to')}}:(<span class="fs-1 text-success">{{ $work->to_time ? date('h:i A', strtotime($work->to_time)) : '12:00 AM' }}</span>)
                                     @endif 
                                     @if($work->on_workrule == 2)
                                    <span class="fs-1 text-danger">{{trans('lang.all')}} {{trans('lang.days')}}</span>
                                    @else
                                    <span class="fs-1 text-danger">{{trans('lang.work')}} {{trans('lang.days')}}</span>
                                    @php
                                        $workdays = json_decode($work->work_days);
                                        $daysOfWeek = [trans('lang.saturday'),trans('lang.sunday'),trans('lang.monday'),trans('lang.tuesday'),trans('lang.wednesday'),trans('lang.thursday'),trans('lang.friday')];
                                        
                                        $selectedDays = array_map(function ($dayIndex) use ($daysOfWeek) {
                                            return $daysOfWeek[$dayIndex];
                                        }, $workdays);
                                        
                                        $daysString = implode(', ', $selectedDays);
                                    @endphp
                                    {{ $daysString }}
                                     @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @else
                    <div class="row mb-8">
                        <div class="col-xl-9">
                            <span class="fs-1 text-danger" >No {{trans('lang.work')}} {{trans('lang.place')}} </span>
                        </div>
                    </div>
                @endif
                @php
                    $list = App\Models\List_contac::where('contact_id', $data->id)->where('status',0)->get();
                @endphp
                @if ($list && count($list) > 0)
                @foreach ($list as $listname)
                <div class="row mb-8">
                    <div class="col-xl-2">
                        <div class="fs-6 fw-semibold">{{trans('lang.nutrilist')}} </div>
                    </div>
                    
                    <div class="col-xl-3 fv-row">
                        <div class="fw-bold fs-5"><span class="text-info">{{ $listname->getemp->name_en }}</span></div>
                    </div>
                    <div class="col-xl-3 fv-row">
                        <div class="fw-bold fs-5"><span class="text-info">{{trans('lang.sale_funnel')}}: {{ $listname->getfunnel->name_en ?? 'No entry'}}</span></div>
                    </div>
                    <div class="col-xl-3 fv-row">
                        <div class="fw-bold fs-5"><span class="text-success">
                        @php
                            $listparent = App\Models\List_contac::where('id',$listname->parentlist_id)->first();
                        @endphp
                            {{ $listparent->name_en ?? 'No Name List'}}
                        </span></div>
                    </div>
                </div>
                    
                @endforeach
                @else
                <div class="row mb-8">
                    <div class="col-xl-2">
                        <div class="fs-6 fw-semibold">{{trans('lang.nutrilist')}} </div>
                    </div>
                    <div class="col-xl-3 fv-row">
                        <div class="fw-bold fs-5"><span class="text-danger">No entry</span></div>
                    </div>
                </div>
                @endif

            </div>

    </div>
</div>

@endsection

@section('script')
@endsection