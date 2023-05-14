<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    
    public function run(): void
    {
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'product-list',
            'product-create',
            'product-edit',
            'product-delete',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'category-list',
            'category-create',
            'category-edit',
            'category-delete',
            'company-list',
            'company-create',
            'company-edit',
            'company-delete',
            'customer-list',
            'customer-create',
            'customer-edit',
            'customer-delete'
         ];
         
         foreach ($permissions as $permission) {
              Permission::create(['name' => $permission]);
         }
    }
}
