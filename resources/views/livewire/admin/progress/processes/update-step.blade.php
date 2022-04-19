<x-organisms.modal
    showButton={{true}}
        name="step_update"
    type="edit"
    id="{{$step->id}}"
    size="xl"
    buttonName=""
    buttonColor='outline-primary'
    buttonRound='{{false}}'
    buttonIcon='far fa-edit'
    buttonSubmitName="Update Step"
    passingData=""
    custom=""
    xdata="
                pid:'{{ $step->id }}',
                sid:'{{ $step->id }}',
                name:'{{ $step->name }}',

                buttonShow:false,
                position:'{{ $step->position }}',
                processID:$wire.entangle('processes_id')
"
>
    <x-molecules.modal.content>
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
            xinit="inputValue='{{ $step->name }}'"
        >
        </x-atoms.bootstrap.input-text>


        {{--          POSITION               --}}
        <x-atoms.bootstrap.input-text
            name="form1.position"
            xdata="
                    label:'Step position',
                    inputValue:'',
                    idName:'position',
                    entangleName:$wire.entangle('form1.position'),
                    placeholder:'Enter a position for the Step'
              "
            xinit="inputValue='{{ $step->position }}'"
        >
        </x-atoms.bootstrap.input-text>



    </x-molecules.modal.content>

</x-organisms.modal>



