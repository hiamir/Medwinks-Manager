<div>
    <x-molecules.bootstrap.container class="{{$class}}" fluid="{{false}}" custom="">
        <x-atoms.modal.formgroup size="" icon="">


    @if($label!='')
    <x-atoms.modal.label
        labelFor="{{$name}}_input_{{$id}}"
        labelName="{{$label}}"
    >
    </x-atoms.modal.label>
    @endif
    {{--    {{dd(json_decode($list))}}--}}
    <select wire:model='{{$name}}' class="form-control form-select">

        @if($firstvalue!='' || $firstvalue!=null)
                <option value="all">{{$firstvalue}}</option>
        @else
            @if($placeholder!='')
                <option value="" selected disabled>
                    {{$placeholder}}
                </option>
            @endif
        @endif
        @foreach($list as $key=>$value)
            <option value="{{$key}}">{{$value}}</option>
        @endforeach
    </select>
        <x-atoms.modal.inputError input="{{$name}}"></x-atoms.modal.inputError>
        </x-atoms.modal.formgroup>
    </x-molecules.bootstrap.container>
</div>

