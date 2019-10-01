<?php
use Avl\AdminManuals\Models\{ Manuals, ManualsData };

if (!function_exists('getManualItems')) {
    function getManualItems($alias)
    {
		$manuals = Manuals::whereAlias($alias)->first();
		if (!is_null($manuals)) {
			$manuals = $manuals->manual_data_childrens()->get();
		}
		return $manuals ?? null;
    }
}

if (!function_exists('getManualItem')) {
	function getManualItem ($id)
	{
		return ManualsData::find($id);
	}
}

 ?>
