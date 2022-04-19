<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Traits\FormValidation;
use App\Traits\Query;
use App\Traits\Quicker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Throwable;

class Profile extends Component
{
    use Quicker;
    use FormValidation;
    public $form = ['name', 'email', 'status', 'current_password','password', 'password_confirmation'];
    public $oldName;
    public $oldEmail;
    protected $oldVerifiedAt;
    public $pageName = "Profile";

    public $user;
    public $roles;

    public $toggleHighlight = false;
    public $toggleUpdateButton = false;

    public function mount()
    {
        $this->toggleHighlight = false;
        $this->toggleUpdateButton=false;
        $this->form['current_password']='';
        $this->form['password']='';
        $this->form['password_confirmation']='';
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function updated()
    {
        if ($this->toggleUpdateButton){

            $this->formValidation($this, 'userUpdate', ['form.email'], $this->user->id);
    }
    }

    public function profile_button($id, $modalID)
    {
        $this->toggleHighlight = false;
        $this->toggleUpdateButton=true;
        $this->recordID = $id;
        $this->modalID = $modalID;
        $this->user = Query::user(auth()->user()->id);
        $this->form['name'] = $this->user->name;
        $this->form['email'] = $this->user->email;
        $this->form['status'] = $this->user->active;
        $this->oldName = $this->user->name;
        $this->oldEmail = $this->user->email;
        $this->oldVerifiedAt = $this->user->email_verified_at;
    }


    public function submit_profile($id, $modalID)
    {

        $this->modalID = $modalID;
        $this->formValidation($this,'userUpdate', ['form.name', 'form.email'],$this->user->id);


        try {
            DB::transaction(function () {
                $user=Query::user(auth()->user()->id);

            if ($this->oldName === $this->form['name'] && $this->oldEmail === $this->form['email']) {
                $this->dispatchBrowserEvent('modalClose', $this->modalID);
                Quicker::toastr($this, 'info', 'There were no changes to update!');
            } else {

                $this->oldName = $user->name;
                $this->oldEmail = $user->email;
                $this->oldVerifiedAt = $user->email_verified_at;
                if ($this->oldEmail != $this->form['email']) {

                    $update = $user->update([
                        'email' => $this->form['email'],
                    ]);

                    $name = $this->form['name'];
                    $email = $this->form['email'];
                    $twoFactorCode = $this->resetTwoFactorCode($user);
                    $this->disablebutton = 'true';

                    Mail::to($this->oldEmail)->send(new \App\Mail\ChangeEmail($name,config('app.admin_email'), $email));
                    Mail::to($email)->send(new \App\Mail\Welcome($name,config('app.admin_email')));
                    Mail::to($email)->send(new \App\Mail\SendTwoFactor($name, config('app.admin_email'), $twoFactorCode));


                    Auth::logout();
                    return redirect(route('login'));
                } else {
                    $update = $user->update([
                        'name' => $this->form['name'],
                    ]);
                    $this->dispatchBrowserEvent('modalClose', $this->modalID);
                    Quicker::toastr($this, 'success', $this->form['name'] . ' was updated successfully!');
                }
                $this->emit('updateProfile');
            }
            });
        } catch (Throwable $e) {
            DB::rollback();
            Quicker::toastr($this, 'error', 'Update Error! Please contact administrator');
            return false;
        }

    }

    public function changepassword_button($id, $modalID)
    {
        $this->recordID = $id;
        $this->modalID = $modalID;


    }

    public function emailKeyup()
    {
        ($this->oldEmail != $this->form['email']) ? $this->toggleHighlight = true : $this->toggleHighlight = false;

    }

    public function submit_changepassword($id, $modalID)
    {

        $this->recordID = $id;
        $this->modalID = $modalID;
        $this->formValidation($this,'userUpdate', ['form.current_password','form.password', 'form.password_confirmation']);
        try {
            DB::transaction(function(){
                $user = $this->user;

            if((strval($this->form['password'])===strval($this->form['password_confirmation'])) &&
                $this->form['current_password'] !='' &&
                $this->form['password'] !='' &&
                $this->form['password_confirmation'] !=''
            ){
                $update = $user->update([
                    'password' => Hash::make($this->form['password'])
                ]);
                $name = $this->user->name;
                $email = $this->user->email;
                Mail::to($email)->send(new \App\Mail\ChangePassword($name, config('app.admin_email')));
                $this->dispatchBrowserEvent('modalClose', $this->modalID);
                Quicker::toastr($this, 'success', 'Password was changed successfully!');
            }
            elseif(!Hash::check($this->form['current_password'], $user->password)){
                Quicker::toastr($this, 'error', 'Current password is incorrect!');
            }
            else{
                Quicker::toastr($this, 'error', 'New password & Confirm Password do not match');
            }
            });
        }catch(Throwable $e){
            DB::rollback();
            Quicker::toastr($this, 'error', 'Update Error! Please contact administrator');
            return false;
        }


    }

    public function render()
    {
        if (auth()->check()) {
            $this->user = User::with('roles')->find(auth()->user()->id);
            $this->roles = ($this->user->roles->pluck('name')->implode(','));
            return view('livewire.profile.index', ['user' => $this->user, 'roles' => $this->roles])->layout('layouts.app');
        } else {
            return view('livewire.login')->layout('layouts.app');;
        }

    }
}
