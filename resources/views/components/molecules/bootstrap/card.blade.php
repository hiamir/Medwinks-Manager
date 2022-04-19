{{-- CARD --}}
<div class="card {{$cardClass}} @if($equalHeight=='true') h-100 @endif" style="width: {{$size}}">

    {{-- CARD BODY --}}
    <div class="card-body {{$bodyClass}}">

        {{-- CARD HEADER --}}
        @if($headerText != null)
            <x-atoms.div class="card-header {{$headerClass}}" custom="">
                <x-atoms.div class="row" custom="">
                    <x-atoms.div class="col-8" custom="">
                        @if($headingIcon !=null || $headingIcon !='')<i class="{{$headingIcon}}"></i>@endif {{$headerText}}
                    </x-atoms.div>
                    <x-atoms.div class="col-4 text-right" custom="">
                       @if($crudButtonsHeader=='true')
                           {{$header_update_delete_buttons}}
                           @endif
                    </x-atoms.div>
                </x-atoms.div>

            </x-atoms.div>
        @endif

        {{-- CARD IMAGE --}}
        @if($image != null)
            <img src="{{$image}}" class="card-img-top {{$imageClass}}" alt="{{$imageAlt}}">
        @endif


        {{-- HEADING--}}
        <x-atoms.div class="row" custom="">
            <x-atoms.div class="col-{{$columnWidth}}" custom="">

                @switch ($headingSize)
                    @case('h1')
                    <h1 class="{{$headingClass}}">{{$headingName}}</h1>
                    @break
                    @case('h2')
                    <h2 class="{{$headingClass}}">{{$headingName}}</h2>
                    @break
                    @case('h3')
                    <h3 class="{{$headingClass}}">{{$headingName}}</h3>
                    @break
                    @case('h4')
                    <h4 class="{{$headingClass}}">{{$headingName}}</h4>
                    @break
                    @case('h5')
                    <h5 class="{{$headingClass}}">{{$headingName}}</h5>
                    @break
                    @case('h6')
                    <h6 class="{{$headingClass}}">{{$headingName}}</h6>
                    @break
                    @default
                    <h4 class="{{$headingClass}}">{{$headingName}}</h4>
                    @break
                @endswitch
            </x-atoms.div>
            <x-atoms.div class="col-{{$columnWidth}} text-end" custom="">
                @if($crudButtons=="true")
                    {{$update_delete_buttons}}
                @endif
            </x-atoms.div>
        </x-atoms.div>


        {{--  SUB HEADING--}}
        @if($subHeadingName != null)
            @switch ($subHeadingSize)
                @case('h1')
                <h1 class="mb-2 text-muted {{$subHeadingClass}}">{{$subHeadingName}}</h1>
                @break
                @case('h2')
                <h2 class="mb-2 text-muted {{$subHeadingClass}}">{{$subHeadingName}}</h2>
                @break
                @case('h3')
                <h3 class="mb-2 text-muted {{$subHeadingClass}}">{{$subHeadingName}}</h3>
                @break
                @case('h4')
                <h4 class="mb-2 text-muted {{$subHeadingClass}}">{{$subHeadingName}}</h4>
                @break
                @case('h5')
                <h5 class="mb-2 text-muted {{$subHeadingClass}}">{{$subHeadingName}}</h5>
                @break
                @case('h6')
                <h6 class="mb-2 text-muted {{$subHeadingClass}}">{{$subHeadingName}}</h6>
                @break
                @default
                <h5 class="mb-2 text-muted {{$subHeadingClass}}">{{$subHeadingName}}</h5>
                @break
            @endswitch
        @endif
        <p class="card-text {{$textClass}}">
            {{$slot}}
        </p>
        @if($cardList=="true")
            {{ $card_lists }}
        @endif

        {{-- CARD HEADER --}}
        @if($footerText != null)
            <div class="card-footer {{$footerClass}}">{{$footerText}}</div>
        @endif
    </div>
</div>
