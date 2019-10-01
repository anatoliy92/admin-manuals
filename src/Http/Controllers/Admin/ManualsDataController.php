<?php namespace Avl\AdminManuals\Controllers\Admin;

use App\Http\Controllers\Avl\AvlController;
	use Avl\AdminManuals\Models\Manuals;
	use Avl\AdminManuals\Models\ManualsData;
	use Illuminate\Http\Request;
	use App\Models\{Menu, Langs};
	use View;

class ManualsDataController extends AvlController
{
	protected $accessModel = null;

	public function __construct (Request $request) {
		parent::__construct($request);

		$this->accessModel = new Manuals();

		View::share('accessModel', $this->accessModel);
		View::share('langs', Langs::where('good', 1)->orderBy('sind')->get());
	}

	/**
	 * Страница вывода списка новостей к определенному новостному разделу
	 * @param  int  $id      номер раздела
	 * @param  Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function index($id, $alias, Request $request)
	{
		$this->authorize('view', $this->accessModel);

		return view('adminmanuals::manuals-data.index', [
			'manual' => Manuals::findOrFail($id),
			'manual_child' => Manuals::where('alias', $alias)->first()
		]);
	}

	/**
	 * Метод для обновления определенной записи
	 * @param  Request $request
	 * @param  int  $id      Номер раздела
	 * @return redirect to index method
	 */
	public function update($id, $alias, Request $request)
	{
		$this->authorize('update', $this->accessModel);

		$manual_id = Manuals::where('alias', $alias)->first();

		$manualData = ($request->manual_data_id == 0) ? new ManualsData : ManualsData::find($request->manual_data_id);

		$manualData->manual_id = $manual_id->id;
		$manualData->title_ru = $request->title_ru;
		$manualData->title_kz = $request->title_kz;
		$manualData->title_en = $request->title_en;
		if ($manualData->save()) {
			return [
				'success' => ['Пункт <b>'. $manualData->title_ru .'</b> - '. (($request->manual_data_id == 0) ? 'добавлен' : 'изменен') .'!']
			];
		}
		return ['errors' => ['Произошла ошибка обратитесь к Администратору']];
	}

	/**
	 * Удаление записи  файлов
	 * @param  int $id      Номер раздела
	 * @return json
	 */
	public function destroy($id, $alias, $manual_id, Request $request)
	{
		$this->authorize('delete', $this->accessModel);

		$manualData = ManualsData::findOrFail($manual_id);

		if ($manualData->delete()) {
			return ['success' => ['Пункт удален!']];
		}

		return ['errors' => ['Ошибка при удалении']];
	}

	public function getManualsData($id, $alias)
	{
		$langs = Langs::all()->toArray();
		$parent = Manuals::where('alias', $alias)->first();
		$manualsData = ManualsData::select(['id', 'title_ru', 'title_kz', 'title_en', 'good'])->whereManual_id($parent->id)->get()->toArray();

		return [
			'elements' => $manualsData,
			'langs' => $langs
		];
	}

}
