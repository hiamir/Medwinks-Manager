<form  action="{{$action}}" method="{{$method}}" wire:submit.prevent="{{$submit}}" >̵
    <div class="modal-body text-left">
       {{$slot}}
    </div>
</form>
