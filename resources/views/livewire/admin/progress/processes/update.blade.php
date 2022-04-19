<x-organisms.modal
showButton={{true}}
        name="process_update"
    type="edit"
    id="{{$process->id}}"
    size="xl"
    buttonName=""
    buttonColor='outline-primary'
    buttonRound='{{false}}'
    buttonIcon='far fa-edit'
    buttonSubmitName="Update Process"
passingData=""
custom=""
xdata="
                pid:'{{ $process->id }}',
                sid:'0',
                name:'{{ $process->name }}',
                reference:'{{ $process->reference }}',
"
>
    <x-molecules.modal.content>
        {{--           NAME INPUT               --}}


        <x-atoms.bootstrap.input-text
            name="form.name"
            xdata="
                    label:'Process name',
                    inputValue:'',
                    idName:'name',
                    inputValue:'',
                    entangleName:$wire.entangle('form.name'),
                    placeholder:'Enter a name for the process'
              "
            xinit="inputValue='{{$process->name}}'"
        >
        </x-atoms.bootstrap.input-text>

        {{--           REFERENCE INPUT               --}}


        <x-atoms.bootstrap.input-text
            name="form.reference"
            xdata="
                    label:'Process reference',
                    inputValue:'',
                    idName:'reference',
                    inputValue:'',
                    entangleName:$wire.entangle('form.reference'),
                    placeholder:'Enter a reference for the process'
              "
            xinit="inputValue='{{$process->reference}}'"
        >
        </x-atoms.bootstrap.input-text>


    </x-molecules.modal.content>

</x-organisms.modal
>



