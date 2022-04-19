<div>
    <x-framer :pageName="$pageName">
    <section class="section">
        <div class="card">
            <div class="card-body">
                @include('livewire.admin.menu.categories.create')

                <x-organisms.table-search :fields="$submitFields" :pageNoList="$pageNoList"
                                          :sortDirectionList="$sortDirectionList"></x-organisms.table-search>

                <div class="dataTable-container">
                    <table class="table table-striped dataTable-table" id="table1">
                        <thead>
                        <tr>
                            <th data-sortable="" style="width: 10%;"><a href="#" class="dataTable-sorter">ID</a></th>
                            <th data-sortable="" style="width: 35%;"><a href="#" class="dataTable-sorter">Name</a></th>
                            <th data-sortable="" style="width: 35%;"><a href="#" class="dataTable-sorter">Position</a></th>
                            <th data-sortable="" class="text-center" style="width: 10%;"><a href="#" class="dataTable-sorter">Action</a>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($categories as $category)

{{--                            <div>--}}
{{--                                DB::table("menu-links")->insert([--}}
{{--                                "id" => '{{$category->id}}',--}}
{{--                                "name" => '{{$category->name}}',--}}
{{--                                "position" => '{{$category->position}}',--}}
{{--                                ]);--}}
{{--                            </div>--}}

                            <tr>
                                <td>{{$category->id}}</td>
                                <td>{{$category->name}}</td>
                                <td>{{$category->position}}</td>
                                <td class="text-center">
                                    @include('livewire.admin.menu.categories.update')
                                    @include('livewire.admin.menu.categories.delete')
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5">
                                    <x-atoms.div class="fw-bold p-2" custom=""><i class="fas fa-exclamation-circle"></i>
                                        No categories Found!</x-atoms.div>
                                </td>
                            </tr>
                        @endforelse


                        </tbody>
                    </table>
                </div>
                <div class="dataTable-info text-sm pb-1">Showing {{$currentPage}} to {{$perPage}}
                    of {{$total}}</div>
                {{$categories->links()}}

            </div>
        </div>

    </section>
    </x-framer>
</div>
