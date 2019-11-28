<?php


namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AlumniController
 * @package App\Controller

 */
class AlumniController extends AbstractController

{
    /**
    * @Route("/alumni/{id}/{slug}", name="alumni.index")
    */
    public function index($id, User $user, $slug)
    {
        return $this->render('alumni/index.html.twig',['user'=> $user]);
    }

}