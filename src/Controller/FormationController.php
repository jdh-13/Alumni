<?php


namespace App\Controller;


use App\Entity\Degree;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\Routing\Annotation\Route;

class FormationController extends AbstractController
{
    /**
     * @Route("/admin/formation/{id}",name="admin.formation.repo")
     */
    public function repository(Degree $degree)
    {
        return $this->render("admin/formation/repo.html.twig", ['degree'=>$degree]);
    }
}