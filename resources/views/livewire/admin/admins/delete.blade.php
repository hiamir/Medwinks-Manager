<x-organisms.modal
    showButton={{true}}
        name="admin_delete"
    type="delete"
    id="{{$admin->id}}"
    size="lg"
    buttonName=""
    buttonColor='outline-danger'
    buttonRound='{{false}}'
    buttonIcon='fas fa-trash'
    buttonSubmitName="Delete {{$admin->name}}"
    passingData=""
    custom=""
>
    <x-molecules.modal.content>



        <x-atoms.formgroup>
            <x-atoms.modal.checkbox
                id='{{$admin->id}}'
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
