<div>
    <x-framer :pageName="$pageName">
    <section class="section">

            <div class="card">
                <div class="card-body">
                    @include('livewire.admin.admins.create')

                    <x-organisms.table-search :fields="$searchFields" :pageNoList="$pageNoList"
                                              :sortDirectionList="$sortDirectionList">
                        <x-molecules.bootstrap.container class="" fluid={{true}} custom="">
                            <x-molecules.bootstrap.row class="" custom="">

                                <x-molecules.bootstrap.column class="col-md-3 col-sm-12 pb-2 px-0 pe-md-3" custom="">
                                    <x-atoms.bootstrap.select
                                        id="sort-role-field"
                                        name="sortRoleField"
                                        class="p-0 mb-0"
                                        label=""
                                        placeholder="Filter Role"
                                        firstvalue="All Roles"
                                        :list="$roles"
                                    >
                                    </x-atoms.bootstrap.select>
                                </x-molecules.bootstrap.column>
                            </x-molecules.bootstrap.row>
                        </x-molecules.bootstrap.container>
                    </x-organisms.table-search>

                    <div class="dataTable-container">
                        <table class="table table-striped dataTable-table" id="table1">
                            <thead>
                            <tr>
                                <th data-sortable="" style="width: 5%;"><a href="#" class="dataTable-sorter">ID</a></th>
                                <th data-sortable="" style="width: 20%;"><a href="#" class="dataTable-sorter">Name</a>
                                </th>
                                <th data-sortable="" style="width: 15%;"><a href="#" class="dataTable-sorter">Email</a>
                                </th>
                                <th data-sortable="" class="text-center" style="width: 10%; ">
                                    <a href="#" class="dataTable-sorter ">Email Verified</a></th>
                                <th data-sortable="" class="text-center" style="width: 30%;">
                                    <a href="#" class="dataTable-sorter">Role</a>
                                </th>
                                <th data-sortable="" class="text-center" style="width: 10%;">
                                    <a href="#" class="dataTable-sorter">Status</a>
                                <th data-sortable="" class="text-center" style="width: 10%;">
                                    <a href="#" class="dataTable-sorter">Action</a>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($roles))
                            @forelse($admins as $admin)
                                <tr>
                                    <td>{{$admin->id}}</td>
                                    <td>{{$admin->name}}</td>
                                    <td>{{$admin->email}}</td>
                                    <td class="text-center">
                                        @isset($admin->email_verified_at)
                                            <i class="fas fa-check-circle text-xl text-success"></i>
                                        @else
                                            <i class="fas fa-times-circle text-xl text-danger"></i>
                                        @endisset
                                    </td>
                                    <td class="text-center">
                                        @foreach($admin->roles as $role)
                                            <span class="badge bg-secondary">{{$role->name}}</span>

                                        @endforeach
                                    </td>
                                    <td class="text-center">
                                        @if(!\App\Traits\Quicker::validateMySQLTimeStamp($admin->blocked))
                                            <span class="badge bg-success text-center">Active</span>
                                        @else
                                            <span class="badge bg-danger text-center">Blocked</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @include('livewire.admin.admins.update')
                                        @include('livewire.admin.admins.delete')

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
                    {{$admins->links()}}
                        @endif

                </div>
            </div>
    </section>
    </x-framer>
</div>
