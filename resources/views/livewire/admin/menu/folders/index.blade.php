<div>
    <x-framer :pageName="$pageName">
        <section class="section">
            <div class="card">
                <div class="card-body">
                    @include('livewire.admin.menu.folders.create')

                    <x-organisms.table-search :fields="$searchFields" :pageNoList="$pageNoList"
                                              :sortDirectionList="$sortDirectionList"></x-organisms.table-search>

                    <div class="dataTable-container">
                        <table class="table table-striped dataTable-table" id="table1">
                            <thead>
                            <tr>
                                <th data-sortable="" style="width: 10%;"><a href="#" class="dataTable-sorter">ID</a>
                                </th>
                                <th data-sortable="" style="width: 35%;"><a href="#" class="dataTable-sorter">Name</a>
                                </th>
                                <th data-sortable="" style="width: 35%;"><a href="#"
                                                                            class="dataTable-sorter">Position</a></th>
                                <th data-sortable="" class="text-center" style="width: 10%;"><a href="#"
                                                                                                class="dataTable-sorter">Action</a>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($folders))
                                @forelse($folders as $folder)

{{--                                    <div>--}}
{{--                                        DB::table("menu-links")->insert([--}}
{{--                                        "id" => '{{$folder->id}}',--}}
{{--                                        "name" => '{{$folder->name}}',--}}
{{--                                        "position" => '{{$folder->position}}',--}}
{{--                                        ]);--}}
{{--                                    </div>--}}



                                    <tr>
                                        <td>{{$folder->id}}</td>
                                        <td>{{$folder->name}}</td>
                                        <td>{{$folder->position}}</td>

                                        <td class="text-center">
                                            @include('livewire.admin.menu.folders.update')
                                            @include('livewire.admin.menu.folders.delete')
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">
                                            <x-atoms.div class="fw-bold p-2" custom=""><i
                                                    class="fas fa-exclamation-circle"></i>
                                                No folders Found!
                                            </x-atoms.div>

                                        </td>
                                    </tr>
                                @endforelse
                            @endif

                            </tbody>
                        </table>
                    </div>
                    @if(!empty($folders))
                        <div class="dataTable-info text-sm pb-1">Showing {{$currentPage}} to {{$perPage}}
                            of {{$total}}</div>
                        {{$folders->links()}}
                    @endif

                </div>
            </div>

        </section>
    </x-framer>
</div>
