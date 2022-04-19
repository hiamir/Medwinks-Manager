<div>
    <li class="list-group-item

        @if($background!='')
            list-group-item-{{$background}}
        @else
        list-group-item
        @endif

        @if($action=='true')
            list-group-item-action
        @endif

        @if($active=='true')
            active
        @endif

        @if($disable=='true')
            disabled
        @endif

        @if($class!='')
            {{$class}}
        @endif


        ">

        {{$slot}}

        @if($bagText!="")
        <span class="badge
         @if($bagColor!='')
            bg-{{$bagColor}}
        @endif
        @if($bagRounded!='')
            rounded-pill
        @endif
        ">
           {{$bag}}
        </span>
        @endif
    </li>
</div>
