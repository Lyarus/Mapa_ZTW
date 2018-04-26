<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Miejsce;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Post;
use AppBundle\Entity\Komentarz;

class BoardController extends Controller
{
    /**
     * @Route("/board", name="board")
     * @Method("GET")
     * @param Request $request
     * @return Response
     */
    public function boardAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $filter = $request->query->get('filter', 'all');
        $posts = $em->getRepository(Post::class)->findForList($filter);
        $comments = $em->getRepository(Komentarz::class)->findForList($filter);
        $miejsca = $em->getRepository(Miejsce::class)->findAll();

        $securityContext = $this->container->get('security.authorization_checker');

        return $this->render('board/main.html.twig', [
            'posts' => $posts,
            'comments' => $comments
        ]);
    }
}
