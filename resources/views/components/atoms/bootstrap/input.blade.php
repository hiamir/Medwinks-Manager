<x-molecules.bootstrap.container  class="{{$class}}"   fluid="{{false}}" custom="" >
    <x-atoms.modal.formgroup size="{{$size}}" icon="{{$icon}}">
        @if($label != null)
            <x-atoms.modal.label
                labelFor={{$name}}_input_{{$id}}
                    labelName="{{$label}}">
            </x-atoms.modal.label>
        @endif

            <div class="input-group"
                 wire:ignore
                x-data="{}"


                 @if($type=='flatpickr')
                    x-init='()=>{
                    const flat=flatpickr($refs.input, {{$configDate}});
                 }'
                 @endif

                @if($type=='file')
                     x-data="{
                     }"
                 x-init="() => {

 const Pond = FilePond.create($refs.input, {{$configFile}} );

     function configFilePond() {
                Pond.setOptions({
                        server: {
                            process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                                @this.upload('{{ $name }}', file, load, error, progress)
                            },
                            revert: (uniqueFileId, load, error) => {
                                @this.removeUpload('{{ $name }}', uniqueFileId, load)
                            },
                            load: (source, load, error, progress, abort, headers) => {
                                var request = new Request(source);
                                fetch(request).then(function(response) {
                                  response.blob().then(function(myBlob) {
                                    load(myBlob)
                                  });
                                });
                            },
                        },
                        fileRenameFunction: (file) => {
                                return `my_new_name${file.extension}`;
                            },
                    });

                     FilePond.registerPlugin(
                   FilePondPluginFileValidateType,
                   FilePondPluginFileValidateSize,
                   FilePondPluginImageExifOrientation,
                    FilePondPluginFilePoster,
                    FilePondPluginFileRename,
                    FilePondPluginImagePreview,
                   FilePondPluginImageResize,

      );
   }
configFilePond();
                        window.addEventListener('pondReset', e => {
                            Pond.removeFiles();
                        });
                        } "



{{--                    FilePond.registerPlugin(FilePondPluginFileEncode);--}}
{{--                    FilePond.registerPlugin(FilePondPluginFileValidateType);--}}
{{--                    FilePond.registerPlugin(FilePondPluginFileValidateSize);--}}
{{--                    FilePond.registerPlugin(FilePondPluginImageExifOrientation);--}}
{{--                    FilePond.registerPlugin(FilePondPluginFilePoster);--}}
{{--                    FilePond.registerPlugin(FilePondPluginFileRename);--}}
{{--                    FilePond.registerPlugin(FilePondPluginImagePreview);--}}
{{--                    FilePond.registerPlugin(FilePondPluginImageResize);--}}
{{--                     FilePond.registerPlugin(FilePondPluginImageTransform);--}}
{{--                      FilePond.registerPlugin(FilePondPluginImageCrop);--}}
{{--                      FilePond.registerPlugin(FilePondPluginImageEdit);--}}

{{--                pond = FilePond.create($refs.input, {{$configFile}} );--}}

{{--                    pond.setOptions({--}}
{{--                        server: {--}}
{{--                            process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) => {--}}
{{--                                @this.upload('{{ $name }}', file, load, error, progress)--}}
{{--                            },--}}
{{--                            revert: (uniqueFileId, load, error) => {--}}
{{--                                @this.removeUpload('{{ $name }}', uniqueFileId, load)--}}
{{--                            },--}}
{{--                            load: (source, load, error, progress, abort, headers) => {--}}
{{--                                var request = new Request(source);--}}
{{--                                fetch(request).then(function(response) {--}}
{{--                                  response.blob().then(function(myBlob) {--}}
{{--                                    load(myBlob)--}}
{{--                                  });--}}
{{--                                });--}}
{{--                            },--}}
{{--                        },--}}

{{--                    });--}}
{{--                 const Pond = FilePond.create($refs.input, {{$configFile}} );--}}

{{--                        window.addEventListener('pondReset', e => {--}}
{{--                            Pond.removeFiles();--}}
{{--                        });--}}
{{--        "--}}
                @endif

            >
                @if($iconLeft!='' || $iconLeft!=null)
                <div class="input-group-prepend
                     @if($iconLeftFunction) cursor_pointer" wire:click="{{$iconLeftFunction}}" @else" @endif
                >
                    <span class="input-group-text h-100 d-inline-block rounded-0 rounded-start" id="inputGroupPrepend"><i class="{{$iconLeft}}"></i></span>
                </div>
                @endif
                <input

                    @if(!empty($debounce) )

                    wire:model.dirty.debounce.{{$debounce}}='{{$name}}'

                    @elseif($debounce ==='' && $lazy && !$defer )

                    wire:model.dirty.lazy='{{$name}}'

                    @elseif($debounce ==='' && !$lazy && $defer )

                    wire:model.dirty.defer ='{{$name}}'

                    @else

                    wire:model.dirty.lazy ='{{$name}}'

                    @endif
                    wire:model="data"

                    wire:key="{{$name}}_input_key_{{$id}}"
                    {{$custom}}
                    type="{{$type}}"
                    placeholder="{{$placeholder}}"

                    x-ref=input

                    id="{{$name}}_input_{{$id}}"
                    name="filepond"
                    class="form-control @if($type=='flatpickr') inputDate @endif @if($type=='file') filepond rounded-0 @endif @if($iconLeft!='' || $iconLeft!=null && $type!='file') rounded-end @elseif($iconRight!='' || $iconRight!=null && $type!='file') rounded-start @elseif($type=='file') rounded-0 border-0 @else rounded @endif px-3"
                    aria-describedby="{{$name}}_input_{{$id}}"
                    >
                    @if($iconRight!='' || $iconRight!=null) <div class="input-group-prepend @if($iconRightFunction) cursor_pointer" wire:click="{{$iconRightFunction}}('{{$name}}')" @else"  @endif >
                            <span
                                class="input-group-text h-100 d-inline-block rounded-0 rounded-end"
                                id="inputGroupPrepend">
                                <i class="{{$iconRight}}"></i>
                            </span>
                        </div>
                    @endif
            </div>


    </x-atoms.modal.formgroup>
    @if($showError==true)
    <x-atoms.modal.inputError input="{{$name}}"/>
    @endif
    {{$slot}}
</x-molecules.bootstrap.container>


