<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Permission\Contracts\Permission as PermissionContract;
use Spatie\Permission\Models\Permission;

class PermissionExtends extends Permission
{
//    use HasFactory;
//
//    /**
//     * @return BelongsToMany
//     */
//    public function roles(): BelongsToMany
//    {
//        // TODO: Implement roles() method.
//    }
//
//    /**
//     * @param string $name
//     * @param string|null $guardName
//     * @return PermissionContract|static
//     */
//    public static function findByName(string $name, $guardName): PermissionContract
//    {
//        // TODO: Implement findByName() method.
//    }
//
//    /**
//     * @param int $id
//     * @param string|null $guardName
//     * @return PermissionContract|static
//     */
//    public static function findById(int $id, $guardName): PermissionContract
//    {
//        // TODO: Implement findById() method.
//    }
//
//    /**
//     * @param string $name
//     * @param string|null $guardName
//     * @return PermissionContract|static
//     */
//    public static function findOrCreate(string $name, $guardName): PermissionContract
//    {
//        // TODO: Implement findOrCreate() method.
//    }

    public function links(){
        return $this->hasOne(MenuLinks::class,'permission_id','id');
    }
    public function logs(){
        return $this->morphToMany(Logs::class,'loggable');
    }
}
