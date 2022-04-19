{{--<div class="border  p-3 border-0 bg-light-secondary rounded-5 mb-4 shadow-sm  mt-3">--}}
    <x-atoms.modal.Highlight
        id="search-background"
        name="search-background"
        class=""
        background="light-secondary"
    >


{{--    <div class="container">--}}
{{--        <div class="row pb-2">--}}
{{--            <div class="col-sm-12 col-md-3 p-0  pe-0 pb-2 pe-sm-0">--}}
{{--                <div class="dataTable-search">--}}
{{--                    <input wire:model='search' wire:keyup=$emit('refreshComponent') class="form-control w-100"--}}
{{--                           placeholder="Search..." type="text">--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-sm-2 col-md-1 p-0 offset-sm-0 offset-md-8">--}}
{{--                <div class="dataTable-dropdown">--}}
{{--                    <select wire:model='pageno' class="form-control form-select">--}}
{{--                        <option value="5">5</option>--}}
{{--                        <option value="10" selected="">10</option>--}}
{{--                        <option value="15">15</option>--}}
{{--                        <option value="20">20</option>--}}
{{--                        <option value="25">25</option>--}}
{{--                    </select>--}}
{{--                </div>--}}

{{--            </div>--}}

{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="container">--}}
{{--        <div class="row">--}}
{{--            <div class="col-md-3 col-sm-12 pb-2 px-0 pe-md-3">--}}
{{--                <select wire:model='sortField' class="form-control form-select">--}}
{{--                    <option value="none" selected disabled hidden>--}}
{{--                        Select an Option--}}
{{--                    </option>--}}
{{--                    @foreach($fields as $key=>$value)--}}
{{--                        <option value="{{$key}}">{{$value}}</option>--}}
{{--                    @endforeach--}}
{{--                </select>--}}
{{--            </div>--}}
{{--            <div class="col-md-3 col-sm-12 pb-2 px-0 ">--}}
{{--                <select wire:model='sortDirection' class="form-control form-select">--}}
{{--                    <option value="asc">Ascending</option>--}}
{{--                    <option value="desc">Descending</option>--}}
{{--                </select>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}


    </x-atoms.modal.Highlight>
