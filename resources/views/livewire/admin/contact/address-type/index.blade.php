<div>
    <x-framer :pageName="$pageName">
        <section class="section">
            <div class="card">
                <div class="card-body">
                    @include('livewire.admin.contact.address-type.create')

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

                                <th data-sortable="" class="text-center" style="width: 10%;"><a href="#"
                                                                                                class="dataTable-sorter">Action</a>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($addressTypes))
                                @forelse($addressTypes as $addressType)
                                    <tr>
                                        <td>{{$addressType->id}} </td>
                                        <td>{{$addressType->name}}</td>

                                        <td class="text-center">
                                            @include('livewire.admin.contact.address-type.update')

                                            @include('livewire.admin.contact.address-type.delete')
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">
                                            <x-atoms.div class="fw-bold p-2" custom=""><i
                                                    class="fas fa-exclamation-circle"></i>
                                                No Address Types Found!
                                            </x-atoms.div>

                                        </td>
                                    </tr>
                                @endforelse
                            @endif

                            </tbody>
                        </table>
                    </div>
                    @if(!empty($addressTypes))
                        <div class="dataTable-info text-sm pb-1">Showing {{$currentPage}} to {{$perPage}}
                            of {{$total}}</div>
                        {{$addressTypes->links()}}
                    @endif

                </div>
            </div>

        </section>
    </x-framer>
</div>
