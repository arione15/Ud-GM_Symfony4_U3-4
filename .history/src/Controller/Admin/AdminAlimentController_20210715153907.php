<?php

namespace App\Controller\Admin;

use App\Entity\Aliment;
use App\Form\AlimentType;
use App\Repository\AlimentRepository;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class AdminAlimentController extends AbstractController
{
    /**
     * @Route("/admin/aliment", name="admin_aliment")
     */
    public function index(AlimentRepository $repository)
    {
        $aliments = $repository -> findAll();
        return $this->render('admin/admin_aliment/adminAliment.html.twig', [
            'aliments' => $aliments
        ]);
    }
    /**
     * @Route("/admin/aliment/{id}", name="admin_aliment_modification")
     */
    public function modifierAliment(Aliment $aliment, Request $request, ObjectManager $objectManager)
    {
        $form = $this -> createForm(AlimentType::class, $aliment);
        $form -> handleRequest($request);
        if($form -> isSubmitted() && $form -> isValid()){
            $objectManager -> persist($aliment);
            $objectManager -> flush();
            return $this -> 



        }


        return $this->render('admin/admin_aliment/modificationAliment.html.twig', [
            'aliment' => $aliment,
            'form' => $form -> createView()
        ]);
    }
}
