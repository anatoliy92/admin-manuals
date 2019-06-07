<?php namespace Avl\AdminManuals\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Menu;
use DB;

class ManualsTableSeeder extends Seeder
{
		/**
		 * Run the database seeds.
		 *
		 * @return void
		 */
		public function run()
		{
				$menu = Menu::whereRoute('adminmanuals::manuals-menu.index')->orderBy('order', 'DESC')->first();
				$lastOrder = Menu::whereNull('parent_id')->orderBy('order', 'DESC')->first();

				if (is_null($menu)) {
					DB::table('menu')->insert([
							'title' => 'Справочники',
							'url' => '',
							'target' => '_self',
							'route' => 'adminmanuals::manuals-menu.index',
							'model' => 'App\Models\Menu',
							'icon_class' => 'fa fa-list',
							'order' => $lastOrder->order++,
							'created_at' => date("Y-m-d H:i:s"),
							'updated_at' => date("Y-m-d H:i:s")
					]);

					// DB::table('menu')->insert([
					// 		'title' => 'Управление персоналом',
					// 		'url' => '',
					// 		'parent_id' => DB::getPdo()->lastInsertId(),
					// 		'target' => '_self',
					// 		'route' => 'adminmanuals::manuals.index',
					// 		'model' => 'Avl\AdminManuals\Models\Table',
					// 		'icon_class' => 'fa fa-users',
					// 		'order' => 1,
					// 		'created_at' => date("Y-m-d H:i:s"),
					// 		'updated_at' => date("Y-m-d H:i:s")
					// ]);
				}

		}
}
