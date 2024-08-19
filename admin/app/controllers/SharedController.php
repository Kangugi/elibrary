<?php 

/**
 * SharedController Controller
 * @category  Controller / Model
 */
class SharedController extends BaseController{
	
	/**
     * users_username_value_exist Model Action
     * @return array
     */
	function users_username_value_exist($val){
		$db = $this->GetModel();
		$db->where("username", $val);
		$exist = $db->has("users");
		return $exist;
	}

	/**
     * users_email_value_exist Model Action
     * @return array
     */
	function users_email_value_exist($val){
		$db = $this->GetModel();
		$db->where("email", $val);
		$exist = $db->has("users");
		return $exist;
	}

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

	/**
     * books_serial_number_value_exist Model Action
     * @return array
     */
	function books_serial_number_value_exist($val){
		$db = $this->GetModel();
		$db->where("serial_number", $val);
		$exist = $db->has("books");
		return $exist;
	}

	/**
     * issuance_request_id_option_list Model Action
     * @return array
     */
	function issuance_request_id_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT request_id AS value,request_id AS label FROM requests";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * issuance_issue_date_option_list Model Action
     * @return array
     */
	function issuance_issue_date_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT issue_date AS value,issue_date AS label FROM issuance";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * issuance_return_id_option_list Model Action
     * @return array
     */
	function issuance_return_id_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT return_id AS value,return_id AS label FROM returns";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * requests_book_id_option_list Model Action
     * @return array
     */
	function requests_book_id_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT book_id AS value,title AS label FROM books";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * requests_duration_option_list Model Action
     * @return array
     */
	function requests_duration_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT lend_duration AS value,lend_duration AS label FROM books";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * requests_user_id_option_list Model Action
     * @return array
     */
	function requests_user_id_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT user_id AS value,username AS label FROM users";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * requests_status_default_value Model Action
     * @return Value
     */
	function requests_status_default_value(){
		$db = $this->GetModel();
		$sqltext = "SELECT*FROM requests WHERE status = 'Pending'";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * resources_category_id_option_list Model Action
     * @return array
     */
	function resources_category_id_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT category_id AS value,category_name AS label FROM categories";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * returns_issue_id_option_list Model Action
     * @return array
     */
	function returns_issue_id_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT issue_id AS value,issue_id AS label FROM issuance";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

}
