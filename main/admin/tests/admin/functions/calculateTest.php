<?php
//namespace tests\admin\functions;
//use admin\functions;
class calculateTest extends PHPUnit_Framework_TestCase {
	
	public function testRenderReturn() {
		$calculate = new \functions\Calculate();
		
		$expected = false;
		
		$this->assertEquals($expected, $calculations->ageGreaterSixtyTwo(400));
		
	}
}
?>
