{{--<livewire:components.admin-header :pageName="$pageName"/>--}}
{{--<livewire:components.menu.menu/>--}}
<section class="section">
<div id="error" class="card">
    <div class="card-body">
        <div class="error-page container">
            <div class="col-md-8 col-12 offset-md-2">
                <img class="img-error" src="{{asset('images/error/'.$image) }}" alt="Access Denied">
                <div class="text-center">
                    <h1 class="error-title">{{$title}}</h1>
                    <p class="fs-5 text-gray-600">{{$description}}</p>
{{--                    <a href="index.html" class="btn btn-lg btn-outline-primary mt-3">Go Home</a>--}}
                </div>
            </div>
        </div>
    </div>
</div>
</section>
{{--<livewire:components.userfooter/>--}}

