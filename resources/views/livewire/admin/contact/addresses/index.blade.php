<div>
    <x-framer :pageName="$pageName">
        <section class="section">
            <div class="card">
                <div class="card-body">
                    @include('livewire.admin.contact.addresses.create')

                    <x-organisms.table-search :fields="$searchFields" :pageNoList="$pageNoList"
                                              :sortDirectionList="$sortDirectionList"></x-organisms.table-search>

                    <div class="dataTable-container">
                        <table class="table table-striped dataTable-table" id="table1">
                            <thead>
                            <tr>
                                <th data-sortable="" style="width: 10%;"><a href="#" class="dataTable-sorter">Address Type</a></th>
                                <th data-sortable="" style="width: 10%;"><a href="#" class="dataTable-sorter">Country</a></th>
                                <th data-sortable="" style="width: 10%;"><a href="#" class="dataTable-sorter">Region</a></th>
                                <th data-sortable="" style="width: 40%;"><a href="#" class="dataTable-sorter">Address</a></th>
                                <th data-sortable="" style="width: 10%;"><a href="#" class="dataTable-sorter">Postal Code </a></th>
                                <th data-sortable="" style="width: 10%;"><a href="#" class="dataTable-sorter">Zip Code </a></th>
                                <th data-sortable="" class="text-center" style="width: 10%;"><a href="#" class="dataTable-sorter">Action</a></tr>
                            </thead>
                            <tbody>
                            @if(!empty($addresses))
                                @forelse($addresses as $address)
                                    <tr>
                                        <td>{{$address->address_type->name}} </td>
                                        <td>{{$address->country->country}} </td>
                                        <td>{{$address->region->name}}</td>
                                        <td>{{$address->address_line1}}, {{$address->address_line2}}</td>
                                        <td>{{$address->postal_code}}</td>
                                        <td>{{$address->zip_code}}</td>
                                        <td class="text-center">
                                            @include('livewire.admin.contact.addresses.update')

                                            @include('livewire.admin.contact.addresses.delete')
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7">
                                            <x-atoms.div class="fw-bold p-2" custom=""><i
                                                    class="fas fa-exclamation-circle"></i>
                                                No Addresses Found!
                                            </x-atoms.div>

                                        </td>
                                    </tr>
                                @endforelse
                            @endif

                            </tbody>
                        </table>
                    </div>
                    @if(!empty($addresses))
                        <div class="dataTable-info text-sm pb-1">Showing {{$currentPage}} to {{$perPage}}
                            of {{$total}}</div>
                        {{$addresses->links()}}
                    @endif

                </div>
            </div>

        </section>
    </x-framer>
</div>
