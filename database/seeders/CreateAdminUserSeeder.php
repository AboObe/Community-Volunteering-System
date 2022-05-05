<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Spatie\Permission\Models\Role;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Alaa Nasser', 
            'email' => 'alaa.ba6ha@gmail.com',
            'password' => bcrypt('123456'),
            'phone' => '971567836770',
            'city'  => 'Dubai'
        ]);
    
        $role = Role::create(['name' => 'Admin']);
     
        $permissions = Permission::pluck('id','id')->all();
   
        $role->syncPermissions($permissions);
     
        $user->assignRole([$role->id]);

        //Normal User
        $role = Role::create(['name' => 'Normal']);
        $normal_permissions = ["5","9","13","19"];
        $role->syncPermissions($normal_permissions);
    }
}
