<x-organisms.modal
    showButton={{true}}
        name="country_create"
    type="add"
    id="0"
    size="xl"
    buttonName="Add Country"
    buttonColor='outline-primary'
    buttonRound='{{true}}'
    buttonIcon='fas fa-user-plus'
    buttonSubmitName="New Country"
    passingData=""
    custom=""
    xdata="
            pid:'0',
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
                    xinit="inputValue=''"
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
                    xinit="inputValue=''"
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
                    xinit="inputValue=''"
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
                    xinit="inputValue=''"
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
                    xinit="inputValue=''"
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
                    xinit="inputValue=''"
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
                    xinit="inputValue=''"
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
                    xinit="inputValue=''"
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
                    xinit="inputValue=''"
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
                    xinit="inputValue=''"
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
                    xinit="inputValue=''"
                >
                </x-atoms.bootstrap.input-text>
            </x-molecules.bootstrap.column>
        </x-molecules.bootstrap.row>
    </x-molecules.modal.content>
</x-organisms.modal>
