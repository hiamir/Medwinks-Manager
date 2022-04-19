<x-organisms.modal
    showButton={{true}}
        name="user_create"
    type="0"
    id="'user'"
    size="lg"
    buttonName="Add User"
    buttonColor='outline-primary'
    buttonRound='{{true}}'
    buttonIcon='fas fa-user-plus'
    buttonSubmitName="Add User"
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
            label="Full Name"
            type="text"
            placeholder="Full Name"
            icon=""
            value=""
            debounce="150ms"
            lazy="{{false}}"
            defer="{{false}}"
            class=""
            custom=""
        >
        </x-atoms.bootstrap.input>


        {{--           EMAIL INPUT               --}}

        <x-atoms.bootstrap.input
            container=""
            id="0"
            size=""
            name="form.email"
            label="Email"
            type="email"
            placeholder="Email"
            icon=""
            value=""
            debounce="150ms"
            lazy="{{false}}"
            defer="{{false}}"
            class=""
            custom="wire:change=newEmailKeyup"
        >
        </x-atoms.bootstrap.input>


        {{--           ROLES INPUT               --}}
        <x-atoms.bootstrap.radioButton
            id='0'
            customID=""
            label="Roles"
            class="p-0"
            name='form.roles.role'
            debounce=""
            lazy="{{false}}"
            defer="{{true}}"
            text="{{}}"
            checked='{{false}}'
            data=""
            click="radioButton"
            parentName="roles"
            childName="role"
            :listdata=json_encode($roles)
        >
        </x-atoms.bootstrap.radioButton>
    </x-molecules.modal.content>

</x-organisms.modal>
