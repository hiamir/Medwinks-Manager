<x-organisms.modal
    showButton={{true}}
        name="address_create"
    type="add"
    id="0"
    size="lg"
    buttonName="Add {{$division->name}} address"
    buttonColor='outline-secondary'
    buttonRound='{{true}}'
    buttonIcon='far fa-address-card'
    buttonSubmitName="New {{$division->name}} Address"
    passingData="{{$division->id}}"
    custom=''
>

{{--    {{$this->emitSelf('divisionID',$division)}}--}}
    <x-molecules.modal.content>

        {{--           ADDRESS TYPE SELECT               --}}
        <x-atoms.bootstrap.select
            id="0"
            name="form3.address_type"
            class=""
            label="Address type"
            placeholder="Select address type"
            firstvalue=""
            :list="$addressTypeList"
        >
        </x-atoms.bootstrap.select>


        {{--           ADDRESS LINE 1               --}}

        <x-atoms.bootstrap.input
            container=""
            id="0"
            size=""
            name="form3.address_line1"
            label="Address line 1"
            type="text"
            placeholder="Address line 1"
            icon=""
            value=""
            debounce="150ms"
            lazy="{{false}}"
            defer="{{false}}"
            class=""
            custom=""
        >
        </x-atoms.bootstrap.input>


        {{--           ADDRESS LINE 2               --}}

        <x-atoms.bootstrap.input
            container=""
            id="0"
            size=""
            name="form3.address_line2"
            label="Address line 2"
            type="text"
            placeholder="Address line 2"
            icon=""
            value=""
            debounce="150ms"
            lazy="{{false}}"
            defer="{{false}}"
            class=""
            custom=""
        >
        </x-atoms.bootstrap.input>


        <x-molecules.bootstrap.row class="row pb-2" custom="">

            <x-molecules.bootstrap.column class="col-sm-12 col-md-6" custom="">

                {{--           POSTAL CODE              --}}

                <x-atoms.bootstrap.input
                    container=""
                    id="0"
                    size=""
                    name="form3.postal_code"
                    label="Postal code"
                    type="text"
                    placeholder="Postal code"
                    icon=""
                    value=""
                    debounce="150ms"
                    lazy="{{false}}"
                    defer="{{false}}"
                    class=""
                    custom=""
                >
                </x-atoms.bootstrap.input>

            </x-molecules.bootstrap.column>

            <x-molecules.bootstrap.column class="col-sm-12 col-md-6" custom="">

                {{--           ZIP CODE              --}}

                <x-atoms.bootstrap.input
                    container=""
                    id="0"
                    size=""
                    name="form3.zip_code"
                    label="Zip code"
                    type="text"
                    placeholder="Zip code"
                    icon=""
                    value=""
                    debounce="150ms"
                    lazy="{{false}}"
                    defer="{{false}}"
                    class=""
                    custom=""
                >
                </x-atoms.bootstrap.input>
            </x-molecules.bootstrap.column>
        </x-molecules.bootstrap.row>

        {{--           COUNTRY NAME  SELECT               --}}
        <x-atoms.bootstrap.select
            id="0"
            name="form3.country"
            class=""
            label="Country Name"
            placeholder="Select country name"
            firstvalue=""
            :list="$countryList"
        >
        </x-atoms.bootstrap.select>

        {{--           REGION NAME  SELECT               --}}
        <x-atoms.bootstrap.select
            id="0"
            name="form3.region"
            class=""
            label="Region Name"
            placeholder="Select region name"
            firstvalue=""
            :list="$regionList"
        >
        </x-atoms.bootstrap.select>




    </x-molecules.modal.content>

</x-organisms.modal>