<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\VarDumper\Cloner\Data;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Uzytkownik
 *
 * @ORM\Table(name="uzytkownik")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UzytkownikRepository")
 */
class Uzytkownik implements UserInterface
{
    /**
     * @var string
     *
     * @ORM\Column(name="idUzytkownik", type="integer", length=11)
     * @ORM\Id
     */
    private $idUzytkownik;
    

    /**
     * @var string
     *
     * @ORM\Column(name="imie", type="string", length=255)
     */
    private $imie;

    /**
     * @var string
     *
     * @ORM\Column(name="nazwisko", type="string", length=255)
     */
    private $nazwisko;

    /**
     *
     *
     * @ORM\Column(name="dataUr", type="string")
     */
    private $dataUr;

    /**
     * @var string
     *
     * @ORM\Column(name="obrazekU", type="string", length=255, unique=true)
     */
    private $obrazekU;

    /**
     * @var string
     *
     * @ORM\Column(name="login", type="string", length=255, unique=true)
     */
    private $login;

    /**
     * @Assert\Email(
     *     message = "Ten email '{{ value }}' ma nieprawidłowy format.",
     *     checkMX = true
     * )
     * @ORM\Column(name="email", type="string", length=255, unique=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="haslo", type="string", length=60)
     */
    private $haslo;

    /**
     * @var date
     *
     * @ORM\Column(name="dataRejestracji", type="datetime")
     */
    private $dataRejestracji;

    /**
     * @var bool
     *
     * @ORM\Column(name="czyAdmin", type="boolean")
     */
    private $czyAdmin;

    /**
     * @var string
     *
     * @ORM\Column(name="miastoU", type="string", length=255)
     */
    private $miastoU;

    public function __construct($id)
    {
        $this->idUzytkownik = $id;
    }

    /**
     * Get id
     *
     * @return string
     */
    public function getIdUzytkownik()
    {
        return $this->idUzytkownik;
    }


    /**
     * @param $dataUr
     * @return $this
     */
    public function setDataUr($dataUr)
    {
        $this->dataUr = $dataUr;

        return $this;
    }

    /**
     * Get data urodzenia
     *
     *
     */
    public function getDataUr()
    {
        return $this->dataUr;
    }


    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }


    public function setObrazekU($obrazekU)
    {
        $this->obrazekU = $obrazekU;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getObrazekU()
    {
        return $this->obrazekU;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Uzytkownik
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
     * Set password
     *
     * @param string $haslo
     *
     * @return Uzytkownik
     */
    public function setPassword($haslo)
    {
        $this->haslo = $haslo;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->haslo;
    }

    /**
     * Set registeredAt
     *
     * @param \DateTime $dataRejestracji
     *
     * @return Uzytkownik
     */
    public function setDataRejestracji($dataRejestracji)
    {
        $this->dataRejestracji = $dataRejestracji;

        return $this;
    }

    /**
     * Get registeredAt
     *
     * @return date
     */
    public function getDataRejestracji()
    {
        return $this->dataRejestracji;
    }

    /**
     * Set isAdmin
     *
     * @param boolean $czyAdmin
     *
     * @return Uzytkownik
     */
    public function setCzyAdmin($czyAdmin)
    {
        $this->czyAdmin = $czyAdmin;

        return $this;
    }

    /**
     * Get isAdmin
     *
     * @return bool
     */
    public function czyAdmin()
    {
        return $this->czyAdmin;
    }

    /**
     * Set fullname
     *
     * @param string $imie
     *
     * @return Uzytkownik
     */
    public function setName($imie)
    {
        $this->imie = $imie;

        return $this;
    }

    /**
     * Get fullname
     *
     * @return string
     */
    public function getImie()
    {
        return $this->imie;
    }

    public function setNazwisko($nazwisko)
    {
        $this->nazwisko = $nazwisko;

        return $this;
    }

    /**
     * Get fullname
     *
     * @return string
     */
    public function getNazwisko()
    {
        return $this->nazwisko;
    }
    /**
     * Get fullname
     *
     * @return string
     */
    public function getMiastoU()
    {
        return $this->miastoU;
    }

    public function setMiastoU($miastoU)
    {
        $this->miastoU = $miastoU;

        return $this;
    }

    public function getRoles()
    {
        $roles = [
            'ROLE_USER',
        ];

        if ($this->czyAdmin()) {
            $roles[] = 'ROLE_ADMIN';
        }

        return $roles;
    }

    public function getSalt()
    {
        return null;
    }

    public function eraseCredentials()
    {

    }

    /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getUsername()
    {
       $this->getLogin();
    }


}
