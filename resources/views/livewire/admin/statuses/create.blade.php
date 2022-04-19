<x-organisms.modal
    showButton={{true}}
    name="status_create"
    type="add"
    id="0"
    size="xl"
    buttonName="Add Status"
    buttonColor='outline-primary'
    buttonRound='{{true}}'
    buttonIcon='fas fa-user-plus'
    buttonSubmitName="New status"
    passingData=""
    custom=""
    xdata="
            pid:'0',
            sid:'0',
            name:'',
            model:''
    "
>
    <x-molecules.modal.content>
        <x-atoms.bootstrap.input-text
            name="form.name"
            xdata="
                    label:'Status',
                    inputValue:'',
                    idName:'name',
                    inputValue:'',
                    entangleName:$wire.entangle('form.name'),
                    placeholder:'Enter a Status Name'"
            xinit="inputValue=''"
        >
        </x-atoms.bootstrap.input-text>

        <x-atoms.bootstrap.input-text
            name="form.reference"
            xdata="
                    label:'Reference',
                    inputValue:'',
                    idName:'reference',
                    inputValue:'',
                    entangleName:$wire.entangle('form.reference'),
                    placeholder:'Enter a Model Reference'"
            xinit="inputValue=''"
        >
        </x-atoms.bootstrap.input-text>

        <x-atoms.bootstrap.input-text
            name="form.icon"
            xdata="
                    label:'Icon',
                    inputValue:'',
                    idName:'icon',
                    inputValue:'',
                    entangleName:$wire.entangle('form.icon'),
                    placeholder:'Enter a Icon'"
            xinit="inputValue=''"
        >
        </x-atoms.bootstrap.input-text>


        <x-atoms.bootstrap.input-select
            dataList="{!! $modelList !!}"
            name="form.model"
            xdata="
                            label:'Model',
                            placeholder:'Select Model',
                            name:'form.model',
                            xdataName:'model',
                            xdata:model"

        >
        </x-atoms.bootstrap.input-select>



    </x-molecules.modal.content>

</x-organisms.modal>
