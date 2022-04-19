
<x-organisms.modal

{{--    showButton={{true}}--}}
{{--        name="passport_create"--}}
{{--    type="add"--}}
{{--    :id="$passportUser->id"--}}
{{--    size="xl"--}}
{{--    buttonName=""--}}
{{--    buttonColor='outline-primary'--}}
{{--    buttonRound='{{false}}'--}}
{{--    buttonIcon='fas fa-plus'--}}
{{--    buttonSubmitName="New Passport"--}}
{{--    passingData=""--}}
{{--    custom="data-clear"--}}

    showButton={{true}}
        name="passport_create"
    type="add"
:id="$passportUser->id"
    size="xl"
    buttonName=""
    buttonColor='outline-success'
    buttonTextColor=""
    buttonRound='{{false}}'
    buttonWidth="w-auto"
    buttonClass="p-0 text-primary"
    buttonIcon="fas fa-plus"
    :buttonDisabled="$disabled"
    buttonSubmitName="New Passport"
    passingData=""
    custom="data-clear"
>
    <x-molecules.modal.content class="p-4 pb-0">
        {{--           PASSPORT NUMBER INPUT               --}}

        <x-atoms.bootstrap.input
            container=""
            id="0"
            size=""
            name="form.passport_number"
            label="Passport number"
            type="text"
            placeholder="Passport number"
            icon=""
            value=""
            reference="passport_number"
            debounce="150ms"
            lazy="{{false}}"
            defer="{{false}}"
            class=""
            custom=""
        >
        </x-atoms.bootstrap.input>


        <x-atoms.div class="row" custom="">

            <x-atoms.div class="col-6" custom="">
                {{--           GIVEN NAME INPUT               --}}

                <x-atoms.bootstrap.input
                    container=""
                    id="0"
                    size=""
                    name="form.given_name"
                    label="Given Name"
                    type="text"
                    placeholder="Your given name"
                    icon=""
                    value=""
                    reference="passport_number"
                    debounce="150ms"
                    lazy="{{false}}"
                    defer="{{false}}"
                    class=""
                    custom=""
                >
                </x-atoms.bootstrap.input>
            </x-atoms.div>

            <x-atoms.div class="col-6" custom="">
                {{--           SUR NAME  INPUT               --}}

                <x-atoms.bootstrap.input
                    container=""
                    id="0"
                    size=""
                    name="form.sur_name"
                    label="Sur Name"
                    type="text"
                    placeholder="Your sur name"
                    icon=""
                    value=""
                    reference="passport_number"
                    debounce="150ms"
                    lazy="{{false}}"
                    defer="{{false}}"
                    class=""
                    custom=""
                >
                </x-atoms.bootstrap.input>
            </x-atoms.div>
        </x-atoms.div>


        <x-atoms.div class="row" custom="">

            <x-atoms.div class="col-4" custom="">
                {{--          DOB INPUT               --}}

                <x-atoms.bootstrap.input
                    container=""
                    id="0"
                    size=""
                    name="form.date_of_birth"
                    label="Date of Birth"
                    type="flatpickr"
                    placeholder="Your date of birth"
                    value=""
                    debounce="150ms"
                    lazy="{{false}}"
                    defer="{{false}}"
                    reference="passport_date_of_birth"
                    iconLeft=""
                    iconLeftFunction=""
                    iconRight="far fa-calendar-alt"
                    iconRightFunction="file_right_icon"
                    inputClass="input_file"
                    class=""
                    custom=""
                    configDate="{
                        altInput: false,
                        altFormat: 'F j, Y',
                        defaultDate:'',
                        dateFormat: 'F j, Y',
                        minDate: '',
                        maxDate: 'today',
                        firstDayOfWeek: 1,
                        allowInput: false,
                        onOpen: function ( dateObj, dateStr, instance ) {
                         $(instance.altInput).prop('readonly', true);
                         $(instance.altFormat).prop('readonly', 'F j, Y');
{{--                        console.log(dateObj);--}}
{{--                        instance.set('altInput',true)--}}
{{--                             instance.setDate(new Date());--}}
{{--                            instance.clear();--}}
                    {{--                            instance.close();--}}

                        },
                    }"
                >
                </x-atoms.bootstrap.input>

            </x-atoms.div>


            <x-atoms.div class="col-4" custom="">
                {{--          ISSUE DATE INPUT               --}}

                <x-atoms.bootstrap.input
                    container=""
                    id="0"
                    size=""
                    name="form.issue_date"
                    label="Issue Date"
                    type="flatpickr"
                    placeholder="Your passport expiry date"
                    value=""
                    debounce="150ms"
                    lazy="{{false}}"
                    defer="{{false}}"
                    reference="passport_issued"
                    iconLeft=""
                    iconLeftFunction=""
                    iconRight="far fa-calendar-alt"
                    iconRightFunction="file_right_icon"
                    inputClass="input_file"
                    class=""
                    custom=""
                    configDate="{
                        altInput: false,
                        altFormat: 'F j, Y',
                        defaultDate:'',
                        dateFormat: 'F j, Y',
                        minDate: '',
                        maxDate: 'today',
                        firstDayOfWeek: 1,
                    }"
                >
                </x-atoms.bootstrap.input>
            </x-atoms.div>

            <x-atoms.div class="col-4" custom="">


                {{--          EXPIRY DATE INPUT               --}}

                <x-atoms.bootstrap.input
                    container=""
                    id="0"
                    size=""
                    name="form.expiry_date"
                    label="Expiry Date"
                    type="flatpickr"
                    placeholder="Your passport expiry date"
                    value=""
                    debounce="150ms"
                    lazy="{{false}}"
                    defer="{{false}}"
                    reference="passport_expiry"
                    iconLeft=""
                    iconLeftFunction=""
                    iconRight="far fa-calendar-alt"
                    iconRightFunction="file_right_icon"
                    inputClass="input_file"
                    class=""
                    custom=""
                    configDate="{
                        altInput: false,
                        altFormat: 'F j, Y',
                         defaultDate:'',
                        dateFormat: 'F j, Y',
                        minDate: 'today',
                        maxDate: '',
                        firstDayOfWeek: 1,
                    }"
                >
                </x-atoms.bootstrap.input>
            </x-atoms.div>
        </x-atoms.div>


        <x-atoms.div class="row" custom="">
            <x-atoms.div class="col-6" custom="">

                {{--           COUNTRY NAME  SELECT               --}}
                <x-atoms.bootstrap.select
                    id="0"
                    name="form.country"
                    class=""
                    label="Country"
                    placeholder="Select country"
                    firstvalue=""
                    :list="$countryList"
                >
                </x-atoms.bootstrap.select>
            </x-atoms.div>

            <x-atoms.div class="col-6" custom="">

                {{--           REGION NAME  SELECT               --}}
                <x-atoms.bootstrap.select
                    id="0"
                    name="form.region"
                    class=""
                    label="Region"
                    placeholder="Select region"
                    firstvalue=""
                    :list="$regionList"
                >
                </x-atoms.bootstrap.select>
            </x-atoms.div>
        </x-atoms.div>


        {{--           FILE INPUT               --}}

        <x-atoms.bootstrap.input
            wire:model="form.file"
            container=""
            id="file"
            size=""
            name="form.file"
            label="Passport file"
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
                allowFileRename:true,
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
                checkValidity:true,
                acceptedFileTypes: ['image/png', 'image/jpeg'],
                maxFileSize: '500kb',
                allowImageCrop: true,
                allowImageResize: true,
                imageResizeMode:'contain',
                imageResizeTargetWidth: '1000px',
                imageResizeTargetHeight: '1000px',
                imageResizeUpscale:false,
                credits:{},
            }"
        >
        </x-atoms.bootstrap.input>
    </x-molecules.modal.content>

</x-organisms.modal>



