<?php 

/**
 * SharedController Controller
 * @category  Controller / Model
 */
class SharedController extends BaseController{
	
	/**
     * books_category_id_option_list Model Action
     * @return array
     */
	function books_category_id_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT category_id AS value,category_name AS label FROM categories ORDER BY category_name ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

}
