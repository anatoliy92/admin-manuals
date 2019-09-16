<?php
use Avl\AdminManuals\Models\Manuals;

if (!function_exists('getManualsChildrenByAlias')) {
    function getManualsChildrenByAlias($alias)
    {
			$manuals = Manuals::whereAlias($alias)->first();
			if (is_null($manuals)) {
				$manuals = null;
				return $manuals;
			}else{
				$manuals = $manuals->manual_data_childrens()->get();
				return $manuals;
			}
    }
}

 ?>
