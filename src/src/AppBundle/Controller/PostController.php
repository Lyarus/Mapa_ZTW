<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\User\UserInterface;
use AppBundle\Entity\Post;
use AppBundle\Form\Type\PostType;
use AppBundle\Form\Type\PostEditType;
use Doctrine\ORM\EntityManagerInterface;
use AppBundle\Entity\Komentarz;
//
// PART OF BOARD
//
class PostController extends Controller
{
    /**
     * @Route("board/posts/{id}", name="post_show")
     * @Method("GET")
     * @param Request $request
     * @param Post $post
     * @return Response
     */
    public function showAction(Request $request, Post $post)
    {
        $em = $this->getDoctrine()->getManager();

        $filter = $request->query->get('filter', 'all');
        $repository = $em->getRepository(Komentarz::class);
        $id = $post->getIdPost();
        $comments = $repository->findBy(array('idPost' => $id)
        );
        return $this->render('board/show.html.twig', [
            'post' => $post,
            'comments' => $comments
        ]);
    }


    /**
     * @Route("board/post", name="post")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param UserInterface|null $uzytkownik
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function postAction(Request $request, EntityManagerInterface $em, UserInterface $uzytkownik = null)
    {
        $post = $uzytkownik ? Post::createFromUser($uzytkownik) : Post::create();

        $form = $this->createForm(PostType::class, $post);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $post->setDataCzasPost(new \DateTime());
            $uzytkownik->setCzyAdmin(false);
            $post->setIdUzytkownik($uzytkownik->getIdUzytkownik());
            $em->persist($post);// prepare to insert into the database
            $em->flush();// execute all SQL queries

            $this->addFlash('success', 'Post został dodany!');

            return $this->redirectToRoute('homepage');
        }

        return $this->render('board/post/post.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("board/admin/posts", name="admin_post_list")
     * @Method("GET")
     */
     public function listAction(Request $request)
     {
         $em = $this->getDoctrine()->getEntityManager();
 
         $filter = $request->query->get('filter', 'all');
         $posts = $em->getRepository(Post::class)->findForList($filter);
 
         return $this->render('board/post/admin/list.html.twig', [
             'posts' => $posts
         ]);
     }

    /**
     * @Route("board/admin/posts/{id}", name="admin_post_show")
     * @Security("is_granted('ROLE_ADMIN')")
     * @Method("GET")
     * @param Post $post
     * @return Response
     */
     public function adminShowAction(Post $post)
     {
         return $this->render('board/post/admin/show.html.twig', [
             'post' => $post,
         ]);
     }

    /**
     * @Route("board/admin/posts/{id}/edit", name="admin_post_edit")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @param Post $post
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function editAction(Request $request, Post $post)
    {
        $form = $this->createForm(PostEditType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'Post został zmodyfikowany!');

            return $this->redirectToRoute('admin_post_list');
        }

        return $this->render('board/post/admin/edit.html.twig', [
            'post' => $post,
            'form' => $form->createView(),
        ]);
    }

    /**
     * Deletes a Post entity.
     *
     * @Route("board/admin/{id}/delete", name="admin_post_delete")
     * @Method("POST")
     * @param Post $post
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(Post $post)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($post);
        $em->flush();

        $this->addFlash('success', 'Post został usunięty!');

        return $this->redirectToRoute('admin_post_list');
    }
}
