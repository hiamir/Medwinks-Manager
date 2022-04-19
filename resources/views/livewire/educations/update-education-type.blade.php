<x-organisms.modal
showButton={{true}}
        name="education_type_update"
    type="edit"
    id="{{$education_type->id}}"
    size="xl"
    buttonName=""
    buttonColor='outline-primary'
    buttonRound='{{false}}'
    buttonIcon='far fa-edit'
    buttonSubmitName="Update {{$education_type->name}}"
passingData=""
custom=""
xdata="
                pid:'{{ $education->id }}',
                sid:'{{ $education_type->id }}',
                name:'{{ $education_type->name }}',
                buttonShow:false,
                acronym:'{{ $education_type->acronym }}',
                educationID:$wire.entangle('educationID')
"
xinit="educationID='{{$education->id}}'"
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
            xinit="inputValue='{{ $education_type->name }}'"
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
            xinit="inputValue='{{ $education_type->name }}'"
        >
        </x-atoms.bootstrap.input-text>


    </x-molecules.modal.content>

</x-organisms.modal>



