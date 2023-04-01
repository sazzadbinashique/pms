<?php


use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;


class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $permissions = [
            // 'miscExpenditure-index',
            // 'miscExpenditure-create',
            // 'miscExpenditure-edit',
            // 'miscExpenditure-delete',
            // 'miscExpenditure-menu'
        ];

        foreach ($permissions as $permission) {
             Permission::create(['name' => $permission]);
        }
    }
}
