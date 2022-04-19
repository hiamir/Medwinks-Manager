<div>
    <x-framer :pageName="$pageName">
        <section class="section">

            <div class="card px-4 pb-4">
                <div class="card-body px-0 pb-0">

                    @php
                        $active='';
                        $activeText='';
                         $headerText="";
                        $cardClass='bg-light-primary shadow-sm';
                        $headerExpiredClass='';
                        $passportExpired=false;
                    @endphp

                    @if(in_array('User',$userRoles))
                     @include('livewire.passports.user_create')
                    @endif

                    <x-organisms.table-search :fields="$searchFields" :pageNoList="$pageNoList"
                                              :sortDirectionList="$sortDirectionList">
                        <x-molecules.bootstrap.container class="" fluid={{true}} custom="">
                            <x-molecules.bootstrap.row class="" custom="">
                                <x-molecules.bootstrap.column class="col-md-3 col-sm-12 pb-2 px-0 pe-md-3" custom="">
                                </x-molecules.bootstrap.column>
                            </x-molecules.bootstrap.row>
                        </x-molecules.bootstrap.container>
                    </x-organisms.table-search>

                    @if(in_array('Manager',$userRoles))
                        <div class="dataTable-container">
                            <table class="table table-striped dataTable-table" id="table1">
                                <thead>
                                <tr>
                                    <th data-sortable="" style="width: 10%;"><a href="#" class="dataTable-sorter">ID</a>
                                    </th>
                                    <th data-sortable="" style="width: 20%;"><a href="#"
                                                                                class="dataTable-sorter">User</a></th>
                                    <th data-sortable="" class="text-left" style="width:55%;"><a href="#"
                                                                                                 class="dataTable-sorter">Passports</a>
                                    </th>
                                    <th data-sortable="" class="text-right" style="width: 15%;"><a href="#"
                                                                                                   class="dataTable-sorter">Action</a>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(!empty($passports))
                                    @forelse($passports as $passportUser)
                                        {{--                            <div>DB::table('regions')->insert([--}}
                                        {{--                                'id' => '{{$passport->id}}',--}}
                                        {{--                                'countries_id' => '{{$passport->countries_id}}',--}}
                                        {{--                                'name' => '{{$passport->name}}',--}}
                                        {{--                                'timezone' => '{{$passport->timezone}}',--}}
                                        {{--                                ]);--}}
                                        {{--                            </div>--}}

                                        <tr>
                                            <td>{{$passportUser->id}}</td>
                                            <td>{{$passportUser->name}}</td>
                                            <td>
                                                @foreach($passportUser->passports as $passport)
                                                    <div class="btn-group btn-group-sm p-1" role="group" aria-label="">
                                                        @include('livewire.passports.view')
                                                        @include('livewire.passports.update')
                                                        @include('livewire.passports.delete')
                                                    </div>

                                                @endforeach
                                            </td>


                                            <td class="text-right">
                                                @include('livewire.passports.create')
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5">
                                                <x-atoms.div class="fw-bold p-2" custom=""><i
                                                        class="fas fa-exclamation-circle"></i>
                                                    No Passport Found!
                                                </x-atoms.div>

                                            </td>
                                        </tr>

                                    @endforelse
                                @endif

                                </tbody>
                            </table>
                        </div>
                        @if(!empty($passports))
                            <div class="dataTable-info text-sm pb-1">Showing {{$currentPage}} to {{$perPage}}
                                of {{$total}}</div>
                            {{$passports->links()}}
                        @endif
                    @else



                        <div class="row row-cols-1 row-cols-md-3 g-4 mt-1">


                            @forelse($passports as $passport)

                           @if(\Carbon\Carbon::parse($passport->expiry)->gt(\Carbon\Carbon::now()))
                                    @php
                                        $cardClass='bg-light-secondary shadow-sm border border-danger border-1';
                                        $headerText="(Expired!)";
                                        $headerExpiredClass="text-danger";
                                        $passportExpired=true;
                                    @endphp
                           @endif


                           @if($passport->active)
                                @php
                                 $active='bg-success';
                                 $headerText='(Active)';

                                 $cardClass=$cardClass.' bg-light-success';
                                @endphp
                               @else
                                @php
                                 $active='';
                                 $headerText='';
                                 $cardClass='bg-light-primary shadow-sm';
                                 @endphp
                           @endif




                                <x-atoms.div class="col my-2" custom="">
                                    <x-molecules.bootstrap.card
                                        cardClass="{{$cardClass}}"
                                        size=""
                                        bodyClass="pb-0"
                                        headerClass="bg-transparent border-bottom border-2 py-1 px-0 font-bold text-secondary {{$headerExpiredClass}}"
                                        headerText="{{$passport->passport_number}} {{$headerText}}"
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

                                                @include('livewire.passports.update')
                                                @include('livewire.passports.delete')
                                            </x-slot>

                                            <x-molecules.bootstrap.list-group
                                                flush="true"
                                                class="bg-transparent"
                                                number=""
                                            >


                                                <x-atoms.div class="" custom="">
                                                    <x-atoms.div class="row" custom="">
                                                        <x-atoms.div class="col-12" custom="">
                                                            <ul class="list-group list-group-flush px-0 py-3 pb-0 pt-0">
                                                                <li class="list-group-item p-0 border-0 bg-transparent">
                                                                    <x-atoms.div class="row" custom="">
                                                                        <x-atoms.div class="col-5  p-3  bg-transparent" custom=""> <i class="fas fa-id-card-alt"></i> Passport Number</x-atoms.div>
                                                                        <x-atoms.div class="col-7 py-3" custom=""> {{$passport->passport_number}} </x-atoms.div>
                                                                    </x-atoms.div>
                                                                </li>
                                                                <li class="list-group-item p-0 border-0 bg-transparent">
                                                                    <x-atoms.div class="row" custom="">
                                                                        <x-atoms.div class="col-5 p-3" custom=""><i class="fas fa-signature"></i> Full Name</x-atoms.div>
                                                                        <x-atoms.div class="col-7 py-3" custom=""> {{$passport->given_name}} {{$passport->sur_name}} </x-atoms.div>
                                                                    </x-atoms.div>
                                                                </li>
                                                                <li class="list-group-item p-0 border-0 bg-transparent">
                                                                    <x-atoms.div class="row" custom="">
                                                                        <x-atoms.div class="col-5 p-3 " custom=""> <i class="fas fa-birthday-cake"></i> Date of Birth</x-atoms.div>
                                                                        <x-atoms.div class="col-7 py-3 " custom=""> {{$passport->date_of_birth}}</x-atoms.div>
                                                                    </x-atoms.div>
                                                                </li>
                                                                <li class="list-group-item p-0 border-0 bg-transparent">
                                                                    <x-atoms.div class="row" custom="">
                                                                        <x-atoms.div class="col-5 p-3 " custom=""> <i class="fas fa-birthday-cake"></i> Passport Issued</x-atoms.div>
                                                                        <x-atoms.div class="col-7 py-3 " custom=""> {{$passport->issue_date}}</x-atoms.div>
                                                                    </x-atoms.div>
                                                                </li>
                                                                <li class="list-group-item p-0 border-0 bg-transparent">
                                                                    <x-atoms.div class="row" custom="">
                                                                        <x-atoms.div class="col-5 p-3 " custom=""> <i class="fas fa-birthday-cake"></i> Passport Expires</x-atoms.div>
                                                                        <div class= @if($passportExpired==true)"col-7 py-3 text-danger" @else "col-7 py-3" @endif > {{$passport->expiry_date}}</div>
                                                                    </x-atoms.div>
                                                                </li>
                                                                <li class="list-group-item p-0 border-0 bg-transparent">
                                                                    <x-atoms.div class="row" custom="">
                                                                        <x-atoms.div class="col-5 p-3 " custom=""> <i class="fas fa-birthday-cake"></i> Place</x-atoms.div>
                                                                        <x-atoms.div class="col-7 py-3 " custom=""> {{$passport->region->name}}, {{$passport->country->country}}</x-atoms.div>
                                                                    </x-atoms.div>
                                                                </li>

                                                                <li class="list-group-item p-0 border-0 bg-transparent">
                                                                    <x-atoms.div class="row" custom="">
                                                                        <x-atoms.div class="col-5 p-3 " custom=""> <i class="fas fa-birthday-cake"></i> File</x-atoms.div>
                                                                        <x-atoms.div class="col-7 py-3 " custom="">
                                                                            @include('livewire.passports.view')
                                                                        </x-atoms.div>
                                                                    </x-atoms.div>
                                                                </li>

                                                            </ul>
                                                        </x-atoms.div>
                                                    </x-atoms.div>
                                                </x-atoms.div>
                                            </x-molecules.bootstrap.list-group>
                                        </x-slot>
                                    </x-molecules.bootstrap.card>
                                </x-atoms.div>
                        @empty
                                    <x-atoms.div class="fw-bold px-3 my-0" custom="">
                                        <div class="alert alert-primary bg-light-danger fw-normal" role="alert">
                                            <i class="fas fa-exclamation-circle"></i> No Passport Added!
                                        </div>

                                    </x-atoms.div>

                            @endforelse
                        </div>
                @if(!empty($passports))
                    <div class="dataTable-info text-sm pb-1">Showing {{$currentPage}} to {{$perPage}}
                        of {{$total}}</div>
                    {{$passports->links()}}
                @endif
                    @endif



                    {{--                    <div class="dataTable-container">--}}


                    {{--                        <div class="row row-cols-1 row-cols-md-3 g-4 mt-1">--}}
                    {{--                            @foreach($passports as $passport)--}}
                    {{--                                <x-atoms.div class="col my-2" custom="">--}}
                    {{--                                    <x-molecules.bootstrap.card--}}
                    {{--                                        cardClass="bg-light-primary"--}}
                    {{--                                        size=""--}}
                    {{--                                        bodyClass=""--}}
                    {{--                                        headerClass="bg-transparent border-bottom border-2 py-1 px-0 font-bold text-secondary"--}}
                    {{--                                        headerText="{{$passport->passport_number}}"--}}
                    {{--                                        image=""--}}
                    {{--                                        imageClass=""--}}
                    {{--                                        imageAlt=""--}}
                    {{--                                        headingSize="h6"--}}
                    {{--                                        headingClass=""--}}
                    {{--                                        headingName=""--}}
                    {{--                                        subHeadingSize=""--}}
                    {{--                                        subHeadingClass=""--}}
                    {{--                                        subHeadingName=""--}}
                    {{--                                        columnWidth="6"--}}
                    {{--                                        textClass="m-0"--}}
                    {{--                                        footerClass="bg-transparent"--}}
                    {{--                                        footerText=""--}}
                    {{--                                        crudButtons=""--}}
                    {{--                                        crudButtonsHeader="true"--}}
                    {{--                                        cardList="true"--}}
                    {{--                                        equalHeight="true"--}}
                    {{--                                    >--}}
                    {{--                                        <x-slot name="card_lists">--}}

                    {{--                                            <x-slot name="header_update_delete_buttons">--}}
                    {{--                                                @include('livewire.passports.update')--}}
                    {{--                                                @include('livewire.passports.delete')--}}
                    {{--                                            </x-slot>--}}

                    {{--                                            <x-molecules.bootstrap.list-group--}}
                    {{--                                                flush="true"--}}
                    {{--                                                class="bg-transparent"--}}
                    {{--                                                number=""--}}
                    {{--                                            >--}}

                    {{--                                                <x-molecules.bootstrap.list-item background="" class="bg-transparent border-0" action=""  active="" disable="" bagText="" bagColor="" bagRounded="">--}}
                    {{--                                                    <x-atoms.div class="row" custom="">--}}
                    {{--                                                        {{$passport->given_name}}  {{$passport->sur_name}}--}}
                    {{--                                                    </x-atoms.div>--}}
                    {{--                                                    <x-atoms.div class="row" custom="">--}}
                    {{--                                                        {{$passport->date_of_birth}}--}}
                    {{--                                                    </x-atoms.div>--}}
                    {{--                                                    <x-atoms.div class="row" custom="">--}}
                    {{--                                                        {{$passport->issue_date}}--}}
                    {{--                                                    </x-atoms.div>--}}
                    {{--                                                    <x-atoms.div class="row" custom="">--}}
                    {{--                                                        {{$passport->expiry_date}}--}}
                    {{--                                                    </x-atoms.div>--}}
                    {{--                                                    <x-atoms.div class="row" custom="">--}}
                    {{--                                                        {{$passport->regions_id}},   {{$passport->countries_id}}--}}
                    {{--                                                    </x-atoms.div>--}}
                    {{--                                                    <x-atoms.div class="row" custom="">--}}
                    {{--                                                        @include('livewire.passports.image')--}}
                    {{--                                                    </x-atoms.div>--}}


                    {{--                                                </x-molecules.bootstrap.list-item>--}}

                    {{--                                            </x-molecules.bootstrap.list-group>--}}

                    {{--                                        </x-slot>--}}

                    {{--                                    </x-molecules.bootstrap.card>--}}
                    {{--                                </x-atoms.div>--}}
                    {{--                            @endforeach--}}
                    {{--                        </div>--}}


                    {{--                    </div>--}}


                </div>
        </section>
    </x-framer>
</div>
