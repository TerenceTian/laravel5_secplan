<?php namespace App\Http\Controllers;

use App\Http\Requests;

use App\Permission;
use App\Role;
use App\ShopRepository;
use App\User;
use Repositories\Api\IShopRepository;

class PagesController extends Controller {

    public function __construct(IShopRepository $shop) {

        $this->shop = $shop;
    }


    public function index() {

        $recent_shops = $this->shop->getNewShops()->take(10)->get();
        $popular_shops = $this->shop->getPopularShops()->take(10)->get();

        //$admin = new Role;
        //$admin->name = 'Admin';
        //$admin->save();
        //
        //$founder = new Role;
        //$founder->name = 'Founder';
        //$founder->save();
        ////dd('role');
        ///** @var User $user */
        //$user = User::where('id','=','1')->first();
        //$user->roles()->attach( $founder->id );
        //
        //$manageShops = new Permission;
        //$manageShops->name = 'manage_shops';
        //$manageShops->display_name = 'Manage Shops';
        //$manageShops->save();
        //
        //$manageUsers = new Permission;
        //$manageUsers->name = 'manage_users';
        //$manageUsers->display_name = 'Manage Users';
        //$manageUsers->save();
        //
        //$founder->perms()->sync(array($manageShops->id,$manageUsers->id));
        //$admin->perms()->sync([$manageShops->id]);

        return view('pages.index', compact('recent_shops', 'popular_shops'));
    }



}
