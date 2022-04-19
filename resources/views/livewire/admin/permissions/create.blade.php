<x-organisms.modal
    showButton={{true}}
        name="permission_create"
    type="add"
    id="0"
    size="xl"
    buttonName="Add Permission"
    buttonColor='outline-primary'
    buttonRound='{{true}}'
    buttonIcon='fas fa-user-plus'
    buttonSubmitName="New Permission"
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

</x-organisms.modal>
