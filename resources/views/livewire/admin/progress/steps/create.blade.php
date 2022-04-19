
<x-organisms.modal
    showButton={{true}}
        name="step_create"
    type="add"
    id="0"
    size="xl"
    buttonName="Add Step"
    buttonColor='outline-primary'
    buttonRound='{{true}}'
    buttonIcon='fas fa-user-plus'
    buttonSubmitName="New Step"
    passingData=""
    custom=""
    xdata="
            pid:'0',
            sid:'0',
            process:'',
             name:'',
            position:''
    "
>
    <x-molecules.modal.content>
        {{--           NAME INPUT               --}}

        <x-atoms.bootstrap.input-text
            name="form.name"
            xdata="
                    label:'Step name',
                    inputValue:'',
                    idName:'name',
                    inputValue:'',
                    entangleName:$wire.entangle('form.name'),
                    placeholder:'Enter a name for the Step'
              "
            xinit="inputValue=''"
        >
        </x-atoms.bootstrap.input-text>


        {{--          POSITION               --}}
        <x-atoms.bootstrap.input-text
            name="form.position"
            xdata="
                    label:'Step position',
                    inputValue:'',
                    idName:'position',
                    inputValue:'',
                    entangleName:$wire.entangle('form.position'),
                    placeholder:'Enter a position for the Step'
              "
            xinit="inputValue=''"
        >
        </x-atoms.bootstrap.input-text>


        <x-atoms.bootstrap.input-select
            dataList="{!! $processList !!}"
            name="form.process"
            xdata="
                            label:'Process',
                            placeholder:'Select Process',
                            name:'form.process',
                            xdataName:'process',
                            xdata:process"
        >
        </x-atoms.bootstrap.input-select>


    </x-molecules.modal.content>

</x-organisms.modal>
