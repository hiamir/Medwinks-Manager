<x-organisms.modal
    showButton={{true}}
        name="category_update"
    type="edit"
    id="{{$category->id}}"
    size="lg"
    buttonName=""
    buttonColor='outline-success'
    buttonRound='{{false}}'
    buttonIcon='far fa-edit'
    buttonSubmitName="Update Category"
    passingData=""
    custom=""
>
    <x-molecules.modal.content>
        {{--           NAME INPUT               --}}

        <x-atoms.bootstrap.input
            container=""
            id="{{$category->id}}"
            size=""
            name="form.name"
            label="Category Name"
            type="text"
            placeholder="Category Name"
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
            id="{{$category->id}}"
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



