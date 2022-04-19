<div>
    <x-framer :pageName="$pageName">
    <section class="section">
        <div class="card">
            <div class="card-body">
                @include('livewire.admin.progress.steps.create')

                <x-organisms.table-search :fields="$searchFields" :pageNoList="$pageNoList"
                                          :sortDirectionList="$sortDirectionList"></x-organisms.table-search>

                <div class="dataTable-container">
                    <table class="table table-striped dataTable-table" id="table1">
                        <thead>
                        <tr>
                            <th data-sortable="" style="width: 5%;"><a href="#" class="dataTable-sorter">ID</a></th>
                            <th data-sortable="" class="text-left" style="width: 85%; "><a href="#" class="dataTable-sorter ">Process</a></th>
                            <th data-sortable="" class="text-center" style="width: 10%;"><a href="#" class="dataTable-sorter">Action</a>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($steps as $step)
                            <tr>
                                <td>{{$step->id}} </td>
                                <td>{{$step->name}}</td>

                                <td class="text-center">
                                    @include('livewire.admin.progress.steps.update')
                                    @include('livewire.admin.progress.steps.delete')
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5">
                                    <x-atoms.div class="fw-bold p-2" custom=""><i class="fas fa-exclamation-circle"></i>
                                        No processs Found!</x-atoms.div>

                                </td>
                            </tr>
                        @endforelse


                        </tbody>
                    </table>
                </div>
                <div class="dataTable-info text-sm pb-1">Showing {{$currentPage}} to {{$perPage}}
                    of {{$total}}</div>
                {{$steps->links()}}

            </div>
        </div>

    </section>
    </x-framer>
</div>
