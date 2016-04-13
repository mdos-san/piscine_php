<?php

class	Matrix {

	const	VOID = 0;
	const	IDENTITY = 1;
	const	SCALE = 2;
	const	RX = 3;
	const	RY = 4;
	const	RZ = 5;
	const	TRANSLATION = 6;
	const	PROJECTION = 7;
	
	private	$_mtx = [];
	private	$_preset;
	private	$_scale;
	private	$_angle;
	private	$_vtc;
	private	$_fov;
	private	$_ratio;
	private	$_near;
	private	$_far;

	static	$verbose = false;

	public function	doc(){
		return (file_get_contents("Matrix.doc.txt"));
	}
	public function	get_mtx(){
			return ($this->_mtx);
	}
	public function	set_mtx(array $array){
			$this->_mtx = $array;
	}

	public function	__construct(array $kwarg){
		$this->_preset = $kwarg['preset'];
		if ($this->_preset == self::VOID)
		{
			$this->_mtx = [];
		}
		if ($this->_preset == self::IDENTITY)
		{
			$this->_mtx = array(array(1, 0, 0, 0), array(0, 1, 0, 0), array(0, 0, 1, 0), array(0, 0, 0, 1));
			if (MATRIX::$verbose == true)
				print("Matrix IDENTITY instance constructed" . PHP_EOL);
		}
		if ($this->_preset == self::SCALE)
		{
			$this->_scale = $kwarg['scale'];
			$this->_mtx = array(array($this->_scale, 0, 0, 0), array(0, $this->_scale, 0, 0), array(0, 0, $this->_scale, 0), array(0, 0, 0, $this->_scale));
			if (MATRIX::$verbose == true)
				print("Matrix SCALE preset instance constructed" . PHP_EOL);
		}
		if ($this->_preset == self::RX || $this->_preset == self::RY || $this->_preset == self::RZ)
		{
			$this->_angle = $kwarg['angle'];
			if ($this->_preset == self::RX)
			{
				$this->_mtx = array(array(1, 0, 0, 0), array(0, cos($this->_angle), -sin($this->_angle), 0), array(0, sin($this->_angle), cos($this->_angle), 0), array(0, 0, 0, 1));
				if (MATRIX::$verbose == true)
					print("Matrix Ox ROTATION preset instance constructed" . PHP_EOL);
			}
			if ($this->_preset == self::RY)
			{
				$this->_mtx = array(array(cos($this->_angle), 0, sin($this->_angle), 0), array(0, 1, 0, 0), array(-sin($this->_angle), 0, cos($this->_angle), 0), array(0, 0, 0, 1));
				if (MATRIX::$verbose == true)
					print("Matrix Oy ROTATION preset instance constructed" . PHP_EOL);
			}
			if ($this->_preset == self::RZ)
			{
				$this->_mtx = array(array(cos($this->_angle), -sin($this->_angle), 0, 0), array(sin($this->_angle), cos($this->_angle), 0, 0), array(0, 0, 1, 0), array(0, 0, 0, 1));
				if (MATRIX::$verbose == true)
					print("Matrix Oz ROTATION preset instance constructed" . PHP_EOL);
			}
		}
		if ($this->_preset == self::TRANSLATION)
		{
			$this->_vtc = $kwarg['vtc'];
			$this->_mtx = array(array(1, 0, 0, $this->_vtc->get_x()), array(0, 1, 0,  $this->_vtc->get_y()), array(0, 0, 1, $this->_vtc->get_z()), array(0, 0, 0, 1));
			if (MATRIX::$verbose == true)
				print("Matrix TRANSLATION preset instance constructed" . PHP_EOL);
		}
		if ($this->_preset == self::PROJECTION)
		{
			$this->_fov = $kwarg['fov'];
			$this->_ratio = $kwarg['ratio'];
			$this->_near = $kwarg['near'];
			$this->_far = $kwarg['far'];
			$this->_mtx = array(array((1 / tan(deg2rad($this->_fov/2)) / $this->_ratio)),
						array(0,  1 / (tan(deg2rad($this->_fov / 2))), 0, 0),
						array(0, 0, -($this->_far + $this->_near) / ($this->_far - $this->_near), -(2 * $this->_far * $this->_near) / ($this->_far - $this->_near)),
						array(0, 0, -1, 0));
			if (MATRIX::$verbose == true)
				print("Matrix PROJECTION preset instance constructed" . PHP_EOL);
		}
		return;
	}

	public function	__destruct(){
		if (Matrix::$verbose == true)
			print('Matrix instance destructed' . PHP_EOL);
		return;
	}

