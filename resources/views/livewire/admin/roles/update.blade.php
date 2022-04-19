<x-organisms.modal
    showButton={{true}}
        name="role_update"
    type="edit"
    id="{{$role->id}}"
    size="lg"
    buttonName=""
    buttonColor='outline-success'
    buttonRound='{{false}}'
    buttonIcon='far fa-edit'
    buttonSubmitName="Update Role"
    passingData=""
    custom=""
>
    <x-molecules.modal.content>
        {{--           NAME INPUT               --}}

        <x-atoms.bootstrap.input
            container=""
            id="{{$role->id}}"
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
            id="{{$role->id}}"
            size=""
            name="form.slug"
            label="Slug Name"
            type="text"
            placeholder="Slug Name"
            icon=""
            value=""
            debounce=""
            lazy="{{true}}"
            defer="{{true}}"
            class=""
            custom=""
        >
        </x-atoms.bootstrap.input>




        {{--      PERMISSIONS       --}}
        <x-atoms.modal.checkbox
            id='{{$role->id}}'
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


        {{--           PERMISSION BUTTON               --}}
{{--        <x-molecules.bootstrap.container class="" fluid="" custom="">--}}
{{--            <x-molecules.bootstrap.row class="justify-content-start" custom="">--}}
{{--                <x-molecules.bootstrap.column class="col-auto p-0" custom="">--}}
{{--                    <x-atoms.formgroup>--}}
{{--                        <x-atoms.modal.button--}}
{{--                            id="{{$role->id}}"--}}
{{--                            name="permissions"--}}
{{--                            type="edit"--}}
{{--                            buttonName="PermissionExtends"--}}
{{--                            buttonColor='outline-danger'--}}
{{--                            buttonIcon='fas fa-key'--}}
{{--                        >--}}
{{--                        </x-atoms.modal.button>--}}
{{--                    </x-atoms.formgroup>--}}
{{--                </x-molecules.bootstrap.column>--}}

{{--            </x-molecules.bootstrap.row>--}}
{{--        </x-molecules.bootstrap.container>--}}
    </x-molecules.modal.content>

</x-organisms.modal>

{{--           EDIT PERMISSIONS               --}}
{{--<x-organisms.modal--}}
{{--    showButton={{0}}--}}
{{--        name="permissions"--}}
{{--    type="edit"--}}
{{--    id="{{$role->id}}"--}}
{{--    buttonName="{{$role->name}} permissions"--}}
{{--    buttonColor='outline-success'--}}
{{--    buttonIcon='fas fa-key'--}}
{{--    buttonSubmitName="Update PermissionExtends"--}}
{{-->--}}
{{--    <x-molecules.modal.content>--}}
{{--        <x-atoms.modal.label--}}
{{--            labelFor="permission"--}}
{{--            labelName="PermissionExtends">--}}
{{--        </x-atoms.modal.label>--}}


{{--        <x-atoms.modal.checkbox--}}
{{--            id='{{$role->id}}'--}}
{{--            customID=""--}}
{{--            label=""--}}
{{--            name='form.permissions.permission'--}}
{{--            debounce="500ms"--}}
{{--            lazy="{{false}}"--}}
{{--            defer="{{false}}"--}}
{{--            text="{{}}"--}}
{{--            checked='{{false}}'--}}
{{--            data=""--}}
{{--            :listdata=json_encode($permissions)--}}
{{--        >--}}
{{--        </x-atoms.modal.checkbox>--}}
{{--    </x-molecules.modal.content>--}}
{{--</x-organisms.modal>--}}

{{--<x-organisms.modal--}}
{{--    showButton={{0}}--}}
{{--        name="permissions"--}}
{{--    type="edit"--}}
{{--    id="{{$role->id}}"--}}
{{--    size="'lg"--}}
{{--    buttonName="{{$role->name}} Permission"--}}
{{--    buttonColor='outline-success'--}}
{{--    buttonIcon='fas fa-key'--}}
{{--    buttonSubmitName="Update Permission"--}}
{{--    custom=""--}}
{{-->--}}
{{--    <x-molecules.modal.content>--}}
{{--        <x-atoms.modal.label--}}
{{--            labelFor="permissions"--}}
{{--            labelName="PermissionExtends">--}}
{{--        </x-atoms.modal.label>--}}

{{--        @php--}}
{{--            $p=Spatie\Permission\Models\Permission::where('guard_name',$role->guard_name)->get();--}}
{{--            $q=App\Traits\Quicker::convertArray($p, 'name');--}}
{{--        @endphp--}}
{{--        @empty($q)--}}
{{--           <p>No PermissionExtends avaliable!</p>--}}
{{--        @endempty--}}
{{--        <x-atoms.modal.checkbox--}}
{{--            id='{{$role->id}}'--}}
{{--            customID=""--}}
{{--            label=""--}}
{{--            class=""--}}
{{--            name='form.permissions.permission'--}}
{{--            debounce="500ms"--}}
{{--            lazy="{{false}}"--}}
{{--            defer="{{false}}"--}}
{{--            text="{{}}"--}}
{{--            checked='{{false}}'--}}
{{--            data=""--}}
{{--            :listdata=json_encode($q)--}}
{{--        >--}}
{{--        </x-atoms.modal.checkbox>--}}
{{--    </x-molecules.modal.content>--}}
{{--</x-organisms.modal>--}}



