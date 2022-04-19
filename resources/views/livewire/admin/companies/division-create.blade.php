<x-organisms.modal
    showButton={{true}}
        name="division_create"
    type="add"
    id="0"
    size="lg"
    buttonName="{{$company->name}} Division"
    buttonColor='outline-success'
    buttonRound='{{true}}'
    buttonIcon='fas fa-divide'
    buttonSubmitName="New Division"
    passingData=""
    custom="wire:click={{$crudName}}({{$company->id}})"
>
    <x-molecules.modal.content>

        {{--           NAME INPUT               --}}

        <x-atoms.bootstrap.input
            container=""
            id="0"
            size=""
            name="form2.name"
            label="Division Name"
            type="text"
            placeholder="Enter new division name"
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
            id="0"
            size=""
            name="form2.description"
            label="Division Description"
            type="text"
            placeholder="Enter new division description"
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
            id="0"
            size=""
            name="form2.website"
            label="Division Website"
            type="text"
            placeholder="Enter division website"
            icon=""
            value=""
            debounce="150ms"
            lazy="{{false}}"
            defer="{{false}}"
            class=""
            custom=""
        >
        </x-atoms.bootstrap.input>

        <input wire:modal='form.companyID' {{$this->companyID=$company->id}} type="hidden">

    </x-molecules.modal.content>

</x-organisms.modal>






{{--<x-organisms.modal--}}
{{--    showButton={{true}}--}}
{{--        name="division_create"--}}
{{--    type="add"--}}
{{--    id="division'"--}}
{{--    size="lg"--}}
{{--    buttonName="Add Division"--}}
{{--    buttonColor='success'--}}
{{--    buttonRound='{{true}}'--}}
{{--    buttonIcon='fas fa-divide'--}}
{{--    buttonSubmitName="Add Division"--}}
{{--    custom="wire:click={{$crudName}}({{$company->id}})"--}}
{{-->--}}


{{--    <x-molecules.modal.content>--}}

{{--            --}}{{--           NAME INPUT               --}}

{{--                <x-atoms.bootstrap.input--}}
{{--                    container=""--}}
{{--                    id="0"--}}
{{--                    size=""--}}
{{--                    name="form2.name"--}}
{{--                    label="Division Name"--}}
{{--                    type="text"--}}
{{--                    placeholder="Enter new division name"--}}
{{--                    icon=""--}}
{{--                    value=""--}}
{{--                    debounce="150ms"--}}
{{--                    lazy="{{false}}"--}}
{{--                    defer="{{false}}"--}}
{{--                    class=""--}}
{{--                    custom=""--}}
{{--                >--}}
{{--                </x-atoms.bootstrap.input>--}}

{{--        --}}{{--           TEXTAREA INPUT               --}}

{{--        <x-atoms.bootstrap.textarea--}}
{{--            container=""--}}
{{--            height="5"--}}
{{--            id="0"--}}
{{--            size=""--}}
{{--            name="form2.description"--}}
{{--            label="Division Description"--}}
{{--            type="text"--}}
{{--            placeholder="Enter new division description"--}}
{{--            icon=""--}}
{{--            value=""--}}
{{--            debounce="150ms"--}}
{{--            lazy="{{false}}"--}}
{{--            defer="{{false}}"--}}
{{--            class=""--}}
{{--            custom=""--}}
{{--        >--}}
{{--        </x-atoms.bootstrap.textarea>--}}


{{--        --}}{{--           WEBSITE INPUT               --}}

{{--        <x-atoms.bootstrap.input--}}
{{--            container=""--}}
{{--            id="0"--}}
{{--            size=""--}}
{{--            name="form2.website"--}}
{{--            label="Division Website"--}}
{{--            type="text"--}}
{{--            placeholder="Enter division website"--}}
{{--            icon=""--}}
{{--            value=""--}}
{{--            debounce="150ms"--}}
{{--            lazy="{{false}}"--}}
{{--            defer="{{false}}"--}}
{{--            class=""--}}
{{--            custom=""--}}
{{--        >--}}
{{--        </x-atoms.bootstrap.input>--}}


{{--        <input wire:modal='form.companyID' {{$this->companyID=$company->id}} type="hidden">--}}

{{--    </x-molecules.modal.content>--}}

{{--</x-organisms.modal>--}}
