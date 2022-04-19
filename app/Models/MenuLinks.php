<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class MenuLinks extends Model
{
    use HasFactory, Notifiable;
    use HasRoles;

    protected $fillable = [
        'name', 'route', 'role', 'permission', 'position', 'list_id', 'created_at', 'updated_at',
    ];

    public function category()
    {
        return $this->belongsTo(MenuCategories::class, 'category_id', 'id');
    }

    public function folder()
    {
        return $this->belongsTo(MenuFolders::class, 'folder_id', 'id');
    }

    public function permission()
    {
        return $this->belongsTo(Permission::class, 'permission_id', 'id');
    }

    public function link_roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    public function logs(){
        return $this->morphToMany(Logs::class,'loggable');
    }

    public function scopeSearch($query, $search)
    {

        $query->where(function ($query) use ($search) {
            $search = trim('%' . $search . '%');
            $query
                ->where('route', 'like', $search)
                ->orWhere('route', 'like', $search)
                ->orWhere('route_index', 'like', $search)
                ->orWhereHas('folder', function ($query) use ($search) {
                    $query->where('menu_folders.name', 'like', $search);
                })
                ->orWhereHas('category', function ($query) use ($search) {
                    $query->where('menu_categories.name', 'like', $search);
                })
                ->orwhereHas('permission', function ($query) use ($search) {
                    $query->where('permissions.name', 'like', $search);
                });
//                ->whereHas('link_roles', function ($query) {
//                    $query->where('roles.name', ['Super Admin','Admin']);
//                });
        });
    }
}
