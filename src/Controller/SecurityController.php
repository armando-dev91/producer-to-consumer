<?php

namespace App\Controller;

use App\Entity\Consumer;
use App\Entity\Producer;
use App\Entity\User;
use App\Form\RegistrationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{

    /**
     * @Route("/login", name="security_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        $lastUsername = $authenticationUtils->getLastUsername();
        $error = $authenticationUtils->getLastAuthenticationError();
        return $this->render('security/login.html.twig', compact('lastUsername', 'error'));
    }

    /**
     * @Route("/register", name="security_register")
     */
    public function register(
        Request $request,
        UserPasswordEncoderInterface $passwordEncoder,
        EntityManagerInterface $manager
    ) {
        $user = $request->query->get('type') === 'producer' ? new Producer() : new Consumer();
        $form = $this->createForm(RegistrationType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $passwordEncoded = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($passwordEncoded);

            $manager->persist($user);
            $manager->flush();
            $this->addFlash('suucess', 'User created successfully !');
            return $this->redirectToRoute('app_home');
        }

        return $this->render('security/register.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout() { }
    
}