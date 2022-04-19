<x-organisms.modal
    showButton={{true}}
        name="application_create"
    type="custom"
    id="0"
    size="xl"
    buttonName="Add application"
    buttonColor='outline-primary'
    buttonRound='{{true}}'
    buttonIcon='fas fa-user-plus'
    buttonSubmitName="New application"
    passingData=""
    custom=""
    xdata="
            pid:'0',
            sid:'0',

    "
>
    <x-molecules.modal.content>
        <div class="row p-2 justify-content-start align-items-center mx-0 border rounded-3 mt-2 mb-4 bg-light-primary">
            <div class="d-inline pt-3 pb-2 mb-1 border-bottom">
                @foreach($multiStep as $key=>$step)
                    @if($currentPage==$key)
                        <h6
                            class="font-bold text-primary pe-4 d-inline">{{App\Traits\Data::all_upper_case($step['heading'])}}</h6>
                    @else
                        <h6
                            class="font-bold text-gray-400 pe-4 d-inline">{{App\Traits\Data::all_upper_case($step['heading'])}}</h6>
                    @endif
                @endforeach
            </div>
            <div class="col-1 pe-0 pb-2 pt-2" style="max-width: 70px"><h4 class="text-gray-400 m-0 font-semibold">{{$currentPage+1}}/{{count($multiStep)}}</h4></div>
            <div class="col-11 ps-0">

                <h6 class="m-0 p-0 fw-normal">{{$multiStep[$currentPage]['subheading']}}</h6>

            </div>
        </div>

        @switch($currentPage)
            @case(0)

            <x-molecules.form.custom-form
                showButton={{true}}
                    id="{{$currentPage}}"
                name="application_service_create"
                buttonSubmitName="Submit Application"
                close="false"
                footerClass="d-none"
            >
                <x-atoms.bootstrap.input-select-livewire
                    dataList="{!! $serviceList !!}"
                    id="service_{{$currentPage}}"
                    label="Service"
                    placeholder="Select Service"
                    name="form.service"
                >
                </x-atoms.bootstrap.input-select-livewire>

                <div class="form-check form-check-inline d-flex justify-content-start align-items-center p-0 mt-3">
                    <input class="form-check-input d-flex m-0 p-0 me-2" type="checkbox" value="" id="terms_checkbox"
                           wire:model="terms">
                    <label class="form-check-label text-sm d-flex" for="inlineCheckbox1">I agree to&nbsp;
                        <x-atoms.modal.button
                            name="termsconditions"
                            type="edit"
                            id="0"
                            buttonName="terms & conditions"
                            buttonColor='btn btn-link p-0 font-semibold'
                            buttonIcon=''
                            custom=""
                        >
                        </x-atoms.modal.button>
                    </label>
                </div>
                @error('terms')
                <label for="0" class="text-"> <span class="text-danger text-xs">{{$message}}</span> </label>
                @enderror


                <x-atoms.div class="row" custom="">
                    <x-atoms.div class="col-12 pt-4 pb-3" custom="">
                        {{--                          @if($currentPage>0)  <button class="btn btn-secondary float-start" wire:click.prevent="previousButton">Back</button>@endif--}}
                        <button type="submit" class="btn btn-secondary float-end"
                                wire:key="application_service_create_modal_update_submit_spinner_0"
                        >Next
                        </button>
                    </x-atoms.div>
                </x-atoms.div>
            </x-molecules.form.custom-form>
            @break

            @case(1)
            <x-molecules.form.custom-form
                showButton={{true}}
                    id="{{$currentPage}}"
                name="application_passport_create"
                buttonSubmitName="Submit Passport"
                close="false"
                footerClass="d-none"
            >
                <x-atoms.bootstrap.input-select-livewire
                    dataList="{!! $passportList !!}"
                    id="passport_{{$currentPage}}"
                    label="Passport"
                    placeholder="Select Passport"
                    name="form.passport"
                >
                </x-atoms.bootstrap.input-select-livewire>


                <x-atoms.div class="row" custom="">
                    <x-atoms.div class="col-12 pt-4 pb-3" custom="">
                        <button class="btn btn-secondary float-start" wire:click.prevent="previousButton">Back
                        </button>
                        <button type="submit" class="btn btn-secondary float-end"
                                wire:key="application_passport_create_modal_update_submit_spinner_0">Next
                        </button>
                    </x-atoms.div>
                </x-atoms.div>

            </x-molecules.form.custom-form>
            @break



            @case(2)
            <x-molecules.form.custom-form
                showButton={{true}}
                    id="0"
                name="application_create"
                buttonSubmitName="Submit Application"
                close="false"
                footerClass="d-none"
            >
                <x-atoms.bootstrap.input-select-livewire
                    dataList="{!! $universityList !!}"
                    id="university_{{$currentPage}}"
                    label="University"
                    placeholder="Select University"
                    name="form.university"
                >
                </x-atoms.bootstrap.input-select-livewire>

                <x-atoms.div class="row" custom="">
                    <x-atoms.div class="col-12 pt-4 pb-3" custom="">
                        <button class="btn btn-secondary float-start" wire:click.prevent="previousButton">Back
                        </button>
                        <button type="submit" class="btn btn-secondary float-end"
                                wire:key="application_create_modal_update_submit_spinner_0">Next
                        </button>
                    </x-atoms.div>
                </x-atoms.div>
            </x-molecules.form.custom-form>
            @break

            @case(3)
            @isset($service_requirements)
                <x-atoms.div class="pt-3" custom="">
                    @if($documentError)
                        <div class="alert alert-danger" role="alert">
                            Please upload all documents!
                        </div>
                    @endif
                </x-atoms.div>

                <div class="row row-cols-1 row-cols-md-3 g-4 mt-1">


                    @forelse($service_requirements->service_requirements as $requirement)
                        <x-molecules.form.custom-form
                            showButton={{true}}
                                id="{{$requirement->id}}"
                            name="document_create"
                            buttonSubmitName="Add Image"
                            footerClass="d-none"
                        >
                            <x-atoms.div class="col my-2" custom="">
                                <x-molecules.bootstrap.card
                                    cardClass="bg-light-secondary shadow-sm border border-secondary border-1"
                                    size=""
                                    bodyClass="p-3"
                                    headerClass="bg-transparent border-bottom border-2 py-1 px-0 font-bold text-secondary}"
                                    headerText="{{$requirement->name}}"
                                    image=""
                                    imageClass=""
                                    imageAlt=""
                                    headingSize="h6"
                                    headingClass=""
                                    headingName=""
                                    headingIcon="fa-solid fa-circle-check"
                                    subHeadingSize=""
                                    subHeadingClass=""
                                    subHeadingName=""
                                    columnWidth="6"
                                    textClass="m-0 "
                                    footerClass="bg-transparent"
                                    footerText=""
                                    crudButtons=""
                                    crudButtonsHeader="false"
                                    cardList="false"
                                    equalHeight="true"
                                >
                                    @if($documents !=null)
                                        @if(count($documents->documents)>0)
                                            @if(in_array($requirement->id,json_decode($documents->documents->pluck('service_requirements_id'),true)))
                                                @foreach($documents->documents as $document)
                                                    @if($document->service_requirements_id ==$requirement->id)
                                                        <img src="{{$document->getFirstMedia('documents')->getUrl() }}"
                                                             class="img-fluid img-thumbnail mb-3" alt="">
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endif
                                    @endif
                                    <x-atoms.bootstrap.input
                                        {{--                                        wire:model="files.file_{{$requirement->id}}"--}}
                                        container=""
                                        id="{{$requirement->id}}"
                                        size=""
                                        name="files.file_{{$requirement->id}}"
                                        label=""
                                        type="file"
                                        placeholder="File"
                                        value=""
                                        debounce="150ms"
                                        lazy="{{false}}"
                                        defer="{{true}}"
                                        reference="file"
                                        iconLeft=""
                                        iconLeftFunction=""
                                        iconRight=""
                                        iconRightFunction=""
                                        inputClass="input_file"
                                        class="p-0"
                                        custom=""
                                        configDate="{}"
                                        configFile="{
                                                        name:'files.file_{{$requirement->id}}',
                                                        allowImagePreview:false,
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
                                                        labelIdle: 'Drag & Drop your picture or <span class=filepond--label-action>Browse</span>',
{{--                                                        imagePreviewHeight: 170,--}}
                                        {{--                                                        imageCropAspectRatio: '1:1',--}}
                                        {{--                                                        imageResizeTargetWidth: 100,--}}
                                        {{--                                                        imageResizeTargetHeight: 100,--}}
                                        {{--                                                        stylePanelLayout: 'compact circle',--}}
                                        {{--                                                        styleLoadIndicatorPosition: 'center bottom',--}}
                                        {{--                                                        styleProgressIndicatorPosition: 'right bottom',--}}
                                        {{--                                                        styleButtonRemoveItemPosition: 'left bottom',--}}
                                        {{--                                                        styleButtonProcessItemPosition: 'right bottom',--}}
                                            credits:{},
                        }"
                                    >
                                    </x-atoms.bootstrap.input>

                                    <x-atoms.div class="row pt-3 justify-content-center align-items-center"
                                                 custom="">
                                        <div
                                            class="col justify-content-center align-items-center text-center">
                                            <button type="submit"
                                                    class="btn btn-sm btn-secondary d-inline rounded-5 text-xs px-3 py-1">
                                                Add File
                                            </button>
                                        </div>
                                    </x-atoms.div>


                                </x-molecules.bootstrap.card>
                            </x-atoms.div>
                        </x-molecules.form.custom-form>
                    @empty
                        No data
                    @endforelse
                </div>
            @endif
            @if($application!=null)
                <x-molecules.form.custom-form
                    showButton={{true}}
                        id="{{$this->application->id}}"
                    name="document_created"
                    buttonSubmitName="Submit Application"
                    close="false"
                    footerClass="d-none"
                >

                    <x-atoms.div class="row" custom="">
                        <x-atoms.div class="col-12 pt-4 pb-3" custom="">
                            <button class="btn btn-secondary float-start" wire:click.prevent="previousButton">Back
                            </button>
                            <button type="submit" class="btn btn-secondary float-end"
                                    wire:key="application_create_modal_update_submit_spinner_0">Next
                            </button>
                        </x-atoms.div>
                    </x-atoms.div>
                </x-molecules.form.custom-form>
            @endif
            @break

            @case(4)
            <x-molecules.form.custom-form
                showButton={{true}}
                    id="0"
                name="application_finalize_submit"
                buttonSubmitName="Submit Application"
                close="false"
                footerClass="d-none"
            >
                <x-atoms.div class="bg-light p-3 mb-4 rounded-3 border" custom="">
                    <h6 class="text-danger fw-normal p-0 m-0"><i class="fa-solid fa-circle-exclamation"></i> Review your application carefully before you submit. Use the back button to go to the right section inorder to make changes!</h6>
                </x-atoms.div>

                <x-atoms.div class="row" custom="">
                    <x-atoms.div class="col-12 pt-4 pb-3" custom="">
                        <button class="btn btn-secondary float-start" wire:click.prevent="previousButton">Back
                        </button>
                        <button type="submit" class="btn btn-secondary float-end"
                                wire:key="application_create_modal_update_submit_spinner_0">Submit
                        </button>
                    </x-atoms.div>
                </x-atoms.div>
            </x-molecules.form.custom-form>
            @break

        @endswitch


    </x-molecules.modal.content>

