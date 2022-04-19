<div>
    <x-framer :pageName="$pageName">
    <section class="section">
        <div class="card">
            <div class="card-body">
                @include('livewire.universities.create')

                <x-organisms.table-search :fields="$searchFields" :pageNoList="$pageNoList"
                                          :sortDirectionList="$sortDirectionList"></x-organisms.table-search>

                <div class="dataTable-container">
                    <table class="table table-striped dataTable-table" id="table1">
                        <thead>
                        <tr>
                            <th data-sortable="" style="width: 5%;"><a href="#" class="dataTable-sorter">ID</a></th>
                            <th data-sortable="" class="text-left" style="width: 60%; "><a href="#" class="dataTable-sorter ">University</a></th>
                            <th data-sortable="" class="text-left" style="width: 25%; "><a href="#" class="dataTable-sorter ">Code</a></th>
                            <th data-sortable="" class="text-center" style="width: 10%;"><a href="#" class="dataTable-sorter">Action</a>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($universities as $university)
                            <tr>
                                <td>{{$university->id}} </td>
                                <td>{{$university->name}}</td>
                                <td>{{$university->code}}</td>

                                <td class="text-center">
                                    @include('livewire.universities.update')
                                    @include('livewire.universities.delete')
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5">
                                    <x-atoms.div class="fw-bold p-2" custom=""><i class="fas fa-exclamation-circle"></i>
                                        No universities Found!</x-atoms.div>

                                </td>
                            </tr>
                        @endforelse


                        </tbody>
                    </table>
                </div>
                <div class="dataTable-info text-sm pb-1">Showing {{$currentPage}} to {{$perPage}}
                    of {{$total}}</div>
                {{$universities->links()}}

            </div>
        </div>

    </section>
    </x-framer>
</div>
