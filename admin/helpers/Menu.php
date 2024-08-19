<?php
/**
 * Menu Items
 * All Project Menu
 * @category  Menu List
 */

class Menu{
	
	
			public static $navbartopleft = array(
		array(
			'path' => 'home', 
			'label' => 'Home', 
			'icon' => ''
		),
		
		array(
			'path' => 'users', 
			'label' => 'Users', 
			'icon' => ''
		),
		
		array(
			'path' => 'books', 
			'label' => 'Books', 
			'icon' => ''
		),
		
		array(
			'path' => 'categories', 
			'label' => 'Categories', 
			'icon' => ''
		),
		
		array(
			'path' => 'issuance', 
			'label' => 'Issuance', 
			'icon' => ''
		),
		
		array(
			'path' => 'requests', 
			'label' => 'Requests', 
			'icon' => ''
		),
		
		array(
			'path' => 'resources', 
			'label' => 'Resources', 
			'icon' => ''
		),
		
		array(
			'path' => 'returns', 
			'label' => 'Returns', 
			'icon' => ''
		),
		
		array(
			'path' => 'books_by_category', 
			'label' => 'Books By Category', 
			'icon' => ''
		)
	);
		
	
	
			public static $status = array(
		array(
			"value" => "Active", 
			"label" => "Active", 
		),
		array(
			"value" => "Inactive", 
			"label" => "Inactive", 
		),);
		
			public static $status2 = array(
		array(
			"value" => "Pending", 
			"label" => "Pending", 
		),
		array(
			"value" => "Approved", 
			"label" => "Approved", 
		),
		array(
			"value" => "Denied", 
			"label" => "Denied", 
		),);
		
			public static $resource_type = array(
		array(
			"value" => "Video", 
			"label" => "Video", 
		),
		array(
			"value" => "Audio", 
			"label" => "Audio", 
		),
		array(
			"value" => "Document", 
			"label" => "Document", 
		),
		array(
			"value" => "Image", 
			"label" => "Image", 
		),
		array(
			"value" => "e-Book", 
			"label" => "E-Book", 
		),);
		
}