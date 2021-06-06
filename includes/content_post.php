<?php

class Post extends Content {
	public function __construct(){

		parent::__construct();
		$this->author = 'Peter Giammarco';

	}

	public function post( $content ){
		$this->format_content( $content );
		var_dump($content);
	}

}

?>