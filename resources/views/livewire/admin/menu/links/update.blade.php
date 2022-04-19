<x-organisms.modal
    showButton={{true}}
        name="link_update"
    type="edit"
    id="{{$link->id}}"
    size="lg"
    buttonName=""
    buttonColor='outline-success'
    buttonRound='{{false}}'
    buttonIcon='far fa-edit'
    buttonSubmitName="Update Link"
    passingData=""
    custom=""
>
    <x-molecules.modal.content>
        {{--           NAME INPUT               --}}

        <x-atoms.bootstrap.input
            container=""
            id="{{$link->id}}"
            size=""
            name="form.name"
            label="List Name"
            type="text"
            placeholder="Enter name"
            icon=""
            value=""
            debounce="150ms"
            lazy="{{false}}"
            defer="{{false}}"
            class=""
            custom=""
        >
        </x-atoms.bootstrap.input>

        {{--           ROUTE INPUT               --}}

        <x-atoms.bootstrap.input
            container=""
            id="{{$link->id}}"
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
            id="{{$link->id}}"
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


        <x-atoms.modal.checkbox
            id="{{$link->id}}"
            customID=""
            class="mb-4"
            label="Roles"
            name='form.roles.role'
            debounce="500ms"
            lazy="{{false}}"
            defer="{{false}}"
            text=""
            checked='{{}}'
            data=""
            :listdata="json_encode($roles)"
        >
        </x-atoms.modal.checkbox>



        {{--           PERMISSION INPUT               --}}

        <x-atoms.bootstrap.input
            container=""
            id="{{$link->id}}"
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
            id="{{$link->id}}"
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
            id="{{$link->id}}"
            name="form.category"
            class=""
            label="Category"
            placeholder="Select Category"
            firstvalue=""
            :list="$menuCategory"
        >
        </x-atoms.bootstrap.select>


        {{--           POSITION INPUT               --}}

        <x-atoms.bootstrap.input
            container=""
            id="{{$link->id}}"
            size=""
            name="form.position"
            label="Position"
            type="text"
            placeholder="Position of list"
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



