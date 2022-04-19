<div>
    <x-framer :pageName="$pageName">
    <section class="section">
        <div class="card">
            <div class="card-body">
                @include('livewire.admin.menu.links.create')

                <x-organisms.table-search :fields="$searchFields" :pageNoList="$pageNoList"
                                          :sortDirectionList="$sortDirectionList"></x-organisms.table-search>

                <div class="dataTable-container">
                    <table class="table table-striped dataTable-table" id="table1">
                        <thead>
                        <tr>
                            <th data-sortable="" style="width: 5%;"><a href="#" class="dataTable-sorter">ID</a></th>
                            <th data-sortable="" style="width: 10%;"><a href="#" class="dataTable-sorter">Name</a></th>
                            <th data-sortable="" style="width: 10%;"><a href="#" class="dataTable-sorter">Route</a></th>
                            <th data-sortable="" style="width: 15%;"><a href="#" class="dataTable-sorter">Route Index</a></th>
                            <th data-sortable="" style="width: 15%;"><a href="#" class="dataTable-sorter">Roles</a></th>
                            <th data-sortable="" style="width: 20%;"><a href="#" class="dataTable-sorter">Permission</a></th>
                            <th data-sortable="" style="width: 5%;"><a href="#" class="dataTable-sorter">Folder</a>
                            </th>
                            <th data-sortable="" style="width: 5%;"><a href="#" class="dataTable-sorter">Category</a>
                            </th>
                            <th data-sortable="" style="width: 5%;"><a href="#" class="dataTable-sorter">Position</a>
                            </th>
                            <th data-sortable="" class="text-center" style="width: 10%;"><a href="#"
                                                                                            class="dataTable-sorter">Action</a>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(!empty($links))
                            @forelse($links as $link)

{{--                                                            <div>DB::table("menu_links")->insert([--}}
{{--                                                                "id" => '{{$link->id}}',--}}
{{--                                                                "name" => '{{$link->name}}',--}}
{{--                                                                "route" => '{{$link->route}}',--}}
{{--                                                                "route_index" => '{{$link->route_index}}',--}}
{{--                                                                "roles" => '{{$link->roles}}',--}}
{{--                                                                "permission_id" => '{{$link->permission_id}}',--}}
{{--                                                                "folder_id" => '{{$link->folder_id}}',--}}
{{--                                                                "category_id" => '{{$link->category_id}}',--}}
{{--                                                                "position" => '{{$link->position}}',--}}
{{--                                                                'created_at'=>"{{\Carbon\Carbon::now()}}",--}}
{{--                                                                'updated_at'=>"{{\Carbon\Carbon::now()}}"--}}
{{--                                                                ]);</div>--}}



                                <tr>
                                    <td>{{$link->id}}</td>
                                    <td>{{$link->name}}</td>
                                    <td>{{$link->route}}</td>
                                    <td>{{$link->route_index}}</td>
                                    <td>
                                        @foreach($link->link_roles as $role)
                                            @if($role->name==='Super Admin')
                                                <span class="badge bg-danger">{{$role->name}}</span>
                                            @elseif($role->name==='Admin')
                                                <span class="badge bg-primary">{{$role->name}}</span>
                                            @elseif($role->name==='Manager')
                                                <span class="badge bg-info">{{$role->name}}</span>
                                            @else
                                                <span class="badge bg-secondary">{{$role->name}}</span>
                                            @endif

                                        @endforeach

                                    </td>
                                    <td>{{$link->permission->name}}</td>
                                    <td>


                                            <span class="badge bg-secondary">{{$link->folder->name}}</span>

                                    </td>
                                    <td>

                                            <span class="badge bg-secondary">{{$link->category->name}}</span>

                                    </td>

                                    <td>{{$link->position}}</td>


                                    <td class="text-center">
                                        @include('livewire.admin.menu.links.update')
                                        @include('livewire.admin.menu.links.delete')
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10 ">
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
                @if(!empty($links))
                    <div class="dataTable-info text-sm pb-1">Showing {{$currentPage}} to {{$perPage}}
                        of {{$total}}</div>
                    {{$links->links()}}
                @endif

            </div>
        </div>

    </section>
    </x-framer>
</div>
