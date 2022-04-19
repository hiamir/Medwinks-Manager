<x-organisms.modal
    showButton={{true}}
        name="company_delete"
    type="delete"
    id="{{$company->id}}"
    size="lg"
    buttonName=""
    buttonColor='outline-danger'
    buttonRound='{{false}}'
    buttonIcon='fas fa-trash'
    buttonSubmitName="Delete {{$company->name}}"
    passingData=""
    custom=""
>
    <x-molecules.modal.content>

            <x-atoms.formgroup>
                <x-atoms.modal.checkbox
                    id='{{$company->id}}'
                    customID=""
                    label=""
                    class=""
                    name='form1.trash'
                    debounce="500ms"
                    lazy="{{false}}"
                    defer="{{false}}"
                    text="Are you sure you want to delete {{$company->name}}?"
                    checked=''
                    data=''
                    listdata=""
                >
                </x-atoms.modal.checkbox>
            </x-atoms.formgroup>



    </x-molecules.modal.content>

</x-organisms.modal>
