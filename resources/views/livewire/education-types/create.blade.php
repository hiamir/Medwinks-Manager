<x-organisms.modal
    showButton={{true}}
        name="education_type_create"
    type="add"
    id="0"
    size="xl"
    buttonName="Add Education Type"
    buttonColor='outline-primary'
    buttonRound='{{true}}'
    buttonIcon='fas fa-user-plus'
    buttonSubmitName="New Education Type"
    passingData=""
    custom=""
    xdata="
            pid:'0',
            sid:'0',
            name:'',
            acronym:'',
                education:'',
    "
    xinit="
        name=''
        "
>
    <x-molecules.modal.content>
        {{--           NAME INPUT               --}}

        <x-atoms.bootstrap.input-text
            name="form.name"
            xdata="
                    label:'Education name',
                    type:'text',
                    value:'',
                    name:'form.name',
                     label:'Education Name',
                      xdataName:'name',
                      xdata:name,
                    placeholder:'Enter a name for the education'
                ">

        </x-atoms.bootstrap.input-text>

        <x-atoms.bootstrap.input-text
            name="form.acronym"
            xdata="
                    label:'Give acronym for this Education',
                    type:'text',
                    value:'',
                    name:'form.acronym',
                      xdataName:'acronym',
                      xdata:acronym,
                    placeholder:'Enter acronym for this Education'
                ">

        </x-atoms.bootstrap.input-text>


        {{--           TYPE INPUT               --}}

        <x-atoms.bootstrap.input-select
            dataList="{!! $education_list !!}"
            name="form.education"
            xdata="
                            label:'Education Type',
                            placeholder:'Select Education Type',
                            name:'form.education',
                            xdataName:'education',
                            xdata:education"

        >
        </x-atoms.bootstrap.input-select>


    </x-molecules.modal.content>

</x-organisms.modal>
