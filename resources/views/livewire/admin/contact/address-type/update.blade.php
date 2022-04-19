<x-organisms.modal
showButton={{true}}
        name="address_type_update"
    type="edit"
    id="{{$addressType->id}}"
    size="lg"
    buttonName=""
    buttonColor='outline-primary'
    buttonRound='{{false}}'
    buttonIcon='far fa-edit'
    buttonSubmitName="Update address type"
passingData=""
custom=""
>
    <x-molecules.modal.content>
        {{--           NAME INPUT               --}}

        <x-atoms.bootstrap.input
            container=""
            id="{{$addressType->id}}"
            size=""
            name="form.name"
            label="Address Type"
            type="text"
            placeholder="Enter address type"
            icon=""
            value=""
            debounce="150ms"
            lazy="{{false}}"
            defer="{{false}}"
            class=""
            custom=""
        >
        </x-atoms.bootstrap.input>


    </x-molecules.modal.content>

</x-organisms.modal
>



