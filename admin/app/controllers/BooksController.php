<?php 
/**
 * Books Page Controller
 * @category  Controller
 */
class BooksController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "books";
	}
	/**
     * List page records
     * @param $fieldname (filter record by a field) 
     * @param $fieldvalue (filter field value)
     * @return BaseView
     */
	function index($fieldname = null , $fieldvalue = null){
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		$fields = array("books.book_id", 
			"books.title", 
			"categories.category_name AS categories_category_name", 
			"books.author", 
			"books.publisher", 
			"books.lend_duration", 
			"books.serial_number", 
			"books.version", 
			"books.year_published", 
			"books.thumbnail");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				books.book_id LIKE ? OR 
				books.title LIKE ? OR 
				categories.category_name LIKE ? OR 
				books.category_id LIKE ? OR 
				books.author LIKE ? OR 
				books.publisher LIKE ? OR 
				books.lend_duration LIKE ? OR 
				books.serial_number LIKE ? OR 
				books.version LIKE ? OR 
				books.year_published LIKE ? OR 
				books.file LIKE ? OR 
				books.thumbnail LIKE ? OR 
				categories.category_id LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "books/search.php";
		}
		$db->join("categories", "books.category_id = categories.category_id", "INNER");
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("books.book_id", ORDER_TYPE);
		}
		if($fieldname){
			$db->where($fieldname , $fieldvalue); //filter by a single field name
		}
		$tc = $db->withTotalCount();
		$records = $db->get($tablename, $pagination, $fields);
		$records_count = count($records);
		$total_records = intval($tc->totalCount);
		$page_limit = $pagination[1];
		$total_pages = ceil($total_records / $page_limit);
		$data = new stdClass;
		$data->records = $records;
		$data->record_count = $records_count;
		$data->total_records = $total_records;
		$data->total_page = $total_pages;
		if($db->getLastError()){
			$this->set_page_error();
		}
		$page_title = $this->view->page_title = "Books";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$this->render_view("books/list.php", $data); //render the full page
	}
	/**
     * View record detail 
	 * @param $rec_id (select record by table primary key) 
     * @param $value value (select record by value of field name(rec_id))
     * @return BaseView
     */
	function view($rec_id = null, $value = null){
		$request = $this->request;
		$db = $this->GetModel();
		$rec_id = $this->rec_id = urldecode($rec_id);
		$tablename = $this->tablename;
		$fields = array("books.book_id", 
			"books.title", 
			"categories.category_name AS categories_category_name", 
			"books.author", 
			"books.publisher", 
			"books.lend_duration", 
			"books.serial_number", 
			"books.version", 
			"books.year_published", 
			"books.thumbnail");
		if($value){
			$db->where($rec_id, urldecode($value)); //select record based on field name
		}
		else{
			$db->where("books.book_id", $rec_id);; //select record based on primary key
		}
		$db->join("categories", "books.category_id = categories.category_id", "INNER ");  
		$record = $db->getOne($tablename, $fields );
		if($record){
			$page_title = $this->view->page_title = "Book Details";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		}
		else{
			if($db->getLastError()){
				$this->set_page_error();
			}
			else{
				$this->set_page_error("No record found");
			}
		}
		return $this->render_view("books/view.php", $record);
	}
	/**
     * Insert new record to the database table
	 * @param $formdata array() from $_POST
     * @return BaseView
     */
	function add($formdata = null){
		if($formdata){
			$db = $this->GetModel();
			$tablename = $this->tablename;
			$request = $this->request;
			//fillable fields
			$fields = $this->fields = array("title","category_id","author","publisher","lend_duration","serial_number","version","year_published","file","thumbnail");
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'title' => 'required',
				'category_id' => 'required',
				'author' => 'required',
				'publisher' => 'required',
				'lend_duration' => 'required|numeric|max_numeric,30|min_numeric,1',
				'serial_number' => 'required',
				'version' => 'required',
				'year_published' => 'required|numeric',
				'file' => 'required',
				'thumbnail' => 'required',
			);
			$this->sanitize_array = array(
				'title' => 'sanitize_string',
				'category_id' => 'sanitize_string',
				'author' => 'sanitize_string',
				'publisher' => 'sanitize_string',
				'lend_duration' => 'sanitize_string',
				'serial_number' => 'sanitize_string',
				'version' => 'sanitize_string',
				'year_published' => 'sanitize_string',
				'file' => 'sanitize_string',
				'thumbnail' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			//Check if Duplicate Record Already Exit In The Database
			$db->where("serial_number", $modeldata['serial_number']);
			if($db->has($tablename)){
				$this->view->page_error[] = $modeldata['serial_number']." Already exist!";
			} 
			if($this->validated()){
				$rec_id = $this->rec_id = $db->insert($tablename, $modeldata);
				if($rec_id){
					$this->set_flash_msg("Book Upload Succesful", "success");
					return	$this->redirect("books");
				}
				else{
					$this->set_page_error();
				}
			}
		}
		$page_title = $this->view->page_title = "Upload Book";
		$this->render_view("books/add.php");
	}
	/**
     * Update table record with formdata
	 * @param $rec_id (select record by table primary key)
	 * @param $formdata array() from $_POST
     * @return array
     */
	function edit($rec_id = null, $formdata = null){
		$request = $this->request;
		$db = $this->GetModel();
		$this->rec_id = $rec_id;
		$tablename = $this->tablename;
		 //editable fields
		$fields = $this->fields = array("book_id","title","category_id","author","publisher","lend_duration","serial_number","version","year_published","file","thumbnail");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'title' => 'required',
				'category_id' => 'required',
				'author' => 'required',
				'publisher' => 'required',
				'lend_duration' => 'required|numeric|max_numeric,30|min_numeric,1',
				'serial_number' => 'required',
				'version' => 'required',
				'year_published' => 'required|numeric',
				'file' => 'required',
				'thumbnail' => 'required',
			);
			$this->sanitize_array = array(
				'title' => 'sanitize_string',
				'category_id' => 'sanitize_string',
				'author' => 'sanitize_string',
				'publisher' => 'sanitize_string',
				'lend_duration' => 'sanitize_string',
				'serial_number' => 'sanitize_string',
				'version' => 'sanitize_string',
				'year_published' => 'sanitize_string',
				'file' => 'sanitize_string',
				'thumbnail' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			//Check if Duplicate Record Already Exit In The Database
			if(isset($modeldata['serial_number'])){
				$db->where("serial_number", $modeldata['serial_number'])->where("book_id", $rec_id, "!=");
				if($db->has($tablename)){
					$this->view->page_error[] = $modeldata['serial_number']." Already exist!";
				}
			} 
			if($this->validated()){
				$db->where("books.book_id", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg("Record updated successfully", "success");
					return $this->redirect("books");
				}
				else{
					if($db->getLastError()){
						$this->set_page_error();
					}
					elseif(!$numRows){
						//not an error, but no record was updated
						$page_error = "No record updated";
						$this->set_page_error($page_error);
						$this->set_flash_msg($page_error, "warning");
						return	$this->redirect("books");
					}
				}
			}
		}
		$db->where("books.book_id", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "Edit  Books";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("books/edit.php", $data);
	}
	/**
     * Delete record from the database
	 * Support multi delete by separating record id by comma.
     * @return BaseView
     */
	function delete($rec_id = null){
		Csrf::cross_check();
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		$this->rec_id = $rec_id;
		//form multiple delete, split record id separated by comma into array
		$arr_rec_id = array_map('trim', explode(",", $rec_id));
		$db->where("books.book_id", $arr_rec_id, "in");
		$bool = $db->delete($tablename);
		if($bool){
			$this->set_flash_msg("Record deleted successfully", "success");
		}
		elseif($db->getLastError()){
			$page_error = $db->getLastError();
			$this->set_flash_msg($page_error, "danger");
		}
		return	$this->redirect("books");
	}
}
