@extends('admin.layout.master')
@php
    $route = 'admin.messages';
    $viewPath = 'admin.message';
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

            <div class="d-flex flex-column flex-lg-row">
                <!--begin::Content-->
                <div class="flex-lg-row-fluid ms-lg-7 ms-xl-10">
                    <!--begin::Messenger-->
                    <div class="card" id="kt_chat_messenger" style="border: 1px solid #f4f4f4;">

                        <!--begin::Card body-->
                        <div class="card-body" id="kt_chat_messenger_body">
                            <!--begin::Messages-->
                            <div class="scroll-y me-n5 pe-5 h-300px h-lg-auto" id="chat" data-kt-element="messages" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_header, #kt_app_header, #kt_app_toolbar, #kt_toolbar, #kt_footer, #kt_app_footer, #kt_chat_messenger_header, #kt_chat_messenger_footer" data-kt-scroll-wrappers="#kt_content, #kt_app_content, #kt_chat_messenger_body" data-kt-scroll-offset="5px">
                                @if (isset($msgs))
                                    @if (count($msgs) > 0)
                                        @foreach($msgs as $item)
                                            @if ($item->sender_type == 'student')
                                                <!--begin::Message(in)-->
                                                <div class="d-flex justify-content-start mb-10">
                                                    <!--begin::Wrapper-->
                                                    <div class="d-flex flex-column align-items-start">
                                                        <!--begin::User-->
                                                        <div class="d-flex align-items-center mb-2">
                                                            <!--begin::Details-->
                                                            <div class="ms-3">
                                                                <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary me-1">{{$student->name}}</a>
                                                                <br>
                                                                <span class="text-muted fs-7 mb-1">{{Carbon\Carbon::parse($item->created_at)}}</span>
                                                            </div>
                                                            <!--end::Details-->
                                                        </div>
                                                        <!--end::User-->
                                                        <!--begin::Text-->
                                                        <div class="p-5 rounded bg-light-info text-dark fw-semibold mw-lg-400px text-start" data-kt-element="message-text">{{$item->message}}</div>
                                                        <!--end::Text-->
                                                    </div>
                                                    <!--end::Wrapper-->
                                                </div>
                                                <!--end::Message(in)-->
                                            @else
                                                <!--begin::Message(out)-->
                                                <div class="d-flex justify-content-end mb-10">
                                                    <!--begin::Wrapper-->
                                                    <div class="d-flex flex-column align-items-end">
                                                        <!--begin::User-->
                                                        <div class="d-flex align-items-center mb-2">
                                                            <!--begin::Details-->
                                                            <div class="me-3">
                                                                <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary ms-1">{{$teacher->name}}</a>
                                                                <br>
                                                                <span class="text-muted fs-7 mb-1">{{Carbon\Carbon::parse($item->created_at)}}</span>
                                                            </div>
                                                            <!--end::Details-->
                                                        </div>
                                                        <!--end::User-->
                                                        <!--begin::Text-->
                                                        <div class="p-5 rounded bg-light-primary text-dark fw-semibold mw-lg-400px text-end" data-kt-element="message-text">{{$item->message}}</div>
                                                        <!--end::Text-->
                                                    </div>
                                                    <!--end::Wrapper-->
                                                </div>
                                                <!--end::Message(out)-->
                                            @endif
                                        @endforeach        
                                    @endif
                                @endif
                            </div>
                            <!--end::Messages-->
                        </div>
                        <!--end::Card body-->
                        <!--begin::Card footer-->

                            <div class="card-footer pt-4" id="kt_chat_messenger_footer">
                                <!--begin::Input-->
                                <input type="hidden" id="teacher_id" name="teacher_id" value="{{$teacher->id}}" />
                                <input type="hidden" id="student_id" name="student_id" value="{{$student->id}}" />

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
        
    </div>
    <!--end::Container-->
@endsection

@section('script')
<script src="{{asset('dash/assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
<script src="{{asset('dash/assets/plugins/custom/datatables/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('dash/assets/plugins/custom/datatables/buttons.print.min.js')}}"></script>
<script src="{{asset('dash/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js')}}"></script>

<script>

    $('.msgadd').click(function (e) {
        var teacher_id = $('#teacher_id').val();
        var student_id = $('#student_id').val();
        var msg = $('#msg').val();


        $.ajax({
            method: 'post',
            url: "{!!route('admin.messages.store')!!}",
            data: {
                "_token": "{{ csrf_token() }}",
                "msg":msg,
                "teacher_id":teacher_id,
                "student_id":student_id,
            },
            complete: function (result) {
                $.ajax({
            type: "GET",
            url: "{{url('/')}}"+"/admin/messages/getmsg/"+student_id+'/'+ teacher_id,
            success: function (data) {
                $("#chat").html(data);
                $('#chat').scrollTop($('#chat')[0].scrollHeight);
            }
        })
                $('#msg').val('');
            }
        });

    });

    function fetchbdg(){
        var teacher_id = $('#teacher_id').val();
        var student_id = $('#student_id').val();
        if (teacher_id) {
            $.ajax({
                type: "GET",
                url: "{{url('/')}}"+"/admin/messages/getmsg/"+student_id+'/'+ teacher_id,
                success: function (data) {
                    $("#chat").html(data);
                    $('#chat').scrollTop($('#chat')[0].scrollHeight);
                }
            })
        }
        
    }
    setInterval(fetchbdg , 4000);


</script>
@endsection