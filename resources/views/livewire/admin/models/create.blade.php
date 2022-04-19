<x-organisms.modal
    showButton={{true}}
    name="model_create"
    type="add"
    id="0"
    size="xl"
    buttonName="Add Model"
    buttonColor='outline-primary'
    buttonRound='{{true}}'
    buttonIcon='fas fa-user-plus'
    buttonSubmitName="New Model"
    passingData=""
    custom=""
    xdata="
            pid:'0',
            sid:'0',
            name:'',
    "
>
    <x-molecules.modal.content>
        <x-atoms.bootstrap.input-text
            name="form.name"
            xdata="
                    label:'Model',
                    inputValue:'',
                    idName:'name',
                    inputValue:'',
                    entangleName:$wire.entangle('form.name'),
                    placeholder:'Enter a Model Name'"
            xinit="inputValue=''"
        >
        </x-atoms.bootstrap.input-text>

    </x-molecules.modal.content>

</x-organisms.modal>
