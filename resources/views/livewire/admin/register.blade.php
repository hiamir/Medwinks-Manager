<div class="row h-100 m-0">
    <div class="col-xl-5 col-lg-6 col-md-6">
        <div id="auth-left">
            <div class="auth-logo">
                <a href="index.html"><img src="{{ asset('images/logo-circle.svg') }}" alt="Logo"></a>
{{--                <a href="index.html"><img src="{{ asset('images/medwinks-logo.svg') }}" alt="Logo"></a>--}}
            </div>
            <h1 class="auth-title">Admin Sign Up</h1>
            <p class="auth-subtitle mb-5">Input your data to register to our website.</p>


            <x-molecules.modal.form wireSubmitPrevent="register">
                <x-atoms.bootstrap.input
                    container="p-0 pb-4"
                    id="register-name"
                    size="large"
                    name="form.name"
                    icon="bi bi-person"
                    label=""
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

                <x-atoms.bootstrap.input
                    container="p-0 pb-4"
                    id="register-email"
                    size="large"
                    name="form.admin-email"
                    icon="bi bi-envelope"
                    label=""
                    value=""
                    debounce="100ms"
                    lazy="{{false}}"
                    defer="{{false}}"
                    type="text"
                    placeholder="Email"
                    class=""
                    custom=""
                >
                </x-atoms.bootstrap.input>

                <x-atoms.bootstrap.input
                    container=""
                    id="register-password"
                    size="large"
                    name="form.password"
                    icon="bi bi-shield-lock"
                    label=""
                    value=""
                    debounce=""
                    lazy="{{true}}"
                    defer="{{false}}"
                    type="password"
                    placeholder="password"
                    class=""
                    custom="autocomplete='on'"
                >
                </x-atoms.bootstrap.input>

                <x-atoms.bootstrap.input
                    container=""
                    id="register-confirm-password"
                    size="large"
                    name="form.password_confirmation"
                    icon="bi bi-shield-lock"
                    label=""
                    value=""
                    debounce=""
                    lazy="{{true}}"
                    defer="{{false}}"
                    type="password"
                    placeholder="Confirm password"
                    class=""
                    custom="autocomplete='on'"
                >
                </x-atoms.bootstrap.input>
                {{--                <div class="container p-0 mb-4">--}}
                {{--                    <div class="form-group position-relative has-icon-left mb-1">--}}
                {{--                        <input type="text" name='name' class="form-control form-control-xl" placeholder="Full Name"--}}
                {{--                               wire:model='form.name'>--}}
                {{--                        <div class="form-control-icon">--}}
                {{--                            <i class="bi bi-person"></i>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                    @error('form.name')--}}
                {{--                    <livewire:components.inputerror :message="$message"/> @endError--}}
                {{--                </div>--}}
                {{--                <div class="container p-0 mb-4">--}}
                {{--                    <div class="form-group position-relative has-icon-left mb-1">--}}
                {{--                        <input type="text" name='email' class="form-control form-control-xl" placeholder="Email"--}}
                {{--                               wire:model='form.email'>--}}
                {{--                        <div class="form-control-icon">--}}
                {{--                            <i class="bi bi-envelope"></i>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                    @error('form.email')--}}
                {{--                    <livewire:components.inputerror :message="$message"/> @endError--}}
                {{--                </div>--}}

                {{--                <div class="container p-0 mb-4">--}}
                {{--                    <div class="form-group position-relative has-icon-left mb-1">--}}
                {{--                        <input type="password" name='password' class="form-control form-control-xl" placeholder="Password"--}}
                {{--                               wire:model='form.password'>--}}
                {{--                        <div class="form-control-icon">--}}
                {{--                            <i class="bi bi-shield-lock"></i>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                    @error('form.password')--}}
                {{--                    <livewire:components.inputerror :message="$message"/> @endError--}}
                {{--                </div>--}}
                {{--                <div class="container p-0 mb-4">--}}
                {{--                    <div class="form-group position-relative has-icon-left mb-1">--}}
                {{--                        <input type="password" name='password_confirmation' class="form-control form-control-xl" placeholder="Confirm Password"--}}
                {{--                               wire:model='form.password_confirmation'>--}}
                {{--                        <div class="form-control-icon">--}}
                {{--                            <i class="bi bi-shield-lock"></i>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                    @error('form.password_confirmation')--}}
                {{--                    <livewire:components.inputerror :message="$message"/> @endError--}}
                {{--                </div>--}}
                <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Sign Up</button>
            </x-molecules.modal.form>
            {{--            </form>--}}
            <div class="text-center mt-5 text-lg fs-4">
                <p class='text-gray-600'>Already have an account? <a href="{{route('admin.login')}}"
                                                                     class="font-bold">Log
                        in</a>.</p>
            </div>
        </div>
    </div>
    <div class="col-xl-7 col-lg-6 col-md-6 d-none d-md-block p-0">
        <div id="auth-right">

        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function () {
            // $("form")[0].reset()
        })
    </script>
@endpush
