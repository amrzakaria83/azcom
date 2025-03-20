@extends('teacher.layout.master')
@php
    $route = 'teacher.classrooms';
    $viewPath = 'teacher.classroom';
@endphp

@section('css')
    <link href="{{asset('dash/assets/plugins/custom/datatables/datatables.bundle.rtl.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('dash/assets/plugins/custom/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('dash/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('style')
    <style>
        .fc .fc-popover {
            background: #ffffff;
        }
    </style>
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
                <a  href="#" class="text-muted text-hover-primary">{{trans('lang.Students')}}</a>
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
        <div class="card-body">

            <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x border-transparent fs-4 fw-semibold mb-15">
                <!--begin:::Tab item-->
                <li class="nav-item">
                    <a class="nav-link text-dark text-active-primary pb-5 active" onclick="copen()" data-bs-toggle="tab" href="#absence">
                        <i class="las la-hashtag text-primary fs-3"></i>
                        {{trans('student.absence')}}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark text-active-primary pb-5" data-bs-toggle="tab" href="#chating">
                        <i class="las la-image text-primary fs-3"></i>
                        {{trans('student.chat')}}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark text-active-primary pb-5" data-bs-toggle="tab" href="#exams">
                        <i class="las la-image text-primary fs-3"></i>
                        {{trans('student.exam')}}
                    </a>
                </li>
                <!--end:::Tab item-->
            </ul>
            <!--end:::Tabs-->
            <!--begin:::Tab content-->
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="absence" role="tabpanel">
                    <div id="kt_docs_fullcalendar_selectable"></div>

                    <div class="modal fade" id="kt_modal_create_absence" tabindex="-1" aria-hidden="true">
                        <!--begin::Modal dialog-->
                        <div class="modal-dialog modal-dialog-centered mw-650px">
                            <!--begin::Modal content-->
                            <div class="modal-content">
                                <!--begin::Modal header-->
                                <div class="modal-header" id="kt_modal_create_absence_header">
                                    <!--begin::Modal title-->
                                    <h2 class="fw-bold">{{trans('student.add_new')}}</h2>
                                    <!--end::Modal title-->
                                    <!--begin::Close-->
                                    <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                                        <span class="svg-icon svg-icon-1">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
                                                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </div>
                                    <!--end::Close-->
                                </div>
                                <!--end::Modal header-->
                                <!--begin::Modal body-->
                                <div class="modal-body scroll-y mx-5 mx-xl-15">
                                    <!--begin::Form-->
                                    <form action="{{route('teacher.absences.store')}}" method="POST" enctype="multipart/form-data" id="kt_account_profile_details_form" class="form">
                                        @csrf
                                        <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">

                                            <input type="hidden" value="{{$data->id}}" name="student_id[]" />
                                            <input type="hidden" name="date" value="" id="absencedate" />
                                            <div class="mb-6">
                                                <!--begin::Label-->
                                                <label class="col-lg-4 col-form-label fw-semibold fs-6"> {{trans('lang.classrooms')}} </label>
                                                <!--end::Label-->
                                                <div class="col-lg-8">
                                                    <select  data-control="select2" data-placeholder="{{trans('student.choose')}}" class=" input-text form-control  form-select  mb-3 mb-lg-0" name="classroom_id">
                                                        @foreach($data->classes as $class)
                                                            <option value="{{$class->classroom->id}}">
                                                                {{$class->classroom->name}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <!--end::Input-->
                                            </div>

    
                                        </div>
    
                                        <div class="text-center pt-15">
                                            <button type="button" class="btn btn-light me-3" data-bs-dismiss="modal">{{trans('student.close')}}</button>
                                            <button type="submit" class="btn btn-primary" id="submit">
                                                <span class="indicator-label">{{trans('student.save')}}</span>
                                                <span class="indicator-progress">Please wait...
                                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                            </button>
                                        </div>
                                        <!--end::Actions-->
                                    </form>
                                    <!--end::Form-->
                                </div>
                                <!--end::Modal body-->
                            </div>
                            <!--end::Modal content-->
                        </div>
                        <!--end::Modal dialog-->
                    </div>
                </div>

                <div class="tab-pane fade" id="chating" role="tabpanel">
                    
                    <div class="d-flex flex-column flex-lg-row">
                        <!--begin::Sidebar-->
                        <div class="flex-column flex-lg-row-auto w-100 w-lg-300px w-xl-400px mb-10 mb-lg-0">
                            <!--begin::Contacts-->
                            <div class="card card-flush" style="border: 1px solid #f4f4f4;">
                                <!--begin::Card body-->
                                <div class="card-body pt-5" id="kt_chat_contacts_body">
                                    <!--begin::List-->
                                    <div class="scroll-y me-n5 pe-5 h-200px h-lg-auto" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_header, #kt_app_header, #kt_toolbar, #kt_app_toolbar, #kt_footer, #kt_app_footer, #kt_chat_contacts_header" data-kt-scroll-wrappers="#kt_content, #kt_app_content, #kt_chat_contacts_body" data-kt-scroll-offset="5px">
                                        <!--begin::User-->
                                        @foreach ($teachers as $teacher)
                                            <div class="d-flex flex-stack py-4">
                                                <!--begin::Details-->
                                                <div class="d-flex align-items-center">
                                                    <!--begin::Avatar-->
                                                    <div class="symbol symbol-45px symbol-circle">
                                                        <span class="symbol-label bg-light-danger text-danger fs-6 fw-bolder">{{substr($teacher->name, 0, 1) }}</span>
                                                    </div>
                                                    <!--end::Avatar-->
                                                    <!--begin::Details-->
                                                    <div class="ms-5">
                                                        <a href="javascript:;" teacher-data="{{$teacher->id}}" class="teacher fs-5 fw-bold text-gray-900 text-hover-primary mb-2">{{$teacher->name}}</a>
                                                        <div class="fw-semibold text-muted">{{$teacher->job_title}}</div>
                                                    </div>
                                                    <!--end::Details-->
                                                </div>
                                                <!--end::Details-->
                                            </div>
                                        @endforeach
                                        

                                    </div>
                                    <!--end::List-->
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Contacts-->
                        </div>
                        <!--end::Sidebar-->
                        <!--begin::Content-->
                        <div class="flex-lg-row-fluid ms-lg-7 ms-xl-10">
                            <!--begin::Messenger-->
                            <div class="card" id="kt_chat_messenger" style="border: 1px solid #f4f4f4;">

                                <!--begin::Card body-->
                                <div class="card-body" id="kt_chat_messenger_body">
                                    <!--begin::Messages-->
                                    <div class="scroll-y me-n5 pe-5 h-300px h-lg-auto" id="chat" data-kt-element="messages" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_header, #kt_app_header, #kt_app_toolbar, #kt_toolbar, #kt_footer, #kt_app_footer, #kt_chat_messenger_header, #kt_chat_messenger_footer" data-kt-scroll-wrappers="#kt_content, #kt_app_content, #kt_chat_messenger_body" data-kt-scroll-offset="5px">
                                        @include('teacher.student.chat')
                                    </div>
                                    <!--end::Messages-->
                                </div>
                                <!--end::Card body-->
                                <!--begin::Card footer-->

                                    <div class="card-footer pt-4" id="kt_chat_messenger_footer">
                                        <!--begin::Input-->
                                        <input type="hidden" id="teacher_id" name="teacher_id" value="" />
                                        <input type="hidden" id="student_id" name="student_id" value="{{$data->id}}" />

                                        <textarea class="form-control form-control-flush mb-3" rows="1" id="msg" name="msg" data-kt-element="input" placeholder="{{trans('student.type_msg')}}"></textarea>
                                        <!--end::Input-->
                                        <!--begin:Toolbar-->
                                        <div class="d-flex flex-stack">
                                            <!--begin::Send-->
                                            <a class="btn btn-primary msgadd" href="javascript:;" >{{trans('student.send')}}</a>
                                            <!--end::Send-->
                                        </div>
                                        <!--end::Toolbar-->
                                    </div>
                                <!--end::Card footer-->
                            </div>
                            <!--end::Messenger-->
                        </div>
                        <!--end::Content-->
                    </div>

                </div>

                <div class="tab-pane fade" id="exams" role="tabpanel">
                    <div class="card no-border">
                        <!--begin::Card header-->
                        {{-- <div class="card-header border-0">
                            <div class="card-toolbar">
                                <div class="d-flex justify-content-end dbuttonsexam">
                                    <button type="button" class="btn btn-sm btn-icon btn-primary btn-active-dark me-3 p-3" data-bs-toggle="modal" data-bs-target="#kt_modal_create_exam">
                                        <i class="bi bi-plus-square fs-1x"></i>
                                    </button>
                                </div>
                            </div>
                        </div> --}}
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body">
                            <!--begin::Table-->
                            <table class="table align-middle table-rounded table-striped table-row-dashed fs-6" id="kt_datatable_table_exam">
                                <!--begin::Table head-->
                                <thead class="bg-light-dark pe-3">
                                    <!--begin::Table row-->
                                    <tr class="text-start text-dark fw-bold fs-4 text-uppercase gs-0">
                                        <th class="min-w-125px text-start p-3">{{trans('student.test')}}</th>
                                        <th class="min-w-125px text-start">{{trans('student.subject')}}</th>
                                        <th class="min-w-125px text-start">{{trans('student.result')}}</th>
                                        <th class="min-w-125px text-start">{{trans('student.day')}}</th>
                                        <th class="min-w-125px text-start">{{trans('student.time')}}</th>
                                        <th class="min-w-125px text-start">#</th>
                                    </tr>
                                    <!--end::Table row-->
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody class="text-gray-600 fw-bold">
                                </tbody>
                                <!--end::Table body-->
                            </table>
                            <!--end::Table-->
                        </div>
                        <!--end::Card body-->

                    </div>

                    <div class="modal fade" id="kt_modal_create_exam" tabindex="-1" aria-hidden="true">
                        <!--begin::Modal dialog-->
                        <div class="modal-dialog modal-dialog-centered mw-650px">
                            <!--begin::Modal content-->
                            <div class="modal-content">
                                <!--begin::Modal header-->
                                <div class="modal-header" id="kt_modal_create_exam_header">
                                    <!--begin::Modal title-->
                                    <h2 class="fw-bold">اضافة</h2>
                                    <!--end::Modal title-->
                                    <!--begin::Close-->
                                    <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                                        <span class="svg-icon svg-icon-1">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
                                                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </div>
                                    <!--end::Close-->
                                </div>
                                <!--end::Modal header-->
                                <!--begin::Modal body-->
                                <div class="modal-body scroll-y mx-5 mx-xl-15">
                                    <!--begin::Form-->
                                    <form action="{{route('teacher.classroomsubjects.store')}}" method="POST" enctype="multipart/form-data" id="kt_account_profile_details_form" class="form">
                                        @csrf
                                        <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">

                                            <input type="hidden" name="classroom_id" value="{{$data->id}}" />
                                            <div class="mb-6">
                                                <!--begin::Label-->
                                                <label class="col-lg-4 col-form-label fw-semibold fs-6"> المواد </label>
                                                <!--end::Label-->
                                                <div class="col-lg-8">
                                                    <select  data-control="select2" data-placeholder="Select an option" class=" input-text form-control  form-select  mb-3 mb-lg-0"  name="subject_id">
                                                        <option value="0">اختر مادة</option>
                                                        @foreach(\App\Models\Subject::all() as $subject)
                                                            <option @if(isset($data) && $data->subject_id == $subject->id) selected @endif value="{{$subject->id}}">
                                                                {{$subject->name}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <!--end::Input-->
                                            </div>

    
                                        </div>
    
                                        <div class="text-center pt-15">
                                            <button type="button" class="btn btn-light me-3" data-bs-dismiss="modal">الغاء</button>
                                            <button type="submit" class="btn btn-primary" id="submit">
                                                <span class="indicator-label">حفظ</span>
                                                <span class="indicator-progress">Please wait...
                                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                            </button>
                                        </div>
                                        <!--end::Actions-->
                                    </form>
                                    <!--end::Form-->
                                </div>
                                <!--end::Modal body-->
                            </div>
                            <!--end::Modal content-->
                        </div>
                        <!--end::Modal dialog-->
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
<script src="{{asset('dash/assets/plugins/custom/datatables/buttons.print.min.js')}}"></script>
<script src="{{asset('dash/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js')}}"></script>

<script>

    $(function () {

        var absences = '{{$absence}}';

var calendarEl = document.getElementById("kt_docs_fullcalendar_selectable");

var calendar = new FullCalendar.Calendar(calendarEl, {
    headerToolbar: {
        left: "prev,next today",
        center: "title",
        right: "dayGridMonth,timeGridWeek,timeGridDay"
    },
    initialDate: "{{date('Y-m-d')}}",
    locale: "{{App::getLocale()}}",
    navLinks: true, // can click day/week names to navigate views
    selectable: true,
    selectMirror: true,

    // Create new event
    select: function (arg) {
        $('#kt_modal_create_absence').modal('show');
        $('#absencedate').val(arg.end.toUTCString());
    },

    // Delete event
    eventClick: function (arg) {
        $('.fc-popover-close').click();

        Swal.fire({
            text: "هل انت متأكد من حذف غياب الطالب ؟",
            icon: "warning",
            showCancelButton: true,
            buttonsStyling: false,
            confirmButtonText: "تأكيد, الحذف !",
            cancelButtonText: "لا",
            customClass: {
                confirmButton: "btn btn-primary",
                cancelButton: "btn btn-active-light"
            }
        }).then(function (result) {
            if (result.value) {
                arg.event.remove();
                $.ajax(
                {
                    url: "{{route('teacher.absences.delete')}}",
                    type: 'post',
                    dataType: "JSON",
                    data: {
                        "id": [arg.event.id],
                        "_method": 'post',
                        "_token": '{{ csrf_token() }}',
                    },
                    success: function (data) {
                        if(data.message == "success") {
                            tableDailyreport.draw();
                            toastr.success("", "تم الحذف بنجاح");
                        } else {
                            toastr.success("", "عفوا لم يتم الحذف");
                        }
                    },
                    fail: function(xhrerrorThrown){
                        toastr.success("", "عفوا لم يتم الحذف");
                    }
                });
            } else if (result.dismiss === "cancel") {

            }
        });
    },
    editable: true,
    dayMaxEvents: true, // allow "more" link when too many events
    events: JSON.parse(absences.replace(/&quot;/g,'"'))
});

calendar.render();
    });

    ///////////// Absence javascript /////////////
    function copen() {
        var absences = '{{$absence}}';

        var calendarEl = document.getElementById("kt_docs_fullcalendar_selectable");

        var calendar = new FullCalendar.Calendar(calendarEl, {
            headerToolbar: {
                left: "prev,next today",
                center: "title",
                right: "dayGridMonth,timeGridWeek,timeGridDay"
            },
            initialDate: "{{date('Y-m-d')}}",
            locale: "{{App::getLocale()}}",
            navLinks: true, // can click day/week names to navigate views
            selectable: true,
            selectMirror: true,

            // Create new event
            select: function (arg) {
                $('#kt_modal_create_absence').modal('show');
                $('#absencedate').val(arg.end.toUTCString());
            },

            // Delete event
            eventClick: function (arg) {
                $('.fc-popover-close').click();

                Swal.fire({
                    text: "هل انت متأكد من حذف غياب الطالب ؟",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "تأكيد, الحذف !",
                    cancelButtonText: "لا",
                    customClass: {
                        confirmButton: "btn btn-primary",
                        cancelButton: "btn btn-active-light"
                    }
                }).then(function (result) {
                    if (result.value) {
                        arg.event.remove();
                        $.ajax(
                        {
                            url: "{{route('teacher.absences.delete')}}",
                            type: 'post',
                            dataType: "JSON",
                            data: {
                                "id": [arg.event.id],
                                "_method": 'post',
                                "_token": '{{ csrf_token() }}',
                            },
                            success: function (data) {
                                if(data.message == "success") {
                                    tableDailyreport.draw();
                                    toastr.success("", "تم الحذف بنجاح");
                                } else {
                                    toastr.success("", "عفوا لم يتم الحذف");
                                }
                            },
                            fail: function(xhrerrorThrown){
                                toastr.success("", "عفوا لم يتم الحذف");
                            }
                        });
                    } else if (result.dismiss === "cancel") {

                    }
                });
            },
            editable: true,
            dayMaxEvents: true, // allow "more" link when too many events
            events: JSON.parse(absences.replace(/&quot;/g,'"'))
        });

        calendar.render();
    
    }


    $('.teacher').click(function (e) {
        $('#teacher_id').val($(this).attr("teacher-data"));
        $.ajax({
            type: "GET",
            url: "{{url('/')}}"+"/admin/messages/getmsg/"+"{{$data->id}}"+'/'+ $(this).attr("teacher-data"),
            success: function (data) {
                $("#chat").html(data);
                $('#chat').scrollTop($('#chat')[0].scrollHeight);
            }
        })

    });

    $('.msgadd').click(function (e) {
        var teacher_id = $('#teacher_id').val();
        var student_id = $('#student_id').val();
        var msg = $('#msg').val();


        $.ajax({
            method: 'post',
            url: "{!!route('teacher.messages.store')!!}",
            data: {
                "_token": "{{ csrf_token() }}",
                "msg":msg,
                "teacher_id":teacher_id,
                "student_id":student_id,
            },
            complete: function (result) {
                $.ajax({
            type: "GET",
            url: "{{url('/')}}"+"/admin/messages/getmsg/"+"{{$data->id}}"+'/'+ teacher_id,
            success: function (data) {
                $("#chat").html(data);
                $('#chat').scrollTop($('#chat')[0].scrollHeight);
            }
        })
                $('#msg').val('');
            }
        });

    });

    ///////////// Exams javascript /////////////
    var tableExam = $('#kt_datatable_table_exam').DataTable({
        processing: false,
        serverSide: true,
        searching: false,
        autoWidth: false,
        responsive: true,
        pageLength: 10,
        sort: false,
        dom: 'Bfrtip',
        buttons: [
            // {
            //     extend: 'excel',
            //     className: 'btn btn-sm btn-icon btn-success btn-active-dark me-3 p-3',
            //     text: '<i class="bi bi-file-earmark-spreadsheet fs-1x"></i>'
            // }
        ],
        ajax: {
            url: "{{ route('teacher.exams.studentexam') }}",
            data: function (d) {
                d.student_id= '{{$data->id}}'
            }
        },
        columns: [
            {data: 'name', name: 'name'},
            {data: 'subject', name: 'subject'},
            {data: 'degree', name: 'degree'},
            {data: 'date', name: 'date'},
            {data: 'time', name: 'time'},
            {data: 'actions', name: 'actions'},
        ]
    });

    tableExam.buttons().container().appendTo($('.dbuttonsexam'));
</script>
@endsection