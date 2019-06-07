<?php namespace Avl\AdminManuals\Controllers\Admin;

use App\Http\Controllers\Avl\AvlController;
	use Avl\AdminManuals\Models\Manuals;
	use Illuminate\Http\Request;
	use App\Models\Menu;
	use View;

class ManualsController extends AvlController
{
	protected $accessModel = null;

	public function __construct (Request $request) {
		parent::__construct($request);

		$this->accessModel = new Manuals();

		View::share('accessModel', $this->accessModel);
	}

	/**
	 * Страница вывода списка новостей к определенному новостному разделу
	 * @param  int  $id      номер раздела
	 * @param  Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function index($id, Request $request)
	{
		$this->authorize('view', $this->accessModel);

		return view('adminmanuals::manuals.index', [
			'manual' => Manuals::findOrFail($id)
		]);
	}

	/**
	 * Метод для обновления определенной записи
	 * @param  Request $request
	 * @param  int  $id      Номер раздела
	 * @return redirect to index method
	 */
	public function update($id, $list_id, Request $request)
	{
		$this->authorize('update', $this->accessModel);

		$manual = ($list_id == 0) ? new Manuals : Manuals::find($list_id);
		$manual->title = $request->title;
		$manual->alias = $request->alias;
		$manual->parent_id = $id;

		if ($manual->save()) {
			return [
				'success' => ['Пункт <b>'. $manual->title .'</b> - '. (($list_id == 0) ? 'добавлен' : 'изменен') .'!']
			];
		}
		return ['errors' => ['Произошла ошибка обратитесь к Администратору']];
	}

	/**
	 * Удаление записи  файлов
	 * @param  int $id      Номер раздела
	 * @return json
	 */
	public function destroy($id, $list_id, Request $request)
	{
		$this->authorize('delete', $this->accessModel);

		$manual = Manuals::findOrFail($list_id);

		if ($manual->delete()) {
			return ['success' => ['Пункт удален!']];
		}

		return ['errors' => ['Ошибка при удалении']];
	}

	public function getManuals($manual_id)
	{
		return [
			'elements' => Manuals::select(['id', 'title', 'alias'])->whereParent_id($manual_id)->get()->toArray(),
		];
	}

}
