<x-organisms.modal
    showButton={{true}}
        name="user_update"
    type="edit"
    id="{{$user->id}}"
    size="lg"
    buttonName=""
    buttonColor='outline-success'
    buttonRound='{{false}}'
    buttonIcon='far fa-edit'
    buttonSubmitName="Update User"
    passingData=""
    custom=""
>
    <x-molecules.modal.content>

        @if($toggleHighlight)
            <x-atoms.modal.Highlight
                id="{{$user->id}}"
                name="email-message-highlight"
                background="light-danger"
                class="mb-4"
            >
                <div class="row">
                    <div class="col-12 text-center">
                        <i class="bi bi-info-circle fs-2"></i>
                    </div>
                    <div class="col-12 text-center">
                        <span class="font-bold ">Changing email?</span>
                        <div class="text-center">After the update, the user need to verify his/her email with a Two
                            Factor authentication code sent to his email.
                        </div>

                    </div>
                </div>

            </x-atoms.modal.Highlight>
        @endif


        {{--           NAME INPUT               --}}

        <x-atoms.bootstrap.input
            container=""
            id="{{$user->id}}"
            size=""
            name="form.name"
            label="Full Name"
            type="text"
            placeholder="Full Name"
            icon=""
            value=""
            debounce=""
            lazy="{{false}}"
            defer="{{false}}"
            class=""
            custom=""
        >
        </x-atoms.bootstrap.input>


        {{--           EMAIL INPUT               --}}

        <x-atoms.bootstrap.input
            container=""
            id="{{$user->id}}"
            size=""
            name="form.email"
            label="Email"
            type="email"
            placeholder="Email"
            icon=""
            value=""
            debounce="100ms"
            lazy="{{false}}"
            defer="{{false}}"
            class=""
            custom="wire:keyup=emailKeyup"
        >
        </x-atoms.bootstrap.input>

            {{--           ROLES INPUT               --}}
            <x-atoms.bootstrap.radioButton
                id='{{$user->id}}'
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


        {{--           CHECKBOX INPUT               --}}
        <x-atoms.formgroup>
            <x-atoms.modal.highlight
                id='{{$user->id}}'
                name="checkbox-highlight"
                class=""
                background="light-primary">
                <x-atoms.modal.checkbox
                    id='{{$user->id}}'
                    customID=""
                    label="Status"
                    name='form.status'
                    class=""
                    debounce="500ms"
                    lazy="{{false}}"
                    defer="{{false}}"
                    text="Block user?"
                    checked='{{$user->active}}'
                    data=""
                    listdata=""
                    >
                </x-atoms.modal.checkbox>
            </x-atoms.modal.highlight>
        </x-atoms.formgroup>




        <div class="row justify-content-start">
                      <div class="col-auto">
                <div class="form-group">
                    <x-atoms.modal.button
                        name="resetpassword"
                        type="edit"
                        id="{{$user->id}}"
                        buttonName="Reset Password"
                        buttonColor='outline-success'
                        buttonIcon='far fa-edit'
                        custom=""
                    >
                    </x-atoms.modal.button>
                </div>
            </div>

        </div>
    </x-molecules.modal.content>

</x-organisms.modal>


{{--           RESET PASSWORD MODAL               --}}
<x-organisms.modal
    showButton={{0}}
        name="resetpassword"
    type="edit"
    id="{{$user->id}}"
    size="lg"
    buttonName="Reset Password"
    buttonColor='outline-success'
    buttonIcon='far fa-edit'
    buttonSubmitName="Reset Password"
    passingData=""
    custom=""
>
    <x-molecules.modal.content>

        Are you sure you want to reset the password?

    </x-molecules.modal.content>
</x-organisms.modal>



