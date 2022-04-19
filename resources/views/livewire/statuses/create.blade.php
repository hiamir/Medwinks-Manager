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
    buttonSubmitName="New Status"
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
        {{--           NAME INPUT               --}}

        <x-atoms.bootstrap.input-text
            name="form.name"
            xdata="
                    label:'Name',
                    inputValue:'',
                    idName:'name',
                    inputValue:'',
                    entangleName:$wire.entangle('form.name'),
                    placeholder:'Enter a Status'"
            xinit="inputValue=''"
        >
        </x-atoms.bootstrap.input-text>


        {{--          code               --}}
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

    </x-molecules.modal.content>

</x-organisms.modal>
