<div>

    <x-organisms.modal
        showButton={{1}}
            name="profile"
        type="edit"
        id="{{auth()->user()->id}}"
        buttonName="Edit Profile"
        buttonColor='outline-primary'
        buttonRound='{{true}}'
        buttonIcon="far fa-edit"
        buttonSubmitName="Update {{$user->name}}"
    >
        <x-molecules.modal.content>

            @if($toggleHighlight)
                <x-atoms.modal.Highlight
                    id="{{$user->id}}"
                    name="email-message-highlight"
                    background="light-danger"
                    class=""
                >
                    <div class="row">
                        <div class="col-12 text-center">
                            <i class="bi bi-info-circle fs-2"></i>
                        </div>
                        <div class="col-12 text-center">
                            <span class="font-bold ">Changing email?</span>
                            <div class="text-center">You will be logged out and a
                                authentication code sent to your email for verification.</div>

                        </div>
                    </div>

                </x-atoms.modal.Highlight>
            @endif

            {{--           NAME INPUT               --}}

            <x-atoms.bootstrap.input
                container=""
                id="{{auth()->user()->id}}"
                size=""
                name="form.name"
                icon=""
                label="Full Name"
                value=""
                debounce=""
                lazy="{{true}}"
                defer="{{false}}"
                type="text"
                placeholder="Full Name"
                class=""
                custom=""
            >
            </x-atoms.bootstrap.input>



            {{--           EMAIL INPUT               --}}

            <x-atoms.bootstrap.input
                container=""
                id="{{auth()->user()->id}}"
                size=""
                name="form.email"
                icon=""
                label="Email"
                value=""
                debounce="150ms"
                lazy="{{false}}"
                defer="{{false}}"
                type="email"
                placeholder="Email"
                class=""
                custom="wire:keyup=emailKeyup"
            >
            </x-atoms.bootstrap.input>


            {{--            <x-atoms.bootstrap.input--}}
            {{--                id="{{auth()->user()->id}}"--}}
            {{--                name="form.email"--}}
            {{--                label="Email"--}}
            {{--                type="email"--}}
            {{--                placeholder="Email"--}}
            {{--                lazy="{{false}}"--}}
            {{--                custom="wire:keyup=emailKeyup"--}}
            {{--            >--}}
            {{--            </x-atoms.bootstrap.input>--}}

            {{--           CHANGE PASSWORD BUTTON               --}}
            <div class="row">

                <div class="col-6">

                    <div class="form-group">


                        <x-atoms.modal.button

                            name="changepassword"
                            type="edit"
                            id="{{$user->id}}"
                            buttonName="Change Password"
                            buttonColor='outline-success'
                            buttonIcon='far fa-edit'
                        >
                        </x-atoms.modal.button>

                    </div>
                </div>
                <div class="col-6"></div>
            </div>
        </x-molecules.modal.content>

    </x-organisms.modal>
</div>

{{--           RESET PASSWORD MODAL         --}}
<x-organisms.modal
    showButton={{0}}
        name="changepassword"
    type="edit"
    id="{{$user->id}}"
    buttonName="Change Password"
    buttonColor='outline-success'
    buttonIcon='far fa-edit'
    buttonSubmitName="Change Password"
>
    <x-molecules.modal.content>
        <x-atoms.bootstrap.input
            container=""
            id="{{$user->id}}"
            size=""
            name="form.current_password"
            icon=""
            label="Current Password"
            value=""
            debounce="100ms"
            lazy="{{false}}"
            defer="{{false}}"
            type="password"
            placeholder="Enter current password"
            class=""
            custom="autocomplete=off"
        >
        </x-atoms.bootstrap.input>


        <x-atoms.bootstrap.input
            container=""
            id="{{$user->id}}"
            size=""
            name="form.password"
            icon=""
            label="New Password"
            value=""
            debounce=""
            lazy="{{true}}"
            defer="{{false}}"
            type="password"
            placeholder="Enter new password"
            class=""
            custom="autocomplete=off"
        >
        </x-atoms.bootstrap.input>

        <x-atoms.bootstrap.input
            container=""
            id="{{$user->id}}"
            size=""
            name="form.password_confirmation"
            icon=""
            label="Confirm Password"
            value=""
            debounce=""
            lazy="{{true}}"
            defer="{{false}}"
            type="password"
            placeholder="Confirm new password"
            class=""
            custom="autocomplete=off"
        >
        </x-atoms.bootstrap.input>

    </x-molecules.modal.content>
</x-organisms.modal>
