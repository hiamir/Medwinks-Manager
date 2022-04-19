<div
    @if($fluid)
    class="container-fluid {{$class}}"
    @else
    class="container {{$class}}"
    @endif
    {{$custom}} >
    {{$slot}}
</div>
