<x-organisms.modal
    showButton={{true}}
        name="phone_type_update"
    type="edit"
    id="{{$phoneType->id}}"
    size="lg"
    buttonName=""
    buttonColor='outline-primary'
    buttonRound='{{false}}'
    buttonIcon='far fa-edit'
    buttonSubmitName="Update Permission"
    passingData=""
    custom=""
>
    <x-molecules.modal.content>
        {{--           NAME INPUT               --}}

        <x-atoms.bootstrap.input
            container=""
            id="{{$phoneType->id}}"
            size=""
            name="form.name"
            label="Phone Type"
            type="text"
            placeholder="Enter phone type"
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



