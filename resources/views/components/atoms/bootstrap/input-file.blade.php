<div class="m-0">
<div class="form-floating  mt-3 floating-label"
     wire:ignore
     x-data="{Pond,
      {{$xdata}},
            reset:false,
            generateID(){
                return this.xdataName+'_'+pid+'_'+sid;
            }
     }"

     x-init="() => {


     function configFilePond() {

       FilePond.setOptions({
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




{{--                   FilePond.registerPlugin(FilePondPluginFileEncode);--}}
{{--                    FilePond.registerPlugin(FilePondPluginFileValidateType);--}}
{{--                    FilePond.registerPlugin(FilePondPluginFileValidateSize);--}}
{{--                    FilePond.registerPlugin(FilePondPluginImageExifOrientation);--}}
{{--                    FilePond.registerPlugin(FilePondPluginFilePoster);--}}
{{--                    FilePond.registerPlugin(FilePondPluginFileRename);--}}
{{--                    FilePond.registerPlugin(FilePondPluginImagePreview);--}}
{{--                    FilePond.registerPlugin(FilePondPluginImageResize);--}}
{{--                    FilePond.setOptions({--}}
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
{{--                        fileRenameFunction: (file) => {--}}
{{--                                return `my_new_name${file.extension}`;--}}
{{--                            },--}}
{{--                    });--}}
                        const Pond = FilePond.create($refs.input, {{$configFile}} );

                        window.addEventListener('pondReset', e => {
                            Pond.removeFiles();
                        });
        "
>
    <span x-text="validationError"></span>

    <input
        x-ref="input"
        type="text"
        x-bind:id="this.generateID"
        wire:model="{{$name}}"
    >
    <span x-text="validationError"></span>
    <label :for="generateID" class="pt-1 text-"><span class="font-semibold text-gray-500 text-sm" x-text="label"></span></label>
</div>
@error($name)
<span style="top:-1rem;" class="position-relative text-"><span class="text-danger text-xs">{{$message}}</span>
@enderror
</div>
