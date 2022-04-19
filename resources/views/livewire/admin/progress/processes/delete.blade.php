<x-organisms.modal
    x-data="{disabled=@entangle('$disabled')}"
    showButton={{true}}
        name="process_delete"
    type="delete"
    id="{{$process->id}}"
    size="lg"
    buttonName=""
    buttonColor=''
    buttonTextColor="text-secondary-50"
    buttonRound='{{false}}'
    buttonWidth="w-auto"
    buttonClass="px-2 btn-outline-danger rounded-end"
    buttonIcon="fas fa-trash"
    :buttonDisabled="$disabled"
    buttonSubmitName="Delete {{$process->name}}"
    passingData=""
    custom=""
>
    <x-molecules.modal.content>


        <x-atoms.formgroup>
            <x-atoms.modal.checkbox
                id='{{$process->id}}'
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
