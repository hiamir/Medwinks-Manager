<div>
    <x-framer :pageName="$pageName">
        <section class="section">
            <div class="card">
                <div class="card-body">
                    @include('livewire.admin.companies.create')

                    <x-organisms.table-search :fields="$searchFields" :pageNoList="$pageNoList"
                                              :sortDirectionList="$sortDirectionList"></x-organisms.table-search>

                    <div class="dataTable-container">
                        @if(!empty($companies))
                            @forelse($companies as $company)
                                <x-molecules.bootstrap.card
                                    cardClass="bg-light-primary mt-3"
                                    size="100%"
                                    bodyClass=""
                                    headerClass=""
                                    headerText=""
                                    image=""
                                    imageClass=""
                                    imageAlt=""
                                    headingSize=""
                                    headingClass=""
                                    headingName="{{$company->name}}"
                                    subHeadingSize=""
                                    subHeadingClass=""
                                    subHeadingName=""
                                    columnWidth="6"
                                    textClass="m-0"
                                    footerClass="bg-transparent"
                                    footerText=""
                                    crudButtons="true"
                                    crudButtonsHeader=""
                                    cardList=""
                                    equalHeight=""
                                >
                                    <x-slot name="update_delete_buttons">
                                        @include('livewire.admin.companies.update')
                                        @include('livewire.admin.companies.delete')
                                    </x-slot>


                                    <x-atoms.div class="" custom=""> {{$company->description}} </x-atoms.div>
                                    <hr>
                                    <x-atoms.div class="mt-2" custom="">
                                        <x-atoms.div class="d-inline" custom="">
                                            <x-atoms.div class="font-bold d-inline" custom="">Website:</x-atoms.div>
                                            <x-atoms.div class="d-inline" custom="">{{$company->website}}</x-atoms.div>
                                        </x-atoms.div>

                                    </x-atoms.div>
                                    <x-atoms.div class="d-inline" custom="">
                                        <x-atoms.div class="font-bold d-inline" custom="">Address:</x-atoms.div>
                                        <x-atoms.div class="d-inline" custom="">
                                            @if(count($company->addresses)>0)
                                            {{$company->addresses->first()->address_line1}}, {{$company->addresses->first()->address_line2}}, {{$company->addresses->first()->postal_code}},
                                            {{$company->addresses->first()->zip_code}}, {{$company->addresses->first()->region->name}}, {{$company->addresses->first()->country->country}}
                                                @endif
                                        </x-atoms.div>
                                        <x-atoms.div class="d-inline" custom="">
                                            @if(count($company->addresses)>0)
                                            @include('livewire.admin.companies.address-update')
                                            @include('livewire.admin.companies.address-delete')
                                                @endif
                                        </x-atoms.div>
                                    </x-atoms.div>


                                    {{--                                    DIVISION                       --}}
                                    <x-atoms.div class="mt-3" custom="">
                                        @include('livewire.admin.companies.division-create')
                                        @if(count($company->addresses)==0)
                                        @include('livewire.admin.companies.address-create')
                                            @endif
                                    </x-atoms.div>


                                    <x-atoms.div class="row row-cols-1 row-cols-md-0 g-4 mt-3" custom="">

                                        @foreach($company->divisions as $division)

                                            <x-atoms.div class="col" custom="">
                                                <x-molecules.bootstrap.card
                                                    cardClass="bg-light-secondary"
                                                    size=""
                                                    bodyClass=""
                                                    headerClass=""
                                                    headerText=""
                                                    image=""
                                                    imageClass=""
                                                    imageAlt=""
                                                    headingSize="h5"
                                                    headingClass=""
                                                    headingName="{{$division->name}}"
                                                    subHeadingSize=""
                                                    subHeadingClass=""
                                                    subHeadingName=""
                                                    columnWidth="6"
                                                    textClass=""
                                                    footerClass="bg-transparent"
                                                    footerText=""
                                                    crudButtons="true"
                                                    crudButtonsHeader=""
                                                    cardList=""
                                                    equalHeight=""
                                                >
                                                    <x-slot name="update_delete_buttons">
                                                        @include('livewire.admin.companies.division-update')
                                                        @include('livewire.admin.companies.division-delete')
                                                    </x-slot>

                                                    <x-slot name="card_lists"></x-slot>

                                                    <x-atoms.div class=""
                                                                 custom=""> {{$division->description}} </x-atoms.div>

                                                    <x-atoms.div class="mt-2" custom="">
                                                        <x-atoms.div class="d-inline" custom="">
                                                            <x-atoms.div class="font-bold d-inline" custom="">Website: </x-atoms.div>
                                                            <x-atoms.div class="d-inline" custom="">{{$division->website}}</x-atoms.div>
                                                        </x-atoms.div>
                                                    </x-atoms.div>
                                                    <x-atoms.div class="mt-3" custom="">
                                                        @if(isset($division))
                                                        @include('livewire.admin.companies.division-address-create')
                                                            @endif
                                                    </x-atoms.div>

                                                    <div class="row row-cols-1 row-cols-md-3 g-4 mt-1">
                                                        @foreach($division->addresses as $address)
                                                            <x-atoms.div class="col my-2" custom="">
                                                                <x-molecules.bootstrap.card
                                                                    cardClass="bg-light-info"
                                                                    size=""
                                                                    bodyClass=""
                                                                    headerClass="bg-transparent border-bottom border-2 py-1 px-0 font-bold text-secondary"
                                                                    headerText="{{$address->address_type->name}}"
                                                                    image=""
                                                                    imageClass=""
                                                                    imageAlt=""
                                                                    headingSize="h6"
                                                                    headingClass=""
                                                                    headingName=""
                                                                    subHeadingSize=""
                                                                    subHeadingClass=""
                                                                    subHeadingName=""
                                                                    columnWidth="6"
                                                                    textClass="m-0"
                                                                    footerClass="bg-transparent"
                                                                    footerText=""
                                                                    crudButtons=""
                                                                    crudButtonsHeader="true"
                                                                    cardList="true"
                                                                    equalHeight="true"
                                                                >
                                                                    <x-slot name="card_lists">

                                                                        <x-slot name="header_update_delete_buttons">
                                                                            @include('livewire.admin.companies.division-address-update')
                                                                            @include('livewire.admin.companies.division-address-delete')
                                                                        </x-slot>

                                                                        <x-molecules.bootstrap.list-group
                                                                            flush="true"
                                                                            class="bg-transparent"
                                                                            number=""
                                                                        >

                                                                            <x-molecules.bootstrap.list-item background="" class="bg-transparent border-0" action=""  active="" disable="" bagText="" bagColor="" bagRounded="">
                                                                                <x-atoms.div class="row" custom="">
                                                                                    {{$address->address_line1}} {{$address->address_line2}}
                                                                                </x-atoms.div>
                                                                                <x-atoms.div class="row" custom="">
                                                                                    {{$address->postal_code}}
                                                                                </x-atoms.div>
                                                                                <x-atoms.div class="row" custom="">
                                                                                    {{$address->zip_code}}
                                                                                </x-atoms.div>
                                                                                <x-atoms.div class="row" custom="">
                                                                                    {{$address->country->country}}
                                                                                </x-atoms.div>
                                                                                <x-atoms.div class="row" custom="">
                                                                                    {{$address->region->name}}
                                                                                </x-atoms.div>


                                                                            </x-molecules.bootstrap.list-item>

                                                                        </x-molecules.bootstrap.list-group>

                                                                    </x-slot>

                                                                </x-molecules.bootstrap.card>
                                                            </x-atoms.div>
                                                        @endforeach
                                                    </div>
                                                </x-molecules.bootstrap.card>


                                            </x-atoms.div>

                                        @endforeach
                                    </x-atoms.div>


                                </x-molecules.bootstrap.card>
                            @empty
                                Not Available
                            @endforelse
                        @endif


                        {{--                        <table wire:init="loadPosts" class="table table-striped dataTable-table" id="table1">--}}
                        {{--                            <thead>--}}
                        {{--                            <tr>--}}
                        {{--                                <th data-sortable="" style="width: 5%;"><a href="#" class="dataTable-sorter">ID</a></th>--}}
                        {{--                                <th data-sortable="" style="width: 20%;"><a href="#"--}}
                        {{--                                                                            class="dataTable-sorter">Company</a>--}}
                        {{--                                </th>--}}
                        {{--                                <th data-sortable="" style="width: 50%;"><a href="#"--}}
                        {{--                                                                            class="dataTable-sorter">Division</a>--}}
                        {{--                                </th>--}}
                        {{--                                <th data-sortable="" class="text-right" style="width: 20%;"><a href="#"--}}
                        {{--                                                                                               class="dataTable-sorter text-right">Action</a>--}}
                        {{--                                </th>--}}
                        {{--                            </tr>--}}
                        {{--                            </thead>--}}
                        {{--                            <tbody>--}}
                        {{--                            @if(!empty($companies))--}}
                        {{--                                @forelse($companies as $company)--}}
                        {{--                                    <tr>--}}
                        {{--                                        <td>{{$company->id}}</td>--}}

                        {{--                                        <td>{{$company->name}}</td>--}}
                        {{--                                        <td> @include('livewire.admin.companies.division')--}}
                        {{--                                            @foreach($company->divisions as $division)--}}
                        {{--                                                <button type="button" class="btn btn-sm btn-primary">--}}
                        {{--                                                    {{$division->name}}--}}
                        {{--                                                </button>--}}
                        {{--                                            @endforeach--}}

                        {{--                                        </td>--}}
                        {{--                                        <td class="text-right">--}}
                        {{--                                            @include('livewire.admin.companies.update')--}}
                        {{--                                            @include('livewire.admin.companies.delete')--}}
                        {{--                                        </td>--}}

                        {{--                                    </tr>--}}
                        {{--                                @empty--}}
                        {{--                                    <tr>--}}
                        {{--                                        <td colspan="3">--}}
                        {{--                                            <x-atoms.div class="fw-bold p-2" custom=""><i--}}
                        {{--                                                    class="fas fa-exclamation-circle"></i>--}}
                        {{--                                                No companies Found!--}}
                        {{--                                            </x-atoms.div>--}}

                        {{--                                        </td>--}}
                        {{--                                    </tr>--}}
                        {{--                                @endforelse--}}
                        {{--                            @endif--}}

                        {{--                            </tbody>--}}
                        {{--                        </table>--}}
                    </div
                    @if(!empty($companies))
                        <div class="dataTable-info text-sm pb-1">Showing {{$currentPage}} to {{$perPage}}
                            of {{$total}}</div>
                        {{$companies->links()}}
                    @endif

                </div>
            </div>

        </section>
    </x-framer>
</div>
