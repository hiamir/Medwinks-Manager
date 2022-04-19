<x-organisms.modal
    showButton={{true}}
        name="user_delete"
    type="delete"
    id="{{$user->id}}"
    size="lg"
    buttonName=""
    buttonColor='outline-danger'
    buttonRound='{{false}}'
    buttonIcon='fas fa-trash'
    buttonSubmitName="Delete {{$user->name}}"
    passingData=""
    custom=""
>
    <x-molecules.modal.content>



        <x-atoms.formgroup>
            <x-atoms.modal.checkbox
                id='{{$user->id}}'
                customID=""
                label=""
                class=""
                name='form.trash'
                debounce="500ms"
                lazy="{{false}}"
                defer="{{false}}"
                text="Are you sure you want to delete {{$user->name}}?"
                checked=''
                data=''
                listdata=""
            >
            </x-atoms.modal.checkbox>
        </x-atoms.formgroup>

    </x-molecules.modal.content>

</x-organisms.modal>
