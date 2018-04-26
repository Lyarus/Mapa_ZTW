<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Uzytkownik;

/**
 * Wiadomosc
 *
 * @ORM\Table(name="contact")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\WiadomoscRepository")
 */
class Wiadomosc
{
    /**
     * @var int
     *
     * @ORM\Column(name="idWiadomosc", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idWiadomosc;

    /**
     * @var string
     *
     * @ORM\Column(name="idUzytkownik", type="string", length=11)
     */
    private $idUzytkownik;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="text")
     */
    private $trescWiadomosci;

    /**
     * @var string
     *
     * @ORM\Column(name="temat", type="string", length=255)
     */
    private $temat;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="wyslano", type="datetime")
     */
    private $wyslano;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dostarczono", type="datetime", nullable=true)
     */
    private $dostarczono;

    public static function create()
    {
        return new self();
    }

    public static function createFromUser(Uzytkownik $uzytkownik)
    {
        $contact = new self();

        $contact->setIdUzytkownik($uzytkownik->getImie());
        $contact->setIdUzytkownik($uzytkownik->getNazwisko());
        $contact->setEmail($uzytkownik->getLogin());

        return $contact;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getIdWiadomosc()
    {
        return $this->idWiadomosc;
    }

    /**
     * Set fullname
     *
     * @param string $idUzytkownik
     *
     * @return Wiadomosc
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
     * Set email
     *
     * @param string $email
     *
     * @return Wiadomosc
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set message
     *
     * @param string $trescWiadomosci
     *
     * @return Wiadomosc
     */
    public function setTrescWiadomosci($trescWiadomosci)
    {
        $this->trescWiadomosci = $trescWiadomosci;

        return $this;
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getTrescWiadomosci()
    {
        return $this->trescWiadomosci;
    }

    /**
     * Set subject
     *
     * @param string $temat
     *
     * @return Wiadomosc
     */
    public function setTemat($temat)
    {
        $this->temat = $temat;

        return $this;
    }

    /**
     * Get subject
     *
     * @return string
     */
    public function getTemat()
    {
        return $this->temat;
    }

    /**
     * Set contactedAt
     *
     * @param \DateTime $wyslano
     *
     * @return Wiadomosc
     */
    public function setWyslano($wyslano)
    {
        $this->wyslano = $wyslano;

        return $this;
    }

    /**
     * Get contactedAt
     *
     * @return \DateTime
     */
    public function getWyslano()
    {
        return $this->wyslano;
    }

    /**
     * Set processedAt
     *
     * @param \DateTime $dostarczono
     *
     * @return Wiadomosc
     */
    public function setDostarczono(\DateTime $dostarczono = null)
    {
        $this->dostarczono = $dostarczono;

        return $this;
    }

    /**
     * Get processedAt
     *
     * @return \DateTime
     */
    public function getDostarczono()
    {
        return $this->dostarczono;
    }

    public function isProcessed()
    {
        return null !== $this->dostarczono;
    }
}
