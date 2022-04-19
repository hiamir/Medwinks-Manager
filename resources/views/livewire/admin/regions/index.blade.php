<div>
    <x-framer :pageName="$pageName">
        <section class="section">
            <div class="card">
                <div class="card-body">
                    @include('livewire.admin.regions.create')

                    <x-organisms.table-search :fields="$searchFields" :pageNoList="$pageNoList"
                                              :sortDirectionList="$sortDirectionList"></x-organisms.table-search>

                    <div class="dataTable-container">
                        <table class="table table-striped dataTable-table" id="table1">
                            <thead>
                            <tr>
                                <th data-sortable="" style="width: 10%;"><a href="#" class="dataTable-sorter">ID</a>
                                </th>
                                <th data-sortable="" style="width: 20%;"><a href="#"
                                                                            class="dataTable-sorter">Country</a></th>
                                <th data-sortable="" class="text-center" style="width: 50%;"><a href="#"
                                                                                                class="dataTable-sorter">Regions</a>
                                </th>
                                <th data-sortable="" class="text-center" style="width: 10%;"><a href="#"
                                                                                                class="dataTable-sorter ">Time
                                        Zone</a></th>
                                <th data-sortable="" class="text-center" style="width: 10%;"><a href="#"
                                                                                                class="dataTable-sorter">Action</a>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($regions))
                                @forelse($regions as $region)
                                    {{--                            <div>DB::table('regions')->insert([--}}
                                    {{--                                'id' => '{{$region->id}}',--}}
                                    {{--                                'countries_id' => '{{$region->countries_id}}',--}}
                                    {{--                                'name' => '{{$region->name}}',--}}
                                    {{--                                'timezone' => '{{$region->timezone}}',--}}
                                    {{--                                ]);--}}
                                    {{--                            </div>--}}

                                    <tr>
                                        <td>{{$region->id}}</td>
                                        <td>{{$region->country->country}}</td>
                                        <td class="text-center">{{$region->name}}</td>
                                        <td class="text-center">{{$region->timezone}}</td>

                                        <td class="text-center">
                                            @include('livewire.admin.regions.update')
                                            @include('livewire.admin.regions.delete')
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">
                                            <x-atoms.div class="fw-bold p-2" custom=""><i
                                                    class="fas fa-exclamation-circle"></i>
                                                No regions Found!
                                            </x-atoms.div>

                                        </td>
                                    </tr>
                                @endforelse
                            @endif

                            </tbody>
                        </table>
                    </div>
                    @if(!empty($regions))
                        <div class="dataTable-info text-sm pb-1">Showing {{$currentPage}} to {{$perPage}}
                            of {{$total}}</div>
                        {{$regions->links()}}
                    @endif

                </div>
            </div>

        </section>
    </x-framer>
</div>
