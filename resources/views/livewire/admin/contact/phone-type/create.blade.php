<x-organisms.modal
    showButton={{true}}
        name="phone_type_create"
    type="add"
    id="'phone-type'"
    size="lg"
    buttonName="Add Phone Type"
    buttonColor='outline-primary'
    buttonRound='{{true}}'
    buttonIcon='fas fa-user-plus'
    buttonSubmitName="New Phone Type"
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
            label="Permission Name"
            type="text"
            placeholder="Phone Type"
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
