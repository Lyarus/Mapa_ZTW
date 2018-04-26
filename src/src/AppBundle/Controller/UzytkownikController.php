<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Doctrine\ORM\EntityManagerInterface;
use AppBundle\Entity\Uzytkownik;
use AppBundle\Form\Type\UserRegistrationType;
use AppBundle\Form\Type\UserUpdatePasswordType;
use AppBundle\Form\Type\UserEditProfileType;
use Ramsey\Uuid\Uuid;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class UzytkownikController extends Controller
{
    /**
     * @Route("/update-password", name="update_password")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param UserInterface $uzytkownik
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function updatePasswordAction(Request $request, EntityManagerInterface $em, UserInterface $uzytkownik)
    {
        $form = $this->createForm(UserUpdatePasswordType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $plainPassword = $form->get('new_password')->getData();

            $haslo = $plainPassword;
            $uzytkownik->setPassword($haslo);

            $em->flush();// execute all SQL queries

            $this->addFlash('success', 'Hasło zostało zmienione!');

            return $this->redirectToRoute('homepage');
        }

        return $this->render('user/update_password.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/register", name="register")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param EntityManagerInterface $em
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function registerAction(Request $request, EntityManagerInterface $em, UserPasswordEncoderInterface $passwordEncoder)
    {
        $uzytkownik = new Uzytkownik((string) Uuid::uuid4());

        $form = $this->createForm(UserRegistrationType::class, $uzytkownik);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $uzytkownik->setDataRejestracji(new \DateTime());
            $uzytkownik->setCzyAdmin(false);
            $plainPassword = $form->get('haslo')->getData();
            $haslo = $passwordEncoder->encodePassword($uzytkownik, $plainPassword);
            $uzytkownik->setPassword($haslo);
            $em->persist($uzytkownik);// prepare to insert into the database
            $em->flush();// execute all SQL queries

            $this->addFlash('success', 'Witamy!');

            return $this->redirectToRoute('homepage');
        }

        return $this->render('user/register.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/user/{id}/edit", name="edit_profile")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @param Uzytkownik $user
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editProfileAction(Request $request, Uzytkownik $user)
    {
        $form = $this->createForm(UserEditProfileType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'Profil został zaktualizowany!');

            return $this->redirectToRoute('profile');
        }

        return $this->render('user/edit_profile.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/login", name="login")
     * @Method({"GET", "POST"})
     * @param AuthenticationUtils $authUtils
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function loginAction(AuthenticationUtils $authUtils)
    {
        // get the login error if there is one
        $error = $authUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authUtils->getLastUsername();

        return $this->render('user/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }

    /**
     * @Route("/admin/users", name="admin_user_list")
     * @Method("GET")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listAction(Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $filter = $request->query->get('filter', 'all');
        $users = $em->getRepository(Uzytkownik::class)->findForList($filter);
        return $this->render('user/admin/list.html.twig', [
            'users' => $users,
        ]);
    }

    /**
     * @Route("/admin/users/{id}", name="admin_user_show")
     * @Security("is_granted('ROLE_ADMIN')")
     * @Method("GET")
     * @param Uzytkownik $uzytkownik
     * @return \Symfony\Component\HttpFoundation\Response
     */
     public function showAction(Uzytkownik $uzytkownik)
     {
         return $this->render('user/admin/show.html.twig', [
             'user' => $uzytkownik,
         ]);
     }

    /**
     * @Route("/admin/users/{id}/edit", name="admin_user_edit")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @param Uzytkownik $uzytkownik
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request, Uzytkownik $uzytkownik)
    {
        $form = $this->createForm(UserEditProfileType::class, $uzytkownik);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'Uzytkownik zaktualizował swój profil!');

            return $this->redirectToRoute('admin_user_list');
        }

        return $this->render('user/admin/edit.html.twig', [
            'user' => $uzytkownik,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/profile/", name="profile")
     * @Method({"GET","POST"})
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function profileAction()
    {
        return $this->render('user/profile.html.twig');
    }


    /**
     * @Route("/settings", name="settings")
     * @Method("GET")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function settingsAction(Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $filter = $request->query->get('filter', 'all');
        $users = $em->getRepository(Uzytkownik::class)->findForList($filter);

        return $this->render('user/settings.html.twig', [
            'users' => $users,
        ]);
    }
}
