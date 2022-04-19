<div>
    <x-framer :pageName="$pageName">
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Application</h4>
                </div>
                <div class="card-body">

                    <x-atoms.div class="page-content" custom="">
                        <section class="row">
                            <x-atoms.div class="col-12 col-lg-12" custom="">
                                <div class="row">
                                    <div class="col-6 col-lg-2 col-md-4">
                                        <div class="card bg-light-primary">
                                            <div class="card-body px-3 py-4-5">
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <div class="stats-icon purple">
                                                            <i class="iconly-boldShow"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-7 ps-0">
                                                        <h6 class="text-muted font-semibold">
                                                            @if (in_array('Manager', $userRole))
                                                                New
                                                            @else
                                                                Submitted
                                                            @endif
                                                        </h6>
                                                        <h6 class="font-extrabold mb-0">{{count($application_submitted->applications)}}</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 col-lg-2 col-md-4">
                                        <div class="card bg-light-primary">
                                            <div class="card-body px-3 py-4-5">
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <div class="stats-icon blue">
                                                            <i class="iconly-boldProfile"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-7 ps-0">
                                                        <h6 class="text-muted font-semibold">
                                                            @if (in_array('Manager', $userRole))
                                                                Incomplete
                                                            @else
                                                                Incomplete
                                                            @endif
                                                        </h6>
                                                        <h6 class="font-extrabold mb-0">{{count($application_incomplete->applications)}}</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 col-lg-2 col-md-4">
                                        <div class="card bg-light-primary">
                                            <div class="card-body px-3 py-4-5">
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <div class="stats-icon bg-warning">
                                                            <i class="iconly-boldAdd-User"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-7 ps-0">
                                                        <h6 class="text-muted font-semibold">
                                                            @if (in_array('Manager', $userRole))
                                                                Revision
                                                            @else
                                                                Revision
                                                            @endif
                                                        </h6>
                                                        <h6 class="font-extrabold mb-0">{{count($application_revision->applications)}}</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 col-lg-2 col-md-4">
                                        <div class="card bg-light-primary">
                                            <div class="card-body px-3 py-4-5">
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <div class="stats-icon green">
                                                            <i class="iconly-boldBookmark"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-7 ps-0">
                                                        <h6 class="text-muted font-semibold">
                                                            @if (in_array('Manager', $userRole))
                                                                Accepted
                                                            @else
                                                                Accepted
                                                            @endif
                                                        </h6>
                                                        <h6 class="font-extrabold mb-0">{{count($application_accepted->applications)}}</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 col-lg-2 col-md-4">
                                        <div class="card bg-light-primary">
                                            <div class="card-body px-3 py-4-5">
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <div class="stats-icon red">
                                                            <i class="iconly-boldBookmark"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-7 ps-0">
                                                        <h6 class="text-muted font-semibold">
                                                            @if (in_array('Manager', $userRole))
                                                                Rejected
                                                            @else
                                                                Rejected
                                                            @endif
                                                        </h6>
                                                        <h6 class="font-extrabold mb-0">{{count($application_rejected->applications)}}</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </x-atoms.div>
                        </section>
                    </x-atoms.div>

                </div>
            </div>
        </section>
    </x-framer>
</div>
