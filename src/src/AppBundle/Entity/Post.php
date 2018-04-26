<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Uzytkownik;
use Symfony\Component\HttpFoundation\File\File;

/**
 * Post
 *
 * @ORM\Table(name="post")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PostRepository")
 */
class Post
{
    /**
     * @var int
     *
     * @ORM\Column(name="idPost", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idPost;

//    /**
//     * @var string
//     *
//     * @ORM\Column(name="idKPost", type="integer")
//     */
//    private $idKPost;

    /**
     * @var string
     *
     * @ORM\Column(name="idUzytkownik", type="string", length=255)
     */
    private $idUzytkownik;


    /**
     * @var string
     *
     * @ORM\Column(name="nazwaPostu", type="string", length=255)
     */
    private $nazwaPostu;

    /**
     * @var string
     *
     * @ORM\Column(name="trescPost", type="text")
     */
    private $trescPost;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dataCzasPost", type="datetime")
     */
    private $dataCzasPost;


    public static function create()
    {
        return new self();
    }

    public static function createFromUser(Uzytkownik $uzytkownik)
    {
        $post = new self();

        $post->setIdUzytkownik($uzytkownik->getImie());
        $post->setIdUzytkownik($uzytkownik->getNazwisko());

        return $post;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getIdPost()
    {
        return $this->idPost;
    }

//    /**
//     * Set kategoria postu
//     *
//     * @param string $idKPost
//     *
//     * @return Post
//     */
//    public function setKategoriaPost($idKPost)
//    {
//        $this->idKPost = $idKPost;
//
//        return $this;
//    }
//
//    /**
//     * Get kategoria postu
//     *
//     * @return string
//     */
//    public function getKategoriaPost()c
//    {
//        return $this->idKPost;
//    }

    /**
     * Set fullname
     *
     * @param string $idUzytkownik
     *
     * @return Post
     */
    public function setIdUzytkownik($idUzytkownik)
    {
        $this->idUzytkownik = $idUzytkownik;

        return $this;
    }

    /**
     * Get fullname
     *
     * @return string
     */
    public function getIdUzytkownik()
    {
        return $this->idUzytkownik;
    }

    /**
     * Set content
     *
     * @param string $trescPost
     *
     * @return Post
     */
    public function setTrescPost($trescPost)
    {
        $this->trescPost = $trescPost;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getTrescPost()
    {
        return $this->trescPost;
    }

    /**
     * Set title
     *
     * @param string $nazwaPostu
     *
     * @return Post
     */
    public function setNazwaPostu($nazwaPostu)
    {
        $this->nazwaPostu = $nazwaPostu;

        return $this;
    }

     /**
      * Get title
      *
      * @return string
      */
     public function getNazwaPostu()
     {
         return $this->nazwaPostu;
     }

    /**
     * Set publishedAt
     *
     * @param \DateTime $dataCzasPost
     *
     * @return Post
     */
    public function setDataCzasPost($dataCzasPost)
    {
        $this->dataCzasPost = $dataCzasPost;

        return $this;
    }

    /**
     * Get publishedAt
     *
     * @return \DateTime
     */
    public function getDataCzasPost()
    {
        return $this->dataCzasPost;
    }
}
