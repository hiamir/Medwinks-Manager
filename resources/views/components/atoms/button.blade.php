<button wire:click="{{$onClick}}"
        wire:key="{{$name}}_button_key_{{$id}}"
        type="{{$type}}"
        id="{{$name}}_modal_button_id"
{{--        style="@if($link==true)all: unset"@endif--}}
        class="
        @if($link==true)
            btn btn-link p-0 menu-pointer nounderline {{$class}}
        @else
            @if($buttonSize==='small') btn-sm @elseif($buttonSize==='large') btn-xl @else btn @endif btn-{{$buttonColor}} @if($buttonRound)rounded-pill px-3 py-2 @endif text-sm {{$class}}"
        @endif

{{--        @if($disablebutton=='true')--}}
{{--        disabled--}}
{{--    @endif--}}
>
    <i class="{{$buttonIcon}}"></i>@isset($buttonName) {{$buttonName}}@endisset
</button>
