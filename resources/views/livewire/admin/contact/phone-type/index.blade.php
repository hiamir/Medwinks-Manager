<div>
    <x-framer :pageName="$pageName">
        <section class="section">
            <div class="card">
                <div class="card-body">
                    @include('livewire.admin.contact.phone-type.create')

                    <x-organisms.table-search :fields="$searchFields" :pageNoList="$pageNoList"
                                              :sortDirectionList="$sortDirectionList"></x-organisms.table-search>

                    <div class="dataTable-container">
                        <table class="table table-striped dataTable-table" id="table1">
                            <thead>
                            <tr>
                                <th data-sortable="" style="width: 10%;"><a href="#" class="dataTable-sorter">ID</a>
                                </th>
                                <th data-sortable="" style="width: 70%;"><a href="#" class="dataTable-sorter">Name</a>
                                </th>
                                <th data-sortable="" class="text-center" style="width: 10%; "><a href="#"
                                                                                                 class="dataTable-sorter ">Guard
                                        Name</a></th>
                                <th data-sortable="" class="text-center" style="width: 10%;"><a href="#"
                                                                                                class="dataTable-sorter">Action</a>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($phoneTypes))
                                @forelse($phoneTypes as $phoneType)
                                    <tr>
                                        <td>{{$phoneType->id}} </td>
                                        <td>{{$phoneType->name}}</td>
                                        <td class="text-center">{{$phoneType->guard_name}}</td>

                                        <td class="text-center">
                                            @include('livewire.admin.contact.phone-type.update')

                                            @include('livewire.admin.contact.phone-type.delete')
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">
                                            <x-atoms.div class="fw-bold p-2" custom=""><i
                                                    class="fas fa-exclamation-circle"></i>
                                                No Phone Types Found!
                                            </x-atoms.div>

                                        </td>
                                    </tr>
                                @endforelse
                            @endif

                            </tbody>
                        </table>
                    </div>
                    @if(!empty($phoneTypes))
                        <div class="dataTable-info text-sm pb-1">Showing {{$currentPage}} to {{$perPage}}
                            of {{$total}}</div>
                        {{$phoneTypes->links()}}
                    @endif

                </div>
            </div>

        </section>
    </x-framer>
</div>
