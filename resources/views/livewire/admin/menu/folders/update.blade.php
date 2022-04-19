<x-organisms.modal
    showButton={{true}}
        name="folder_update"
    type="edit"
    id="{{$folder->id}}"
    size="lg"
    buttonName=""
    buttonColor='outline-success'
    buttonRound='{{false}}'
    buttonIcon='far fa-edit'
    buttonSubmitName="Update Folder"
    passingData=""
    custom=""
>
    <x-molecules.modal.content>
        {{--           NAME INPUT               --}}

        <x-atoms.bootstrap.input
            container=""
            id="{{$folder->id}}"
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
            id="{{$folder->id}}"
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



