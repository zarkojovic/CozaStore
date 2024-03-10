<div>
    @if($items == NULL && !$isDropdown)
        <label class="small mb-1" for="{{$id}}">{{$label}} @if($required)
                <span class="text-danger">*</span>
            @endif </label>
        <input class="form-control" id="{{$id}}" name="{{$name}}" type="{{$type}}" {{$readonly ? 'disabled' : ''}}
        placeholder="{{$placeholder}}" value="{{$value}}">
        @if($errors->has($name))
            <span class="text-danger">{{$errors->first($name)}}</span>
        @endif
    @else
        <label class="small mb-1" for="{{$id}}">{{$label}} @if($required)
                <span class="text-danger">*</span>
            @endif </label>
        <select class="form-control" id="{{$id}}" name="{{$name}}" {{$readonly ? 'disabled' : ''}}>
            <option value="0">Select {{$label}}</option>
            @foreach($items as $item)
                <option
                    value="{{$item->id}}" {{$item->id == $value ? 'selected="selected"' : ''}}>{{$item->text}}</option>
            @endforeach
        </select>
        @if($errors->has($name))
            <span class="text-danger">{{$errors->first($name)}}</span>
        @endif
    @endif
</div>
