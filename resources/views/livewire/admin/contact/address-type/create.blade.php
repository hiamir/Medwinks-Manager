<x-organisms.modal
    showButton={{true}}
        name="address_type_create"
    type="add"
    id="0"
    size="lg"
    buttonName="Add Address Type"
    buttonColor='outline-primary'
    buttonRound='{{true}}'
    buttonIcon='fas fa-user-plus'
    buttonSubmitName="New Address Type"
    passingData=""
    custom=""
>
    <x-molecules.modal.content>
        {{--           NAME INPUT               --}}

        <x-atoms.bootstrap.input
            container=""
            id="0"
            size=""
            name="form.name"
            label="Address Type"
            type="text"
            placeholder="Address Type"
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

</x-organisms.modal>
