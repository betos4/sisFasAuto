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

            [
                'name_menu' => 'Configurar',
                'url_menu' => '#',
                'icon_menu' => 'fa fa-cog'
            ],
            [
                'name_menu' => 'Clientes',
                'url_menu' => 'clientes',
                'menu_id' => 6,
                'icon_menu' => 'fa fa-user'
            ],
            [
                'name_menu' => 'Créditos',
                'url_menu' => 'creditos',
                'menu_id' => 6,
                'icon_menu' => 'fa fa-coins'
            ],
            [
                'name_menu' => 'Estado civiles',
                'url_menu' => 'estadoCiviles',
                'menu_id' => 6,
                'icon_menu' => 'fas fa-church'
            ],
            [
                'name_menu' => 'Tipo referencias',
                'url_menu' => 'tipoReferencias',
                'menu_id' => 6,
                'icon_menu' => 'fa fa-sitemap'
            ],

            [
                'name_menu' => 'Gestionar',
                'url_menu' => '#',
                'icon_menu' => 'fa fa-folder-open'
            ],
            [
                'name_menu' => 'Contratos',
                'url_menu' => 'contratos',
                'menu_id' => 11,
                'icon_menu' => 'fa fa-file'
            ],
        ];

        foreach($menus as $menu){
            Menu::create($menu);
        }
    }
}
