<?php namespace Avl\AdminManuals\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ModelTrait;
use LaravelLocalization;

class Manuals extends Model
{
		use ModelTrait;

		protected $table = 'manuals';

		protected $modelName = __CLASS__;

		protected $lang = null;

		public function __construct ()
		{
			$this->lang = LaravelLocalization::getCurrentLocale();
		}

 		public function childrens()
 		{
 			return $this->hasMany('Avl\AdminManuals\Models\Manuals', 'parent_id');
 		}

}
