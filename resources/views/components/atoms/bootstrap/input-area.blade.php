<div class="form-floating mb-3 floating-label"
     x-data="{
            {{$xdata}},
            reset:false,
            generateID(){
                return this.xdataName+'_'+pid+'_'+sid;
            }
         }"
     x-init="
{{--     @this.on('notify-error')--}}
         $refs.input.focus();
         $watch('reset',(value)=>{
              if(reset){
{{--               console.log(reset)--}}
         xdata='';
         $refs.input.focus()
         reset=false;
     }
})"
>

    <textarea
        x-ref="input"
        type="text"
        class="form-control"
        x-model="xdata"
        x-bind:style="'height:'+height+';'"
        x-bind:id="generateID"
        x-bind:placeholder="placeholder"
        wire:model="{{$name}}"
        x-on:blur="$dispatch('input', xdata);"
    >
    </textarea>
    <span class="reset-icon" x-on:click="reset=true" ><i class="fas fa-times-circle"></i></span>

    @error($name)
        <label :for="generateID" class="text-"><span class="font-semibold  text-xs" x-text="label"></span> - <span class="text-danger text-xs">{{$message}}</span> </label>
    @else
        <label :for="generateID" class="text-"><span class="font-semibold" x-text="label"></span></label>
        @enderror

</div>
