

<x-organisms.modal

    showButton={{true}}
        name="service_requirement_view"
    type="view"
    id="{{$service_requirement->id}}"
    size="xl"
    buttonName="{{$service_requirement->name}}"
    buttonColor='bg-danger border-0'
    buttonTextColor="text-white"
    buttonRound='{{false}}'
    buttonWidth="w-auto"
    buttonClass="px-2 btn-outline-secondary  rounded-start rounded-end"
    buttonIcon=""
    :buttonDisabled="true"
    buttonSubmitName="View {{$service_requirement->name}}"
    passingData=""
    custom=""
    xdata="buttonShow:false, disabled:true"

>
{{--    <x-molecules.modal.content class="p-4 pb-0">--}}

{{--        <x-atoms.div class="" custom="">--}}
{{--            <x-atoms.div class="row" custom="">--}}
{{--                <x-atoms.div class="col-3" custom="">--}}
{{--                    <picture>--}}
{{--                        {{dd(file_exists($service_requirement->getFirstMedia('image')->getPath()))}}--}}
{{--                        @if(file_exists($service_requirement->getFirstMedia('image')->getPath()) || $service_requirement->getFirstMedia('image')->getUrl()!=null)--}}
{{--                            <img src="{{$service_requirement->getFirstMedia('image')->getUrl() }}" class="img-fluid img-thumbnail w-100" alt="">--}}
{{--                        @else--}}
{{--                            <img src="{{ asset('images/not-found.jpg') }}" class="img-fluid img-thumbnail w-100" alt="">--}}
{{--                        @endif--}}
{{--                    </picture>--}}

{{--                </x-atoms.div>--}}
{{--                <x-atoms.div class="col-9" custom="">--}}
{{--                    <ul class="list-group list-group-flush px-3 py-3 pb-4 pt-0">--}}
{{--                        <li class="list-group-item p-0 border-0">--}}
{{--                            <x-atoms.div class="row" custom="">--}}
{{--                                <x-atoms.div class="col-4  p-3  bg-light" custom=""> <i class="fas fa-id-card-alt"></i> education_type Number</x-atoms.div>--}}
{{--                                <x-atoms.div class="col-8 py-3" custom=""> {{$service_requirement->name}} </x-atoms.div>--}}
{{--                            </x-atoms.div>--}}
{{--                        </li>--}}
{{--                        <li class="list-group-item p-0 border-0">--}}
{{--                            <x-atoms.div class="row" custom="">--}}
{{--                                <x-atoms.div class="col-4 p-3 bg-light" custom=""><i class="fas fa-signature"></i> Full Name</x-atoms.div>--}}
{{--                                <x-atoms.div class="col-8 py-3" custom=""> {{$service_requirement->given_name}} {{$service_requirement->sur_name}}</x-atoms.div>--}}
{{--                            </x-atoms.div>--}}
{{--                        </li>--}}
{{--                        <li class="list-group-item p-0 border-0">--}}
{{--                            <x-atoms.div class="row" custom="">--}}
{{--                                <x-atoms.div class="col-4 p-3 bg-light " custom=""> <i class="fas fa-birthday-cake"></i> Date of Birth</x-atoms.div>--}}
{{--                                <x-atoms.div class="col-8 py-3 " custom=""> {{$service_requirement->date_of_birth}}</x-atoms.div>--}}
{{--                            </x-atoms.div>--}}
{{--                        </li>--}}
{{--                        <li class="list-group-item p-0 border-0">--}}
{{--                            <x-atoms.div class="row" custom="">--}}
{{--                                <x-atoms.div class="col-4 p-3 bg-light " custom=""> <i class="fas fa-birthday-cake"></i> education_type Issued</x-atoms.div>--}}
{{--                                <x-atoms.div class="col-8 py-3 " custom=""> {{$service_requirement->issue_date}}</x-atoms.div>--}}
{{--                            </x-atoms.div>--}}
{{--                        </li>--}}
{{--                        <li class="list-group-item p-0 border-0">--}}
{{--                            <x-atoms.div class="row" custom="">--}}
{{--                                <x-atoms.div class="col-4 p-3 bg-light " custom=""> <i class="fas fa-birthday-cake"></i> education_type Expires</x-atoms.div>--}}
{{--                                <x-atoms.div class="col-8 py-3 " custom=""> {{$service_requirement->expiry_date}}</x-atoms.div>--}}
{{--                            </x-atoms.div>--}}
{{--                        </li>--}}
{{--                        <li class="list-group-item p-0 border-0">--}}
{{--                            <x-atoms.div class="row" custom="">--}}
{{--                                <x-atoms.div class="col-4 p-3 bg-light " custom=""> <i class="fas fa-birthday-cake"></i> Place</x-atoms.div>--}}
{{--                                <x-atoms.div class="col-8 py-3 " custom=""> {{$service_requirement->region->name}}, {{$service_requirement->country->country}}</x-atoms.div>--}}
{{--                            </x-atoms.div>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </x-atoms.div>--}}
{{--            </x-atoms.div>--}}


{{--        </x-atoms.div>--}}

{{--    </x-molecules.modal.content>--}}

</x-organisms.modal>
