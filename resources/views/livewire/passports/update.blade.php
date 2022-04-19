<x-organisms.modal
    showButton={{true}}
        name="passport_update"
    type="edit"
    id="{{$passport->id}}"
    size="xl"
    buttonName=""
    buttonColor='outline-primary'
    buttonTextColor=""
    buttonRound='{{false}}'
    buttonWidth="w-auto"
    buttonClass="px-2 text-primary"
    buttonIcon="far fa-edit"
    :buttonDisabled="$disabled"
    buttonSubmitName="Update {{$passport->passport_number}}"
    passingData=""
    custom=""
    xdata="
                pid:'{{ $passport->id }}',
                sid:'{{ $passport->id }}',
                passport_number:'{{ $passport->passport_number }}',
                given_name:'{{ $passport->given_name }}',
                sur_name:'{{ $passport->sur_name }}',
                date_of_birth:'{{ $passport->date_of_birth }}',
                issue_date:'{{ $passport->issue_date }}',
                expiry_date:'{{ $passport->expiry_date }}',
                country:'{{ $passport->countries_id }}',
                region:'{{ $passport->regions_id }}'
            "

>

    <x-molecules.modal.content class="p-4 pb-0">

        <x-atoms.bootstrap.input-text
            name="form.passport_number"
            xdata="
                    label:'Passport Number',
                    inputValue:'',
                    idName:'passport_number',
                    inputValue:'',
                    entangleName:$wire.entangle('form.passport_number'),
                    placeholder:'Enter a your passport number'"
            xinit="inputValue='{{ $passport->passport_number }}'"
        >
        </x-atoms.bootstrap.input-text>

        <x-atoms.div class="row" custom="">
            <x-atoms.div class="col-6" custom="">
                <x-atoms.bootstrap.input-text
                    name="form.given_name"
                    xdata="
                    label:'Given Name',
                    inputValue:'',
                    idName:'given_name',
                    inputValue:'',
                    entangleName:$wire.entangle('form.given_name'),
                    placeholder:'Enter your given name'"
                    xinit="inputValue='{{ $passport->given_name }}'"
                >
                </x-atoms.bootstrap.input-text>
            </x-atoms.div>

            <x-atoms.div class="col-6" custom="">
                <x-atoms.bootstrap.input-text
                    name="form.sur_name"
                    xdata="
                    label:'Sur Name',
                    inputValue:'',
                    idName:'sur_name',
                    inputValue:'',
                    entangleName:$wire.entangle('form.sur_name'),
                    placeholder:'Enter your sur name'"
                    xinit="inputValue='{{ $passport->sur_name }}'"
                >
                </x-atoms.bootstrap.input-text>
            </x-atoms.div>
        </x-atoms.div>

        <x-atoms.div class="row" custom="">
            <x-atoms.div class="col-4" custom="">
                <x-atoms.bootstrap.input-date
                    name="form.date_of_birth"

                    xdata="
                           label:'Date of Birth',
                            type:'date',
                            name:'form.date_of_birth',
                            xdataName:'date_of_birth',
                            xdata:date_of_birth,
                            placeholder:'Enter your Date of Birth'
                            "
                    config="{
                            altInput:false,
                            altFormat: 'F j, Y',
                            defaultDate:'',
                            dateFormat: 'F j, Y',
                            minDate: '',
                            maxDate: 'today',
                            firstDayOfWeek: 1,
                            }"
                >
                </x-atoms.bootstrap.input-date>
            </x-atoms.div>
            <x-atoms.div class="col-4" custom="">
                <x-atoms.bootstrap.input-date
                    name="form.issue_date"
                    xdata="
                           label:'Passport Issued Date',
                            type:'date',
                            name:'form.issue_date',
                            xdataName:'issue_date',
                            xdata:issue_date,
                            placeholder:'Enter passport issued date'
                            "
                    config="{
                            altInput:false,
                            defaultDate:'',
                            altFormat: 'F j, Y',
                            dateFormat: 'F j, Y',
                            minDate: '',
                            maxDate: 'today',
                            firstDayOfWeek: 1,
                        }"
                >
                </x-atoms.bootstrap.input-date>
            </x-atoms.div>

            <x-atoms.div class="col-4" custom="">
                <x-atoms.bootstrap.input-date
                    name="form.expiry_date"
                    xdata="
                           label:'Passport Expiry Date',
                            type:'date',
                            name:'form.expiry_date',
                            xdataName:'expiry_date',
                            xdata:expiry_date,
                            placeholder:'Enter passport expiry date'
                            "
                    config="{
                            altInput:false,
                            altFormat: 'F j, Y',
                            defaultDate:'',
                            dateFormat: 'F j, Y',
                            minDate: 'today',
                            maxDate: '',
                            firstDayOfWeek: 1,
                            }"
                >
                </x-atoms.bootstrap.input-date>
            </x-atoms.div>
        </x-atoms.div>

        <x-atoms.div class="row pb-3" custom="">
            <x-atoms.div class="col-6" custom="">

                <x-atoms.bootstrap.input-select
                    dataList="{!! $countryList !!}"
                    name="form.country"
                    xdata="
                            label:'Country',
                            placeholder:'Select Country',
                            name:'form.country',
                            xdataName:'country',
                            xdata:country"

                >
                </x-atoms.bootstrap.input-select>
            </x-atoms.div>

            <x-atoms.div class="col-6" custom="">
                <x-atoms.bootstrap.input-select
                    dataList="{!! $regionList !!}"
                    name="form.region"
                    xdata="
                            label:'Region',
                            placeholder:'Select Region',
                            name:'form.region',
                            xdataName:'region',
                            xdata:region">
                </x-atoms.bootstrap.input-select>
            </x-atoms.div>
        </x-atoms.div>
        {{--                   FILE INPUT--}}

        <x-atoms.div class="row" custom="">
            <x-atoms.div class="col-12" custom="">
                <x-atoms.bootstrap.input
                    wire:model="form.file"
                    container=""
                    id="file"
                    size=""
                    name="form.file"
                    label=""
                    type="file"
                    placeholder="Passport file"
                    value=""
                    debounce="150ms"
                    lazy="{{false}}"
                    defer="{{false}}"
                    reference="passport_file"
                    iconLeft=""
                    iconLeftFunction=""
                    iconRight=""
                    iconRightFunction=""
                    inputClass="input_file"
                    class="p-0"
                    custom=""
                    configDate="{}"
                    configFile="{
                allowImagePreview:true,
                imagePreviewHeight:'200px',
                imagePreviewMaxFileSize:'200kb',
                allowDrop:true,
                allowBrowse:true,
                allowPaste:true,
                allowMultiple: false,
                allowRevert:true,
                allowRemove:true,
                allowReplace:true,
                allowReorder: true,
                allowProcess:true,
                maxParallelUploads:3,
                checkValidity:false,
                acceptedFileTypes: ['image/png', 'image/jpeg'],
                maxFileSize: '500kb',
                allowImageCrop: true,
                allowImageResize: true,
                imageResizeMode:'contain',
                imageResizeTargetWidth: '1000px',
                imageResizeTargetHeight: '1000px',
                imageResizeUpscale:false,
                labelIdle:'<span class=text-xs text-bold>Drag and drop or  &nbsp; <span class=filepond--label-action>Browse</span>  &nbsp; to upload your Passport File <br><span class=subtext>Max file size: 500kb - Allowed file types: JPG, JPEG, PNG</span></span>',
                credits:{},
            }"
                >
                </x-atoms.bootstrap.input>
            </x-atoms.div>
        </x-atoms.div>

        <x-atoms.div class="row pb-4" custom="">
            <x-atoms.div class="col-12" custom="">


                <x-atoms.bootstrap.input-checkbox
                    name="form.active"
                    xdata="
                    label:'Active',
                    inputValue:'',
                    idName:'active',
                    entangleName:$wire.entangle('form.active'),
                    placeholder:'Check if you want to use this primary passport'"
                    xinit="inputValue=[{{$passport->active}}]"
                >
                </x-atoms.bootstrap.input-checkbox>



{{--                <div class="input-checkbox bg-light-primary"--}}
{{--                     id="checkboxDiv-{{$passport->id}}"--}}
{{--                     x-data="{--}}
{{--                     selected:''--}}
{{--                     }"--}}
{{--                     x-init="selected=[{{$passport->active}}]"--}}
{{--                >--}}

{{--                    <div class="form-check form-check-inline">--}}
{{--                        <input class="form-check-input" type="checkbox" id="checkbox-{{$passport->id}}"--}}
{{--                               value=1--}}
{{--                               x-model='selected'--}}
{{--                               wire:model="form.active"--}}
{{--                        >--}}
{{--                        <label class="form-check-label" for="checkbox-0">Check if you want to use this primary passport</label>--}}
{{--                    </div>--}}

{{--                    <label for="input-checkbox">Active</label>--}}
{{--                </div>--}}


            </x-atoms.div>
        </x-atoms.div>

    </x-molecules.modal.content>

</x-organisms.modal>

