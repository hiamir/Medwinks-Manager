@if($showButton)
    <x-atoms.modal.button
        name="{{$name}}"
        type="{{$type}}"
        id="{{$id}}"
        buttonName="{{$buttonName}}"
        buttonColor='{{$buttonColor}}'
        buttonTextColor='{{$buttonTextColor}}'
        buttonIcon='{{$buttonIcon}}'
        buttonRound='{{$buttonRound}}'
        buttonWidth='{{$buttonWidth}}'
        buttonClass='{{$buttonClass}}'
        passingData="{{$passingData}}"
        buttonDisabled="{{$buttonDisabled}}"
        custom='{{$custom}}'
        xdata='{{$xdata}}'
    >
    </x-atoms.modal.button>
@endif




@if($type=='add')

    <div wire:ignore.self class="modal text-left @if(!$showButton)secondModal @endif"
         id="{{$name}}_modal_{{$id}}" data-bs-backdrop="static"
         data-bs-keyboard="false" tabindex="-1" aria-labelledby="{{$name}}_modal_label" aria-hidden="true"
         style="display: none;">

        <div class="modal-{{$size}} modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content" x-data="{ {{$xdata}} }" x-init="{{$xinit}}">
                <div class="modal-header px-4">
                    <h4 class="modal-title" id="{{$name}}_modal">{{$buttonSubmitName}}</h4>
                    <button
                        x-data="{}"
                        @click="$dispatch('modelframe',{value:'close'})"
                        wire:click="modalClose('{{$name}}_modal_{{$id}}')"
                        type="button" class="close pe-0" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x-lg text-lg"></i>
                    </button>
                </div>


                <x-molecules.modal.form
                    wireSubmitPrevent="submit_{{($name)}}({{$id}},'{{$name}}_modal_{{$id}}')" class="{{$scroll}}">
                    {{$slot}}
                    <x-molecules.modal.footer class="p-4">

                        <button
                            x-data="{}"
                            @click="$dispatch('modelframe',{value:'close'})"
                            wire:click="modalClose('{{$name}}_modal_{{$id}}')" type="button"
                            class="btn btn-light-secondary">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>

                        <button
                            x-data="{}"
                            @click="modelframe='submitCreate'"
                            wire:key="{{$name}}_modal_create_submit-key-{{$id}}"
                            type="submit"
                            class="submit-button-spinner btn btn-primary me-1"
                        >
                                            <span
                                                wire:loading class="spinner spinner-grow spinner-grow-sm"
                                                wire:target="submit_{{($name)}}({{$id}},'{{$name}}_modal_{{$id}}')"
                                                wire:key="{{$name}}_modal_create_submit_spinner_{{$id}}"
                                                wire:loading.delay
                                                role="status"
                                                aria-hidden="true"></span>
                            {{$buttonSubmitName}}
                        </button>

                    </x-molecules.modal.footer>
                </x-molecules.modal.form>
            </div>
        </div>
    </div>


@elseif($type=='edit')

    <div


        wire:ignore.self class="modal text-left @if(!$showButton)secondModal @endif"
        id="{{$name}}_modal_{{$id}}" data-bs-backdrop="static"
        data-bs-keyboard="false" tabindex="-1" aria-labelledby="{{$name}}_modal_label_{{$id}}"
        aria-hidden="true"
        style="display: none;">


        <div class="modal-{{$size}} modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content" x-data="{ {{$xdata}} }" x-init="{{$xinit}}">
                <div class="modal-header px-4">
                    <h4 class="modal-title"
                        id="{{$name}}_modal_title_{{$id}}">{{$buttonSubmitName}}</h4>
                    <button
                        x-data="{}"
                        @click="$dispatch('modelframe',{value:'close'})"
                        wire:click="modalClose('{{$name}}_modal_{{$id}}')"
                        type="button" class="close pe-0" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x-lg text-lg"></i>
                    </button>
                </div>

                <x-molecules.modal.form wireSubmitPrevent="submit_{{($name)}}({{$id}},'{{$name}}_modal_{{$id}}')"
                                        class="{{$scroll}}">

                    {{$slot}}
                    <x-molecules.modal.footer>
                        <button
                            x-data="{}"
                            @click="modelframe='close'"
                            wire:click="modalClose('{{$name}}_modal_{{$id}}')" type="button"
                            class="btn btn-light-secondary">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>


                        <button
                            x-data="{}"
                            {{--                            @click="modelframe=false"--}}
                            @click="modelframe='submitChange'"
                            wire:key="{{$name}}_modal_update_submit-key-{{$id}}"
                            id="submit_{{($name)}}_{{$id}}"
                            type="submit"
                            class="submit-button-spinner btn btn-primary me-1"
                            {{--                            --}}
                        >
                                            <span
                                                wire:loading class="spinner spinner-grow spinner-grow-sm"
                                                wire:target="submit_{{($name)}}({{$id}},'{{$name}}_modal_{{$id}}')"
                                                wire:key="{{$name}}_modal_update_submit_spinner_{{$id}}"
                                                wire:loading.delay
                                                role="status"
                                                aria-hidden="true"></span>
                            {{$buttonSubmitName}}
                        </button>
                    </x-molecules.modal.footer>
                </x-molecules.modal.form>
            </div>
        </div>
    </div>

