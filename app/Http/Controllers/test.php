<?php

use App\Role;

function test() {
    $admin = new Role;
    $admin->name = 'Admin';
    $admin->save();

    $founder = new Role;
    $founder->name = 'Founder';
    $founder->save();

    $user = User::where('name','=','admin')->first();
    $user->attachRole( $admin );

    $manageShops = new Permission;
    $manageShops->name = 'manage_shops';
    $manageShops->display_name = 'Manage Shops';
    $manageShops->save();

    $manageUsers = new Permission;
    $manageUsers->name = 'manage_users';
    $manageUsers->display_name = 'Manage Users';
    $manageUsers->save();

    $founder->perms()->sync(array($manageShops->id,$manageUsers->id));
    $admin->perms()->sync([$manageShops->id]);
}

test();