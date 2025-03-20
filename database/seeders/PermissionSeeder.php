<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arrayOfPermission = [
            'visit plan',
            'visit plan new',
            'visit',
            'visit new',
            'report list',
            'report product',
            'all list',
            'list details',
            'list new',
            'list edit',
            'all employee',
            'employee details',
            'employee new',
            'employee edit',
            'employee delete',
            'all tool',
            'tool new',
            'all contact',
            'contact details',
            'contact new',
            'contact edit',
            'all contact place',
            'contact place details',
            'contact place new',
            'contact place edit',
            'all contact type',
            'contact type details',
            'contact type new',
            'contact type edit',
            'contact relative',
            'contact rate',
            'all center',
            'center details',
            'center new',
            'center edit',
            'all assistant',
            'assistant details',
            'assistant new',
            'assistant edit',
            'assistant delete',
            'all vacation',
            'vacation request',
            'vacation new',
            'vacation edit',
            'all expense',
            'expense details',
            'expense new',
            'expense edit',
            'expense delete',
            'all product',
            'product details',
            'product new',
            'product edit',
            'product delete',
            'all product msg',
            'product msg details',
            'product msg new',
            'product msg edit',
            'product msg delete',
            'all area',
            'area details',
            'area new',
            'area edit',
            'area delete',
            'all specialty',
            'specialty details',
            'specialty new',
            'specialty edit',
            'specialty delete',
            'all brand gift',
            'brand gift details',
            'brand gift new',
            'brand gift edit',
            'brand gift delete',
            'all social style',
            'social style details',
            'social style new',
            'social style edit',
            'social style delete',
            'all sale funnel',
            'sale funnel details',
            'sale funnel new',
            'sale funnel edit',
            'all rating',
            'rating details',
            'rating new',
            'rating edit',
            'rating delete',
            'all event',
            'event details',
            'event new',
            'event edit',
            'event delete',
            'sale',
            'sale report',
            'all role',
            'role new',
            'role edit',
            'role delete',
            'setting' 
        ];

        $permissions = collect($arrayOfPermission)->map(function ($permission){
            return ['name' => $permission, 'guard_name' => 'admin'];
        });

        Permission::insert($permissions->toArray());

        $role = Role::create([
            'name' => 'super admin',
            'guard_name' => 'admin'
        ])->givePermissionTo($arrayOfPermission);
    }
}
