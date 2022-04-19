<div>
    <x-framer :pageName="$pageName">
    <section class="section">
        <div class="card">
            <div class="card-body">
                @include('livewire.applications.create')
                @if(session()->has('submitted'))
                    <div class="alert alert-success alert-message alert-dismissible my-4 show fade">
                        {{ session('submitted') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @elseif(session()->has('already-submitted'))
                    <div class="alert alert-info alert-message alert-dismissible my-4 show fade">
                        {{ session('already-submitted') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <x-organisms.table-search :fields="$searchFields" :pageNoList="$pageNoList"
                                          :sortDirectionList="$sortDirectionList">
                </x-organisms.table-search>
                <x-atoms.div class="row" custom="">
                    @foreach($statuses as $status)
                    <x-atoms.div class="col-2 col-sm-4 col-md-3 col-lg-2 col-xl-2 pb-3" custom="">
                        <button wire:click="statusClick({{$status->id}})"
                                x-data="{ statusChange: @entangle('status_id') }"
                                x-on:click="statusChange={{$status_id}}"
{{--                                :id="{{$status->id}}"--}}
                                type="button" class="btn btn-icon icon-left w-100" :class="statusChange==={{$status->id}}?'btn-danger':'btn-primary'">
                            <i class="{{$status->icon}}"></i> {{$status->name}} <span class="badge bg-transparent">{{count($status->applications)}}</span>
                        </button>
                    </x-atoms.div>
                        @endforeach
                </x-atoms.div>


                <div class="dataTable-container">
                    <table class="table table-striped dataTable-table" id="table1">
                        <thead>
                        <tr>
                            @if (in_array('Manager', $userRole))
                                <th data-sortable="" style="width: 5%;"><a href="#" class="dataTable-sorter">ID</a></th>
                                <th data-sortable="" class="text-left" style="width: 20%; "><a href="#" class="dataTable-sorter ">Submitted By</a></th>
                                <th data-sortable="" class="text-left" style="width: 15%; "><a href="#" class="dataTable-sorter ">Passport</a></th>
                                <th data-sortable="" class="text-left" style="width: 20%; "><a href="#" class="dataTable-sorter ">Service</a></th>
                                <th data-sortable="" class="text-left" style="width: 20%; "><a href="#" class="dataTable-sorter ">University</a></th>
                                <th data-sortable="" class="text-center" style="width: 10%; "><a href="#" class="dataTable-sorter ">Created at</a></th>
                                <th data-sortable="" class="text-center" style="width: 10%;"><a href="#" class="dataTable-sorter">Action</a>
                                </th>
                            @else
                                <th data-sortable="" style="width: 5%;"><a href="#" class="dataTable-sorter">ID</a></th>
                                <th data-sortable="" class="text-left" style="width: 25%; "><a href="#" class="dataTable-sorter ">Passport</a></th>
                                <th data-sortable="" class="text-left" style="width: 20%; "><a href="#" class="dataTable-sorter ">Service</a></th>
                                <th data-sortable="" class="text-left" style="width: 20%; "><a href="#" class="dataTable-sorter ">University</a></th>
                                <th data-sortable="" class="text-center" style="width: 20%; "><a href="#" class="dataTable-sorter ">Created at</a></th>
                                <th data-sortable="" class="text-center" style="width: 10%;"><a href="#" class="dataTable-sorter">Action</a>
                            @endif

                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($applications as $application)
                            <tr>
                                <td>{{$application->id}} </td>
                                @if (in_array('Manager', $userRole))<td>{{$application->user->name}} </td>@endif
                                <td>{{$application->passports()->first()->passport_number}}</td>
                                <td>{{$application->services()->first()->name}}</td>
                                <td>{{$application->universities()->first()->name}}</td>
                                <td class="text-center">{{ \Carbon\Carbon::parse($application->created_at)->diffForhumans()}}</td>

                                <td class="text-center">
                                    @include('livewire.applications.update')
                                    @include('livewire.applications.delete')
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6">
                                    <x-atoms.div class="fw-bold p-2" custom=""><i class="fas fa-exclamation-circle"></i>
                                        No Applications Found!</x-atoms.div>

                                </td>
                            </tr>
                        @endforelse


                        </tbody>
                    </table>
                </div>
                <div class="dataTable-info text-sm pb-1">Showing {{$currentPage}} to {{$perPage}}
                    of {{$total}}</div>
                {{$applications->links()}}

            </div>
        </div>

    </section>
    </x-framer>
</div>
