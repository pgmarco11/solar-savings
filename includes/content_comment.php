<?php

class Comment extends Content {

	public function __construct(){
		parent::__construct();
	}

	public function add( $comment ){
		$this->save( 'John Doe', $comment );
	}

}

?>