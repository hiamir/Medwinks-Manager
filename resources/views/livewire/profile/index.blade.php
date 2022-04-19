<div>
    <x-framer :pageName="$pageName">
        <section class="section">
            <div class="card">
                <div class="card m-4 bg-light-secondary shadow-sm" ">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="container emp-profile">

                                <div class="row">
                                    <div class="col-md-3 profile-left">
                                        <div class="profile-img">
                                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS52y5aInsxSm31CvHOFHWujqUx_wWTS9iM6s7BAm21oEN_RiGoog" alt=""/>
                                            <div class="file btn btn-lg btn-primary">
                                                Change Photo
                                                <input type="file" name="file"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 profile-center">
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="profile-head">
                                                    <h5>
                                                        {{$user->name}}
                                                    </h5>
                                                    <h6 class="pb-3">
                                                        {{$roles}}
                                                    </h6>
                                                    <p class="proile-rating">RANKINGS : <span>8/10</span></p>

                                                </div>
                                            </div>
                                            <div class="col-4 text-right">
                                                @include('livewire.profile.update')

                                            </div>
                                        </div>


                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home"
                                                   role="tab" aria-controls="home" aria-selected="true" style="">Home</a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile"
                                                   role="tab" aria-controls="profile" aria-selected="false"
                                                   style="">Profile</a>
                                            </li>
                                        </ul>


                                        <div class="tab-content" id="myTabContent">
                                            <div class="tab-pane fade active show" id="home" role="tabpanel"
                                                 aria-labelledby="home-tab">
                                                <p class="my-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                                    Nulla ut nulla
                                                    neque. Ut hendrerit nulla a euismod pretium.
                                                    Fusce venenatis sagittis ex efficitur suscipit. In tempor mattis
                                                    fringilla. Sed id
                                                    tincidunt orci, et volutpat ligula.
                                                    Aliquam sollicitudin sagittis ex, a rhoncus nisl feugiat quis. Lorem
                                                    ipsum dolor sit
                                                    amet, consectetur adipiscing elit.
                                                    Nunc ultricies ligula a tempor vulputate. Suspendisse pretium mollis
                                                    ultrices.</p>
                                            </div>
                                            <div class="tab-pane fade" id="profile" role="tabpanel"
                                                 aria-labelledby="profile-tab">
                                                Integer interdum diam eleifend metus lacinia, quis gravida eros mollis.
                                                Fusce non sapien
                                                sit amet magna dapibus
                                                ultrices. Morbi tincidunt magna ex, eget faucibus sapien bibendum non. Duis
                                                a mauris ex.
                                                Ut finibus risus sed massa
                                                mattis porta. Aliquam sagittis massa et purus efficitur ultricies. Integer
                                                pretium dolor
                                                at sapien laoreet ultricies.
                                                Fusce congue et lorem id convallis. Nulla volutpat tellus nec molestie
                                                finibus. In nec
                                                odio tincidunt eros finibus
                                                ullamcorper. Ut sodales, dui nec posuere finibus, nisl sem aliquam metus, eu
                                                accumsan
                                                lacus felis at odio. Sed lacus
                                                quam, convallis quis condimentum ut, accumsan congue massa. Pellentesque et
                                                quam vel
                                                massa pretium ullamcorper vitae eu
                                                tortor.
                                            </div>
                                        </div>


                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-3">

                                    </div>
                                    <div class="col-md-9">

                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </section>
    </x-framer>
</div>





