<x-organisms.modal
    showButton={{true}}
        name="step_delete"
    type="delete"
    id="{{$process->id}}_{{$step->id}}"
    size="xl"
    buttonName=""
    buttonColor='outline-danger'
    buttonRound='{{false}}'
    buttonIcon='fas fa-trash'
    buttonClass="px-2 btn-outline-danger rounded-end"
    buttonSubmitName="Delete {{$step->name}}"
    passingData=""
    custom=""
>
    <x-molecules.modal.content>


        <x-atoms.formgroup>
            <x-atoms.modal.checkbox
                id='{{$process->id}}_{{$step->id}}'
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
