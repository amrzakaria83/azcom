<div class="row">
    <div class="col-lg-4">
        <div class="mb-6">
            <!--begin::Label-->
            <label class="col-lg-12 col-form-label fw-semibold fs-6"> {{trans('question.subject')}}  </label>
            <!--end::Label-->
            <div class="col-lg-12">
                <select  data-control="select2" data-placeholder="Select an option" class=" input-text form-control subject form-select  mb-3 mb-lg-0" name="subject_id">
                    <option value="0">{{trans('question.choose')}}</option>
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
    <div class="col-lg-4">
        <div class="mb-6">
            <!--begin::Label-->
            <label class="col-lg-12 col-form-label fw-semibold fs-6"> {{trans('lang.subject_units')}} </label>
            <!--end::Label-->
            <div class="col-lg-12">
                <select  data-control="select2" data-placeholder="Select an option" class=" input-text form-control section form-select  mb-3 mb-lg-0" required name="section_id">
                    <option value="">{{trans('question.choose')}}</option>
                    @if(isset($data))
                    @foreach(\App\Models\Section::where('subject_id', $data->subject_id)->get() as $section)
                        <option @if(isset($data) && $data->section_id == $section->id) selected @endif value="{{$section->id}}">
                            {{$section->name}}
                        </option>
                    @endforeach
                    @endif
                </select>
            </div>
            <!--end::Input-->
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-8">
        <div class="mb-6">
            <label class="col-lg-12 col-form-label required fw-semibold fs-6">{{trans('question.question')}}:</label>
            <div class="col-lg-12">
                <textarea name="name" style="height: 70px;" class="form-control form-control-solid">
                    {{old('name',$data->name ?? '')}}
                </textarea>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="mb-6">
            <label class="col-lg-12 col-form-label fw-semibold fs-6">{{trans('question.photo')}}</label>
            <div class="col-lg-12">
                <input type="file" name="photo" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                @if (isset($data) && $data->getMedia('photo')->count())
                <span><a target="blank" href="{{$data->getFirstMediaUrl('photo', 'thumb')}}">{{trans('question.view_attechment')}}</a></span>
                @endif
            </div>
        </div> 
    </div>

</div>


<!--begin::Repeater-->
<div id="kt_docs_repeater_basic">
    <!--begin::Form group-->
    <div class="form-group">
        <div data-repeater-list="kt_docs_repeater_basic">
            @if(isset($data) && count($data->answers) > 0)
                @foreach ($data->answers as $answers_item)
                    <div data-repeater-item>
                        <div class="form-group row mb-6">
                            <div class="col-md-6">
                                <label class="form-label">{{trans('question.answer')}}</label>
                                <textarea name="answer_name" style="height: 70px;" class="form-control form-control-solid">
                                    {{$answers_item->name}}
                                </textarea>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">{{trans('question.photo')}}</label>
                                <div class="col-lg-12">
                                    <input type="file" name="answer_photo" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                                    @if (isset($answers_item) && $answers_item->getMedia('photo')->count())
                                    <span><a target="blank" href="{{$answers_item->getFirstMediaUrl('photo', 'thumb')}}">{{trans('question.view_attechment')}}</a></span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label"> </label>
                                <div class="form-check form-check-custom form-check-solid me-10 form-check-success mt-3 mt-md-3">
                                    <input class="form-check-input h-20px w-20px" type="checkbox" name="answer_correct" @if($answers_item->is_correct == 'correct') checked @endif value="1" id="flexCheckDefault" />
                                    <label class="form-check-label" for="flexCheckDefault">
                                        {{trans('question.correct_answer')}}
                                    </label>
                                </div>
                                <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger mt-5 mt-md-5">
                                    <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                                    {{trans('question.remove')}}
                                </a>
                            </div>
        
                        </div>
                    </div>
                @endforeach
            @endif

            <div data-repeater-item>
                <div class="form-group row mb-6">
                    
                    <div class="col-md-6">
                        <label class="form-label">{{trans('question.answer')}}</label>
                        <textarea name="answer_name" style="height: 70px;" class="form-control form-control-solid">
                        </textarea>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">{{trans('question.photo')}}</label>
                        <div class="col-lg-12">
                            <input type="file" name="answer_photo" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label"> </label>
                        <div class="form-check form-check-custom form-check-solid me-10 form-check-success mt-3 mt-md-3">
                            <input class="form-check-input h-20px w-20px" type="checkbox" name="answer_correct" value="1" id="flexCheckDefault" />
                            <label class="form-check-label" for="flexCheckDefault">
                                {{trans('question.correct_answer')}}
                            </label>
                        </div>
                        <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger mt-5 mt-md-5">
                            <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                            {{trans('question.remove')}}
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
            {{trans('question.add_more')}}
        </a>
    </div>
    <!--end::Form group-->
</div>
<!--end::Repeater-->







<script src="{{ URL::asset('dash/assets/plugins/custom/tinymce/tinymce.bundle.js')}}"></script>

<script>
    var options = {selector: "#kt_docs_tinymce_basic"};

    tinymce.init(options);

</script>