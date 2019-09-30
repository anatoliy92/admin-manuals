<?php namespace Avl\AdminManuals\Controllers\Admin;

	use App\Http\Controllers\Avl\AvlController;
	use Avl\AdminManuals\Models\Manuals;
	use Illuminate\Http\Request;
	use App\Models\{Menu, Langs};
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
	 * Страница вывода подпунктов меню
	 * @param  int  $id      номер пункта меню
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
	 * Метод для обновления или добавления пункта меню
	 * @param  Request $request
	 * @param  int  $id      Номер пункта меню
	 * @param  int  $list_id      Номер подпункта меню
	 * @return redirect to index method
	 */
	public function update($id, $list_id, Request $request)
	{
		$this->authorize('update', $this->accessModel);

		$manual = ($list_id == 0) ? new Manuals : Manuals::find($list_id);
		$manual->title_ru = $request->title_ru;
		$manual->title_kz = $request->title_kz;
		$manual->title_en = $request->title_en;
		$manual->alias = $request->alias;
		$manual->parent_id = $id;

		if ($manual->save()) {
			return [
				'success' => ['Пункт <b>'. $manual->title_ru .'</b> - '. (($list_id == 0) ? 'добавлен' : 'изменен') .'!']
			];
		}
		return ['errors' => ['Произошла ошибка обратитесь к Администратору']];
	}

	/**
	 * Удаление пунктов
	 * @param  int  $id      Номер пункта меню
	 * @param  int  $list_id      Номер подпункта меню
	 * @return json
	 */
	public function destroy($id, $list_id, Request $request)
	{
		$this->authorize('delete', $this->accessModel);

		$manual = Manuals::findOrFail($list_id);

		if ($manual->manual_data_childrens) {
				$manual->manual_data_childrens()->delete();
		}

		if ($manual->delete()) {
			return ['success' => ['Пункт удален!']];
		}

		return ['errors' => ['Ошибка при удалении']];
	}

	public function getManuals($manual_id)
	{
		$langs = Langs::all()->toArray();
		return [
			'elements' => Manuals::select(['id', 'title_ru', 'title_kz', 'title_en', 'alias', 'good'])->whereParent_id($manual_id)->get()->toArray(),
			'langs' => $langs
		];
	}

}
