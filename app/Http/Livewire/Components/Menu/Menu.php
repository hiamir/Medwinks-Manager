<?php

namespace App\Http\Livewire\Components\Menu;

use App\Models\MenuCategories;
use App\Models\MenuLinks;
use App\Traits\AuthorizesRoleOrPermission;
use App\Traits\AuthSubmit;
use App\Traits\Data;
use App\Traits\Query;
use App\Traits\Quicker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Menu extends Component
{
    use AuthorizesRoleOrPermission;

    public $menu = [];
    public $categories = [];
    public $menulist = [];
    public $menuSort = 'ASC';
    public $menuCategories;
    public $mainMenu;
    public $routeLink;
    public $routeName;

//    protected $listeners=['refreshMenu'=>'$refresh'];
    protected $listeners = ['refreshMenu'];


    public function mount()
    {
        $this->routeName = Request::route()->getName();
        if (session()->exists('route')) {
            if ($this->routeName == session()->get('route')) {
                $this->routeLink = session()->get('route');
            } else {

                $this->routeLink = $this->routeName;
            }
        }else{
            $this->routeLink = $this->routeName;
        }
        $this->records();
    }

    public function records()
    {
        $authRole = auth()->user()->roles->first()->name;
        $this->menuCategories = MenuCategories::
        with(['links' => function ($q) use ($authRole) {
            $q->whereHas('link_roles', function ($lr) use ($authRole) {
                $lr->where('name', $authRole);
            });
            $q->whereHas('permission', function ($p) use ($authRole) {
                $p->where('guard_name', Query::role_guard_from_name($authRole))
                    ->where(function ($q) use ($authRole) {
                        $permissions = Query::role_record_from_name($authRole)->permissions->pluck('name')->toArray();
                        $q->whereIn('name', $permissions);
                    });
            })
                ->with(['permission', 'folder'])->orderBy('position', 'asc');
        }])
            ->orderBy('position', 'asc')->get();
    }

    public function getRoute($route)
    {
        session()->put('route', $route);
        return redirect()->route($route);
    }

    public function refreshMenu()
    {
        $this->records();
    }

    public function render()
    {
        return view('livewire.admin.menu.index');
    }
}
