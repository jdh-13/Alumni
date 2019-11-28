<?php
namespace App\Service\Avatar;

class AvatarMatrix 
{
	const DEFAULT_SIZE = 5;
	const DEFAULT_COLORS = ['black', 'white'];
		
	private $size;
	private $colors;
	private $matrix;

	public function __construct()
	{

		$this ->size = self::DEFAULT_SIZE;
		$this ->colors = self::DEFAULT_COLORS;
		$this ->matrix = [];
	}

	public function buildMatrix()
	{
		$matrix = [];
		for ($i = 0; $i < $this ->size; $i++){
			$matrix[$i] = [];
			for($j = 0; $j < $this ->size; $j++){
				$color = $this ->colors[rand(0, count($this ->colors) -1)];
				$matrix [$i][$j] = $color;
				$matrix [$i][$this ->size - 1 - $j] = $color; 
				
			}
		}
		$this ->matrix = $matrix;
	}

	public function setSize(int $size)
    {
    	$this->size = $size;    
    }
    
    public function getSize()
    {
    	return $this->size;
    }
    
    public function setColors(array $colors)
    {
    	$this->colors = $colors;    
    }
    
    public function getColors()
    {
    	return $this->colors;
    }
    
    public function getMatrix()
    {
    	return $this->matrix;
    }
    
    private function getRandomColor()
    {
    	return $this->colors[rand(0, count($this->colors) -1)];
    }
}





	
