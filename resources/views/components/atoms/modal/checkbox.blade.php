<x-molecules.bootstrap.container class="{{$class}}  p-0 checkbox" fluid="{{false}}" custom="">
    <x-atoms.modal.formgroup size="" icon="">
        @if($label != null)
            <x-atoms.modal.label
                labelFor={{$name}}_input_{{$id}}
                    labelName="{{$label}}">
            </x-atoms.modal.label>
        @endif


@if($listdata != '')
    <ul class="list-unstyled mb-0">
        @foreach(json_decode($listdata,true) as $key=>$value)
            <li class="d-inline-block me-2 mb-1">
                <div class="form-check">
                    <div class="checkbox">

                        <input
                            @if(!empty($debounce) )
                            wire:model.debounce.{{$debounce}}='{{$name}}-{{$id}}-{{$key}}'
                            @elseif($lazy && !$defer) wire:model.lazy='{{$name}}-{{$id}}-{{$key}}'
                            @elseif(!$lazy && $defer) wire:model.defer='{{$name}}-{{$id}}-{{$key}}'
                            @else wire:model='{{$name}}-{{$id}}-{{$key}}'
                            @endif

                            wire:key="{{$name}}_input-key_{{$id}}_{{$key}}"
                            type="checkbox"
                            id= "{{$id}}-{{$key}}"


                        class="form-check-input"
                        @if($checked) checked="" @endif>

                        <label
                            for="{{$name}}_input_{{$id}}_{{$key}}"
                            class="text-sm">{{$value}}
                        </label>
                    </div>
                </div>

            </li>

        @endforeach

    </ul>

@else

    <div class="form-check">
        <div class="checkbox">

            <input
                @if(!empty($debounce) )
                wire:model.debounce.{{$debounce}}='{{$name}}'
                @elseif($lazy && !$defer) wire:model.lazy='{{$name}}'
                @elseif(!$lazy && $defer) wire:model.defer='{{$name}}'
                @else wire:model='{{$name}}'
                @endif

                wire:key="{{$name}}_input-key_{{$id}}"
                type="checkbox"
                id=
                @if($customID!='')
                    "{{$customID}}"
            @else
                "{{$name}}_input_{{$id}}"
            @endif

            class="form-check-input"
            @if($checked) checked="" @endif>

            <label
                for="{{$name}}_input_{{$id}}"
                class="text-sm">{{$text}}
            </label>
        </div>

    </div>

@endif

            <x-atoms.modal.inputError input="{{$name}}"/>
    </x-atoms.modal.formgroup>


</x-molecules.bootstrap.container>

