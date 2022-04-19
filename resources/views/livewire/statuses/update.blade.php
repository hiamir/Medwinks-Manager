<x-organisms.modal
showButton={{true}}
        name="status_update"
    type="edit"
    id="{{$status->id}}"
    size="xl"
    buttonName=""
    buttonColor='outline-primary'
    buttonRound='{{false}}'
    buttonIcon='far fa-edit'
    buttonSubmitName="Update University"
passingData=""
custom=""
xdata="
                pid:'{{ $status->id }}',
                sid:'{{ $status->id }}',
                name:'{{$status->name}}',
                reference:'{{$status->reference}}',
                model:'{{$status->models_id}}'

"
>
    <x-molecules.modal.content>
        {{--           NAME INPUT               --}}

        <x-molecules.modal.content>
            {{--           NAME INPUT               --}}

            <x-atoms.bootstrap.input-text
                name="form.name"
                xdata="
                    label:'Name',
                    inputValue:'',
                    idName:'name',
                    inputValue:'',
                    entangleName:$wire.entangle('form.name'),
                    placeholder:'Enter a Status'"
                xinit="inputValue='{{$status->name}}'"
            >
            </x-atoms.bootstrap.input-text>


            {{--          code               --}}
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

            <x-atoms.bootstrap.input-text
                name="form.icon"
                xdata="
                    label:'Icon',
                    inputValue:'',
                    idName:'icon',
                    inputValue:'',
                    entangleName:$wire.entangle('form.icon'),
                    placeholder:'Enter a Icon'"
                xinit="inputValue=''"
            >
            </x-atoms.bootstrap.input-text>

        </x-molecules.modal.content>

    </x-molecules.modal.content>

</x-organisms.modal
>



