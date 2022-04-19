<div>
    <x-framer :pageName="$pageName">
        <section class="section">
            <div class="card">
                <div class="card-body">
                    @include('livewire.admin.roles.create')

                    <x-organisms.table-search :fields="$searchFields" :pageNoList="$pageNoList"
                                              :sortDirectionList="$sortDirectionList"></x-organisms.table-search>

                    <div class="dataTable-container">
                        <table class="table table-striped dataTable-table" id="table1">
                            <thead>
                            <tr>
                                <th data-sortable="" style="width: 5%;"><a href="#" class="dataTable-sorter">ID</a></th>
                                <th data-sortable="" style="width: 15%;"><a href="#" class="dataTable-sorter">Name</a>
                                </th>
                                <th data-sortable="" class="text-center" style="width: 15%;"><a href="#"
                                                                                                class="dataTable-sorter">Slug
                                        Name</a></th>
                                <th data-sortable="" class="text-center" style="width: 10%; "><a href="#"
                                                                                                 class="dataTable-sorter ">Guard
                                        Name</a></th>
                                <th data-sortable="" class="text-center" style="width: 35%; "><a href="#"
                                                                                                 class="dataTable-sorter ">Permissions</a>
                                </th>
                                <th data-sortable="" class="text-center" style="width: 10%;"><a href="#"
                                                                                                class="dataTable-sorter">Action</a>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($roles))
                                @forelse($roles as $role)
                                    <tr>
                                        <td>{{$role->id}}</td>
                                        <td>{{$role->name}}</td>
                                        <td class="text-center">{{$role->slug_name}}</td>
                                        <td class="text-center">{{$role->guard_name}}</td>
                                        <td class="text-center">
                                            @foreach($role->permissions as $permission)
                                                <span class="badge bg-secondary">{{$permission->name}}</span>
                                        @endforeach

                                        <td class="text-center">
                                            @include('livewire.admin.roles.update')
                                            @include('livewire.admin.roles.delete')
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">
                                            <x-atoms.div class="fw-bold p-2" custom=""><i
                                                    class="fas fa-exclamation-circle"></i>
                                                No links Found!
                                            </x-atoms.div>

                                        </td>
                                    </tr>
                                @endforelse

                            @endif
                            </tbody>
                        </table>
                    </div>
                    @if(!empty($roles))
                        <div class="dataTable-info text-sm pb-1">Showing {{$currentPage}} to {{$perPage}}
                            of {{$total}}</div>
                        {{$roles->links()}}
                    @endif
                </div>
            </div>

        </section>
    </x-framer>
</div>
