<?php

namespace App\Controller;

use App\Repository\DegreeRepository;
use App\Repository\UserRepository;
use App\Repository\YearRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/",name="home.index")
     */
    public function index( Request $request, DegreeRepository $degreeRepo,YearRepository $yearRepo, UserRepository $userRepo)

    {
        $users=null;
        if($request->request->count())
        {
            $degree=$request->request->get('degree');
            $year=$request->request->get('year');
            $users= $userRepo->search($degree,$year);

        }
        $degrees = $degreeRepo->findAll();
        $years = $yearRepo->findAll();

        return $this->render('home.html.twig',['degrees'=>$degrees,
                                            'years'=>$years,
                                            'result'=>$users]);
    }
}

