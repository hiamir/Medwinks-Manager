<input type="hidden" value="@if(sizeof($passport->getMedia('image'))==0) {{$disabled='true'}} @endif">

<x-organisms.modal
    x-data="{disabled=@entangle('$disabled')}"
    showButton={{true}}
        name="passport_file"
    type="image"
    id="{{$passport->id}}"
    size="lg"
    buttonName="{{$passport->passport_number}}"
    buttonColor=''
    buttonTextColor="text-secondary-50"
    buttonRound='{{false}}'
    buttonWidth="w-auto"
    buttonClass="px-2 btn-outline-secondary  rounded-start"
    buttonIcon="fas fa-camera"
    :buttonDisabled="$disabled"
    buttonSubmitName="{{$passport->passport_number}}"
    passingData=""
    custom=""
>
    <x-molecules.modal.content class="p-0">

        <x-atoms.div class="" custom="">

            {{--            {{dd(($passport->getFirstMedia('image')->getUrl()))}}--}}

            @if(\Illuminate\Support\Facades\Storage::exists($passport->getFirstMedia('image')->getPath()) || $passport->getFirstMedia('image')->getUrl()!=null)
                <div>
                <img src="{{$passport->getFirstMedia('image')->getUrl() }}" class="img-fluid w-100" alt="">
                </div>
            @else
                <img src="{{ asset('images/not-found.jpg') }}" class="img-fluid w-100" alt="">
            @endif

            {{--            @foreach ($passport->getMedia('image') as $image)--}}
            {{--                <div class="item">--}}
            {{--                    @if (\Illuminate\Support\Facades\Storage::disk('public')->exists($image->id.'/'.$image->file_name))--}}
            {{--                        <img src="{{ asset($image->getUrl()) }}" class="img-fluid w-100" alt="">--}}

            {{--                    @else--}}
            {{--                        <img src="{{ asset('images/not-found.jpg') }}" class="img-fluid w-100" alt="">--}}
            {{--                    @endif--}}


            {{--                </div>--}}
            {{--            @endforeach--}}


        </x-atoms.div>

    </x-molecules.modal.content>

</x-organisms.modal>
