<div class="m-0">
    <x-molecules.modal.form
        wireSubmitPrevent="submit_{{($name)}}({{$id}},'{{$name}}_modal_{{$id}}')" class="{{$scroll}} customForm">

        {{$slot}}

        <x-molecules.modal.footer class="{{$footerClass}}">

            <button
                x-data="{}"
                @click="$dispatch('modelframe',{value:'close'})"
                wire:click="modalClose('{{$name}}_modal_{{$id}}')" type="button"
                class="btn btn-light-secondary @if($close==false) d-none @endif">
                <i class="bx bx-x d-block d-sm-none"></i>
                <span class="d-none d-sm-block">Close</span>
            </button>

            <button
                x-data="{ {{$xdata}} }"
                x-init="{ {{$xinit}} }"
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
