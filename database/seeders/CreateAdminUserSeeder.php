<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{
    
    public function run(): void
    {
        $user = User::create([
            'user_name' => 'Super Admin', 
            'email' => 'superadmin@gmail.com',
            'phone' => '1234567890',
            'password' => bcrypt('super@123'),
            'address' => 'Surat',
            'user_image' => 'superadmin',

        ]);
        
        $role = Role::create(['name' => 'Admin']);
         
        $permissions = Permission::pluck('id','id')->all();
       
        $role->syncPermissions($permissions);
         
        $user->assignRole([$role->id]);
    }
}
