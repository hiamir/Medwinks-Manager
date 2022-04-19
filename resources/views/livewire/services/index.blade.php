<div>
    <x-framer :pageName="$pageName">
        <section class="section">
            <div class="card">
                <div class="card-body">
                    @include('livewire.services.create')

                    <x-organisms.table-search :fields="$searchFields" :pageNoList="$pageNoList"
                                              :sortDirectionList="$sortDirectionList"></x-organisms.table-search>

                    <div class="dataTable-container">
                        <table class="table table-striped dataTable-table" id="table1">
                            <thead>
                            <tr>
                                <th data-sortable="" style="width: 5%;"><a href="#" class="dataTable-sorter">ID</a></th>
                                <th data-sortable="" class="text-left" style="width: 10%; "><a href="#"
                                                                                               class="dataTable-sorter ">Service</a>
                                </th>
                                <th data-sortable="" class="text-left" style="width: 75%; "><a href="#"
                                                                                               class="dataTable-sorter ">Description</a>
                                </th>
                                <th data-sortable="" class="text-center" style="width: 10%;"><a href="#"
                                                                                                class="dataTable-sorter">Action</a>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($services as $service)
                                <tr>
                                    <td>{{$service->id}} </td>
                                    <td>{{$service->name}}</td>
                                    <td>{{$service->description}}</td>

                                    <td class="text-center">
                                        @include('livewire.services.update')
                                        @include('livewire.services.delete')
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="3">
                                        <h6 class="text-sm mb-1">Required Documents</h6>
                                        @forelse($service->service_requirements as $service_requirement)
                                            <div class="btn-group btn-group-sm p-1 ps-0 " role="group" aria-label="">
                                                @include('livewire.services.view-service-requirement')
                                            </div>
                                        @empty
                                            <span class="badge bg-light-primary text-gray-600">No {{$education->name}} available!</span>
                                        @endforelse
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="5">
                                        <x-atoms.div class="fw-bold p-2" custom=""><i
                                                class="fas fa-exclamation-circle"></i>
                                            No services Found!
                                        </x-atoms.div>

                                    </td>
                                </tr>
                            @endforelse


                            </tbody>
                        </table>
                    </div>
                    <div class="dataTable-info text-sm pb-1">Showing {{$currentPage}} to {{$perPage}}
                        of {{$total}}</div>
                    {{$services->links()}}

                </div>
            </div>

        </section>
    </x-framer>
</div>
