<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use App\Models\User;
use App\Traits\AuthorizesRoleOrPermission;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class Comments extends Component
{
   use withPagination;
   use withFileUploads;
   use AuthorizesRoleOrPermission;

    protected $paginationTheme = 'bootstrap';

    public  $inputComment;
    public $photo;

    public function mount()
    {
        //        auth()->user()->assignRole('Proof Reader');
//        auth()->user()->givePermissionTo('edit comment');
//$permission=Permission::create(['name'=>'write comment']);
//$role=Role::find(7);
//$role->givePermissionTo('write comment');
//        dd(Auth::user()->hasRole('Proof Reader'));

//        $this->middleware('permission:role-list');

        $this->authorizeRoleOrPermission('Proof Reader|write comment');


        $this->validate([
            'photo'=>'image|max:1024',
            'inputComment' => ['min:6', 'required', 'max:255']
        ]);
    }

    public function updated($field)
    {
        $this->validateOnly($field, [
            'photo'=>'image|max:1024',
            'inputComment' => ['min:6', 'required', 'max:255']
        ]);
    }

    public function deleteComment($id)
    {
        $comment = Comment::find($id);
        $creator_id = $comment->creator_id;
        if (Auth::user()->id === $creator_id) {

            $comment->delete();
            session()->flash('message-delete', $creator_id . ' deleted successsfully!');
        } else {
            session()->flash('message-cannot-delete', $creator_id . ' cannot be deleted!');
        }

    }

    public function addComment()
    {
        $validate = $this->validate([
            'photo'=>'image|max:1024',
            'inputComment' => ['required', 'min:6']
        ]);
        $name = md5($this->photo . microtime()).'.'.$this->photo->extension();
        $this->photo->storeAs('public/photos', $name);
        Comment::create([
            'body' => $this->inputComment,
            'photo'=>$name,
            'creator_id' => Auth::user()->id
        ]);
        $this->reset();
        session()->flash('message-add', 'Comment added successsfully!');

    }

    public function render()
    {
        $comments = Comment::orderBy('created_at', 'DESC')->paginate(2);
        return view('livewire.comments',['comments'=>$comments]);
    }
}
