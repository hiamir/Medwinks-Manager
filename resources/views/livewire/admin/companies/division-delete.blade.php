<x-organisms.modal
    showButton={{true}}
        name="division_delete"
    type="delete"
    id="{{$division->id}}"
    size="lg"
    buttonName=""
    buttonColor='outline-danger'
    buttonRound='{{false}}'
    buttonIcon='fas fa-trash'
    passingData=""
    buttonSubmitName="Delete {{$division->name}}"
    custom=""
>
    <x-molecules.modal.content>

            <x-atoms.formgroup>
                <x-atoms.modal.checkbox
                    id='{{$division->id}}'
                    customID=""
                    label=""
                    class=""
                    name='form2.trash'
                    debounce="500ms"
                    lazy="{{false}}"
                    defer="{{false}}"
                    text="Are you sure you want to delete {{$division->name}}?"
                    checked=''
                    data=''
                    listdata=""
                >
                </x-atoms.modal.checkbox>
            </x-atoms.formgroup>



    </x-molecules.modal.content>

</x-organisms.modal>
