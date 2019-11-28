<?php


namespace App\Controller\Admin;


use App\Entity\Promotion;
use App\Form\PromotionFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminPromotionController extends AbstractController
{
    /**
     *@Route("/admin/promotion/new",name="admin.promotion.new")
     */
        public function new(Request $request)
        {
            $form = $this->createForm(PromotionFormType::class);
            $form->handleRequest($request);
            if($form->isSubmitted() && $form->isValid())
            {
                $promotion = $form->getData();

                $manager = $this->getDoctrine()->getManager();
                $manager->persist($promotion);
                $manager->flush();
                $this->addFlash('success','Promotion ajoutée avec succès!');
                return $this->redirectToRoute('admin.index',
                    [
                        '_fragment' => 'promotions'
                    ]);
            }
            return $this->render('admin/promotion/new.html.twig',
                [
                    'form' => $form->createView()
                ]);
        }

    /**
     * @Route ("/admin/promotion/{id}/edit",name="admin.promotion.edit")
     */
        public function edit(Request $request, Promotion $promotion)
        {
            $form = $this->createForm(PromotionFormType::class,$promotion);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid())
            {
                $em = $this->getDoctrine()->getManager();
                $em->flush();
                $this->addFlash('success', 'Promotion modifiée avec succès!');
                return $this-> redirectToRoute('admin.index',
                    [
                        '_fragment' => 'promotions'
                    ]);
            }
            return $this->render('admin/promotion/edit.html.twig',
                [
                    'form' => $form->createView()
                ]);
        }

    /**
     * @route("/admin/promotion/{id}/delete",name="admin.promotion.delete")
     */
        public function delete(Promotion $promotion)
        {
            $id = 'promotion-' . $promotion->getId();
            $em = $this->getDoctrine()->getManager();
            $em->remove($promotion);
            $em->flush();

            return $this->json($id);
        }
}