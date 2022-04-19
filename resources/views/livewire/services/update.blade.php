<x-organisms.modal
showButton={{true}}
        name="service_update"
    type="edit"
    id="{{$service->id}}"
    size="xl"
    buttonName=""
    buttonColor='outline-primary'
    buttonRound='{{false}}'
    buttonIcon='far fa-edit'
    buttonSubmitName="Update Service"
passingData=""
custom=""
xdata="
                pid:'{{ $service->id }}',
                sid:'{{ $service->id }}',
                name:'{{ $service->name }}',
                description:'{{ $service->description }}',
"
>
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
                    placeholder:'Enter a service'"
            xinit="inputValue='{{ $service->name }}'"
        >
        </x-atoms.bootstrap.input-text>



        {{--          DESCRIPTION               --}}
        <x-atoms.bootstrap.input-text
            name="form.description"
            xdata="
                    label:'Description',
                    inputValue:'',
                    idName:'description',
                    inputValue:'',
                    entangleName:$wire.entangle('form.description'),
                    placeholder:'Enter a description'"
            xinit="inputValue='{{ $service->description }}'"
        >
        </x-atoms.bootstrap.input-text>


        <x-atoms.div class="row" custom="">
            <x-atoms.div class="col-12" custom="">
                <div class="input-checkbox"
                     x-data="{
                        selected:@entangle('selectedCheckbox'),

                }"
                >

                    @foreach($service_requirements as $requirement)
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="checkbox-{{$service->id}}-{{$requirement->id}}" value="{{$requirement->id}}"
                                   wire:model="selectedCheckbox"
                                   @change="
                                if($event.target.checked){
                                    selected.push({{$requirement->id}})
                                }else{
                                    const index = selected.indexOf({{$requirement->id}});
                                    if (index > -1) {
                                      selected.splice(index, 1);
                                    }
                                }"
                            >
                            <label class="form-check-label" for="checkbox-{{$service->id}}-{{$requirement->id}}">{{$requirement->name}}</label>
                        </div>
                    @endforeach
                    <label for="input-checkbox">Requirements</label>
                </div>
            </x-atoms.div>
        </x-atoms.div>



    </x-molecules.modal.content>

</x-organisms.modal
>



