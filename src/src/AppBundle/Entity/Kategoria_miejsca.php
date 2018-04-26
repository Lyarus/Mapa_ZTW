<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Kategoria_miejsca
 *
 * @ORM\Table(name="kategoria_miejsca")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Kategoria_miejscaRepository")
 */
class  Kategoria_miejsca
{

    /**
     * @var integer
     *
     * @ORM\Column(name="idKategorii", type="integer", length=11)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idKategorii;

    /**
     * @var string
     *
     * @ORM\Column(name="nazwaK", type="string", length=255)
     */
    private $nazwaK;


    /**
     * @return integer
     */
    public function getIdKategorii()
    {
        return $this->idKategorii;
    }


    /**
     * @param $idKategorii
     * @return $this
     */
    public function setIdKategorii($idKategorii)
    {
        $this->idKategorii = $idKategorii;
        return $this;
    }


    /**
     * @return string
     */
    public function getNazwaK()
    {
        return $this->nazwaK;
    }


    /**
     * @param $nazwaK
     * @return $this
     */
    public function setNazwaK($nazwaK)
    {
        $this->nazwaK = $nazwaK;
        return $this;
    }
}