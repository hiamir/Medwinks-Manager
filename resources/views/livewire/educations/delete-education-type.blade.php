<x-organisms.modal
    showButton={{true}}
        name="education_type_delete"
    type="delete"
    id="{{$education_type->id}}"
    size="xl"
    buttonName=""
    buttonColor='outline-danger'
    buttonRound='{{false}}'
    buttonIcon='fas fa-trash'
    buttonClass="px-2 btn-outline-danger rounded-end"
    buttonSubmitName="Delete {{$education_type->name}}"
    passingData=""
    custom=""
>
    <x-molecules.modal.content>


        <x-atoms.formgroup>
            <x-atoms.modal.checkbox
                id='{{$education_type->id}}'
                customID=""
                label=""
                class=""
                name='form1.trash'
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
