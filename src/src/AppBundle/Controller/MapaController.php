<?php
/**
 * Created by PhpStorm.
 * Uzytkownik: Amaltea
 * Date: 18/03/2018
 * Time: 10:12
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Kategoria_miejsca;
use AppBundle\Entity\Miejsce;
use AppBundle\Form\Type\MiejsceType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Security\Core\User\UserInterface;
use AppBundle\Entity\Post;
use AppBundle\Form\Type\PostType;
use AppBundle\Form\Type\PostEditType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class MapaController extends Controller
{

    /**
     * @Route("/map", name="map")
     * @Method({"GET","POST"})
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param UserInterface|null $uzytkownik
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function mapAction(Request $request, EntityManagerInterface $em, UserInterface $uzytkownik = null)
    {
        $miejsce = new Miejsce();
        $form = $this->createForm(MiejsceType::class, $miejsce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $miejsce->setIdUzytkownik($uzytkownik->getIdUzytkownik());
            $miejsce->setDataCzasMiejsce(new \DateTime());
            $miejsce->setCzyAktualne(1);
            $miejsce->setCzyUkryte(0);
            $miejsce->setCzyZatwierdzone(0);
//            $miejsce->setLng(22);
//            $miejsce->setLat(11);
//            $miejsce->setIdKategoria(1);


            //dodaje obrazek
            $file = $form['obrazekM']->getData();
            if($file==null){
                $miejsce->setObrazekM(null);
            }else{
                /** @var /vendor/symfony/http-foundation/File/UploadedFile.php $file */
                $fileName = $this->generateUniqueFileName() . '.' . $file->guessClientExtension();
                $file->move(
                    $this->getParameter('obrazki_miejsca_directory'),
                    $fileName
                );
                $miejsce->setObrazekM($fileName);
            }



            $this->getDoctrine()->getManager()->flush();
            $em->persist($miejsce);// prepare to insert into the database
            $this->addFlash('success', 'Miejsce zostalo zapisane!');
            $em->flush();// execute all SQL queries
            return $this->redirectToRoute('map');
        }

        return $this->render('contact/map.html.twig', [
            'user' => $uzytkownik,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/mapView", name="mapView")
     * @Method({"GET","POST"})
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param UserInterface|null $uzytkownik
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function mapViewAction(Request $request, EntityManagerInterface $em, UserInterface $uzytkownik = null)
    {

        $em = $this->getDoctrine()->getManager();

        $filter = $request->query->get('filter', 'all');
        $miejsca = $em->getRepository(Miejsce::class)->findAll();

        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);
        $miejscaSer = $serializer->serialize($miejsca, 'json');
//        echo $miejscaSer;

        return $this->render('contact/mapView.html.twig', [
            'user' => $uzytkownik,
            'miejsca' => $miejsca,
            'miejscaSer' => $miejscaSer
        ]);
    }

    /**
     * @Route("/mapEdit", name="mapEdit")
     * @Method({"GET","POST"})
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param UserInterface|null $uzytkownik
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function mapEditAction(Request $request, EntityManagerInterface $em, UserInterface $uzytkownik = null)
    {
//        $miejsce = new Miejsce();
        $miejsce = $this->getDoctrine()->getRepository(Miejsce::class)->find(1);
        $miejsce->setObrazekM(null);
        $form = $this->createForm(MiejsceType::class, $miejsce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
//            $miejsce->setIdUzytkownik($uzytkownik->getIdUzytkownik());
//            $miejsce->setDataCzasMiejsce(new \DateTime());
//            $miejsce->setCzyAktualne(1);
//            $miejsce->setCzyUkryte(0);
//            $miejsce->setCzyZatwierdzone(0);
////            $miejsce->setLng(22);
////            $miejsce->setLat(11);
////            $miejsce->setIdKategoria(1);
//
//
//            //dodaje obrazek
//            $file = $form['obrazekM']->getData();
//            if($file==null){
//                $miejsce->setObrazekM(null);
//            }else{
//                /** @var /vendor/symfony/http-foundation/File/UploadedFile.php $file */
//                $fileName = $this->generateUniqueFileName() . '.' . $file->guessClientExtension();
//                $file->move(
//                    $this->getParameter('obrazki_miejsca_directory'),
//                    $fileName
//                );
//                $miejsce->setObrazekM($fileName);
//            }
//
//
//
//            $this->getDoctrine()->getManager()->flush();
//            $em->persist($miejsce);// prepare to insert into the database
//            $this->addFlash('success', 'Miejsce zostalo zapisane!');
//            $em->flush();// execute all SQL queries
            return $this->redirectToRoute('mapEdit');
        }

        return $this->render('contact/mapEdit.html.twig', [
            'user' => $uzytkownik,
            'form' => $form->createView(),
        ]);
    }

    private function generateUniqueFileName()
    {
        return md5(uniqid());
    }
}