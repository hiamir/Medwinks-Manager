<div>
    <x-framer :pageName="$pageName">
        <section class="section">
            <div class="card">
                <div class="card-body">
                    @include('livewire.admin.countries.create')

                    <x-organisms.table-search :fields="$searchFields" :pageNoList="$pageNoList"
                                              :sortDirectionList="$sortDirectionList"></x-organisms.table-search>

                    <div class="dataTable-container">
                        <table wire:init="loadPosts" class="table table-striped dataTable-table" id="table1">
                            <thead>
                            <tr>
                                <th data-sortable="" style="width: 10%;"><a href="#" class="dataTable-sorter">ID</a>
                                </th>
                                <th data-sortable="" style="width: 20%;"><a href="#"
                                                                            class="dataTable-sorter">Country</a></th>
                                <th data-sortable="" class="text-center" style="width: 40%;"><a href="#"
                                                                                                class="dataTable-sorter">Regions</a>
                                </th>
                                <th data-sortable="" class="text-center" style="width: 10%;"><a href="#"
                                                                                                class="dataTable-sorter">Phone
                                        Prefix</a></th>
                                <th data-sortable="" class="text-center" style="width: 10%;"><a href="#"
                                                                                                class="dataTable-sorter ">Currency
                                        Name</a></th>
                                <th data-sortable="" class="text-center" style="width: 10%;"><a href="#"
                                                                                                class="dataTable-sorter">Action</a>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($countries))
                                @forelse($countries as $country)
                                    {{--                            <div>DB::table("countries")->insert([--}}
                                    {{--                                "id" => "{{$country->id}}",--}}
                                    {{--                                "iso" => "{{$country->iso}}",--}}
                                    {{--                                "iso3" => "{{$country->iso3}}",--}}
                                    {{--                                "fips" => "{{$country->fips}}",--}}
                                    {{--                                "country" => "{{$country->country}}",--}}
                                    {{--                                "continent" => "{{$country->continent}}",--}}
                                    {{--                                "currency_code" => "{{$country->currency_code}}",--}}
                                    {{--                                "currency_name" => "{{$country->currency_name}}",--}}
                                    {{--                                "phone_prefix" => "{{$country->phone_prefix}}",--}}
                                    {{--                                "postal_code" => "{{$country->postal_code}}",--}}
                                    {{--                                "languages" => "{{$country->languages}}",--}}
                                    {{--                                "geonameid" => "{{$country->geonameid}}",--}}
                                    {{--                                ]);</div>--}}

                                    <tr>
                                        <td>{{$country->id}}</td>
                                        <td>{{$country->country}}</td>
                                        <td class="text-center">
                                            @if(sizeof(json_decode($country->regions->pluck('name'),true))>0)
                                                {{implode(', ',json_decode($country->regions->pluck('name'),true))}}
                                            @else
                                                {{'NA'}}
                                            @endif


                                            {{--                                    @forelse($country->regions as $region)--}}
                                            {{--                                                                      {{$region->name}}--}}
                                            {{--                                    @empty--}}
                                            {{--                                        {{'NA'}}--}}
                                            {{--                                    @endforelse--}}

                                        </td>
                                        <td class="text-center">{{$country->phone_prefix}}</td>
                                        <td class="text-center">{{$country->currency_name}} ({{$country->currency_code}}
                                            )
                                        </td>

                                        <td class="text-center">
                                            @include('livewire.admin.countries.update')
                                            @include('livewire.admin.countries.delete')
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">
                                            <x-atoms.div class="fw-bold p-2" custom=""><i
                                                    class="fas fa-exclamation-circle"></i>
                                                No countries Found!
                                            </x-atoms.div>

                                        </td>
                                    </tr>
                                @endforelse
                            @endif

                            </tbody>
                        </table>
                    </div>
                    @if(!empty($countries))
                        <div class="dataTable-info text-sm pb-1">Showing {{$currentPage}} to {{$perPage}}
                            of {{$total}}</div>
                        {{$countries->links()}}
                    @endif

                </div>
            </div>

        </section>
    </x-framer>
</div>
