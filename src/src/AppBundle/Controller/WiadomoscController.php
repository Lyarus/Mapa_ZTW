<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\User\UserInterface;
use AppBundle\Entity\Wiadomosc;
use AppBundle\Form\Type\WiadomoscType;
use Doctrine\ORM\EntityManagerInterface;

class WiadomoscController extends Controller
{
    /**
     * @Route("/contact", name="contact")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @param \Swift_Mailer $mailer
     * @param UserInterface|null $uzytkownik
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function contactAction(Request $request, \Swift_Mailer $mailer, UserInterface $uzytkownik = null)
    {
        $contact = $uzytkownik ? Wiadomosc::createFromUser($uzytkownik) : Wiadomosc::create();

        $form = $this->createForm(WiadomoscType::class, $contact);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contact->setWyslano(new \DateTime());

            $em = $this->getDoctrine()->getEntityManager();

            $em->persist($contact);// prepare to insert into the database
            $em->flush();// execute all SQL queries

            $message = new \Swift_Message();
            $message->setTo('contact@example.org');
            $message->setFrom([$contact->getEmail() => $contact->getIdUzytkownik()]);
            $message->setSubject($contact->getTemat());
            $message->setBody($contact->getTrescWiadomosci());

            $mailer->send($message);

            $this->addFlash('success', 'Dziękujemy za wiadomość!');

            return $this->redirectToRoute('homepage');
        }

        return $this->render('contact/contact.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/contacts", name="admin_contact_list")
     * @Security("is_granted('ROLE_ADMIN')")
     * @Method("GET")
     * @param Request $request
     * @return Response
     */
    public function listAction(Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $filter = $request->query->get('filter', 'all');

        $contacts = $em->getRepository(Wiadomosc::class)->findForList($filter);

        return $this->render('contact/admin/list.html.twig', [
            'contacts' => $contacts,
        ]);
    }

    /**
     * @Route("/admin/contacts/{id}", name="admin_contact_show")
     * @Security("is_granted('ROLE_ADMIN')")
     * @Method("GET")
     * @param Wiadomosc $contact
     * @return Response
     */
    public function showAction(Wiadomosc $contact)
    {
        return $this->render('contact/admin/show.html.twig', [
            'contact' => $contact,
        ]);
    }

    /**
     * @Route("/admin/contacts/{id}/process", name="admin_contact_process")
     * @Security("is_granted('ROLE_ADMIN')")
     * @Method("GET")
     * @param Request $request
     * @param Wiadomosc $contact
     * @param EntityManagerInterface $em
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function processAction(Request $request, Wiadomosc $contact, EntityManagerInterface $em)
    {
        $response = $this->redirectToRoute('admin_contact_show', [
            'id' => $contact->getIdWiadomosc()
        ]);

        $token = $request->query->get('token');
        if (!$this->isCsrfTokenValid('contact_process.' . $contact->getIdWiadomosc(), $token)) {
            $this->addFlash('error', 'CSRF token invalid.');

            return $response;
        }

        if ($contact->isProcessed()) {
            $this->addFlash('warning', 'Wiadomosc już została wysłana.');

            return $response;
        }

        $contact->setDostarczono(new \DateTime());

        $em->flush();

        $this->addFlash('success', 'Wiadomosc została wysłana pomyślnie.');

        return $response;
    }
}