@elseif($type=='delete')

    <div wire:ignore.self class="modal text-left @if(!$showButton)secondModal @endif"
         id="{{$name}}_modal_{{$id}}" data-bs-backdrop="static"
         data-bs-keyboard="false" tabindex="-1"
         aria-labelledby="{{$name}}_modal_label_{{$id}}" aria-hidden="true"
         style="display: none;">


        <div class="modal-{{$size}} modal-dialog modal-dialog-centered modal-dialog-scrollable"
             role="document">
            <div class="modal-content  x-data="{{$xdata}}" x-init="{{$xinit}}">
            <div class="modal-header">
                <h4 class="modal-title"
                    id="{{$name}}_modal_title_{{$id}}">{{$buttonSubmitName}}</h4>
                <button
                    x-data="{}"
                    @click="$dispatch('modelframe',{value:'close'})"
                    wire:click="modalClose('{{$name}}_modal_{{$id}}')"
                    type="button" class="close  pe-0" data-bs-dismiss="modal"
                    aria-label="Close">
                    <i class="bi bi-x-lg text-lg"></i>
                </button>
            </div>

            <x-molecules.modal.form
                wireSubmitPrevent="submit_{{($name)}}({{$id}},'{{$name}}_modal_{{$id}}')" class="p-3 {{$scroll}}">
                {{$slot}}
                <x-molecules.modal.footer>
                    <button
                        @click="modelframe='close'"
                        wire:click="modalClose('{{$name}}_modal_{{$id}}')"
                        type="button"
                        class="btn btn-light-secondary">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>

                    <button
                        x-data="{}"
                        @click="modelframe='submitDelete'"
                        wire:key="{{$name}}_modal_delete_submit-key-{{$id}}"
                        type="submit"
                        class="submit-button-spinner btn btn-danger me-1"
                    >
                                        <span wire:loading class="spinner spinner-grow spinner-grow-sm"
                                              wire:target="submit_{{($name)}}({{$id}},'{{$name}}_modal_{{$id}}')"
                                              wire:key="{{$name}}_modal_delete_submit_spinner_{{$id}}" role="status"
                                              aria-hidden="true"></span>
                        {{$buttonSubmitName}}
                    </button>

                </x-molecules.modal.footer>
            </x-molecules.modal.form>
        </div>
    </div>
    </div>

@elseif($type=='twoforms')
    <div wire:ignore.self class="modal text-left @if(!$showButton)secondModal @endif"
         id="{{$name}}_modal_{{$id}}" data-bs-backdrop="static"
         data-bs-keyboard="false" tabindex="-1" aria-labelledby="{{$name}}_modal_label_{{$id}}"
         aria-hidden="true"
         style="display: none;">


        <div class="modal-{{$size}} modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content  x-data="{{$xdata}}">
            <div class="modal-header px-4">
                <h4 class="modal-title"
                    id="{{$name}}_modal_title_{{$id}}">{{$buttonSubmitName}}</h4>
                <button
                    x-data="{}"
                    @click="$dispatch('modelframe',{value:false})"
                    wire:click="modalClose('{{$name}}_modal_{{$id}}')"
                    type="button" class="close pe-0" data-bs-dismiss="modal" aria-label="Close">
                    <i class="bi bi-x-lg text-lg"></i>
                </button>
            </div>
            {{$slot}}
            <x-molecules.modal.form
                wireSubmitPrevent="submit_{{($name)}}({{$id}},'{{$name}}_modal_{{$id}}')" class="{{$scroll}}">

                <x-molecules.modal.footer>
                    <button
                        @click="modelframe='close'"
                        wire:click="modalClose('{{$name}}_modal_{{$id}}')" type="button"
                        class="btn btn-light-secondary">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>


                                        <button
                                            x-data="{}"
                                                                        @click="modelframe=false"
                                            wire:key="{{$name}}_modal_update_submit-key-{{$id}}"
                                            type="submit"
                                            class="submit-button-spinner btn btn-primary me-1"

                                        >
                                                                <span
                                                                    wire:loading class="spinner spinner-grow spinner-grow-sm"
                                                                    wire:target="submit_{{($name)}}({{$id}},'{{$name}}_modal_{{$id}}')"
                                                                    wire:key="{{$name}}_modal_update_submit_spinner_{{$id}}"
                                                                    wire:loading.delay
                                                                    role="status"
                                                                    aria-hidden="true"></span>
                                            {{$buttonSubmitName}}
                                        </button>

                </x-molecules.modal.footer>
            </x-molecules.modal.form>
        </div>
    </div>
    </div>

