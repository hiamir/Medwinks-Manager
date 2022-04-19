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
            xinit="inputValue='{{ $step->name }}'"
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
            xinit="inputValue='{{ $step->position }}'"
        >
        </x-atoms.bootstrap.input-text>


    </x-molecules.modal.content>

</x-organisms.modal
>