	public function	__toString(){
		$str = sprintf("M | vtcX | vtcY | vtcZ | vtxO\n");
		$str .= sprintf("-----------------------------\n");
		$str .= sprintf("x | %.2lf | %.2lf | %.2lf | %.2lf\n", $this->_mtx[0][0], $this->_mtx[0][1], $this->_mtx[0][2], $this->_mtx[0][3]);
		$str .= sprintf("y | %.2lf | %.2lf | %.2lf | %.2lf\n", $this->_mtx[1][0], $this->_mtx[1][1], $this->_mtx[1][2], $this->_mtx[1][3]);
		$str .= sprintf("z | %.2lf | %.2lf | %.2lf | %.2lf\n", $this->_mtx[2][0], $this->_mtx[2][1], $this->_mtx[2][2], $this->_mtx[2][3]);
		$str .= sprintf("w | %.2lf | %.2lf | %.2lf | %.2lf", $this->_mtx[3][0], $this->_mtx[3][1], $this->_mtx[3][2], $this->_mtx[3][3]);
		return($str);
	}

	public function	mult(Matrix $rhs){
		$a1 = $this->get_mtx();
		$a2 = $rhs->get_mtx();
		$new = new Matrix(array('preset' => Matrix::VOID));
		$new->set_mtx(array(
			array($a1[0][0] * $a2[0][0] + $a1[0][1] * $a2[1][0] + $a1[0][2] * $a2[2][0] + $a1[0][3] * $a2[3][0],
					$a1[0][0] * $a2[0][1] + $a1[0][1] * $a2[1][1] + $a1[0][2] * $a2[2][1] + $a1[0][3] * $a2[3][1],
					$a1[0][0] * $a2[0][2] + $a1[0][1] * $a2[1][2] + $a1[0][2] * $a2[2][2] + $a1[0][3] * $a2[3][2],
					$a1[0][0] * $a2[0][3] + $a1[0][1] * $a2[1][3] + $a1[0][2] * $a2[2][3] + $a1[0][3],
			),
			array($a1[1][0] * $a2[0][0] + $a1[1][1] * $a2[1][0] + $a1[1][2] * $a2[2][0] + $a1[1][3] * $a2[3][0],
					$a1[1][0] * $a2[0][1] + $a1[1][1] * $a2[1][1] + $a1[1][2] * $a2[2][1] + $a1[1][3] * $a2[3][1],
					$a1[1][0] * $a2[0][2] + $a1[1][1] * $a2[1][2] + $a1[1][2] * $a2[2][2] + $a1[1][3] * $a2[3][2],
					$a1[1][0] * $a2[0][3] + $a1[1][1] * $a2[1][3] + $a1[1][2] * $a2[2][3] + $a1[1][3],
			),
			array($a1[2][0] * $a2[0][0] + $a1[2][1] * $a2[1][0] + $a1[2][2] * $a2[2][0] + $a1[2][3] * $a2[3][0],
					$a1[2][0] * $a2[0][1] + $a1[2][1] * $a2[1][1] + $a1[2][2] * $a2[2][1] + $a1[2][3] * $a2[3][1],
					$a1[2][0] * $a2[0][2] + $a1[2][1] * $a2[1][2] + $a1[2][2] * $a2[2][2] + $a1[2][3] * $a2[3][2],
					$a1[2][0] * $a2[0][3] + $a1[2][1] * $a2[1][3] + $a1[2][2] * $a2[2][3] + $a1[2][3],
			),
			array($a1[3][0] * $a2[0][0] + $a1[3][1] * $a2[1][0] + $a1[3][2] * $a2[2][0] + $a1[3][3] * $a2[3][0],
					$a1[3][0] * $a2[0][1] + $a1[3][1] * $a2[1][1] + $a1[3][2] * $a2[2][1] + $a1[3][3] * $a2[3][1],
					$a1[3][0] * $a2[0][2] + $a1[3][1] * $a2[1][2] + $a1[3][2] * $a2[2][2] + $a1[3][3] * $a2[3][2],
					$a1[3][0] * $a2[0][3] + $a1[3][1] * $a2[1][3] + $a1[3][2] * $a2[2][3] + $a1[3][3],
			),
		));
		return ($new);
	}

	public function	transformVertex(Vertex $vtx){
		$new = new Vertex(array('x' => 0, 'y' => 0, 'z' => 0));
		$a = $this->get_mtx();
		$new->set_x($a[0][0] * $vtx->get_x() + $a[0][1] * $vtx->get_y() + $a[0][2] * $vtx->get_z() + $a[0][3] * $vtx->get_w());
		$new->set_y($a[1][0] * $vtx->get_x() + $a[1][1] * $vtx->get_y() + $a[1][2] * $vtx->get_z() + $a[1][3] * $vtx->get_w());
		$new->set_z($a[2][0] * $vtx->get_x() + $a[2][1] * $vtx->get_y() + $a[2][2] * $vtx->get_z() + $a[2][3] * $vtx->get_w());
		$new->set_w($a[3][0] * $vtx->get_x() + $a[3][1] * $vtx->get_y() + $a[3][2] * $vtx->get_z() + $a[3][3] * $vtx->get_w());
		return ($new);
	}
}
?>
