<div>
    <x-framer :pageName="$pageName">
    <section class="section">
        <div class="card">
            <div class="card-body">
                @include('livewire.admin.permissions.create')

                <x-organisms.table-search :fields="$searchFields" :pageNoList="$pageNoList"
                                          :sortDirectionList="$sortDirectionList"></x-organisms.table-search>

                <div class="dataTable-container">
                    <table class="table table-striped dataTable-table" id="table1">
                        <thead>
                        <tr>
                            <th data-sortable="" style="width: 10%;"><a href="#" class="dataTable-sorter">ID</a></th>
                            <th data-sortable="" style="width: 70%;"><a href="#" class="dataTable-sorter">Name</a></th>
                            <th data-sortable="" class="text-center" style="width: 10%; "><a href="#" class="dataTable-sorter ">Guard Name</a></th>
                            <th data-sortable="" class="text-center" style="width: 10%;"><a href="#" class="dataTable-sorter">Action</a>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($permissionViews as $permissionView)

{{--                            <div>--}}
{{--                                        DB::table("permisisons")->insert([--}}
{{--                                        "id" => '{{$permissionView->id}}',--}}
{{--                                        "name" => '{{$permissionView->name}}',--}}
{{--                                        "guard_name" => '{{$permissionView->guard_name}}',--}}
{{--                                        ]);--}}
{{--                                    </div>--}}

                            <tr>
                                <td>{{$permissionView->id}} </td>
                                <td>{{$permissionView->name}}</td>
                                <td class="text-center">{{$permissionView->guard_name}}</td>

                                <td class="text-center">
                                    @include('livewire.admin.permissions.update')

                                    @include('livewire.admin.permissions.delete')
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5">
                                    <x-atoms.div class="fw-bold p-2" custom=""><i class="fas fa-exclamation-circle"></i>
                                        No permissions Found!</x-atoms.div>

                                </td>
                            </tr>
                        @endforelse


                        </tbody>
                    </table>
                </div>
                <div class="dataTable-info text-sm pb-1">Showing {{$currentPage}} to {{$perPage}}
                    of {{$total}}</div>
                {{$permissionViews->links()}}

            </div>
        </div>

    </section>
    </x-framer>
</div>
