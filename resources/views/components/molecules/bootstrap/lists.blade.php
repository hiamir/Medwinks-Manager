
{{--@if(isset($lists) && $displayList=='none')--}}
{{--    {{ dd($lists)}}--}}
{{--    <x-atoms.modal.inputError input="{{$name}}"/>--}}
{{--    @endif--}}
<div class="list-group position-absolute index w-{{$width}} d-{{$displayList}} shadow-sm rounded-5 " style="z-index:10;">
    @isset($lists)

        @error($error)
        <button type="button" class="list-group-item list-group-item-action bg-danger text-sm text-white ">
            <div class="row">
                <div class="col-11">
                    Available Permissions
{{--                    {{$message}}--}}
                </div>
                <div wire:click="listClose('display_{{$listName}}_list')" class="col-1"><i class="fas fa-times"></i></div>
            </div>

        </button>

        @enderror
    @if(is_array($lists))

            @forelse($lists as $list)
                <button wire:click={{$listName}}Select('{{$list[$name]}}') type="button" class="list-group-item list-group-item-action bg-light-{{$background}} text-sm">{{$list[$name]}}</button>
            @empty
                <button  type="button" class="list-group-item list-group-item-action bg-light-{{$background}} text-sm">Permissions unavailable</button>
            @endforelse

        @else

            @forelse($lists as $list)
                <button wire:click={{$listName}}Select('{{$list->$name}}') type="button" class="list-group-item list-group-item-action bg-light-{{$background}} text-sm">{{$list->$name}}</button>
            @empty
                <button  type="button" class="list-group-item list-group-item-action bg-light-{{$background}} text-sm">Permissions unavailable</button>
            @endforelse

        @endif

    @endisset
</div>
