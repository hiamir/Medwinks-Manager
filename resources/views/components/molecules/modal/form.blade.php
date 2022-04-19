<form
    x-data="{modelframe:''}"
    @modelframe.window="modelframe=$event.detail.value"
    x-init= "console.log(modelframe);"

    wire:submit.prevent="{{$wireSubmitPrevent}}" enctype="multipart/form-data" novalidate class="{{$class}}">
    {{$slot}}
</form>
