<x-organisms.modal
    showButton={{true}}
        name="region_delete"
    type="delete"
    id="{{$region->id}}"
    size="modal-xl"
    buttonName=""
    buttonColor='outline-danger'
    buttonRound='{{false}}'
    buttonIcon='fas fa-trash'
    buttonSubmitName="Delete {{$region->name}}"
    passingData=""
    custom=""
>
    <x-molecules.modal.content>

            <x-atoms.formgroup>
                <x-atoms.modal.checkbox
                    id='{{$region->id}}'
                    customID=""
                    label=""
                    class=""
                    name='form.trash'
                    debounce="500ms"
                    lazy="{{false}}"
                    defer="{{false}}"
                    text="{{$deleteMessage}}"
                    checked=''
                    data=''
                    listdata=""
                >
                </x-atoms.modal.checkbox>
            </x-atoms.formgroup>



    </x-molecules.modal.content>

</x-organisms.modal>
