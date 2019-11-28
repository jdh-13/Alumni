<?php


namespace App\Twig;


use App\Service\Avatar\SvgAvatarFactory;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class AssetAvatarTwigExtension extends AbstractExtension

{
    private $uploadDir;
    public function __construct(string $uploadDir)
    {
        $this->uploadDir = $uploadDir;
    }

    public function getFunctions()
    {
        return array(
            new TwigFunction('asset_avatar', array($this,'assetAvatar'))
        );
    }
    public function assetAvatar(string $avatarName)
    {
        return '/' . $this->uploadDir. '/' . SvgAvatarFactory::AVATAR_DIR . '/' . $avatarName;
    }
}