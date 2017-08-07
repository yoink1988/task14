<?php

include_once __DIR__. '/Calc.php';

/**
 * Description of CalcTest
 *
 * OK (31 tests, 40 assertions)
 */
class CalcTest extends PHPUnit_Framework_TestCase
{

	public function setUp()
	{
		$this->calc = new Calc;
	}


	public function testPlus()
	{
		$this->assertTrue($this->calc->plus(2,3) == 5);
	}

	public function testMinus()
	{
		$this->assertTrue($this->calc->minus(10,3) == 7);
	}
	public function testMult()
	{
		$this->assertTrue($this->calc->mult(2,5) == 10);
	}
	public function testDivision()
	{
		$this->assertTrue($this->calc->division(10,2) == 5);
	}

	public function testDivisionZero()
	{
		define ('ZERO_DIV', 'Divisiion by Zero!!!');
		$this->assertTrue($this->calc->division(10,0) == ZERO_DIV);
	}

	public function testSquareRoot()
	{
		$this->assertTrue($this->calc->squareRoot(81) == 9);
	}
	
	public function testPercent()
	{
		$this->assertTrue($this->calc->percent(500,3) == 15);
	}

	public function testCheckInput()
	{
		$this->assertTrue($this->calc->checkInput(1321) == 1321);
	}

	public function testCheckInputFalse()
	{
		$this->assertTrue($this->calc->checkInput('dadsa') == false);
	}

	public function testSetAction()
	{
		$this->calc->setAction('+');
		$this->assertTrue($this->calc->getAction() == '+');
	}

	public function testGetAction()
	{
		$act = '=';
		$this->calc->setAction($act);
		$this->assertTrue($this->calc->getAction() == $act);
	}

	public function testMemPlus()
	{
		$_SESSION['calc']['action'] = 'm+';
		$_SESSION['calc']['mem'] = 2;
		$this->calc->memPlus(5);
		$this->assertEquals($_SESSION['calc']['mem'], 7);
		$this->assertFalse(isset($_SESSION['calc']['action']));
	}

		public function testMemPlusEmptyMem()
	{
		$_SESSION['calc']['action'] = 'm+';
		$this->calc->memPlus(5);
		$this->assertEquals($_SESSION['calc']['mem'], 5);
		$this->assertFalse(isset($_SESSION['calc']['action']));
	}

	public function testMemMinus()
	{
		$_SESSION['calc']['action'] = 'm-';
		$_SESSION['calc']['mem'] = 5;
		$this->calc->memMinus(2);
		$this->assertEquals($_SESSION['calc']['mem'], 3);
		$this->assertFalse(isset($_SESSION['calc']['action']));
	}

		public function testMemMinusEmptyMem()
	{
		$_SESSION['calc']['action'] = 'm-';
		$this->calc->memMinus(5);
		$this->assertEquals($_SESSION['calc']['mem'], -5);
		$this->assertFalse(isset($_SESSION['calc']['action']));
	}

	public function testMemSave()
	{
		$_SESSION['calc']['action'] = 'ms';
		$this->calc->memSave(6);
		$this->assertEquals($_SESSION['calc']['mem'], 6);
		$this->assertFalse(isset($_SESSION['calc']['action']));
	}

	public function testMemClear()
	{
		$_SESSION['calc']['mem'] = 12;
		$_SESSION['calc']['action']= 'mc';
		$this->calc->memClear();
		$this->assertFalse(isset($_SESSION['calc']['mem']));
		$this->assertFalse(isset($_SESSION['calc']['action']));
	}

	public function testMemRead()
	{
		$_SESSION['calc']['mem'] = 5;
		$this->assertEquals(5, $this->calc->memRead());
	}

	public function testMemReadZero()
	{
		$this->assertEquals(0, $this->calc->memRead());
	}

	public function testClearData()
	{
		$_SESSION['calc']['input'] = '12';
		$_SESSION['calc']['action'] = '=';
		$this->calc->setVal1(12);
		$this->calc->setVal2(33);

		$this->calc->clearData();

		$this->assertFalse(isset($_SESSION['calc']['mem']));
		$this->assertFalse(isset($_SESSION['calc']['action']));
		$this->assertTrue($this->calc->getVal1() == null); 
		$this->assertTrue($this->calc->getVal2() == null);
	}

	public function testSetVal1()
	{
		$this->calc->setVal1(2);
		$this->assertTrue($this->calc->getVal1() == 2);
	}

	public function testSetVal2()
	{
		$this->calc->setVal1(5);
		$this->assertTrue($this->calc->getVal1() == 5);
	}

	public function testGetVal1()
	{
		$val = 2;
		$this->calc->setVal1($val);
		$this->assertTrue($this->calc->getVal1() == $val);
	}

	public function testGetVal2()
	{
		$val = 5;
		$this->calc->setVal1($val);
		$this->assertTrue($this->calc->getVal1() == $val);
	}

	public function testSetSessAction()
	{
		$this->calc->setSessAction('-');
		$this->assertTrue($this->calc->getSessAction() == '-');
	}
	public function testGetSessAction()
	{
		$sessAct = '*';
		$this->calc->setSessAction($sessAct);
		$this->assertEquals($this->calc->getSessAction(), $sessAct);
	}

	public function testSetErr()
	{
		$this->calc->setErr('message');
		$this->assertEquals($this->calc->getOutput()['%err%'], 'message');
	}

	public function testCheckMem()
	{
		$_SESSION['calc']['mem'] = 12;
		$this->calc->checkMem();
		$this->assertEquals($this->calc->getOutput()['%mem%'], 'M');
	}

	public function testCheckMemEmpty()
	{
		$this->calc->checkMem();
		$this->assertEquals($this->calc->getOutput()['%mem%'], '');
	}

	public function testGetOputput()
	{
		$this->calc->setErr('message');

		$this->assertEquals($this->calc->getOutput()['%err%'], 'message');
	}

	public function testAddToRender()
	{
		$this->calc->addToRender('result');
		$this->assertEquals($this->calc->getOutput()['%out%'], 'result');
	}
}
