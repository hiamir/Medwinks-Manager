<div class="h-100">
    <div class="container h-100">
        <div class="row align-items-center justify-content-center h-100">
            <div class="col-xl-5 col-md-6 col-sm-12 align-self-center">
                <div class="card shadow-sm">
                    <div class="card-content">
                        @if($message!="")
                            <div wire:modal='alert' class="alert alert-danger m-0 rounded-0 rounded-top text-sm" role="alert">
                                <i class="fas fa-info-circle"></i>
                                {{$message}}
                            </div>
                        @endif
                        <div class="card-header pb-2 border-bottom">
                            <h4 class="card-title m-0 pb-2 ">Verify Two Factor Authentication</h4>
                        </div>


                        <div class="card-body pt-3">

                            <p class="card-text">
                                Please verify the <strong>Two Factor Code</strong> sent to you email.
                            </p>

                            <x-molecules.modal.form
                                wireSubmitPrevent="verify" class=""
                            >
                                <x-atoms.modal.form-body >
                                    <x-atoms.bootstrap.input
                                        container=""
                                        id="verification_code"
                                        size=""
                                        name="verification_code"
                                        icon=""
                                        label=""
                                        value=""
                                        debounce=""
                                        lazy="{{true}}"
                                        defer="{{false}}"
                                        type="text"
                                        placeholder="Enter verification code"
                                        class=""
                                        custom="autocomplete=off"
                                    >
                                    </x-atoms.bootstrap.input>
                                    <div class="form-actions d-flex justify-content-end">
                                        <x-atoms.button
                                            name="verify"
                                            type="submit"
                                            id="verify"
                                            class="me-1"
                                            buttonName="Authenticate"
                                            buttonSize=""
                                            buttonColor='primary'
                                            link="{{false}}"
                                            buttonIcon=''
                                            buttonRound='{{true}}'
                                            onClick=""
                                        >
                                        </x-atoms.button>

                                        <x-atoms.button
                                            name="logout"
                                            type="submit"
                                            id="logout"
                                            class=""
                                            buttonName="Logout"
                                            buttonSize=""
                                            buttonColor='danger'
                                            link="{{false}}"
                                            buttonIcon=''
                                            buttonRound='{{true}}'
                                            onClick="logout"
                                        >
                                        </x-atoms.button>
                                    </div>


                                </x-atoms.modal.form-body>

                            </x-molecules.modal.form>

{{--                            <form class="form" wire:submit.prevent="verify">--}}
{{--                                <div class="form-body">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <input wire:model='verification_code' type="text" class="form-control"--}}
{{--                                               placeholder="Verification code">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="form-actions d-flex justify-content-end">--}}
{{--                                    <button type="submit" class="btn btn-primary me-1">Authenticate</button>--}}
{{--                                    <button type="reset" class="btn btn-danger" wire:click="logout">Logout</button>--}}
{{--                                </div>--}}
{{--                            </form>--}}
                        </div>
                            <div class="card-footer py-3 text-right">
                            <span class="text-sm">Didn't receive the code? <strong>
                                    <x-atoms.button
                                        name="resend_two_factor"
                                        type="submit"
                                        id="logout"
                                        class="menu-pointer text-sm fw-bold"
                                        buttonName="Resend Two Factor Code"
                                        buttonSize=""
                                        buttonColor=''
                                        link="{{true}}"
                                        buttonIcon=''
                                        buttonRound='{{true}}'
                                        onClick="resendcode"
                                    >
                                        </x-atoms.button>
                                </strong></span>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
