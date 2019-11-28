<?php
namespace App\Service\Avatar;
use App\Service\Tools\ColorTools;

class SvgAvatarFactory
{
    const AVATAR_DIR='avatar';
    private $template;

    public function __construct($template)
    {
        $this->template=$template;
    }

     public function getAvatar(int $nbColors, int $size)
	{
		$colors = ColorTools::getRandomColors($nbColors);

		$avatar = new AvatarMatrix();
		$avatar ->setColors($colors);
		$avatar ->setSize($size);
		$svgAvatarRenderer = new SvgAvatarRenderer($this->template);
		$svg = $svgAvatarRenderer->render($avatar);

		return $svg;
	}
}