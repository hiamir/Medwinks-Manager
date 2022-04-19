<div>
    <x-framer :pageName="$pageName">
    <section class="section">
        <div class="card">
            <div class="card-body">
                @include('livewire.admin.statuses.create')

                <x-organisms.table-search :fields="$searchFields" :pageNoList="$pageNoList"
                                          :sortDirectionList="$sortDirectionList"></x-organisms.table-search>

                <div class="dataTable-container">
                    <table class="table table-striped dataTable-table" id="table1">
                        <thead>
                        <tr>
                            <th data-sortable="" style="width: 5%;"><a href="#" class="dataTable-sorter">ID</a></th>
                            <th data-sortable="" class="text-left" style="width: 20%; "><a href="#" class="dataTable-sorter ">Model</a></th>
                            <th data-sortable="" class="text-left" style="width: 15%; "><a href="#" class="dataTable-sorter ">Status</a></th>
                            <th data-sortable="" class="text-left" style="width: 35%; "><a href="#" class="dataTable-sorter ">Icon</a></th>
                            <th data-sortable="" class="text-left" style="width: 15%; "><a href="#" class="dataTable-sorter ">Reference</a></th>
                            <th data-sortable="" class="text-center" style="width: 10%;"><a href="#" class="dataTable-sorter">Action</a>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($statuses as $status)
                            <tr>
                                <td>{{$status->id}} </td>
                                <td>{{$status->models()->first()->name}}</td>
                                <td>{{$status->name}}</td>
                                <td>{{$status->icon}}</td>
                                <td>{{$status->reference}}</td>

                                <td class="text-center">
                                    @include('livewire.admin.statuses.update')
                                    @include('livewire.admin.statuses.delete')
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5">
                                    <x-atoms.div class="fw-bold p-2" custom=""><i class="fas fa-exclamation-circle"></i>
                                        No models Found!</x-atoms.div>

                                </td>
                            </tr>
                        @endforelse


                        </tbody>
                    </table>
                </div>
                <div class="dataTable-info text-sm pb-1">Showing {{$currentPage}} to {{$perPage}}
                    of {{$total}}</div>
                {{$statuses->links()}}

            </div>
        </div>

    </section>
    </x-framer>
</div>
