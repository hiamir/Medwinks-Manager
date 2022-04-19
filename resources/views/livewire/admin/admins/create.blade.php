<x-organisms.modal
    showButton={{true}}
        name="admin_create"
    type="add"
    id="0"
    size="lg"
    buttonName="Add Admin"
    buttonColor='outline-primary'
    buttonRound='{{true}}'
    buttonIcon='fas fa-user-plus'
    buttonSubmitName="Add Admin"
    passingData=""
    custom=""
>
    <x-molecules.modal.content>

        @if ($errors->has('form.two_factor_code') ||$errors->has('form.two_factor_expires_at') )
            <x-molecules.bootstrap.alert
                bgColor="alert-danger"
                textColor="text-white"
            >
                @if($errors->has('form.two_factor_code')  )
                    {{ $errors->first('form.two_factor_code') }}

                @elseif($errors->has('form.two_factor_expires_at')  )
                    {{ $errors->first('form.two_factor_expires_at')}}
                @endif
            </x-molecules.bootstrap.alert>
        @endif



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
