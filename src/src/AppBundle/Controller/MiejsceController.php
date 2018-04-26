<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Miejsce;
use AppBundle\Form\Type\MiejsceType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\User\UserInterface;
use AppBundle\Entity\Komentarz;
use AppBundle\Form\Type\KomentarzType;
use Doctrine\ORM\EntityManagerInterface;

class MiejsceController extends Controller
{
//    /**
//     * @Route("/map", name="map")
//     * @Method({"GET","POST"})
//     * @param Request $request
//     * @param EntityManagerInterface $em
//     * @param UserInterface|null $uzytkownik
//     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
//     */
//    public function commentAction(Request $request, EntityManagerInterface $em, UserInterface $uzytkownik = null)
//    {
//        $miejsce= new Miejsce();
//        $miejsce->setNazwaM("Domyślne miejsce");
//        $form = $this->createForm(MiejsceType::class, $miejsce);
//        $form->handleRequest($request);
//        if ($form->isSubmitted() && $form->isValid()) {
//
//            $em->persist($miejsce);
//            $em->flush();// execute all SQL queries
//
//            $this->addFlash('success', 'Miejsce zostało dodane!');
//
//            return $this->redirectToRoute('homepage');
//        }
//
//        return $this->render('contact/map.html.twig', [
//            'form' => $form->createView(),
//        ]);
//    }
}
