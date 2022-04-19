<x-organisms.modal
    showButton={{true}}
        name="application_delete"
    type="delete"
    id="{{$application->id}}"
    size="xl"
    buttonName=""
    buttonColor='outline-danger'
    buttonRound='{{false}}'
    buttonIcon='fas fa-trash'
    buttonSubmitName="Delete Application"
    passingData=""
    custom=""
>
    <x-molecules.modal.content>


        <x-atoms.formgroup>
            <x-atoms.modal.checkbox
                id='{{$application->id}}'
                customID=""
                label=""
                class=""
                name='form.trash'
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
