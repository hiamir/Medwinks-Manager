<x-organisms.modal
    showButton={{true}}
        name="role_create"
    type="add"
    id="0"
    size="lg"
    buttonName="Add Role"
    buttonColor='outline-primary'
    buttonRound='{{true}}'
    buttonIcon='fas fa-user-plus'
    buttonSubmitName="New Role"
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
            label="Role Name"
            type="text"
            placeholder="Role Name"
            icon=""
            value=""
            debounce="150ms"
            lazy="{{false}}"
            defer="{{false}}"
            class=""
            custom=""
        >
        </x-atoms.bootstrap.input>


        {{--           SLUG NAME  INPUT               --}}
        <x-atoms.bootstrap.input
            container=""
            id="0"
            size=""
            name="form.slug"
            label="Slug Name"
            type="text"
            placeholder="Slug Name"
            icon=""
            value=""
            debounce="150ms"
            lazy="{{false}}"
            defer="{{false}}"
            class=""
            custom=""
        >
        </x-atoms.bootstrap.input>


        {{--      PERMISSIONS       --}}
        <x-atoms.modal.checkbox
            id='0'
            customID=""
            label="Permissions"
            class="mb-4"
            name='form.permissions.permission'
            debounce="500ms"
            lazy="{{false}}"
            defer="{{false}}"
            text="{{}}"
            checked='{{false}}'
            data=""
            :listdata=json_encode($permissionList)
        >
        </x-atoms.modal.checkbox>



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
