<?php

class	Color {

	static	$verbose = false;

	public	$red = 0;
	public	$green = 0;
	public	$blue = 0;

	public function			__construct(array $kwarg){
		if (array_key_exists('rgb', $kwarg))
		{
			$this->red = $kwarg['rgb'] >> 16;
			$this->green = $kwarg['rgb'] >> 8 & 0x00FF;
			$this->blue = $kwarg['rgb'] & 0x0000FF;
		}
		else
		{
			if (array_key_exists('red', $kwarg))
				$this->red = $kwarg['red'];
			if (array_key_exists('green', $kwarg))
				$this->green = $kwarg['green'];
			if (array_key_exists('blue', $kwarg))
				$this->blue = $kwarg['blue'];
		}
		if (Color::$verbose == True)
			print($this . ' constructed.' . PHP_EOL );
		return;
	}

	public function			__destruct(){
		if (Color::$verbose == true)
			print($this . ' destructed.' . PHP_EOL);
		return;
	}

	public static function	doc() {
		return (file_get_contents("Color.doc.txt"));
	}

	public function			__toString(){
		return (sprintf("Color( red: %3d, green: %3d, blue: %3d )",  $this->red, $this->green, $this->blue));
	}

	public function			add(Color $add){
		$new = new Color(array('red' => $this->red + $add->red, 'green' => $this->green + $add->green, 'blue' => $this->blue + $add->blue));
		return ($new);
	}

	public function			sub(Color $sub){
		$new = new Color(array('red' => $this->red - $sub->red, 'green' => $this->green - $sub->green, 'blue' => $this->blue - $sub->blue));
		return ($new);
	}

	public function			mult($mul){
		$new = new Color(array('red' => $this->red * $mul, 'green' => $this->green * $mul, 'blue' => $this->blue * $mul));
		return ($new);
	}
}

?>
