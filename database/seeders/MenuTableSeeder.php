<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menus = [
            [
                'name_menu' => 'Administrar',
                'url_menu' => '#',
                'icon_menu' => 'fas fa-user-shield'
            ],
            [
                'name_menu' => 'Menús',
                'url_menu' => 'menus',
                'menu_id' => 1,
                'icon_menu' => 'fas fa-bars'
            ],
            [
                'name_menu' => 'Roles',
                'url_menu' => 'roles',
                'menu_id' => 1,
                'icon_menu' => 'fas fa-user-tag'
            ],
            [
                'name_menu' => 'Menú-Rol',
                'url_menu' => 'menu-rol',
                'menu_id' => 1,
                'icon_menu' => 'fab fa-r-project'
            ],
            [
                'name_menu' => 'Usuarios',
                'url_menu' => 'users',
                'menu_id' => 1,
                'icon_menu' => 'fas fa-users'
            ],
        ];

        foreach($menus as $menu){
            Menu::create($menu);
        }
    }
}
