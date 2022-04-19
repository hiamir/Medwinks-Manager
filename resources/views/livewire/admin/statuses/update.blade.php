<x-organisms.modal
    showButton={{true}}
        name="status_update"
    type="edit"
    id="{{$status->id}}"
    size="xl"
    buttonName=""
    buttonColor='outline-primary'
    buttonRound='{{true}}'
    buttonIcon='far fa-edit'
    buttonSubmitName="Update {{$status->name}}"
    passingData=""
    custom=""
    xdata="
            pid:'0',
            sid:'0',
            name:'{{$status->name}}',
            reference:'{{$status->reference}}',
            model:'{{$status->models_id}}',
    "
>
    <x-molecules.modal.content>
        <x-atoms.bootstrap.input-text
            name="form.name"
            xdata="
                    label:'Model',
                    inputValue:'',
                    idName:'name',
                    inputValue:'',
                    entangleName:$wire.entangle('form.name'),
                    placeholder:'Enter a Model Name'"
            xinit="inputValue='{{$status->name}}'"
        >
        </x-atoms.bootstrap.input-text>

        <x-atoms.bootstrap.input-text
            name="form.reference"
            xdata="
                    label:'Reference',
                    inputValue:'',
                    idName:'reference',
                    inputValue:'',
                    entangleName:$wire.entangle('form.reference'),
                    placeholder:'Enter a Model Reference'"
            xinit="inputValue='{{$status->reference}}'"
        >
        </x-atoms.bootstrap.input-text>

        <x-atoms.bootstrap.input-text
            name="form.icon"
            xdata="
                    label:'Icon',
                    inputValue:'',
                    idName:'icon',
                    inputValue:'',
                    entangleName:$wire.entangle('form.icon'),
                    placeholder:'Enter a Icon'"
            xinit="inputValue='{{$status->icon}}'"
        >
        </x-atoms.bootstrap.input-text>


        <x-atoms.bootstrap.input-select
            dataList="{!! $modelList !!}"
            name="form.model"
            xdata="
                            label:'Model',
                            placeholder:'Select Model',
                            name:'form.model',
                            xdataName:'model',
                            xdata:model"

        >
        </x-atoms.bootstrap.input-select>



    </x-molecules.modal.content>

</x-organisms.modal>
