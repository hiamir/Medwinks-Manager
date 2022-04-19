<x-organisms.modal
    showButton={{true}}
        name="region_create"
    type="add"
    id="0"
    size="modal-xl"
    buttonName="Add Region"
    buttonColor='outline-primary'
    buttonRound='{{true}}'
    buttonIcon='fas fa-user-plus'
    buttonSubmitName="New Region"
    passingData=""
    custom=""
>
    <x-molecules.modal.content>

        {{--           COUNTRY NAME  SELECT               --}}
        <x-atoms.bootstrap.select
            id="form.country"
            name="form.country"
            class=""
            label="Country Name"
            placeholder="Select Country Name"
            firstvalue=""
            :list="$countryList"
        >
        </x-atoms.bootstrap.select>

        {{--           REGION NAME TEXT               --}}
        <x-atoms.bootstrap.input
            container=""
            id="0"
            size=""
            name="form.name"
            label="Region"
            type="text"
            placeholder="Enter a region"
            icon=""
            value=""
            debounce="150ms"
            lazy="{{false}}"
            defer="{{false}}"
            class=""
            custom=""
        >
        </x-atoms.bootstrap.input>


        {{--           CODE TEXT               --}}
        <x-atoms.bootstrap.input
            container=""
            id="0"
            size=""
            name="form.timezone"
            label="Time Zone"
            type="text"
            placeholder="Enter Time Zone for this region"
            icon=""
            value=""
            debounce="150ms"
            lazy="{{false}}"
            defer="{{false}}"
            class=""
            custom=""
        >
        </x-atoms.bootstrap.input>


    </x-molecules.modal.content>



</x-organisms.modal>
