<?php

class PagesTest extends PHPUnit_Framework_TestCase {
	
	public function testRenderReturnHelloWorld() {
		
		$pages = new \functions\Pages();
		
		$expected = 'Hello World';
		
		$this->assertEquals($expected, $pages->render());
		
	}
	
}

?>