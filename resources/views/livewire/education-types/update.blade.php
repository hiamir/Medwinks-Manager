<x-organisms.modal
showButton={{true}}
        name="education_type_update"
    type="edit"
    id="{{$education_type->id}}"
    size="xl"
    buttonName=""
    buttonColor='outline-primary'
    buttonRound='{{false}}'
    buttonIcon='far fa-edit'
    buttonSubmitName="Update {{$education_type->name}}"
passingData=""
custom=""
xdata="
                pid:'{{ $education_type->id }}',
                sid:'{{ $education_type->id }}',
                name:'{{ $education_type->name }}',
                acronym:'{{ $education_type->acronym }}',
                education:'{{ $education_type->educations_id }}',
"
>
    <x-molecules.modal.content>
        {{--           NAME INPUT               --}}

        <x-atoms.bootstrap.input-text
            name="form.name"
            xdata="
                    label:'Service name',
                    type:'text',
                    value:'{{$education_type->name}}',
                    name:'form.name',
                     label:'Service Name',
                      xdataName:'name',
                      xdata:name,
                    placeholder:'Enter a name for the service'
                ">

        </x-atoms.bootstrap.input-text>


        {{--           ACRONYM INPUT               --}}

        <x-atoms.bootstrap.input-text
            name="form.acronym"
            xdata="
                    label:'Give acronym for this Education',
                    type:'text',
                    value:'',
                    name:'form.acronym',
                      xdataName:'acronym',
                      xdata:acronym,
                    placeholder:'Enter a name for the Education'
                ">

        </x-atoms.bootstrap.input-text>


        {{--           EDUCATION SELECT               --}}

        <x-atoms.bootstrap.input-select
            dataList="{!! $education_list !!}"
            name="form.education_type"
            xdata="
                            label:'Select Education',
                            placeholder:'Select Education',
                            name:'form.education',
                            xdataName:'education_type',
                            xdata:education"

        >
        </x-atoms.bootstrap.input-select>


    </x-molecules.modal.content>

</x-organisms.modal
>



