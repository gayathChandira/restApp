<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
class UserTableSeeder extends Seeder
{
    // /**
    //  * Run the database seeds.
    //  *
    //  * @return void
    //  */
    // public function run()
    // {
    //     $role_admin =  Role::where('name', 'Admin')->first();
    //     $role_invMgr =  Role::where('name', 'InvMgr')->first();
    //     $role_cashier =  Role::where('name', 'Cashier')->first();
    //     $role_accountant =  Role::where('name', 'Accnt')->first();

    //     $user = new User();
    //     $user->fname ='admin';
    //     $user->lname = 'admin';
    //     $user->email = 'admin@gmail.com';
    //     $user->password =  bcrypt('admin');
    //     $user->save();
    //     $user->roles()->attach($role_admin);

    //     $user = new User();
    //     $user->fname ='Inventory';
    //     $user->lname = 'Manager';
    //     $user->email = 'inventory@gmail.com';
    //     $user->password =  bcrypt('inventory');
    //     $user->save();
    //     $user->roles()->attach($role_invMgr);

    //     $user = new User();
    //     $user->fname ='cashier';
    //     $user->lname = 'cashier';
    //     $user->email = 'cashier@gmail.com';
    //     $user->password =  bcrypt('cashier');
    //     $user->save();
    //     $user->roles()->attach($role_cashier);

    //     $user = new User();
    //     $user->fname ='accountant';
    //     $user->lname = 'accountant';
    //     $user->email = 'accountant@gmail.com';
    //     $user->password =  bcrypt('accountant');
    //     $user->save();
    //     $user->roles()->attach($role_accountant);
    // }
}
