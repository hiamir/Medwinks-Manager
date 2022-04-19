

<x-organisms.modal

    showButton={{true}}
        name="step_view"
    type="view"
    id="{{$step->id}}"
    size="xl"
    buttonName="{{$step->position}}. {{$step->name}}"
    buttonColor='bg-secondary text-white'
    buttonTextColor=""
    buttonRound='{{false}}'
    buttonWidth="w-auto"
    buttonClass="px-2 btn-outline-secondary  rounded-start"
    buttonIcon=""
    :buttonDisabled="true"
    buttonSubmitName="View {{$step->name}}"
    passingData=""
    custom=""
    xdata="buttonShow:false"

>
{{--    <x-molecules.modal.content class="p-4 pb-0">--}}

{{--        <x-atoms.div class="" custom="">--}}
{{--            <x-atoms.div class="row" custom="">--}}
{{--                <x-atoms.div class="col-3" custom="">--}}
{{--                    <picture>--}}
{{--                        {{dd(file_exists($step->getFirstMedia('image')->getPath()))}}--}}
{{--                        @if(file_exists($step->getFirstMedia('image')->getPath()) || $step->getFirstMedia('image')->getUrl()!=null)--}}
{{--                            <img src="{{$step->getFirstMedia('image')->getUrl() }}" class="img-fluid img-thumbnail w-100" alt="">--}}
{{--                        @else--}}
{{--                            <img src="{{ asset('images/not-found.jpg') }}" class="img-fluid img-thumbnail w-100" alt="">--}}
{{--                        @endif--}}
{{--                    </picture>--}}

{{--                </x-atoms.div>--}}
{{--                <x-atoms.div class="col-9" custom="">--}}
{{--                    <ul class="list-group list-group-flush px-3 py-3 pb-4 pt-0">--}}
{{--                        <li class="list-group-item p-0 border-0">--}}
{{--                            <x-atoms.div class="row" custom="">--}}
{{--                                <x-atoms.div class="col-4  p-3  bg-light" custom=""> <i class="fas fa-id-card-alt"></i> step Number</x-atoms.div>--}}
{{--                                <x-atoms.div class="col-8 py-3" custom=""> {{$step->name}} </x-atoms.div>--}}
{{--                            </x-atoms.div>--}}
{{--                        </li>--}}
{{--                        <li class="list-group-item p-0 border-0">--}}
{{--                            <x-atoms.div class="row" custom="">--}}
{{--                                <x-atoms.div class="col-4 p-3 bg-light" custom=""><i class="fas fa-signature"></i> Full Name</x-atoms.div>--}}
{{--                                <x-atoms.div class="col-8 py-3" custom=""> {{$step->given_name}} {{$step->sur_name}}</x-atoms.div>--}}
{{--                            </x-atoms.div>--}}
{{--                        </li>--}}
{{--                        <li class="list-group-item p-0 border-0">--}}
{{--                            <x-atoms.div class="row" custom="">--}}
{{--                                <x-atoms.div class="col-4 p-3 bg-light " custom=""> <i class="fas fa-birthday-cake"></i> Date of Birth</x-atoms.div>--}}
{{--                                <x-atoms.div class="col-8 py-3 " custom=""> {{$step->date_of_birth}}</x-atoms.div>--}}
{{--                            </x-atoms.div>--}}
{{--                        </li>--}}
{{--                        <li class="list-group-item p-0 border-0">--}}
{{--                            <x-atoms.div class="row" custom="">--}}
{{--                                <x-atoms.div class="col-4 p-3 bg-light " custom=""> <i class="fas fa-birthday-cake"></i> step Issued</x-atoms.div>--}}
{{--                                <x-atoms.div class="col-8 py-3 " custom=""> {{$step->issue_date}}</x-atoms.div>--}}
{{--                            </x-atoms.div>--}}
{{--                        </li>--}}
{{--                        <li class="list-group-item p-0 border-0">--}}
{{--                            <x-atoms.div class="row" custom="">--}}
{{--                                <x-atoms.div class="col-4 p-3 bg-light " custom=""> <i class="fas fa-birthday-cake"></i> step Expires</x-atoms.div>--}}
{{--                                <x-atoms.div class="col-8 py-3 " custom=""> {{$step->expiry_date}}</x-atoms.div>--}}
{{--                            </x-atoms.div>--}}
{{--                        </li>--}}
{{--                        <li class="list-group-item p-0 border-0">--}}
{{--                            <x-atoms.div class="row" custom="">--}}
{{--                                <x-atoms.div class="col-4 p-3 bg-light " custom=""> <i class="fas fa-birthday-cake"></i> Place</x-atoms.div>--}}
{{--                                <x-atoms.div class="col-8 py-3 " custom=""> {{$step->region->name}}, {{$step->country->country}}</x-atoms.div>--}}
{{--                            </x-atoms.div>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </x-atoms.div>--}}
{{--            </x-atoms.div>--}}


{{--        </x-atoms.div>--}}

{{--    </x-molecules.modal.content>--}}

</x-organisms.modal>
