
<x-organisms.modal
    showButton={{true}}
        name="education_type_create"
    type="add"
    id="0"
    size="xl"
    buttonName=""
    buttonColor='bg-primary p-2 text-white'
    buttonRound='{{true}}'
    buttonIcon='fa-solid fa-plus'
    buttonSubmitName="New Education Type"
    passingData="{{$education->id}}"
    custom=""
    xdata="
            pid:'{{ $education->id }}',
            sid:'0',
             name:'',
            position:'',
             acronym:''"
>
    <x-molecules.modal.content>
        {{--           NAME INPUT               --}}

        <x-atoms.bootstrap.input-text
            name="form1.name"
            xdata="
                    label:'Enter a {{$education->name}}',
                    inputValue:'',
                    idName:'name',
                    inputValue:'',
                    entangleName:$wire.entangle('form1.name'),
                    placeholder:'Enter a {{$education->name}} degree'"
            xinit="inputValue=''"
        >
        </x-atoms.bootstrap.input-text>

        {{--           ACRONYM INPUT               --}}

        <x-atoms.bootstrap.input-text
            name="form1.name"
            xdata="
                    label:'Give acronym for this Education',
                    inputValue:'',
                    idName:'acronym',
                    inputValue:'',
                    entangleName:$wire.entangle('form1.acronym'),
                    placeholder:'Enter a name for the Education'"
            xinit="inputValue=''"
        >
        </x-atoms.bootstrap.input-text>

        {{--        <input type="text"  wire:model="processes_id" x-model="processID" x-init="processID='{{$process->id}}'">--}}

    </x-molecules.modal.content>

</x-organisms.modal>
