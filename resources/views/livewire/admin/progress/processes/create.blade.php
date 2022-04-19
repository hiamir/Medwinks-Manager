<x-organisms.modal
    showButton={{true}}
        name="process_create"
    type="add"
    id="0"
    size="xl"
    buttonName="Add Process"
    buttonColor='outline-primary'
    buttonRound='{{true}}'
    buttonIcon='fas fa-user-plus'
    buttonSubmitName="New Process"
    passingData=""
    custom=""
    xdata="
            pid:'process',
            sid:'0',
            name:'',
            reference:''
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
            xinit="inputValue=''"
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
                    placeholder:'Enter a name for the process',
                    entangleName:$wire.entangle('form.reference')

              "
            xinit="inputValue=''"
        >
        </x-atoms.bootstrap.input-text>

    </x-molecules.modal.content>

</x-organisms.modal>
