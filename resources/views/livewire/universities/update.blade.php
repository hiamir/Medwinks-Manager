<x-organisms.modal
showButton={{true}}
        name="university_update"
    type="edit"
    id="{{$university->id}}"
    size="xl"
    buttonName=""
    buttonColor='outline-primary'
    buttonRound='{{false}}'
    buttonIcon='far fa-edit'
    buttonSubmitName="Update University"
passingData=""
custom=""
xdata="
                pid:'{{ $university->id }}',
                sid:'{{ $university->id }}',

"
>
    <x-molecules.modal.content>
        {{--           NAME INPUT               --}}


            <x-atoms.bootstrap.input-text
                name="form.name"
                xdata="
                    label:'University Name',
                    inputValue:'',
                    idName:'name',
                    inputValue:'',
                    entangleName:$wire.entangle('form.name'),
                    placeholder:'Enter a university'"
                xinit="inputValue='{{ $university->name }}'"
            >
            </x-atoms.bootstrap.input-text>


            {{--          code               --}}
            <x-atoms.bootstrap.input-text
                name="form.code"
                xdata="
                    label:'University code',
                    inputValue:'',
                    idName:'code',
                    inputValue:'',
                    entangleName:$wire.entangle('form.code'),
                    placeholder:'Enter a university'"
                xinit="inputValue='{{ $university->code }}'"
            >
            </x-atoms.bootstrap.input-text>



    </x-molecules.modal.content>

</x-organisms.modal
>


