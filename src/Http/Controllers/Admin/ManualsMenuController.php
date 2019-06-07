<?php namespace Avl\AdminManuals\Controllers\Admin;

use App\Http\Controllers\Avl\AvlController;
use App\Models\{ Langs, Menu };
use Avl\AdminManuals\Models\{Manuals};

use App\Traits\SectionsTrait;
use Illuminate\Http\Request;
use Auth;
use View;

class ManualsMenuController extends AvlController
{

	protected $langs = null;

	protected $accessModel = null;

	public function __construct (Request $request) {
		parent::__construct($request);

		$this->accessModel = Menu::where('model', 'App\Models\Langs')->firstOrFail();

		View::share('accessModel', $this->accessModel);
	}

	/**
	 * Страница вывода списка новостей к определенному новостному разделу
	 * @param  int  $id      номер раздела
	 * @param  Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
			$this->authorize('view', $this->accessModel);

			return view('adminmanuals::manuals-menu.index', [

			]);
	}

	/**
	 * Метод для обновления определенной записи
	 * @param  Request $request
	 * @param  int  $id      Номер раздела
	 * @return redirect to index method
	 */
	public function update($id = null, Request $request)
	{
		$this->authorize('update', $this->accessModel);

		$manual = ($id == 0) ? new Manuals : Manuals::find($id);
		$manual->title = $request->title;

		if ($manual->save()) {
			return [
				'success' => ['Пункт <b>'. $manual->title .'</b> - '. (($id == 0) ? 'добавлен' : 'изменен') .'!']
			];
		}
		return ['errors' => ['Произошла ошибка обратитесь к Администратору']];
	}

	/**
	 * Удаление записи и всех медиа файлов
	 * @param  int $id      Номер пункта
	 * @return json
	 */
	public function destroy($id, Request $request)
	{
		$this->authorize('delete', $this->accessModel);

		$manual = Manuals::findOrFail($id);

		if ($manual->childrens) {
				$manual->childrens()->delete();
		}

		if ($manual->delete()) {
			return ['success' => ['Пункт удален!']];
		}

		return ['errors' => ['Ошибка при удалении']];
	}

	public function getManuals()
	{
		return [
			'elements' => Manuals::select(['id', 'title'])->whereNull('parent_id')->get()->toArray(),
		];
	}
}