@elseif($type=='view')

    <div wire:ignore.self class="modal text-left @if(!$showButton)secondModal @endif"
         id="{{$name}}_modal_{{$id}}" data-bs-backdrop="static"
         data-bs-keyboard="false" tabindex="-1" aria-labelledby="{{$name}}_modal_label_{{$id}}"
         aria-hidden="true"
         style="display: none;">


        <div class="modal-{{$size}} modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content  x-data="{{$xdata}}">
            <div class="modal-header px-4">
                <h4 class="modal-title"
                    id="{{$name}}_modal_title_{{$id}}">{{$buttonSubmitName}}</h4>
                <button
                    x-data="{}"
                    @click="$dispatch('modelframe',{value:false})"
                    wire:click="modalClose('{{$name}}_modal_{{$id}}')"
                    type="button" class="close pe-0" data-bs-dismiss="modal" aria-label="Close">
                    <i class="bi bi-x-lg text-lg"></i>
                </button>
            </div>
            <x-molecules.modal.form
                wireSubmitPrevent="submit_{{($name)}}({{$id}},'{{$name}}_modal_{{$id}}')" class="{{$scroll}}">
                {{$slot}}
                <x-molecules.modal.footer>
                    <button
                        @click="modelframe='close'"
                        wire:click="modalClose('{{$name}}_modal_{{$id}}')" type="button"
                        class="btn btn-light-secondary">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>


{{--                    <button--}}
{{--                        x-data="{}"--}}
{{--                        --}}{{--                            @click="modelframe=false"--}}
{{--                        wire:key="{{$name}}_modal_update_submit-key-{{$id}}"--}}
{{--                        type="submit"--}}
{{--                        class="submit-button-spinner btn btn-primary me-1"--}}
{{--                        --}}{{--                            --}}
{{--                    >--}}
{{--                                            <span--}}
{{--                                                wire:loading class="spinner spinner-grow spinner-grow-sm"--}}
{{--                                                wire:target="submit_{{($name)}}({{$id}},'{{$name}}_modal_{{$id}}')"--}}
{{--                                                wire:key="{{$name}}_modal_update_submit_spinner_{{$id}}"--}}
{{--                                                wire:loading.delay--}}
{{--                                                role="status"--}}
{{--                                                aria-hidden="true"></span>--}}
{{--                        {{$buttonSubmitName}}--}}
{{--                    </button>--}}

                </x-molecules.modal.footer>
            </x-molecules.modal.form>
        </div>
    </div>
    </div>




@elseif($type=='image')
    <div wire:ignore.self class="modal text-left @if(!$showButton)secondModal @endif"
         id="{{$name}}_modal_{{$id}}" data-bs-backdrop="static"
         data-bs-keyboard="false" tabindex="-1"
         aria-labelledby="{{$name}}_modal_label_{{$id}}" aria-hidden="true"
         style="display: none;">


        <div class="modal-{{$size}} modal-dialog modal-dialog-centered modal-dialog-scrollable"
             role="document">
            <div class="modal-content" x-data="{ {{$xdata}} }">
                <div class="modal-header position-absolute w-100 border-0 px-4" style="z-index: 100">
                    <h5 class="modal-title text-black"
                        id="{{$name}}_modal_title_{{$id}}">{{$buttonSubmitName}}</h5>
                    <button
                        x-data="{}"
                        @click="$dispatch('modelframe',{value:'close'})"
                        wire:click="modalClose('{{$name}}_modal_{{$id}}')"
                        type="button" class="close  pe-0" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="bi bi-x-lg text-lg"></i>
                    </button>
                </div>
                {{$slot}}


                {{--                    <x-molecules.modal.footer>--}}
                {{--                        <button wire:click="modalClose('{{$name}}_modal_{{$id}}')"--}}
                {{--                                type="button"--}}
                {{--                                class="btn btn-light-secondary">--}}
                {{--                            <i class="bx bx-x d-block d-sm-none"></i>--}}
                {{--                            <span class="d-none d-sm-block">Close</span>--}}
                {{--                        </button>--}}
                {{--                    </x-molecules.modal.footer>--}}
            </div>
        </div>
    </div>
@elseif($type=='custom')

    <div wire:ignore.self class="modal text-left @if(!$showButton)secondModal @endif"
         id="{{$name}}_modal_{{$id}}" data-bs-backdrop="static"
         data-bs-keyboard="false" tabindex="-1" aria-labelledby="{{$name}}_modal_label" aria-hidden="true"
         style="display: none;">

        <div class="modal-{{$size}} modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content" x-data="{ {{$xdata}} }" x-init="{{$xinit}}">
                <div class="modal-header px-4">
                    <h4 class="modal-title" id="{{$name}}_modal">{{$buttonSubmitName}}</h4>
                    <button
                        x-data="{}"
                        @click="$dispatch('modelframe',{value:'close'})"
                        wire:click="modalClose('{{$name}}_modal_{{$id}}')"
                        type="button" class="close pe-0" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x-lg text-lg"></i>
                    </button>
                </div>

                {{$slot}}

            </div>
        </div>
    </div>
@endif
