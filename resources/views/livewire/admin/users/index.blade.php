<div>
    <x-framer :pageName="$pageName">
    <section class="section">
        <div class="card">
            <div class="card-body">
                @include('livewire.admin.users.create')

                <x-organisms.table-search :fields="$searchFields" :pageNoList="$pageNoList"
                                          :sortDirectionList="$sortDirectionList">


                    <x-molecules.bootstrap.container  class="" fluid={{true}} custom="" >
                    <x-molecules.bootstrap.row class="" custom="">

                        <x-molecules.bootstrap.column class="col-md-3 col-sm-12 pb-2 px-0 pe-md-3"  custom="" >
                            <x-atoms.bootstrap.select
                                id="sort-role-field"
                                name="sortRoleField"
                                class="p-0 mb-0"
                                label=""
                                placeholder="Filter Role"
                                firstvalue="All Roles"
                                :list="$roles"
                            >
                            </x-atoms.bootstrap.select>
                        </x-molecules.bootstrap.column>
                    </x-molecules.bootstrap.row>
                    </x-molecules.bootstrap.container>
                </x-organisms.table-search>

                <div class="dataTable-container">
                    <table class="table table-striped dataTable-table" id="table1">
                        <thead>
                        <tr>
                            <th data-sortable="" style="width: 5%;"><a href="#" class="dataTable-sorter">ID</a></th>
                            <th data-sortable="" style="width: 20%;"><a href="#" class="dataTable-sorter">Name</a></th>
                            <th data-sortable="" style="width: 15%;"><a href="#" class="dataTable-sorter">Email</a></th>
                            <th data-sortable="" class="text-center" style="width: 10%; ">
                                <a href="#" class="dataTable-sorter ">Email Verified</a></th>
                            <th data-sortable="" class="text-center" style="width: 30%;">
                                <a href="#" class="dataTable-sorter">Role</a>
                            </th>
                            <th data-sortable="" class="text-center" style="width: 10%;">
                                <a href="#" class="dataTable-sorter">Status</a>
                            <th data-sortable="" class="text-center" style="width: 10%;">
                                <a href="#" class="dataTable-sorter">Action</a>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td class="text-center">
                                    @isset($user->email_verified_at)
                                        <i class="fas fa-check-circle text-xl text-success"></i>
                                    @else
                                        <i class="fas fa-times-circle text-xl text-danger"></i>
                                    @endisset
                                </td>
                                <td class="text-center">
                                    @foreach($user->roles as $role)
                                        <span class="badge bg-secondary">{{$role->name}}</span>

                                    @endforeach
                                </td>
                                <td class="text-center">
                                    @if(!\App\Traits\Quicker::validateMySQLTimeStamp($user->blocked))
                                        <span class="badge bg-success text-center">Active</span>
                                    @else
                                        <span class="badge bg-danger text-center">Blocked</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @include('livewire.admin.users.update')
                                    @include('livewire.admin.users.delete')
{{--                                    <x-organisms.modal :modalName="'Edit-User'">--}}

{{--                                        <livewire:atoms.button :buttonName="''" :buttonIcon="'far fa-edit'"--}}
{{--                                                               :wire:key="'modalButton-'.$user->id"--}}
{{--                                                               :modalDismiss="false" :modalID="'#edit-user-'.$user->id"--}}
{{--                                                               :buttonColor="''"/>--}}

{{--                                        <x-molecules.modalcontent :modelID="'edit-user-'.$user->id">--}}

{{--                                            <x-atoms.modal.header :headerName="'Edit User'"/>--}}

{{--                                            <x-molecules.modal.form :wireName="'submitUser'">--}}

{{--                                                <x-atoms.modal.body>--}}

{{--                                                    <x-atoms.formgroup>--}}
{{--                                                        <livewire:atoms.label :labelFor="'edit-user'"--}}
{{--                                                                              :labelName="'Full Name'"--}}
{{--                                                                              :wire:key="'inputLabelName-'.$user->id"/>--}}
{{--                                                        <livewire:atoms.input :inputType="'text'" :inputErrorClass="''"--}}
{{--                                                                              :inputID="'edit-user-name-'.$user->id"--}}
{{--                                                                              :inputPlaceholder="'Enter full name'"--}}
{{--                                                                              :inputValue="$user->name"--}}
{{--                                                                              :wire:key="'inputName-'.$user->id"--}}
{{--                                                                              :inputError="''"/>--}}
{{--                                                    </x-atoms.formgroup>--}}

{{--                                                    <x-atoms.formgroup>--}}
{{--                                                        <livewire:atoms.label :labelFor="'edit-email'"--}}
{{--                                                                              :wire:key="'inputLabelEmail-'.$user->id"--}}
{{--                                                                              :labelName="'Email'"/>--}}
{{--                                                        <livewire:atoms.input :inputType="'email'" :inputErrorClass="''"--}}
{{--                                                                              :inputID="'edit-user-email-'.$user->id"--}}
{{--                                                                              :inputPlaceholder="'Enter email'"--}}
{{--                                                                              :inputValue="$user->email"--}}
{{--                                                                              :wire:key="'inputEmail-'.$user->id"--}}
{{--                                                                              :inputError="''"/>--}}
{{--                                                    </x-atoms.formgroup>--}}

{{--                                                </x-atoms.modal.body>--}}

{{--                                                <x-atoms.modal.footer>--}}
{{--                                                    <livewire:atoms.button :buttonName="'Close'" :buttonIcon="''"--}}
{{--                                                                           :modalDismiss="true"--}}
{{--                                                                           :modalID="''"--}}
{{--                                                                           :wire:key="'modalClose-'.$user->id"--}}
{{--                                                                           :buttonColor="'light-secondary'"/>--}}
{{--                                                    <livewire:atoms.button :buttonName="'Submit'" :buttonIcon="''"--}}
{{--                                                                           :modalDismiss="false"--}}
{{--                                                                           :wire:key="'modalSubmit-'.$user->id"--}}
{{--                                                                           :modalID="''"--}}
{{--                                                                           :buttonColor="'primary'"/>--}}
{{--                                                </x-atoms.modal.footer>--}}

{{--                                            </x-molecules.modal.form>--}}

{{--                                        </x-molecules.modalcontent>--}}
{{--                                        <livewire:atoms.button :buttonName="''" :buttonIcon="'fas fa-trash'"--}}
{{--                                                               :modalDismiss="false" :modalID="'#edit-user-'.$user->id"--}}
{{--                                                               :wire:key="'modalDelete-'.$user->id"--}}
{{--                                                               :buttonColor="'btn text-danger'"/>--}}

{{--                                    </x-organisms.modal>--}}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">
                                    <x-atoms.div class="fw-bold p-2" custom=""><i class="fas fa-exclamation-circle"></i>
                                        No Users Found!</x-atoms.div>

                                </td>
                            </tr>
                        @endforelse


                        </tbody>
                    </table>
                </div>
                <div class="dataTable-info text-sm pb-1">Showing {{$currentPage}} to {{$perPage}}
                    of {{$total}}</div>
                {{$users->links()}}

            </div>
        </div>

    </section>
    </x-framer>
</div>
