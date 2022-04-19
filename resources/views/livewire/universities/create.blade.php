<x-organisms.modal
    showButton={{true}}
    name="university_create"
    type="add"
    id="0"
    size="xl"
    buttonName="Add University"
    buttonColor='outline-primary'
    buttonRound='{{true}}'
    buttonIcon='fas fa-user-plus'
    buttonSubmitName="New University"
    passingData=""
    custom=""
    xdata="
            pid:'0',
            sid:'0',
            name:'',
            code:''
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
            xinit="inputValue=''"
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
            xinit="inputValue=''"
        >
        </x-atoms.bootstrap.input-text>

    </x-molecules.modal.content>

</x-organisms.modal>
