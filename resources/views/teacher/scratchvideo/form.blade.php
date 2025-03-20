@if (!isset($data))
<div class="row mb-6">
    <label class="col-lg-2 col-form-label fw-semibold fs-6">فيديو</label>
    <div class="col-lg-8 fv-row">
        <input type="file" name="video" placeholder="فيديو" value="{{old('video',$data->video ?? '')}}" accept=".mp4" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
    </div>
</div>
@endif

<div class="row mb-6">
    <label class="col-lg-2 col-form-label required fw-semibold fs-6">عدد المشاهدات المسموحه</label>
    <div class="col-lg-8 fv-row">
        <input type="number" name="permission" placeholder="عدد المشاهدات المسموحه" value="{{old('permission',$data->permission ?? '')}}" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
    </div>
</div>

@if (!isset($data))
<div class="row mb-6">
    <label class="col-lg-2 col-form-label required fw-semibold fs-6">عدد السريال</label>
    <div class="col-lg-8 fv-row">
        <input type="number" name="qty" placeholder="عدد السريال" value="{{old('qty',$data->qty ?? '')}}" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
    </div>
</div>
@endif


<div class="mb-6">
    <div
        class="form-check form-switch form-check-custom form-check-solid">
        <label class="col-lg-2 col-form-label fw-semibold fs-6" for="flexSwitchDefault">مفعل ؟ </label>
        <div class="col-lg-8 fv-row">
        <input class="form-check-input" name="is_active" type="hidden"
               value="0" id="flexSwitchDefault"/>
        <input class="form-check-input w-45px h-25px "
               name="is_active" type="checkbox"    @if(isset($data) && $data->is_active == '1') checked @endif
               value="1" id="flexSwitchDefault" />
        </div>
    </div>

</div>

