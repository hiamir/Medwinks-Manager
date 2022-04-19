<x-organisms.modal
    showButton={{true}}
        name="division_update"
    type="edit"
    id="{{$division->id}}"
    size="lg"
    buttonName=""
    buttonColor='outline-success'
    buttonRound='{{false}}'
    buttonIcon='far fa-edit'
    passingData=""
    buttonSubmitName="Update {{$division->name}}"
    custom=""
>
    <x-molecules.modal.content>

        {{--           NAME INPUT               --}}

        <x-atoms.bootstrap.input
            container=""
            id="{{$division->id}}"
            size=""
            name="form2.name"
            label="Division Name"
            type="text"
            placeholder="Enter new division name"
            icon=""
            value=""
            debounce="150ms"
            lazy="{{false}}"
            defer="{{false}}"
            class=""
            custom=""
        >
        </x-atoms.bootstrap.input>


        {{--           TEXTAREA INPUT               --}}

        <x-atoms.bootstrap.textarea
            container=""
            height="5"
            id="{{$division->id}}"
            size=""
            name="form2.description"
            label="Division Description"
            type="text"
            placeholder="Enter new Division description"
            icon=""
            value=""
            debounce="150ms"
            lazy="{{false}}"
            defer="{{false}}"
            class=""
            custom=""
        >
        </x-atoms.bootstrap.textarea>


        {{--           WEBSITE INPUT               --}}

        <x-atoms.bootstrap.input
            container=""
            id="{{$division->id}}"
            size=""
            name="form2.website"
            label="Division Website"
            type="text"
            placeholder="Enter division website"
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
