<div>
    <x-framer :pageName="$pageName">
    <section class="section">
        <div class="card">
            <div class="card-body">
                @include('livewire.education-types.create')
                <x-organisms.table-search :fields="$searchFields" :pageNoList="$pageNoList"
                                          :sortDirectionList="$sortDirectionList"></x-organisms.table-search>

                <div class="dataTable-container">
                    <table class="table table-striped dataTable-table" id="table1">
                        <thead>
                        <tr>
                            <th data-sortable="" style="width: 5%;"><a href="#" class="dataTable-sorter">ID</a></th>
                            <th data-sortable="" class="text-left" style="width: 85%; "><a href="#" class="dataTable-sorter ">Name</a></th>
                            <th data-sortable="" class="text-right" style="width: 10%;"><a href="#" class="dataTable-sorter">Action</a>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($education_types as $education_type)
                            <tr>
                                <td>{{$education_type->id}} </td>
                                <td>{{$education_type->name}}</td>

                                <td class="text-right">
                                    <div class="btn-group btn-group-sm p-1" role="group" aria-label="">
                                    @include('livewire.education-types.update')
                                    @include('livewire.education-types.delete')
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5">
                                    <x-atoms.div class="fw-bold p-2" custom=""><i class="fas fa-exclamation-circle"></i>
                                        No Education Types Found!</x-atoms.div>

                                </td>
                            </tr>
                        @endforelse


                        </tbody>
                    </table>
                </div>
                <div class="dataTable-info text-sm pb-1">Showing {{$currentPage}} to {{$perPage}}
                    of {{$total}}</div>
                {{$education_types->links()}}

            </div>
        </div>

    </section>
    </x-framer>
</div>
