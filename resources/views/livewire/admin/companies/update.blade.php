<x-organisms.modal
    showButton={{true}}
        name="company_update"
    type="edit"
    id="{{$company->id}}"
    size="lg"
    buttonName=""
    buttonColor='outline-success'
    buttonRound='{{false}}'
    buttonIcon='far fa-edit'
    passingData=""
    buttonSubmitName="Update Company"
    custom=""
>
    <x-molecules.modal.content>

        {{--           NAME INPUT               --}}

        <x-atoms.bootstrap.input
            container=""
            id="{{$company->id}}"
            size=""
            name="form1.name"
            label="Company Name"
            type="text"
            placeholder="Enter new company name"
            icon=""
            value=""
            debounce="150ms"
            lazy="{{false}}"
            defer="{{false}}"
            class=""
            custom=""
        >
        </x-atoms.bootstrap.input>


        {{--           TEXTAREA INPUT               --}}

        <x-atoms.bootstrap.textarea
            container=""
            height="5"
            id="{{$company->id}}"
            size=""
            name="form1.description"
            label="Company Description"
            type="text"
            placeholder="Enter new company description"
            icon=""
            value=""
            debounce="150ms"
            lazy="{{false}}"
            defer="{{false}}"
            class=""
            custom=""
        >
        </x-atoms.bootstrap.textarea>


        {{--           WEBSITE INPUT               --}}

        <x-atoms.bootstrap.input
            container=""
            id="{{$company->id}}"
            size=""
            name="form1.website"
            label="Company Website"
            type="text"
            placeholder="Enter company website"
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
