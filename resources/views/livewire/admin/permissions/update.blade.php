<x-organisms.modal
showButton={{true}}
        name="permission_update"
    type="edit"
    id="{{$permissionView->id}}"
    size="xl"
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
            id="{{$permissionView->id}}"
            size=""
            name="form.name"
            label="Permission Name"
            type="text"
            placeholder="Permission Name"
            icon=""
            value=""
            debounce="150ms"
            lazy="{{false}}"
            defer="{{false}}"
            class=""
            custom=""
        >
        </x-atoms.bootstrap.input>


        {{--           GUARD NAME  SELECT               --}}
        <x-atoms.bootstrap.select
            id="form.guard"
            name="form.guard"
            class=""
            label="Guard Name"
            placeholder="Select Guard Name"
            firstvalue=""
            :list="$guardList"
        >
        </x-atoms.bootstrap.select>
    </x-molecules.modal.content>

</x-organisms.modal
>



