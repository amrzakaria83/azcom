<div class="form-check form-switch form-check-custom form-check-solid me-10">

    <input class="form-check-input" name="status" type="hidden"
           value="inactive" id="flexSwitchDefault"/>
    <input
        class="form-check-input h-20px w-40px"
        onchange="update_active(this,'{{route('teacher.scratchvideos.change_active')}}')"
        value="{{ $id }}" name="status" type="checkbox" @if($is_used == '1') checked @endif
        id="flexSwitchDefault"/>
</div>