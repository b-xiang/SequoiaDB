<?php
class droptest extends PHPUnit_Framework_TestCase
{
	public function testselectCS()
	{
		$sdb = new Sequoiadb() ;
		$array = $sdb->connect( "localhost:11810" ) ;
		$this->assertEquals( 0, $array['errno'] ) ;
		$cs = $sdb->selectCS( "cs_test" ) ;
		$this->assertNotEmpty( $cs ) ;
		return $cs ;
	}
	/**
	* @depends testselectCS
	*/
	public function testselectCL( SequoiaCS $cs )
	{
		$cl = $cs->selectCollection( "cl_test" ) ;
		$this->assertNotEmpty( $cl ) ;
		return $cl ;
	}
	/**
	* @depends testselectCL
	*/
	public function testgetCSName()
	{
	   $args_array = func_get_args() ;
	   $cl = $args_array[0] ;
		$CSName = $cl->getCSName() ;
		$this->assertEquals( "cs_test", $CSName );
	}
	/**
	* @depends testselectCS
	*/
	public function testdropCS( SequoiaCS $cs )
	{
		$array = $cs->drop() ;
		$this->assertEquals( 0, $array["errno"] ) ;
	}
}
?>