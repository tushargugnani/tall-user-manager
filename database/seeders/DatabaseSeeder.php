<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //Admin User
        $adminUser = User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
        ]);

        //Non Admin User
        $nonAdminUser = User::create([
            'name' => 'user',
            'email' => 'user@user.com',
            'password' => bcrypt('password'),
        ]);

        //Roles
        $adminRole = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'user']);
        
        $viewAllUserPermission = Permission::create(['name' => 'view users']);
        $viewSingleUserPermission = Permission::create(['name' => 'view user']); 
        $addUserPermission = Permission::create(['name' => 'add user']);   
        $editUserPermission = Permission::create(['name' => 'edit user']);    
        $deleteUserPermission = Permission::create(['name' => 'delete user']);   
        $manageUserRolesPermission = Permission::create(['name' => 'manage user roles']); 

        $viewAllRolePermission = Permission::create(['name' => 'view roles']);
        $viewSingleRolePermission = Permission::create(['name' => 'view role']); 
        $addRolePermission = Permission::create(['name' => 'add role']);   
        $editRolePermission = Permission::create(['name' => 'edit role']);    
        $deleteRolePermission = Permission::create(['name' => 'delete role']);  

        $viewAllPermissionPermission = Permission::create(['name' => 'view permissions']);
        $viewSinglePermissionPermission = Permission::create(['name' => 'view permission']); 
        $addPermissionPermission = Permission::create(['name' => 'add permission']);   
        $editPermissionPermission = Permission::create(['name' => 'edit permission']);    
        $deletePermissionPermission = Permission::create(['name' => 'delete permission']);
        

        //Assign permissions to admin user
        $adminRole->syncPermissions([
                    $viewAllUserPermission, $viewSingleUserPermission, $addUserPermission, $editUserPermission, $deleteUserPermission, $viewAllRolePermission,
                    $viewSingleRolePermission, $addRolePermission, $editRolePermission, $deleteRolePermission, $viewAllPermissionPermission, $viewSinglePermissionPermission,
                    $addPermissionPermission, $editPermissionPermission, $deletePermissionPermission
                ]);

        $adminUser->assignRole($adminRole);

    }
}
