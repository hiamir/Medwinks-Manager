<div class="h-100">
    <div class="container h-100">
        <div class="row align-items-center justify-content-center h-100">
            <div class="col-xl-5 col-md-6 col-sm-12 align-self-center">
                <div class="card shadow-sm">
                    <div class="card-content">
                        @if(session()->has('message'))
                            <div class="alert alert-danger m-0 rounded-0 rounded-top text-sm" role="alert">
                                <i class="fas fa-info-circle"></i> {{session('message')}}
                            </div>
                        @endif
                        <div class="card-header pb-2 border-bottom">
                            <h4 class="card-title m-0 pb-2 ">Send Two Factor Authentication</h4>
                        </div>
                        <div class="card-body pt-3">

                            <p class="card-text">
                                Please click the <strong>Send Two Factor Code</strong> button below to send a code tou
                                your email for verification
                            </p>
                            <x-molecules.modal.form
                                wireSubmitPrevent="emailcode"
                            >

                                <div class="form-actions d-flex justify-content-end">


                                    <x-atoms.button
                                        name="send_two_factor"
                                        type="submit"
                                        id="send_two_factor"
                                        class="me-1"
                                        buttonName="Send Two Factor Code"
                                        buttonSize=""
                                        buttonColor='primary'
                                        link="{{false}}"
                                        buttonIcon=''
                                        buttonRound='{{true}}'
                                        onClick=""
                                    >
                                    </x-atoms.button>


{{--                                    <button type="button" class="submit-button-spinner btn btn-primary me-1"--}}
{{--                                            wire:click="emailcode" wire:loading.attr="disabled">--}}
{{--                                        <span wire:loading class="spinner spinner-grow spinner-grow-sm" role="status"--}}
{{--                                              aria-hidden="true"></span>--}}
{{--                                        Send Two Factor Code--}}
{{--                                    </button>--}}

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

{{--                                    <button wire:model='disablebutton' type="reset"--}}
{{--                                            @if($disablebutton=='true')--}}
{{--                                            disabled--}}
{{--                                            @endif--}}
{{--                                            class="btn btn-danger" wire:click="logout" wire:loading.attr="disabled">--}}
{{--                                        Logout--}}
{{--                                    </button>--}}
                                </div>
                            </x-molecules.modal.form>
                        </div>
                            <div class="card-footer py-3 text-right">
                            <span class="text-sm">I already have the <strong>
                                    <x-atoms.button
                                        name="resend_two_factor"
                                        type="submit"
                                        id="logout"
                                        class="menu-pointer text-sm fw-bold"
                                        buttonName="Two Factor Verification Code"
                                        buttonSize=""
                                        buttonColor=''
                                        link="{{true}}"
                                        buttonIcon=''
                                        buttonRound='{{true}}'
                                        onClick="verify_code"
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
