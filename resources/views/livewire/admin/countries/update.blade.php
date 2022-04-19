<x-organisms.modal
    showButton={{true}}
        name="country_update"
    type="edit"
    id="{{$country->id}}"
    size="xl"
    buttonName=""
    buttonColor='outline-success'
    buttonRound='{{false}}'
    buttonIcon='far fa-edit'
    buttonSubmitName="Update Country"
    passingData=""
    custom=""
    xdata="
            pid:'{{$country->id}}',
            sid:'0',
    "
>
    <x-molecules.modal.content>
        <x-molecules.bootstrap.row class="row  pb-2" custom="">
            <x-molecules.bootstrap.column class="col-sm-12 col-md-6 " custom="">
                <x-atoms.bootstrap.input-text
                    name="form.name"
                    xdata="
                    label:'Country name',
                    inputValue:'',
                    idName:'name',
                    inputValue:'',
                    entangleName:$wire.entangle('form.name'),
                    placeholder:'Enter a name for the Step'"
                    xinit="inputValue='{{$country->country}}'"
                >
                </x-atoms.bootstrap.input-text>
            </x-molecules.bootstrap.column>
            <x-molecules.bootstrap.column class="col-sm-12 col-md-6 " custom="">
                <x-atoms.bootstrap.input-text
                    name="form.iso"
                    xdata="
                    label:'ISO',
                    inputValue:'',
                    idName:'iso',
                    inputValue:'',
                    entangleName:$wire.entangle('form.iso'),
                    placeholder:'Enter ISO code'"
                    xinit="inputValue='{{$country->iso}}'"
                >
                </x-atoms.bootstrap.input-text>
            </x-molecules.bootstrap.column>
        </x-molecules.bootstrap.row>
        <x-molecules.bootstrap.row class="row pb-2" custom="">
            <x-molecules.bootstrap.column class="col-sm-12 col-md-6" custom="">
                <x-atoms.bootstrap.input-text
                    name="form.iso3"
                    xdata="
                    label:'ISO3',
                    inputValue:'',
                    idName:'iso3',
                    inputValue:'',
                    entangleName:$wire.entangle('form.iso3'),
                    placeholder:'Enter ISO3 code'"
                    xinit="inputValue='{{$country->iso3}}'"
                >
                </x-atoms.bootstrap.input-text>
            </x-molecules.bootstrap.column>
            <x-molecules.bootstrap.column class="col-sm-12 col-md-6 " custom="">
                <x-atoms.bootstrap.input-text
                    name="form.fips"
                    xdata="
                    label:'Fips',
                    inputValue:'',
                    idName:'fips',
                    inputValue:'',
                    entangleName:$wire.entangle('form.fips'),
                    placeholder:'Enter fips'"
                    xinit="inputValue='{{$country->fips}}'"
                >
                </x-atoms.bootstrap.input-text>
            </x-molecules.bootstrap.column>
        </x-molecules.bootstrap.row>
        <x-molecules.bootstrap.row class="row pb-2" custom="">
            <x-molecules.bootstrap.column class="col-sm-12 col-md-6 " custom="">
                <x-atoms.bootstrap.input-text
                    name="form.continent"
                    xdata="
                    label:'Continent',
                    inputValue:'',
                    idName:'continent',
                    inputValue:'',
                    entangleName:$wire.entangle('form.continent'),
                    placeholder:'Enter continent'"
                    xinit="inputValue='{{$country->continent}}'"
                >
                </x-atoms.bootstrap.input-text>
            </x-molecules.bootstrap.column>
            <x-molecules.bootstrap.column class="col-sm-12 col-md-6 " custom="">
                <x-atoms.bootstrap.input-text
                    name="form.postal_code"
                    xdata="
                    label:'Postal Code',
                    inputValue:'',
                    idName:'postal_code',
                    inputValue:'',
                    entangleName:$wire.entangle('form.postal_code'),
                    placeholder:'Enter Postal Code'"
                    xinit="inputValue='{{$country->postal_code}}'"
                >
                </x-atoms.bootstrap.input-text>
            </x-molecules.bootstrap.column>
        </x-molecules.bootstrap.row>
        <x-molecules.bootstrap.row class="row pb-2" custom="">
            <x-molecules.bootstrap.column class="col-sm-12 col-md-6 " custom="">
                <x-atoms.bootstrap.input-text
                    name="form.currency_code"
                    xdata="
                    label:'Currency Code',
                    inputValue:'',
                    idName:'currency_code',
                    inputValue:'',
                    entangleName:$wire.entangle('form.currency_code'),
                    placeholder:'Enter Currency Code'"
                    xinit="inputValue='{{$country->currency_code}}'"
                >
                </x-atoms.bootstrap.input-text>
            </x-molecules.bootstrap.column>
            <x-molecules.bootstrap.column class="col-sm-12 col-md-6 " custom="">
                <x-atoms.bootstrap.input-text
                    name="form.currency_name"
                    xdata="
                    label:'Currency Name',
                    inputValue:'',
                    idName:'currency_name',
                    inputValue:'',
                    entangleName:$wire.entangle('form.currency_name'),
                    placeholder:'Enter Currency Name'"
                    xinit="inputValue='{{$country->currency_name}}'"
                >
                </x-atoms.bootstrap.input-text>
            </x-molecules.bootstrap.column>
        </x-molecules.bootstrap.row>
        <x-molecules.bootstrap.row class="row pb-2" custom="">
            <x-molecules.bootstrap.column class="col-sm-12 col-md-6 " custom="">
                <x-atoms.bootstrap.input-text
                    name="form.languages"
                    xdata="
                    label:'Languages',
                    inputValue:'',
                    idName:'languages',
                    inputValue:'',
                    entangleName:$wire.entangle('form.languages'),
                    placeholder:'Enter Languages'"
                    xinit="inputValue='{{$country->languages}}'"
                >
                </x-atoms.bootstrap.input-text>
            </x-molecules.bootstrap.column>
            <x-molecules.bootstrap.column class="col-sm-12 col-md-6 " custom="">
                <x-atoms.bootstrap.input-text
                    name="form.geonameid"
                    xdata="
                    label:'Geonameid',
                    inputValue:'',
                    idName:'geonameid',
                    inputValue:'',
                    entangleName:$wire.entangle('form.geonameid'),
                    placeholder:'Enter Geonameid'"
                    xinit="inputValue='{{$country->geonameid}}'"
                >
                </x-atoms.bootstrap.input-text>
            </x-molecules.bootstrap.column>
        </x-molecules.bootstrap.row>
        <x-molecules.bootstrap.row class="row pb-2" custom="">
            <x-molecules.bootstrap.column class="col-sm-12 col-md-6 " custom="">
                <x-atoms.bootstrap.input-text
                    name="form.phone_prefix"
                    xdata="
                    label:'Phone Prefix',
                    inputValue:'',
                    idName:'phone_prefix',
                    inputValue:'',
                    entangleName:$wire.entangle('form.phone_prefix'),
                    placeholder:'Enter phone prefix'"
                    xinit="inputValue='{{$country->phone_prefix}}'"
                >
                </x-atoms.bootstrap.input-text>
            </x-molecules.bootstrap.column>
        </x-molecules.bootstrap.row>
    </x-molecules.modal.content>

</x-organisms.modal>



