<x-molecules.bootstrap.container class="{{$class}}" fluid="{{false}}" custom="">
    <x-atoms.modal.formgroup size="{{$size}}" icon="{{$icon}}">
        @if($label != null)
            <x-atoms.modal.label
                labelFor={{$name}}_input_{{$id}}
                    labelName="{{$label}}">
            </x-atoms.modal.label>
        @endif


        <textarea
            rows="{{$height}}"
            @if(!empty($debounce) )

            wire:model.dirty.debounce.{{$debounce}}='{{$name}}'

            @elseif($debounce==='' && $lazy && !$defer )

            wire:model.dirty.lazy='{{$name}}'

            @elseif($debounce==='' && !$lazy && $defer )

            wire:model.dirty.defer='{{$name}}'

            @else

            wire:model.dirty.lazy='{{$name}}'

            @endif

            wire:key="{{$name}}_input_key_{{$id}}"
            {{$custom}}
            type="{{$type}}"
            placeholder="{{$placeholder}}"
            id="{{$name}}_input_{{$id}}"
            class="form-control

         @if($size==='large')
                form-control-xl
            @endif

            @error('$name') is-invalid @endError"
            aria-describedby={{$name}}_input_{{$id}}">
        </textarea>

        @if($icon!=null)
            <div class="form-control-icon">
                <i class="{{$icon}}"></i>
            </div>
        @endif

    </x-atoms.modal.formgroup>
    @if($showError==true)
        <x-atoms.modal.inputError input="{{$name}}"/>
    @endif
    {{$slot}}
</x-molecules.bootstrap.container>



