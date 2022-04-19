{{--{{dd(json_decode($dataList))}}--}}
<div class="form-floating">

    <select
        wire:loading.attr="disabled"
        wire:model="{{$name}}"
        id="{{$id}}"
        class="form-select ">
        @if(json_decode($dataList)!= "")
            @if(count(json_decode($dataList))==0)
                <option value="">'No Data Available'</option>
            @else
                <option value="" selected class="form-floating-label" >{{$placeholder}}</option>
            @endif
            @foreach(json_decode($dataList) as $value))
                    <option value="{{$value->id}}">{{$value->name}}</option>
                @endforeach
        @endif
    </select>

    @error($name)
    <label for="{{$id}}" class="text-"><span class="" >{{$label}}</span> - <span class="text-danger text-xs">{{$message}}</span> </label>
    @else
        <label for="{{$id}}" class="text-"><span class="form-floating-label" >{{$label}}</span></label>
        @enderror

        <div wire:loading.delay wire:target="{{$name}}">
            <div class="la-line-scale la-dark la-sm"> <div></div> <div></div> <div></div> <div></div> <div></div> </div>
        </div>

</div>
