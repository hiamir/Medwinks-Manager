<x-organisms.modal
showButton={{true}}
        name="education_update"
    type="edit"
    id="{{$education->id}}"
    size="xl"
    buttonName=""
    buttonColor='outline-primary'
    buttonRound='{{false}}'
    buttonIcon='far fa-edit'
    buttonSubmitName="Update Education"
passingData=""
custom=""
mydata='[{ name:"{{ $education->name }} }",{ position:"{{ $education->position }}" } ]'
xdata="
                pid:'{{ $education->id }}',
                sid:'education_{{ $education->id }}',
                name:'{{ $education->name }}',
                position:'{{ $education->position}}',
   "
xinit="

    name='{{ $education->name }}'
"
>

    <x-molecules.modal.content>
        {{--           NAME INPUT               --}}

        <x-atoms.bootstrap.input-text
            name="form.name"
            xdata="
                    label:'Education Name',
                    inputValue:'',
                    idName:'name',
                    inputValue:'',
                    entangleName:$wire.entangle('form.name'),
                    placeholder:'Enter a education'"
            xinit="inputValue='{{ $education->name }}'"
        >
        </x-atoms.bootstrap.input-text>


        {{--           POSITION INPUT               --}}

        <x-atoms.bootstrap.input-text
            name="form.position"
            xdata="
                    label:'Position',
                    inputValue:'',
                    idName:'position',
                    inputValue:'',
                    entangleName:$wire.entangle('form.position'),
                    placeholder:'Enter a position'"
            xinit="inputValue='{{ $education->position}}'"
        >
        </x-atoms.bootstrap.input-text>


    </x-molecules.modal.content>

</x-organisms.modal
>



