{{--<span x-data="{processID:@entangle('processes_id')}" x-init="processID='{{$process->id}}'">--}}

<x-organisms.modal
    showButton={{true}}
        name="step_create"
    type="add"
    id="{{$process->id}}"
    size="xl"
    buttonName=""
    buttonColor='outline-primary'
    buttonRound='{{true}}'
    buttonIcon='fa-solid fa-plus'
    buttonSubmitName="New Step"
    passingData="{{$process->id}}"
    custom=""
    xdata="
            pid:'step_{{$process->id}}',
            sid:'0',
             name:'',
            position:''
    "
>
    <x-molecules.modal.content>
        {{--           NAME INPUT               --}}

        <x-atoms.bootstrap.input-text
            name="form1.name"
            xdata="
                    label:'Step name',
                    inputValue:'',
                    idName:'name',
                    inputValue:'',
                    entangleName:$wire.entangle('form1.name'),
                    placeholder:'Enter a name for the Step'
              "
            xinit="inputValue=''"
        >
        </x-atoms.bootstrap.input-text>


        {{--          POSITION               --}}
        <x-atoms.bootstrap.input-text
            name="form1.position"
            xdata="
                    label:'Step position',
                    inputValue:'',
                    idName:'position',
                    inputValue:'',
                    entangleName:$wire.entangle('form1.position'),
                    placeholder:'Enter a position for the Step'
              "
            xinit="inputValue=''"
        >
        </x-atoms.bootstrap.input-text>



    </x-molecules.modal.content>
</x-organisms.modal>
</span>
