<div>
    <x-framer :pageName="$pageName">
        <section class="section">
            <div class="card">
                <div class="card-body">
                    @include('livewire.educations.create')
                    <x-organisms.table-search :fields="$searchFields" :pageNoList="$pageNoList"
                                              :sortDirectionList="$sortDirectionList"></x-organisms.table-search>

                    <div class="dataTable-container">
                        <table class="table table-striped dataTable-table" id="table1">
                            <thead>
                            <tr>
                                <th data-sortable="" class="text-center" style="width: 5%;"><a href="#" class="dataTable-sorter">ID</a></th>
                                <th data-sortable="" class="text-left" style="width: 80%; "><a href="#"
                                                                                               class="dataTable-sorter ">Education</a>
                                </th>

                                <th data-sortable="" class="text-left" style="width: 5%; "><a href="#"
                                                                                              class="dataTable-sorter ">Position</a>
                                </th>
                                <th data-sortable="" class="text-center" style="width: 10%;"><a href="#"
                                                                                                class="dataTable-sorter">Action</a>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($educations as $education)
                                <tr>
                                    <td class="text-center">{{$education->id}} </td>
                                    <td class="font-bold">{{$education->name}}</td>
                                    <td>{{$education->position}}</td>

                                    <td class="text-center">
                                        <div class="btn-group btn-group-sm p-1" role="group" aria-label="">
                                            @include('livewire.educations.update')
                                            @include('livewire.educations.delete')
                                        </div>
                                    </td>
                                </tr>
                                <tr>

                                    <td class="text-center"> @include('livewire.educations.create-education-type')</td>
                                    <td colspan="3">
                                        @forelse($education->education_types as $education_type)
                                            <div class="btn-group btn-group-sm p-1" role="group" aria-label="">
                                                @include('livewire.educations.view-education-type')
                                                @include('livewire.educations.update-education-type')
                                                @include('livewire.educations.delete-education-type')
                                            </div>
                                        @empty
                                            <span class="badge bg-light-primary text-gray-600">No {{$education->name}} available!</span>
                                        @endforelse
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">
                                        <x-atoms.div class="fw-bold p-2" custom=""><i
                                                class="fas fa-exclamation-circle"></i>
                                            No Educations Found!
                                        </x-atoms.div>

                                    </td>
                                </tr>

                            @endforelse

                            </tbody>
                        </table>
                    </div>
                    <div class="dataTable-info text-sm pb-1">Showing {{$currentPage}} to {{$perPage}}
                        of {{$total}}</div>
                    {{$educations->links()}}

                </div>
            </div>

        </section>
    </x-framer>
</div>
