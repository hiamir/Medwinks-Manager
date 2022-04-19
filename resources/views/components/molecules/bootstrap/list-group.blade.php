<div>
    @if($number=='true')
        <ol class="list-group list-group-numbered list-group-{{$flush}} {{$class}}">
            {{$slot}}
        </ol>
    @else
        <ul class="
        @if($flush==true)
            list-group list-group-flush
            @else
            list-group list-group
        @endif

        {{$class}}">
            {{$slot}}
        </ul>
        @endif

</div>
