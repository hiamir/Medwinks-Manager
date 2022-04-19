
<div class="row h-100 m-0">
    <div class=" col-xl-5 col-lg-6 col-md-6">
        <div id="auth-left">
            <div class="auth-logo">
                <a href="index.html"><img src="{{ asset('images/logo-circle.svg') }}" alt="Logo"></a>
            </div>
            <h1 class="auth-title">Log in.</h1>
            <p class="auth-subtitle mb-5">Log in with your data that you entered during registration.</p>

            <livewire:components.sessionmessagetoastr/>
            <form action="" method="" wire:submit.prevent="login" novalidate>
                <div class="container p-0 mb-4">
                    <div class="form-group position-relative has-icon-left mb-1">
                        <input type="email" class="form-control form-control-xl" placeholder="Email"
                               wire:model.debounce.300ms='form.email' autocomplete="email">
                        <div class="form-control-icon">
                            <i class="bi bi-person"></i>
                        </div>

                    </div>
                    @include('livewire.components.input-error',['input'=>'form.email'])

                </div>
                <div class="container p-0 mb-4">
                    <div class="form-group position-relative has-icon-left mb-1">
                        <input type="password" class="form-control form-control-xl" placeholder="Password"
                               wire:model.debounce.300ms='form.password' autocomplete="password">
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                    </div>
                    @include('livewire.components.input-error',['input'=>'form.password'])

                </div>

                <div class="form-check form-check-lg d-flex align-items-end">
                    <input class="form-check-input me-2" type="checkbox" value="" id="flexCheckDefault">
                    <label class="form-check-label text-gray-600" for="flexCheckDefault">
                        Keep me logged in
                    </label>
                </div>
                <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Log in</button>
            </form>
            <div class="text-center mt-5 text-lg fs-4">
                <p class="text-gray-600">Don't have an account? <a href="{{route('register')}}"
                                                                   class="font-bold">Sign
                        up</a>.</p>
                <p><a class="font-bold" href="auth-forgot-password.html">Forgot password?</a>.</p>
            </div>
        </div>
    </div>
    <div class=" col-xl-7 col-lg-6 col-md-6 d-none d-lg-block p-0">
        <div id="auth-right">

        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function () {
            $("form")[0].reset()
        })
    </script>
@endpush
