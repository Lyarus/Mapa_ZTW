<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Uzytkownik;
use Symfony\Component\HttpFoundation\File\File;

/**
 * Komentarz
 *
 * @ORM\Table(name="komentarz")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\KomentarzRepository")
 */
class Komentarz
{
    /**
     * @var int
     *
     * @ORM\Column(name="idKomentarz", type="integer")
     * @ORM\id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idKomentarz;

    /**
     * @var int
     *
     * @ORM\Column(name="idPost", type="integer")
     */
    private $idPost;
    
    /**
     * @var string
     *
     * @ORM\Column(name="idUzytkownik", type="integer")
     */
    private $idUzytkownik;

    /**
     * @var string
     *
     * @ORM\Column(name="trescKom", type="string", length=255)
     */
    private $trescKom;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dataCzasKom", type="datetime")
     */
    private $dataCzasKom;


    public static function create()
    {
        return new self();
    }

    public static function createFromUser(Uzytkownik $uzytkownik)
    {
        $komentarz = new self();

        $komentarz->setIdUzytkownik($uzytkownik->getImie());
        $komentarz->setIdUzytkownik($uzytkownik->getNazwisko());

        return $komentarz;
    }
    

    /**
     * Get id
     *
     * @return int
     */
    public function getIdKomentarz()
    {
        return $this->idKomentarz;
    }


    /**
     * Set content
     *
     * @param string $trescKom
     *
     * @return Komentarz
     */
    public function setTrescKom($trescKom)
    {
        $this->trescKom = $trescKom;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getTrescKom()
    {
        return $this->trescKom;
    }

    /**
     *
     * @param \DateTime $dataCzasKom
     *
     * @return Komentarz
     */
    public function setDataCzasKom($dataCzasKom)
    {
        $this->dataCzasKom = $dataCzasKom;

        return $this;
    }

    /**
     * Get publishedAt
     *
     * @return \DateTime
     */
    public function getDataCzasKom()
    {
        return $this->dataCzasKom;
    }

    /**
     * Set postId
     *
     * @param string $idPost
     *
     * @return Komentarz
     */
    public function setIdPost($idPost)
    {
        $this->idPost = $idPost;

        return $this;
    }

    /**
     * Get postId
     *
     * @return int
     */
     public function getIdPost()
     {
         return $this->idPost;
     }

    /**
     * Set userId
     *
     * @param string $idUzytkownik
     *
     * @return Komentarz
     */
    public function setIdUzytkownik($idUzytkownik)
    {
        $this->idUzytkownik = $idUzytkownik;

        return $this;
    }

    /**
     * Get userId
     *
     * @return string
     */
     public function getIdUzytkownik()
     {
         return $this->idUzytkownik;
     }
}
