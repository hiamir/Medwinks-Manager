

<x-organisms.modal

    showButton={{true}}
        name="education_type_view"
    type="view"
    id="{{$education_type->id}}"
    size="xl"
    buttonName="{{$education_type->name}}"
    buttonColor='outline-primary'
    buttonTextColor=""
    buttonRound='{{false}}'
    buttonWidth="w-auto"
    buttonClass="px-2 btn-outline-secondary  rounded-start"
    buttonIcon=""
    :buttonDisabled="$disabled"
    buttonSubmitName="View {{$education_type->name}}"
    passingData=""
    custom=""
    xdata="buttonShow:false"

>
{{--    <x-molecules.modal.content class="p-4 pb-0">--}}

{{--        <x-atoms.div class="" custom="">--}}
{{--            <x-atoms.div class="row" custom="">--}}
{{--                <x-atoms.div class="col-3" custom="">--}}
{{--                    <picture>--}}
{{--                        {{dd(file_exists($education_type->getFirstMedia('image')->getPath()))}}--}}
{{--                        @if(file_exists($education_type->getFirstMedia('image')->getPath()) || $education_type->getFirstMedia('image')->getUrl()!=null)--}}
{{--                            <img src="{{$education_type->getFirstMedia('image')->getUrl() }}" class="img-fluid img-thumbnail w-100" alt="">--}}
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
{{--                                <x-atoms.div class="col-8 py-3" custom=""> {{$education_type->name}} </x-atoms.div>--}}
{{--                            </x-atoms.div>--}}
{{--                        </li>--}}
{{--                        <li class="list-group-item p-0 border-0">--}}
{{--                            <x-atoms.div class="row" custom="">--}}
{{--                                <x-atoms.div class="col-4 p-3 bg-light" custom=""><i class="fas fa-signature"></i> Full Name</x-atoms.div>--}}
{{--                                <x-atoms.div class="col-8 py-3" custom=""> {{$education_type->given_name}} {{$education_type->sur_name}}</x-atoms.div>--}}
{{--                            </x-atoms.div>--}}
{{--                        </li>--}}
{{--                        <li class="list-group-item p-0 border-0">--}}
{{--                            <x-atoms.div class="row" custom="">--}}
{{--                                <x-atoms.div class="col-4 p-3 bg-light " custom=""> <i class="fas fa-birthday-cake"></i> Date of Birth</x-atoms.div>--}}
{{--                                <x-atoms.div class="col-8 py-3 " custom=""> {{$education_type->date_of_birth}}</x-atoms.div>--}}
{{--                            </x-atoms.div>--}}
{{--                        </li>--}}
{{--                        <li class="list-group-item p-0 border-0">--}}
{{--                            <x-atoms.div class="row" custom="">--}}
{{--                                <x-atoms.div class="col-4 p-3 bg-light " custom=""> <i class="fas fa-birthday-cake"></i> education_type Issued</x-atoms.div>--}}
{{--                                <x-atoms.div class="col-8 py-3 " custom=""> {{$education_type->issue_date}}</x-atoms.div>--}}
{{--                            </x-atoms.div>--}}
{{--                        </li>--}}
{{--                        <li class="list-group-item p-0 border-0">--}}
{{--                            <x-atoms.div class="row" custom="">--}}
{{--                                <x-atoms.div class="col-4 p-3 bg-light " custom=""> <i class="fas fa-birthday-cake"></i> education_type Expires</x-atoms.div>--}}
{{--                                <x-atoms.div class="col-8 py-3 " custom=""> {{$education_type->expiry_date}}</x-atoms.div>--}}
{{--                            </x-atoms.div>--}}
{{--                        </li>--}}
{{--                        <li class="list-group-item p-0 border-0">--}}
{{--                            <x-atoms.div class="row" custom="">--}}
{{--                                <x-atoms.div class="col-4 p-3 bg-light " custom=""> <i class="fas fa-birthday-cake"></i> Place</x-atoms.div>--}}
{{--                                <x-atoms.div class="col-8 py-3 " custom=""> {{$education_type->region->name}}, {{$education_type->country->country}}</x-atoms.div>--}}
{{--                            </x-atoms.div>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </x-atoms.div>--}}
{{--            </x-atoms.div>--}}


{{--        </x-atoms.div>--}}

{{--    </x-molecules.modal.content>--}}

</x-organisms.modal>
