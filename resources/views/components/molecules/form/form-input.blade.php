<x-molecules.bootstrap.container class="{{$container}}  p-0 mb-4" custom="">
    <x-atoms.modal.formgroup size="{{$size}}" icon="{{$icon}}">
        <x-atoms.modal.label
            labelFor={{$name}}_input_{{$id}}
                labelName="{{$label}}">
        </x-atoms.modal.label>
        <x-atoms.bootstrap.input
            container=""
            id="0"
            size=""
            name="form.name"
            label="Role Name"
            type="text"
            placeholder="Role Name"
            icon=""
            value=""
            debounce="150ms"
            lazy="{{false}}"
            defer="{{false}}"
            class=""
            custom=""
        >
        </x-atoms.bootstrap.input>
    </x-atoms.modal.formgroup>
    <x-atoms.modal.inputError input="{{$name}}"> </x-atoms.modal.inputError>
</x-molecules.bootstrap.container>
