<x-organisms.modal
    showButton={{true}}
        name="address_company_delete"
    type="delete"
    id="{{$company->addresses->first()->id}}"
    size="lg"
    buttonName=""
    buttonColor='outline-danger'
    buttonRound='{{false}}'
    buttonIcon='fas fa-trash'
    buttonSubmitName="Delete {{$company->addresses->first()->address_type->name}}"
    passingData=""
    custom=""
>
    <x-molecules.modal.content>


        <x-atoms.formgroup>
            <x-atoms.modal.checkbox
                id='{{$company->addresses->first()->id}}'
                customID=""
                label=""
                class=""
                name='form3.trash'
                debounce="500ms"
                lazy="{{false}}"
                defer="{{false}}"
                text="{{$deleteMessage}}"
                checked=''
                data=""
                listdata=""
            >
            </x-atoms.modal.checkbox>


        </x-atoms.formgroup>

    </x-molecules.modal.content>

</x-organisms.modal>
