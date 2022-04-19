{{--{{dd(json_decode($dataList))}}--}}
<div class="form-floating"

     x-data="{
 {{ $xdata }},
  xxdata:'',
        select:'',
        title: '',
        generateID(){
                return this.xdataName+'_'+pid+'_'+sid;
            }

    }"
     x-init="
      xxdata=xdata;


        $watch('xdata',(value)=>{
            $refs.select.focus();
        });
 $watch('modelframe',(value)=>{
            xdata= xxdata;
     });
"
     @notify.window='title = $event.detail'
>

    {{--    <div--}}
    {{--        x-data="{ title: 'Hello' }"--}}
    {{--        @set-title.window="title = $event.detail"--}}
    {{--    >--}}
    {{--        <h1 x-text="title" @click="$dispatch('set-title', 'Hello World!')"></h1>--}}
    {{--    </div>--}}


    <select

        x-ref="select"
        x-model="xdata"
        wire:loading.attr="disabled"
        wire:model="{{$name}}"
        x-bind:id="generateID"
        @change="$dispatch('notify', xdata)"
        x-on:blur="$dispatch('select', xdata);"
        class="form-select ">
        @if(json_decode($dataList)!= "")
            @if(count(json_decode($dataList))==0)
                <option value="" x-text="'No Data Available'"></option>
            @else
                <option value="" selected class="form-floating-label" x-text="placeholder"></option>
            @endif


{{--            <template x-for="(option, index) in {{$dataList}}" :key="index">--}}
{{--                <option--}}
{{--                    :key="option.id"--}}
{{--                    :value="option.id"--}}
{{--                    x-text="option.name"--}}
{{--                    :selected="option.id == xdata"--}}

{{--                ></option>--}}
{{--            </template>--}}

            @foreach(json_decode($dataList) as $value))

                    <option value="{{$value->id}}">{{$value->name}}</option>

                @endforeach


        @endif
    </select>



    @error($name)
    <label :for="generateID" class="text-"><span class="" x-text="label"></span> - <span class="text-danger text-xs">{{$message}}</span> </label>
    @else
        <label :for="generateID" class="text-"><span class="form-floating-label" x-text="label"></span></label>
        @enderror


        <div wire:loading.delay wire:target="{{$name}}">
            <div class="la-line-scale la-dark la-sm"> <div></div> <div></div> <div></div> <div></div> <div></div> </div>
        </div>

</div>