</x-organisms.modal>


{{--           RESET PASSWORD MODAL               --}}
<x-organisms.modal
    showButton={{0}}
        name="termsconditions"
    type="custom"
    id="0"
    size="lg"
    buttonName="Terms & Conditions"
    buttonColor=''
    buttonIcon=''
    buttonSubmitName="Terms & Conditions"
    passingData=""
    custom=""
>
    <x-molecules.modal.content>
        <x-atoms.div class="" custom="">
            <h4 style="text-align: center;">TERMS AND CONDITIONS</h4>
            <ol>
                <li><strong>Introduction</strong></li>
            </ol>
            <p>The On Standard Terms and Conditions written on this webpage shall manage your use of On. These Terms
                will be applied fully and affect to your use of On. By using On, you agreed to accept all terms and
                conditions written in here. You must not use On if you disagree with any of the On Standard Terms and
                Conditions.</p>
            <p>Minors or people below 7 years old are not allowed to use On.</p>
            <ol start="2">
                <li><strong>Intellectual Property Rights</strong></li>
            </ol>
            <p>Other than the content you own, under these Terms, On and/or its licensors own all the intellectual
                property rights and materials contained in On.</p>
            <p>You are granted limited license only for purposes of viewing the material contained on On.</p>
            <ol start="3">
                <li><strong>Restrictions</strong></li>
            </ol>
            <p>You are specifically restricted from all of the following</p>
            <ul>
                <li>publishing any On material in any other media;</li>
                <li>selling, sublicensing and/or otherwise commercializing any On material;</li>
                <li>publicly performing and/or showing any On material;</li>
                <li>using On in any way that is or may be damaging to On;</li>
                <li>using On in any way that impacts user access to On;</li>
                <li>using On contrary to applicable laws and regulations, or in any way may cause harm to On, or to any
                    person or business entity;
                </li>
                <li>engaging in any data mining, data harvesting, data extracting or any other similar activity in
                    relation to On;
                </li>
                <li>using On to engage in any advertising or marketing.</li>
            </ul>
            <p>Certain areas of On are restricted from being access by you and On may further restrict access by you to
                any areas of On, at any time, in absolute discretion. Any user ID and password you may have for On are
                confidential and you must maintain confidentiality as well.</p>
            <ol start="4">
                <li><strong>Your Content</strong></li>
            </ol>
            <p>In these On Standard Terms and Conditions, “Your Content” shall mean any audio, video text, images or
                other material you choose to display on On. By displaying Your Content, you grant On a non-exclusive,
                worldwide irrevocable, sub licensable license to use, reproduce, adapt, publish, translate and
                distribute it in any and all media.</p>
            <p>Your Content must be your own and must not be invading any third-party’s rights. On reserves the right to
                remove any of Your Content from On at any time without notice.</p>
            <ol start="5">
                <li><strong>No warranties</strong></li>
            </ol>
            <p>On is provided “as is,” with all faults, and On express no representations or warranties, of any kind
                related to On or the materials contained on On. Also, nothing contained on On shall be interpreted as
                advising you.</p>
            <ol start="6">
                <li><strong>Limitation of liability</strong></li>
            </ol>
            <p>In no event shall On, nor any of its officers, directors and employees, shall be held liable for anything
                arising out of or in any way connected with your use of On whether such liability is under contract.
                &nbsp;On, including its officers, directors and employees shall not be held liable for any indirect,
                consequential or special liability arising out of or in any way related to your use of On.</p>
            <ol start="7">
                <li><strong>Indemnification</strong></li>
            </ol>
            <p>You hereby indemnify to the fullest extent On from and against any and/or all liabilities, costs,
                demands, causes of action, damages and expenses arising in any way related to your breach of any of the
                provisions of these Terms.</p>
            <ol start="8">
                <li><strong>Severability</strong></li>
            </ol>
            <p>If any provision of these Terms is found to be invalid under any applicable law, such provisions shall be
                deleted without affecting the remaining provisions herein.</p>
            <ol start="9">
                <li><strong>Variation of Terms</strong></li>
            </ol>
            <p>On is permitted to revise these Terms at any time as it sees fit, and by using On you are expected to
                review these Terms on a regular basis.</p>
            <ol start="10">
                <li><strong>Assignment</strong></li>
            </ol>
            <p>On is allowed to assign, transfer, and subcontract its rights and/or obligations under these Terms
                without any notification. However, you are not allowed to assign, transfer, or subcontract any of your
                rights and/or obligations under these Terms.</p>
            <ol start="11">
                <li><strong>Entire Agreement</strong></li>
            </ol>
            <p>These Terms constitute the entire agreement between On and you in relation to your use of On, and
                supersede all prior agreements and understandings.</p>
            <ol start="12">
                <li><strong>Governing Law &amp; Jurisdiction</strong></li>
            </ol>
            <p>These Terms will be governed by and interpreted in accordance with the laws of Hong Kong, and you submit
                to the non-exclusive jurisdiction of the state and federal courts located in Hong Kong for the
                resolution of any disputes.</p>
        </x-atoms.div>


    </x-molecules.modal.content>
</x-organisms.modal>
