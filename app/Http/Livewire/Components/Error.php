<?php

namespace App\Http\Livewire\Components;



use App\Traits\Data;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Livewire\Component;

class Error extends Component
{
    use Data;
    public $pageName = 'Page Error!';
    public $error = '500';
    public $image;
    public $title;
    public $description;


    public function mount()
    {
//        if(in_array(Request::route()->getName(),$this->all_routes())){
//            dd('hello');
//            session()->exists('error') ? $this->message(session()->get('error')) : $this->message($this->error);
//        }else{
//
//        }

        session()->exists('error') ? $this->message(session()->get('error')) : $this->message($this->error);

    }


    public function message($error)
    {
        switch ($error) {
            case 403:
                $this->image = "403.png";
                $this->title = "Forbidden";
                $this->description = "You are unauthorized to see this page.";
                session()->forget('error');
                break;

            case 404:
                $this->image = "404.png";
                $this->title = "Not Found";
                $this->description =  "'".(session()->exists('error'))?session()->get('url')."' page not found.":"The page you are looking not found.";
                session()->forget('error');
                break;


            case 500:
                $this->image = "500.png";
                $this->title = "Oops... Something went wrong";
                $this->description = "Sorry for the inconvenience. We're working on it.";
                session()->forget('error');
                break;
        }
    }

    public function render()
    {
        return view('livewire.components.error')->layout('layouts.app');
    }
}
