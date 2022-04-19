<?php

namespace App\Traits;

use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Spatie\Permission\Models\Role;

trait AuthorizesRoleOrPermission
{
    public $error = true;
    public $routeIndex;

    public function securityGate()
    {

        $routeName = Request::route()->getName();

        if (Query::menu_links_with_route($routeName) !== null) {
            $permission = Query::permission_name_from_id(Query::menu_links_with_route($routeName)->permission_id);
            $this->authorizeRoute($routeName);

            $this->authorize($permission);
        } else {
            return redirect()->route('error')->with(['error' => '404']);
        }

    }

    public function authorize($roleOrPermission, $guard = null)
    {
        $guard = AuthSubmit::guard();
        if (Auth::guard($guard)->guest()) {
            throw UnauthorizedException::notLoggedIn();
        }

        $rolesOrPermissions = is_array($roleOrPermission)
            ? $roleOrPermission
            : explode('|', $roleOrPermission);


        if (in_array('Super Admin', json_decode(auth()->user()->roles->pluck('name')))) {
            return true;
        }
        if (!Auth::guard($guard)->user()->hasAnyRole($rolesOrPermissions) && !Auth::guard($guard)->user()->hasAnyPermission($rolesOrPermissions)) {
//            return redirect()->route('error')->with(['error'=>'403']);
            return back()->with(['error' => '403']);
        }
        return true;
    }

    public function authorizeBol($roleOrPermission, $guard = null)
    {

        if (Auth::guard($guard)->guest()) {
            throw UnauthorizedException::notLoggedIn();
        }
        $rolesOrPermissions = is_array($roleOrPermission)
            ? $roleOrPermission
            : explode('|', $roleOrPermission);


        if (!Auth::guard($guard)->user()->hasAnyRole($rolesOrPermissions) && !Auth::guard($guard)->user()->hasAnyPermission($rolesOrPermissions)) {
            (Auth()->guard('admin')->check()) ? $route = 'admin.error-forbidden' : $route = 'user.error-forbidden';
//            return back()->with(['error'=>'403']);
        }
        return true;
    }

    // AUTHORIZE ROUTE

    protected function authorizeRoute($routeName)
    {

        $link = Query::menu_links_with_route($routeName);

        if (Quicker::routeCheck($routeName)) {

            switch ($routeName) {

                //DASHBOARD

                case 'admin.dashboard':
                case 'admin.admins':
                case 'admin.users':
                case 'admin.roles':
                case 'admin.permissions':
                case 'admin.menu.categories':
                case 'admin.menu.folders':
                case 'admin.menu.links':
                case 'admin.countries':
                case 'admin.regions':
                case 'admin.companies':
                case 'admin.models':
                case 'admin.contact.address-types':
                case 'admin.contact.addresses':
                case 'admin.contact.phone-types':
                case 'admin.progress.processes':
                case 'admin.progress.steps':
                case 'admin.statuses':

                    $this->auth = 'admin';
                    $this->routeIndex = (Query::menu_links_with_route($routeName)->route_index);
                    $this->pageName = (Query::menu_links_with_route($routeName)->name);
                    $this->error = false;
                    break;

                case'user.dashboard':
                case'user.applications':
                case'manager.dashboard':
                case'user.passports':
                case'user.universities':
                case'user.services':
                case'user.service-requirements':
                case'user.educations':
                case'user.education-types':

                    $this->auth = 'web';
                    $this->routeIndex = (Query::menu_links_with_route($routeName)->route_index);
                    $this->pageName = (Query::menu_links_with_route($routeName)->name);
                    $this->error = false;
                    break;


                default:
                    return redirect()->route(Quicker::route_previous_name())->with(['error' => '500']);
            }
        } else {

            return back()->with(['error' => '404']);
        }
    }


}
