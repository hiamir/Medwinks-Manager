<button wire:click="changePassword({{$auth()->user()->id}},'modalUser-{{$auth()->user()->id}}')" type="button"
        class="btn btn-modal btn-sm btn-outline-success"
        data-bs-toggle="modal" data-bs-target="#modalChangePassword-{{$auth()->user()->id}}">
    <i class="far fa-edit"></i>
</button>
<div wire:ignore.self class="modal secondModal text-left"
     id="modalChangePassword-{{$auth()->user()->id}}" data-bs-backdrop="static"
     data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalLabelChangePassword-{{$auth()->user()->id}}" aria-hidden="true"
     style="display: none;">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modalLabelChangePassworde-{{$auth()->user()->id}}">Reset Password</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="bi bi-x-lg text-lg"></i>
                </button>
            </div>
            <form wire:key="modalResetPasswordForm-{{$auth()->user()->id}}" wire:submit.prevent="ChangePassword({{$auth()->user()->id}},'modalChangePassword-{{$auth()->user()->id}}')" class=""
                  novalidate>
                <div class="modal-body">
                    Change Password!

                </div>
                <div class="modal-footer">
                    <button wire:click="modalClose('modalUserResetPassword-{{$auth()->user()->id}}')" type="button"
                            class="btn btn-light-secondary">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>


                    <button wire:key="modalChangePasswordBtn-{{$auth()->user()->id}}" type="suubmit" class="submit-button-spinner btn btn-primary me-1"
                            wire:loading.attr="disabled">
                                        <span wire:loading class="spinner spinner-grow spinner-grow-sm" role="status"
                                              aria-hidden="true"></span>
                        Change Password
                    </button>


                    {{--                    <button wire:key="modalResetPasswordBtn-{{$auth()->user()->id}}" type="submit" class="btn btn-primary ml-1">--}}
                    {{--                        <i class="bx bx-check d-block d-sm-none"></i>--}}
                    {{--                        <span class="d-none d-sm-block">Reset Password</span>--}}
                    {{--                    </button>--}}
                </div>
            </form>
        </div>
    </div>
</div>
