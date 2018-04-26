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

class DefaultController extends Controller
{

    /**
     * @Route("/", name="homepage")
     * @Method("GET")
     * @param Request $request
     * @return Response
     */
    public function listAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $filter = $request->query->get('filter', 'all');
        $posts = $em->getRepository(Post::class)->findForList($filter);
        $comments = $em->getRepository(Komentarz::class)->findForList($filter);
        $miejsca = $em->getRepository(Miejsce::class)->findAll();

        $securityContext = $this->container->get('security.authorization_checker');
        if ($securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return $this->render('default/main_page.html.twig', [
                'posts' => $posts,
                'comments' => $comments
            ]);
        }
        return $this->render('default/start_page.html.twig', [
            'posts' => $posts,
            'comments' => $comments
        ]);
    }



    /**
     * @Route("/about", name="about")
     * @return Response
     */
    public function aboutAction()
    {
        return $this->render('default/about.html.twig');
    }

    /**
     * @Route("/images", name="images")
     * @return Response
     */
    public function imagesAction()
    {
        return $this->render('default/images.html.twig');
    }
//
//    /**
//     * @Route("/main", name="main")
//     * @return Response
//     */
//    public function mainPageAction()
//    {
//        return $this->render('default/main_page.html.twig');
//    }
//
//    /**
//     * @Route("/start", name="start")
//     * @return Response
//     */
//    public function startPageAction()
//    {
//        return $this->render('default/start_page.html.twig');
//    }

    /**
     * @Route("/my_trips", name="my_trips")
     * @return Response
     */
    public function myTripsAction()
    {
        return $this->render('trips/my_trips.html.twig');
    }

    /**
     * @Route("/favourite_trips", name="favourite_trips")
     * @return Response
     */
    public function FavouriteTripsAction()
    {
        return $this->render('trips/favourite_trips.html.twig');
    }

    /**
     * @Route("/favourite_places", name="favourite_places")
     * @return Response
     */
    public function FavouritePlacesAction()
    {
        return $this->render('map/favourite_places.html.twig');
    }

    /**
     * @Route("/map", name="map")
     * @return Response
     */
    public function mapAction()
    {
        return $this->render('map/main/main.html.twig');
    }

    /**
     * @Route("/trips", name="trips")
     * @return Response
     */
    public function tripsAction()
    {
        return $this->render('trips/main.html.twig');
    }

    /**
     * @Route("/creator", name="creator")
     * @return Response
     */
    public function creatorAction()
    {
        return $this->render('creator/entry.html.twig');
    }


}
