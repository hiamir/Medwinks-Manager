<x-atoms.div class="" custom="">
    <x-atoms.modal.Highlight
        id="search-background"
        name="search-background"
        class="mt-4"
        background="light-secondary"
    >
        <x-molecules.bootstrap.container  class="" fluid={{true}} custom="" >
            <x-molecules.bootstrap.row class="row pb-2" custom="" >
                <x-molecules.bootstrap.column class="col-sm-12 col-md-3 p-0  pe-0 pe-sm-0" custom="" >
                    <x-atoms.div class="dataTable-search" custom="" >
                        <x-atoms.bootstrap.input
                            container="px-0 mb-0"
                            id="user-keyword-search"
                            size=""
                            name="search"
                            label=""
                            type="text"
                            placeholder="Search..."
                            icon=""
                            value=""
                            debounce="100ms"
                            lazy="{{false}}"
                            defer="{{false}}"
                            class="p-0 mb-0"
                            custom="wire:keyup=$emit('refreshComponent')"
                        >
                        </x-atoms.bootstrap.input>
                    </x-atoms.div>
                </x-molecules.bootstrap.column>

                <x-molecules.bootstrap.column class="col-sm-2 col-md-1 p-0 offset-sm-0 offset-md-8" custom="" >
                    <x-atoms.div class="dataTable-dropdown" custom="" >
                        <x-atoms.bootstrap.select
                            id="user-sort"
                            name="pageNo"
                            class="mb-0 p-0"
                            label=""
                            placeholder=""
                            firstvalue=""
                            :list="$pageNoList"
                        >
                        </x-atoms.bootstrap.select>
                    </x-atoms.div>
                </x-molecules.bootstrap.column>

            </x-molecules.bootstrap.row>
        </x-molecules.bootstrap.container>

        <x-molecules.bootstrap.container class="" fluid={{true}} custom="">
            <x-molecules.bootstrap.row class="" custom="">
                <x-molecules.bootstrap.column class="col-md-3 col-sm-12 pb-2 px-0 pe-md-3" custom="">
                    <x-atoms.bootstrap.select
                        id="sort-field"
                        name="sortField"
                        class="p-0 mb-0"
                        label=""
                        placeholder=""
                        firstvalue=""
                        :list="$fields"
                    >
                    </x-atoms.bootstrap.select>
                </x-molecules.bootstrap.column>

                <x-molecules.bootstrap.column class="col-md-3 col-sm-12 pb-2 px-0 pe-md-3" custom="">
                    <x-atoms.bootstrap.select
                        id="sort-direction"
                        name="sortDirection"
                        class="mb-0"
                        label=""
                        placeholder="Please select"
                        firstvalue=""
                        :list="$sortDirectionList"
                    >
                    </x-atoms.bootstrap.select>
                </x-molecules.bootstrap.column>
            </x-molecules.bootstrap.row>
        </x-molecules.bootstrap.container>
        {{$slot}}
    </x-atoms.modal.Highlight>
</x-atoms.div>
