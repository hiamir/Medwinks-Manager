@if($passport->active)
    @php
       $buttonClass='px-2 btn-primary text-white  rounded-start';
    @endphp
@else
    @php

        $buttonClass='px-2 btn-outline-secondary  rounded-start';
    @endphp
@endif

<x-organisms.modal

    showButton={{true}}
        name="passport_view"
    type="view"
    id="{{$passport->id}}"
    size="xl"
    buttonName="{{$passport->passport_number}}"
    buttonColor='outline-primary'
    buttonTextColor=""
    buttonRound='{{false}}'
    buttonWidth="w-auto"
    buttonClass="{{$buttonClass}}"
    buttonIcon="fas fa-camera"
    :buttonDisabled="$disabled"
    buttonSubmitName="View {{$passport->passport_number}}"
    passingData=""
    custom=""
    xdata="buttonShow:false"

>
    <x-molecules.modal.content class="p-4 pb-0">

        <x-atoms.div class="" custom="">
            <x-atoms.div class="row" custom="">
                <x-atoms.div class="col-3" custom="">
                    <picture>
                        @if((count($passport->media)>0))
                        @if(file_exists($passport->getFirstMedia('image')->getPath()) || $passport->getFirstMedia('image')->getUrl()!=null)
                            <img src="{{$passport->getFirstMedia('image')->getUrl() }}" class="img-fluid img-thumbnail w-100" alt="">
                        @else
                            <img src="{{ asset('images/not-found.jpg') }}" class="img-fluid img-thumbnail w-100" alt="">
                        @endif
                            @endif
                    </picture>

                </x-atoms.div>
                <x-atoms.div class="col-9" custom="">
                    <ul class="list-group list-group-flush px-3 py-3 pb-4 pt-0">
                        <li class="list-group-item p-0 border-0">
                            <x-atoms.div class="row" custom="">
                                <x-atoms.div class="col-4  p-3  bg-light" custom=""> <i class="fas fa-id-card-alt"></i> Passport Number</x-atoms.div>
                                <x-atoms.div class="col-8 py-3" custom=""> {{$passport->passport_number}} </x-atoms.div>
                            </x-atoms.div>
                        </li>
                        <li class="list-group-item p-0 border-0">
                            <x-atoms.div class="row" custom="">
                                <x-atoms.div class="col-4 p-3 bg-light" custom=""><i class="fas fa-signature"></i> Full Name</x-atoms.div>
                                <x-atoms.div class="col-8 py-3" custom=""> {{$passport->given_name}} {{$passport->sur_name}}</x-atoms.div>
                            </x-atoms.div>
                        </li>
                        <li class="list-group-item p-0 border-0">
                            <x-atoms.div class="row" custom="">
                                <x-atoms.div class="col-4 p-3 bg-light " custom=""> <i class="fas fa-birthday-cake"></i> Date of Birth</x-atoms.div>
                                <x-atoms.div class="col-8 py-3 " custom=""> {{$passport->date_of_birth}}</x-atoms.div>
                            </x-atoms.div>
                        </li>
                        <li class="list-group-item p-0 border-0">
                            <x-atoms.div class="row" custom="">
                                <x-atoms.div class="col-4 p-3 bg-light " custom=""> <i class="fas fa-birthday-cake"></i> Passport Issued</x-atoms.div>
                                <x-atoms.div class="col-8 py-3 " custom=""> {{$passport->issue_date}}</x-atoms.div>
                            </x-atoms.div>
                        </li>
                        <li class="list-group-item p-0 border-0">
                            <x-atoms.div class="row" custom="">
                                <x-atoms.div class="col-4 p-3 bg-light " custom=""> <i class="fas fa-birthday-cake"></i> Passport Expires</x-atoms.div>
                                <x-atoms.div class="col-8 py-3 " custom=""> {{$passport->expiry_date}}</x-atoms.div>
                            </x-atoms.div>
                        </li>
                        <li class="list-group-item p-0 border-0">
                            <x-atoms.div class="row" custom="">
                                <x-atoms.div class="col-4 p-3 bg-light " custom=""> <i class="fas fa-birthday-cake"></i> Place</x-atoms.div>
                                <x-atoms.div class="col-8 py-3 " custom=""> {{$passport->region->name}}, {{$passport->country->country}}</x-atoms.div>
                            </x-atoms.div>
                        </li>
                    </ul>
                </x-atoms.div>
            </x-atoms.div>


        </x-atoms.div>

    </x-molecules.modal.content>

</x-organisms.modal>
