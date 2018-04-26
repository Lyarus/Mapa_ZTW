<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Miejsce;
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
//
// PART OF BOARD
//
class KomentarzController extends Controller
{
    /**
     * @Route("board/comment", name="comment")
     * @Method({"GET","POST"})
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param UserInterface|null $uzytkownik
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function commentAction(Request $request, EntityManagerInterface $em, UserInterface $uzytkownik = null)
    {
        $komentarz = new Komentarz();
        $form = $this->createForm(KomentarzType::class, $komentarz);
        $form->handleRequest($request);
        $post = $request->query->get('post');
        if ($form->isSubmitted() && $form->isValid()) {
            $komentarz->setDataCzasKom(new \DateTime());
            $komentarz->setIdUzytkownik($uzytkownik->getIdUzytkownik());
            $komentarz->setIdPost($post);
            $em->persist($komentarz);// prepare to insert into the database
            $em->flush();// execute all SQL queries
            $this->addFlash('success', 'Komentarz został dodany!');
            return $this->redirectToRoute('homepage');
        }

        return $this->render('board/comment/comment.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
