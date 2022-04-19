<x-organisms.modal
    showButton={{true}}
        name="education_create"
    type="add"
    id="0"
    size="xl"
    buttonName="Add Education"
    buttonColor='outline-primary'
    buttonRound='{{true}}'
    buttonIcon='fas fa-user-plus'
    buttonSubmitName="New Education"
    passingData=""
    custom=""
    xdata="
            pid:'0',
            sid:'0',
            name:'',
            position:''
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
            xinit="inputValue=''"
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
            xinit="inputValue=''"
        >
        </x-atoms.bootstrap.input-text>

    </x-molecules.modal.content>

</x-organisms.modal>
