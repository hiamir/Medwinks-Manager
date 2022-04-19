<x-organisms.modal
    showButton={{true}}
        name="service_requirement_create"
    type="add"
    id="0"
    size="xl"
    buttonName="Add Service Requirement"
    buttonColor='outline-primary'
    buttonRound='{{true}}'
    buttonIcon='fas fa-user-plus'
    buttonSubmitName="New Service Requirement"
    passingData=""
    custom=""
    xdata="
            pid:'0',
            sid:'0',
            name:'',
            description:''
    "
>
    <x-molecules.modal.content>
        {{--           NAME INPUT               --}}

        <x-atoms.bootstrap.input-text
            name="form.name"
            xdata="
                    label:'Service requirement Name',
                    inputValue:'',
                    idName:'name',
                    inputValue:'',
                    entangleName:$wire.entangle('form.name'),
                    placeholder:'Enter a service requirement'"
            xinit="inputValue=''"
        >
        </x-atoms.bootstrap.input-text>


        {{--          DESCRIPTION               --}}
        <x-atoms.bootstrap.input-area
            name="form.description"
            xdata="
                    label:'Service description',
                    type:'text',
                    value:'',
                    height:'100px',
                    name:'form.description',
                     label:'Service Description',
                      xdataName:'description',
                      xdata:description,
                    placeholder:'Enter a description for the service-requirement'
                ">

        </x-atoms.bootstrap.input-area>
    </x-molecules.modal.content>

</x-organisms.modal>
