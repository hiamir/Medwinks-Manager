<x-organisms.modal
showButton={{true}}
        name="model_update"
    type="edit"
    id="{{$model->id}}"
    size="xl"
    buttonName=""
    buttonColor='outline-primary'
    buttonRound='{{false}}'
    buttonIcon='far fa-edit'
    buttonSubmitName="Update Model"
passingData=""
custom=""
xdata="
                pid:'{{ $model->id }}',
                sid:'{{ $model->id }}',
"
>
    <x-molecules.modal.content>
        {{--           NAME INPUT               --}}

            <x-atoms.bootstrap.input-text
                name="form.name"
                xdata="
                    label:'Model',
                    inputValue:'',
                    idName:'name',
                    inputValue:'',
                    entangleName:$wire.entangle('form.name'),
                    placeholder:'Enter a Model Name'"
                xinit="inputValue='{{$model->name}}'"
            >
            </x-atoms.bootstrap.input-text>



    </x-molecules.modal.content>

</x-organisms.modal
>



