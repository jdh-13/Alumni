<?php
namespace App\Controller;

use App\Service\Avatar\SvgAvatarFactory;
use App\Service\Helpers\FileSystemHelper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AvatarController extends AbstractController
{
    private $SvgAvatarFactory;
    /**
     * @var FileSystemHelper
     */
    private $FileSystemHelper;

    public function __construct(SvgAvatarFactory $SvgAvatarFactory,FileSystemHelper $FileSystemHelper)
    {
       $this->SvgAvatarFactory=$SvgAvatarFactory;
       $this->FileSystemHelper=$FileSystemHelper;

    }

    /**
     * @Route("/avatar",name="avatar.get")
     */
    public function getAvatar($uploadDir)
    {
        $svg=$this->SvgAvatarFactory->getAvatar(2,5);

        // Création d'un nom de fichier unique et aléatoire
        $filename = sha1(uniqid(rand(), true)) .'.svg';

        // Crée les dossiers s'ils n'existent pas, et écrit dedans le contenu
        $this->FileSystemHelper->write($uploadDir.'/'.$this->SvgAvatarFactory::AVATAR_DIR.'/'.$filename, $svg);
        return $this->render('avatar.html.twig',[
            'filename'=>$filename]);
    }
}
