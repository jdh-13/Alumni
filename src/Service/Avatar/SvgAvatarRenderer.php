<?php
namespace App\Service\Avatar;

class SvgAvatarRenderer {

	private $template;

    public function __construct($template)
    {
    	$this->template = $template;
    }

	public function render(AvatarMatrix $matrix)
    {
    		$matrix->buildMatrix();
        $result = $matrix->getMatrix();
        $size = $matrix->getSize();

        ob_start();

        include $this->template;

        return ob_get_clean();
    }
}
