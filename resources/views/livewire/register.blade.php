<div class="row h-100 m-0">
    <div class="col-xl-5 col-lg-6 col-md-6">
        <div id="auth-left">
            <div class="auth-logo">
                <a href="index.html"><img src="{{ asset('images/logo-circle.svg') }}" alt="Logo"></a>
            </div>
            <h1 class="auth-title">Sign Up</h1>
            <p class="auth-subtitle mb-5">Input your data to register to our website.</p>


            <x-molecules.modal.form wireSubmitPrevent="register" class="">


                <x-atoms.bootstrap.input-text
                    name="form.name"
                    xdata="
                    label:'Full Name',
                    inputValue:'',
                    idName:'name',
                    inputValue:'',
                    entangleName:$wire.entangle('form.name'),
                    placeholder:'Enter your full name'"
                    xinit="inputValue=''"
                >
                </x-atoms.bootstrap.input-text>


                <x-atoms.bootstrap.input-text
                    name="form.email"
                    xdata="
                    label:'Email',
                    inputValue:'',
                    idName:'email',
                    inputValue:'',
                    entangleName:$wire.entangle('form.email'),
                    placeholder:'Enter your email'"
                    xinit="inputValue=''"
                >
                </x-atoms.bootstrap.input-text>

                <x-atoms.bootstrap.input-text
                    name="form.password"
                    type="password"
                    xdata="
                    label:'Password',
                    inputValue:'',
                    idName:'password',
                    inputValue:'',
                    entangleName:$wire.entangle('form.password'),
                    placeholder:'Enter your password'"
                    xinit="inputValue=''"
                >
                </x-atoms.bootstrap.input-text>


                <x-atoms.bootstrap.input-text
                    name="form.password_confirmation"
                    type="password"
                    xdata="
                    label:'Password Confirmation',
                    inputValue:'',
                    idName:'password_confirmation',
                    inputValue:'',
                    entangleName:$wire.entangle('form.password_confirmation'),
                    placeholder:'Re-type you password'"
                    xinit="inputValue=''"
                >
                </x-atoms.bootstrap.input-text>

{{--                <x-atoms.bootstrap.input--}}
{{--                    container="p-0 pb-4"--}}
{{--                    id="register-name"--}}
{{--                    size="large"--}}
{{--                    name="form.name"--}}
{{--                    icon="bi bi-person"--}}
{{--                    label=""--}}
{{--                    value=""--}}
{{--                    debounce=""--}}
{{--                    lazy="{{true}}"--}}
{{--                    defer="{{false}}"--}}
{{--                    type="text"--}}
{{--                    placeholder="Full Name"--}}
{{--                    class=""--}}
{{--                    custom=""--}}
{{--                >--}}
{{--                </x-atoms.bootstrap.input>--}}

{{--                <x-atoms.bootstrap.input--}}
{{--                    container="p-0 pb-4"--}}
{{--                    id="register-email"--}}
{{--                    size="large"--}}
{{--                    name="form.email"--}}
{{--                    icon="bi bi-envelope"--}}
{{--                    label=""--}}
{{--                    value=""--}}
{{--                    debounce="100ms"--}}
{{--                    lazy="{{false}}"--}}
{{--                    defer="{{false}}"--}}
{{--                    type="text"--}}
{{--                    placeholder="Email"--}}
{{--                    class=""--}}
{{--                    custom=""--}}
{{--                >--}}
{{--                </x-atoms.bootstrap.input>--}}

{{--                <x-atoms.bootstrap.input--}}
{{--                    container=""--}}
{{--                    id="register-password"--}}
{{--                    size="large"--}}
{{--                    name="form.password"--}}
{{--                    icon="bi bi-shield-lock"--}}
{{--                    label=""--}}
{{--                    value=""--}}
{{--                    debounce=""--}}
{{--                    lazy="{{true}}"--}}
{{--                    defer="{{false}}"--}}
{{--                    type="password"--}}
{{--                    placeholder="password"--}}
{{--                    class=""--}}
{{--                    custom="autocomplete='on'"--}}
{{--                >--}}
{{--                </x-atoms.bootstrap.input>--}}

{{--                <x-atoms.bootstrap.input--}}
{{--                    container=""--}}
{{--                    id="register-confirm-password"--}}
{{--                    size="large"--}}
{{--                    name="form.password_confirmation"--}}
{{--                    icon="bi bi-shield-lock"--}}
{{--                    label=""--}}
{{--                    value=""--}}
{{--                    debounce=""--}}
{{--                    lazy="{{true}}"--}}
{{--                    defer="{{false}}"--}}
{{--                    type="password"--}}
{{--                    placeholder="Confirm password"--}}
{{--                    class=""--}}
{{--                    custom="autocomplete='on'"--}}
{{--                >--}}
{{--                </x-atoms.bootstrap.input>--}}


                <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Sign Up</button>
            </x-molecules.modal.form>
            {{--            </form>--}}
            <div class="text-center mt-5 text-lg fs-4">
                <p class='text-gray-600'>Already have an account? <a href="{{route('login')}}"
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
