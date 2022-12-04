<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $adminPermissions = [
            'create-merchant',
            'list-merchants',
            'approve-merchants',
            'payment-methods-resource',
            'payment-method-update',

        ];

        $merchantPermissions = [
            'add-product',
            'update-product',
            'remove-product',
            'store-variant',
            'list-requests',
            'export-orders',
            'release-order',
            'export-payments'
        ];
        foreach ($adminPermissions as $item) {
            Permission::insert([
                'name' => $item,
                'guard_name' => 'api',
            ]);
        }
        foreach ($merchantPermissions as $item) {
            Permission::insert([
                'name' => $item,
                'guard_name' => 'api',
            ]);
        }

        $customer_role_id = Role::insertGetId(['name' => 'customer', 'name_en' => 'Customer', 'name_ar' => 'زبون', 'guard_name' => 'api']);
        $admin_role_id = Role::insertGetId(['name' => 'admin', 'name_en' => 'Admin', 'name_ar' => 'أدمن', 'guard_name' => 'api']);
        $merchant_role_id = Role::insertGetId(['name' => 'merchant', 'name_en' => 'Merchant', 'name_ar' => 'بائع', 'guard_name' => 'api']);

        // Assign permissions to roles

        // find permissions ids
        $permissionIdsByName = fn ($_permissions) => Permission::whereIn('name', $_permissions)->pluck('id')->toArray();
        $roleHasPermission = DB::table('role_has_permissions');

        $roleHasPermission
        ->insert(
            collect($permissionIdsByName($adminPermissions))->map(fn ($id) => [
                'role_id' => $admin_role_id,
                'permission_id' => $id,
            ])->toArray()
        );

        $roleHasPermission
        ->insert(
            collect($permissionIdsByName($merchantPermissions))->map(fn ($id) => [
                'role_id' => $merchant_role_id,
                'permission_id' => $id,
            ])->toArray()
        );
    }
}
