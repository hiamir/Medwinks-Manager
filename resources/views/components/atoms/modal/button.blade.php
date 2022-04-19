@if($type==='add' || $type==='custom')
    {{--    <button wire:click="{{$name}}_button('{{$name}}_modal')"--}}
    <button
        x-data="{value:'create'}"
        x-on:click.prevent="$dispatch('modelframe',{value:'create'}); $dispatch('pondReset');"

        wire:click="{{$name}}_button({{$id}},'{{$name}}_modal_{{$id}}') {{$custom}}"
        wire:key="{{$name}}_modal_button_key_{{$id}}" type="button" id="{{$name}}_modal_button_id_{{$id}}"
        @if($passingData !='' || $passingData !=null)
        wire:focus="$emit('passingData',{{$passingData}})"
        @endif
        class="btn btn-modal  {{$buttonColor}}
        @if($buttonWidth!='') {{$buttonWidth}} @endif  btn-sm btn-{{$buttonColor}}  @if($type!='view')px-3 py-2 @endif  text-sm "
        {{ $attributes->merge(['class' => $buttonClass]) }}
        data-bs-toggle="modal"
        data-bs-target="#{{$name}}_modal_{{$id}}">
        <i class="{{$buttonIcon}}"></i>@isset($buttonName) {{$buttonName}}@endisset
    </button>

@elseif($type==='view' || $type=='twoforms')
    <button

        wire:click="{{$name}}_button({{$id}},'{{$name}}_modal_{{$id}}') {{$custom}}"
            wire:key="{{$name}}_modal_button_key_{{$id}}" type="button" id="{{$name}}_modal_button_id_{{$id}}"
            @if($passingData !='' || $passingData !=null)
            wire:focus="$emit('passingData',{{$passingData}})"
            @endif
            class="btn btn-modal  {{$buttonColor}}
            @if($buttonWidth!='') {{$buttonWidth}} @endif  btn-sm btn-{{$buttonColor}}  @if($type!='view') @endif  text-sm {{$buttonClass}}"
            data-bs-toggle="modal"
            data-bs-target="#{{$name}}_modal_{{$id}}"
            @if($buttonDisabled==1) disabled @endif >
        <span class="{{$buttonTextColor}}">
        <i class="{{$buttonIcon}} {{$buttonTextColor}}"></i> @isset($buttonName) {{$buttonName}}@endisset
        </span>
    </button>
@elseif($type==='edit')


    <button
        x-data="{value:false}"
        x-on:click.prevent="$dispatch('modelframe',{value:'change'});"
            wire:click="{{$name}}_button({{$id}},'{{$name}}_modal_{{$id}}') {{$custom}}"
            wire:key="{{$name}}_modal_button_key_{{$id}}" type="button" id="{{$name}}_modal_button_id_{{$id}}"
            @if($passingData !='' || $passingData !=null)
            wire:focus="$emit('passingData',{{$passingData}})"
            @endif
            class="btn btn-modal  {{$buttonColor}}
            @if($buttonWidth!='') {{$buttonWidth}} @endif  btn-sm btn-{{$buttonColor}}  @if($type!='view') @endif  text-sm {{$buttonClass}}"
            data-bs-toggle="modal"
            data-bs-target="#{{$name}}_modal_{{$id}}">
        <i class="{{$buttonIcon}}"></i>@isset($buttonName) {{$buttonName}}@endisset
    </button>

@elseif($type==='delete')


    <button
        x-data="{value:false}"
        x-on:click.prevent="$dispatch('modelframe',{value:'delete'});"
        wire:click="{{$name}}_button({{$id}},'{{$name}}_modal_{{$id}}') {{$custom}}"
        wire:key="{{$name}}_modal_button_key_{{$id}}" type="button" id="{{$name}}_modal_button_id_{{$id}}"
        @if($passingData !='' || $passingData !=null)
        wire:focus="$emit('passingData',{{$passingData}})"
        @endif
        class="btn btn-modal  {{$buttonColor}}
        @if($buttonWidth!='') {{$buttonWidth}} @endif  btn-sm btn-{{$buttonColor}}  @if($type!='view') @endif  text-sm {{$buttonClass}}"
        data-bs-toggle="modal"
        data-bs-target="#{{$name}}_modal_{{$id}}">
        <i class="{{$buttonIcon}}"></i>@isset($buttonName) {{$buttonName}}@endisset
    </button>
@endif
