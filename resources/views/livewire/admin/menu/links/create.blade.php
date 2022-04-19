<x-organisms.modal
    showButton={{true}}
        name="link_create"
    type="add"
    id="0"
    size="lg"
    buttonName="Add Link"
    buttonColor='outline-primary'
    buttonRound='{{true}}'
    buttonIcon='fas fa-user-plus'
    buttonSubmitName="New Link"
    passingData=""
    custom=""
    xdata="
            pid:'0',
            sid:'0',

    "
>
    <x-molecules.modal.content>
        {{--           NAME INPUT               --}}

        <x-atoms.bootstrap.input
            container=""
            id="0"
            size=""
            name="form.name"
            label="List Name"
            type="text"
            placeholder="Enter name"
            icon=""
            value=""
            debounce=""
            lazy="{{false}}"
            defer="{{true}}"
            class=""
            custom=""
        >
        </x-atoms.bootstrap.input>

        {{--           ROUTE INPUT               --}}

        <x-atoms.bootstrap.input
            container=""
            id="0"
            size=""
            name="form.route"
            label="List Route"
            type="text"
            placeholder="Enter route"
            icon=""
            value=""
            debounce="150ms"
            lazy="{{false}}"
            defer="{{false}}"
            class=""
            custom=""
        >
            <x-molecules.bootstrap.lists
                displayList="{{$display_route_list}}"
                listName="route"
                name="name"
                width="50"
                background="secondary"
                error="form.route"
                :lists=$routeList
            >
            </x-molecules.bootstrap.lists>

        </x-atoms.bootstrap.input>


{{--        ROUTE INDEX         --}}

        <x-atoms.bootstrap.input
            container=""
            id="0"
            size=""
            name="form.route_index"
            label="Route Index"
            type="text"
            placeholder="Enter route index"
            icon=""
            value=""
            debounce="150ms"
            lazy="{{false}}"
            defer="{{false}}"
            class=""
            custom=""
        >
        </x-atoms.bootstrap.input>


        {{--           ROLE CHECKBOX               --}}

        <x-atoms.modal.label
            labelFor="roles"
            labelName="Roles">
        </x-atoms.modal.label>


        <x-atoms.modal.checkbox
            id='0'
            customID=""
            label=""
            class="mb-4"
            name='form.roles.role'
            debounce="500ms"
            lazy="{{false}}"
            defer="{{false}}"
            text="{{}}"
            checked='{{false}}'
            data=""
            :listdata=json_encode($roles)
        >
        </x-atoms.modal.checkbox>


        {{--           PERMISSION INPUT               --}}

        <x-atoms.bootstrap.input
            container=""
            id="0"
            size=""
            name="form.permission"
            label="Permission"
            type="text"
            placeholder="Enter permission to view"
            icon=""
            value=""
            debounce="150ms"
            lazy="{{false}}"
            defer="{{false}}"
            class=""
            showError="{{true}}"
            custom=""
        >
            <x-molecules.bootstrap.lists
                displayList="{{$display_permission_list}}"
                listName="permission"
                name="name"
                width="50"
                background="secondary"
                error="form.permission"
                :lists=$permissionList
            >
            </x-molecules.bootstrap.lists>
        </x-atoms.bootstrap.input>



        {{--           FOLDER NAME  SELECT               --}}
        <x-atoms.bootstrap.select
            id="form.folder"
            name="form.folder"
            class=""
            label="Sub Folder"
            placeholder="Select Folder"
            firstvalue=""
            :list="$menuList"
        >
        </x-atoms.bootstrap.select>


        {{--           CATEGORY NAME  SELECT               --}}
        <x-atoms.bootstrap.select
            id="form.category"
            name="form.category"
            class=""
            label="Sub Category"
            placeholder="Select Category"
            firstvalue=""
            :list="$menuCategory"
        >
        </x-atoms.bootstrap.select>


        {{--           POSITION INPUT               --}}

        <x-atoms.bootstrap.input
            container=""
            id="0"
            size=""
            name="form.position"
            label="Position"
            type="text"
            placeholder="Position of list"
            icon=""
            value=""
            debounce=""
            lazy="{{true}}"
            defer="{{false}}"
            class=""
            custom=""
        >
        </x-atoms.bootstrap.input>


    </x-molecules.modal.content>


</x-organisms.modal>
