<?php

/**
 * 
 */
class Content
{
	protected $publish_date;

	private $content;

	public function __construct()
	{
				
		$this->load_dependecies();

	}			

	public function save( $content ){
		$this->content;
	}

	public function read(){
		return $this->content;
	}

	public function load_dependecies(){
		require_once plugin_dir_path( __FILE__ ) . 'CPT.php';
	}

}

?>