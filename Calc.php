<?php

class Calc
{
	private $action;
	private $sessAction;
	private $val1;
	private $val2;

	private $output = array('%out%' => '', '%mem%' => '','%err%' => '');

	public function checkInput($input)
	{
		if(filter_var($input, FILTER_VALIDATE_FLOAT))
		{
			return true;
		}
	return false;
	}

	public function getOutput()
	{
		return $this->output;
	}

	public function setErr($mess)
	{
		$this->output['%err%'] = $mess;
	}

	public function checkMem()
	{
		if(isset($_SESSION['calc']['mem']))
		{
			$this->output['%mem%'] = 'M';
		}
	}

	public function setAction($action)
	{
		$this->action = $action;
	}

	public function getAction()
	{
		return $this->action;
	}

	public function setSessAction($sessAct)
	{
		$this->sessAction = $sessAct;
	}

	public function getSessAction()
	{
		return $this->sessAction;
	}

	public function addToRender($res)
	{
		$this->output['%out%'] .= $res;
	}

	public function setVal1($input)
	{
		$this->val1 = (integer)$input;
	}

	public function setVal2($input)
	{
		$this->val2 = (integer)$input;
	}


	public function getVal1()
	{
		return $this->val1;
	}

	public function getVal2()
	{
		return $this->val2;
	}

	public function clearData()
	{
		unset($_SESSION['calc']['input']);
		unset($_SESSION['calc']['action']);
		$this->val1 = null;
		$this->val2 = null;
	}

	public function percent($val1, $val2)
	{
		return $val1 * $val2 / 100;
	}

	public function memPlus($val)
	{
		if(isset($_SESSION['calc']['mem']))
		{
			$_SESSION['calc']['mem'] += $val;
		}
		else
		{
			$_SESSION['calc']['mem'] = $val;
		}
		unset($_SESSION['calc']['action']);
	}

	public function memMinus($val)
	{
		if(isset($_SESSION['calc']['mem']))
		{
			$_SESSION['calc']['mem'] -= $val;
		}
		else
		{
			$_SESSION['calc']['mem'] = (0-$val);
		}
		unset($_SESSION['calc']['action']);
	}

	public function memSave($val)
	{
		$_SESSION['calc']['mem'] = $val;
		unset($_SESSION['calc']['action']);
	}
	public function memClear()
	{
		unset($_SESSION['calc']['mem']);
		unset($_SESSION['calc']['action']);
	}
	public function memRead()
	{
		if(isset($_SESSION['calc']['mem']))
		{
			return $_SESSION['calc']['mem'];
		}
		return 0;
	}

	public function plus($val1,$val2)
	{
		return $val1 + $val2;
	}

	public function minus($val1, $val2)
	{
		return $val1 - $val2;
	}

	public function mult($val1, $val2)
	{
		return $val1 * $val2;
	}

	public function division($val1, $val2)
	{
		if($val2 != '0')
		{
			return $val1 / $val2;
		}
		return ZERO_DIV;
	}

	public function squareRoot($val)
	{
		return sqrt($val);
	}

public function __construct(){}
}
