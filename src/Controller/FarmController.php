<?php

namespace App\Controller;

use App\Entity\Farm;
use App\Form\FarmType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @IsGranted("ROLE_PRODUCER")
 */
class FarmController extends AbstractController
{

    /**
     * @Route("/profile/farm/edit")
     * @param Request $request
     * @return void
     */
    public function edit(Request $request, EntityManagerInterface $manager)
    {
        $farm = $this->getUser()->getFarm();

        if($farm === null) {
            $farm = new Farm();
            $this->getUser()->setFarm($farm);
        }

        $form = $this->createForm(FarmType::class, $farm);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $manager->flush();
            $this->addFlash('success', 'Farm updated successfully !');
            return $this->redirectToRoute('app_home');
        }

        return $this->render('farm/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }
}