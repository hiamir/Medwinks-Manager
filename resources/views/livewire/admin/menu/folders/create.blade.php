<x-organisms.modal
    showButton={{true}}
        name="folder_create"
    type="add"
    id="0"
    size="lg"
    buttonName="Add Folder"
    buttonColor='outline-primary'
    buttonRound='{{true}}'
    buttonIcon='fas fa-user-plus'
    buttonSubmitName="New Folder"
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
            label="Folder Name"
            type="text"
            placeholder="Folder Name"
            icon=""
            value=""
            debounce="150ms"
            lazy="{{false}}"
            defer="{{false}}"
            class=""
            custom=""
        >
        </x-atoms.bootstrap.input>

        {{--           POSITION INPUT               --}}

        <x-atoms.bootstrap.input
            container=""
            id="0"
            size=""
            name="form.position"
            label="Position"
            type="text"
            placeholder="Position of Folder"
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