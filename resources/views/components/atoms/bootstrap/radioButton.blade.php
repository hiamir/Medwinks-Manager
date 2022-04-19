<x-molecules.bootstrap.container class="{{$class}}" fluid="{{false}}" custom="">
    <x-atoms.modal.formgroup size="" icon="">
        @if($label != null)
            <x-atoms.modal.label
                labelFor={{$name}}_input_{{$id}}
                    labelName="{{$label}}">
            </x-atoms.modal.label>
        @endif

 @if($listdata != '')
        @foreach(json_decode($listdata,true) as $key=>$value)
            <div class="form-check">
            <input
                @if(!empty($debounce) )
                wire:model.debounce.{{$debounce}}='{{$name}}-{{$id}}-{{$key}}'
                @elseif($lazy && !$defer) wire:model.lazy='{{$name}}-{{$id}}-{{$key}}'
                @elseif(!$lazy && $defer) wire:model.defer='{{$name}}-{{$id}}-{{$key}}'
                @else wire:model='{{$name}}-{{$id}}-{{$key}}'
                @endif

                wire:click="{{$click}}('{{$id}}','{{$key}}','{{$parentName}}','{{$childName}}')"

                wire:key="{{$name}}_input-key_{{$id}}_{{$key}}"

                id= "{{$id}}-{{$key}}"

                class="form-check-input"
                type="radio"
                name="radioButton"
                checked=""
            >
            <label class="form-check-label" for="{{$value}}">
                {{$value}}
            </label>
            </div>
        @endforeach
        @endif

    </x-atoms.modal.formgroup>
    {{ $errors->first('form.roles') }}
    <x-atoms.modal.inputError input="{{$name}}"/>
</x-molecules.bootstrap.container>





