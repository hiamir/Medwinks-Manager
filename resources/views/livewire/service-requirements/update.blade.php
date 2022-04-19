<x-organisms.modal
showButton={{true}}
        name="service_requirement_update"
    type="edit"
    id="{{$requirement->id}}"
    size="xl"
    buttonName=""
    buttonColor='outline-primary'
    buttonRound='{{false}}'
    buttonIcon='far fa-edit'
    buttonSubmitName="Update Service Requirement"
passingData=""
custom=""
xdata="
                pid:'{{ $requirement->id }}',
                sid:'{{ $requirement->id }}',
                name:'{{ $requirement->name }}',
                description:'{{ $requirement->description }}',
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
            xinit="inputValue='{{ $requirement->name }}'"
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



