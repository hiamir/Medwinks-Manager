<div>
    <x-framer :pageName="$pageName">
        <section class="section">
            <div class="card">
                <div class="card-body">
                    @include('livewire.admin.progress.processes.create')

                    <x-organisms.table-search :fields="$searchFields" :pageNoList="$pageNoList"
                                              :sortDirectionList="$sortDirectionList"></x-organisms.table-search>

                    <div class="dataTable-container">
                        <table class="table table-striped dataTable-table" id="table1">
                            <thead>
                            <tr>
                                <th data-sortable="" style="width: 5%;"  class="text-center"><a href="#" class="dataTable-sorter">ID</a></th>


                                <th data-sortable="" class="text-left" style="width: 10%; "><a href="#"
                                                                                               class="dataTable-sorter ">Process</a>
                                </th>


                                <th data-sortable="" class="text-left" style="width: 65%;"><a href="#"
                                                                                              class="dataTable-sorter">Reference</a>
                                </th>
                                <th data-sortable="" class="text-center" style="width: 10%;"><a href="#"
                                                                                                class="dataTable-sorter">Action</a>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($processes as $process)
                                <tr >
                                    <td class="text-center">{{$process->id}} </td>

                                    <td>{{$process->name}}</td>

                                    <td>{{$process->reference}}</td>


                                    <td class="text-center">
                                        <div class="btn-group btn-group-sm p-1" role="group" aria-label="">
                                            @include('livewire.admin.progress.processes.update')
                                            @include('livewire.admin.progress.processes.delete')
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4">
                                        <x-atoms.div class="row justify-content-center align-items-center" custom="">
                                            <x-atoms.div class="col-1" custom="">
                                                @include('livewire.admin.progress.processes.create-step',['process_id'=>$process->id])
                                            </x-atoms.div>
                                            <x-atoms.div class="col-11" custom="">
                                                @isset($process->steps)
                                                    @forelse($process->steps as $step)
                                                        <div class="btn-group btn-group-sm p-0" role="group" aria-label="">
                                                            @include('livewire.admin.progress.processes.view-step')
                                                            @include('livewire.admin.progress.processes.update-step')
                                                            @include('livewire.admin.progress.processes.delete-step')
                                                        </div>
                                                    @empty
                                                        <span class="badge bg-info text-dark">No steps available!</span>
                                                    @endforelse
                                                @endisset
                                            </x-atoms.div>
                                        </x-atoms.div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">
                                        <x-atoms.div class="fw-bold p-2" custom=""><i class="fas fa-exclamation-circle"></i>
                                            No processs Found!
                                        </x-atoms.div>

                                    </td>
                                </tr>
                            @endforelse


                            </tbody>
                        </table>
                    </div>
                    <div class="dataTable-info text-sm pb-1">Showing {{$currentPage}} to {{$perPage}}
                        of {{$total}}</div>
                    {{$processes->links()}}

                </div>
            </div>

        </section>
    </x-framer>
</div>
