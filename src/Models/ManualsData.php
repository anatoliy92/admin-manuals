<?php namespace Avl\AdminManuals\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ModelTrait;
use LaravelLocalization;

class ManualsData extends Model
{
		use ModelTrait;

		protected $table = 'manuals_data';

		protected $modelName = __CLASS__;

		protected $lang = null;

		public function __construct ()
		{
			$this->lang = LaravelLocalization::getCurrentLocale();
		}
}
