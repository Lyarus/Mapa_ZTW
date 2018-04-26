<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Uzytkownik;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Miejsce
 *
 * @ORM\Table(name="Miejsce")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MiejsceRepository")
 */
class Miejsce
{
    /**
     * @var int
     *
     * @ORM\Column(name="idMiejsce", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idMiejsce;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dataCzasMiejsce", type="datetime")
     */
    private $dataCzasMiejsce;

    /**
     * @var string
     *
     * @ORM\Column(name="idUzytkownik", type="integer")
     */
    private $idUzytkownik;


    /**
     * @var string
     *
     * @ORM\Column(name="idKategorii", type="integer")
     */
    private $idKategoria;

    /**
     * @var string
     * @Assert\NotBlank
     * @ORM\Column(name="nazwaM", type="string", length=255)
     */
    private $nazwaM;

    /**
     * @var string
     * @Assert\NotBlank
     * @ORM\Column(name="adresM", type="string", length=255)
     */
    private $adresM;

    /**
     * @var int
     * @Assert\NotBlank
     * @ORM\Column(name="LNG", type="string")
     */
    private $lng;

    /**
     * @var string
     * @Assert\NotBlank
     * @ORM\Column(name="LAT", type="string")
     */
    private $lat;

    /**
     * @var string
     * @ORM\Column(name="opisM", type="string", length=255, nullable=true)
     */
    private $opisM;

    /**
     * @var string
     * @Assert\Url(
     *    message = "Podany link '{{ value }}' nie jest poprawnym formatem url",
     *    protocols = {"http", "https", "ftp"}
     * )
     * @ORM\Column(name="linkM", type="string", length=255)
     */
    private $linkM;

    /**
     *  @return string
     */
    public function getLinkM()
    {
        return $this->linkM;
    }

    /**
     * @Assert\Length(
     *     min = 8,
     *     max = 20,
     *     minMessage = "Numer telefonu musi zawierać minimalnie 8 cyfr",
     *     maxMessage = "Numer telefonu może zawierać maksymalnie 20 syfr"
     * )
     * @ORM\Column(name="telefonM")
     */
    private $telefonM;

    /**
     *  @return string
     */
    public function getTelefonM()
    {
        return $this->telefonM;
    }

    /**
     * @param string $linkM
     */
    public function setLinkM(string $linkM)
    {
        $this->linkM = $linkM;
    }

    /**
     * @param string $telefonM
     */
    public function setTelefonM(string $telefonM)
    {
        $this->telefonM = $telefonM;
    }


    /**
     * @var string
     *
     * @Assert\File(mimeTypes={ "image/jpeg", "image/png" })
     * )
     * @ORM\Column(name="obrazekM", type="string")
     */
    private $obrazekM;

    /**
     * @var string
     *
     * @ORM\Column(name="czyUkryte", type="string", length=255)
     */
    private $czyUkryte;

    /**
     * @var string
     *
     * @ORM\Column(name="czyZatwierdzone", type="string", length=255)
     */
    private $czyZatwierdzone;

    /**
     * @var string
     *
     * @ORM\Column(name="czyAktualne", type="string", length=255)
     */
    private $czyAktualne;

    /**
     * Set isAdmin
     *
     * @param boolean $czyUkryte
     *
     * @return Miejsce
     */

    public function setCzyUkryte($czyUkryte)
    {
        $this->czyUkryte = $czyUkryte;

        return $this;
    }

    /**
     * Get czyUkryte
     *
     * @return bool
     */
    public function czyUkryte()
    {
        return $this->czyUkryte;
    }

    /**
     * Set isAdmin
     *
     * @param boolean $czyZatwierdzone
     *
     * @return Miejsce
     */

    public function setCzyZatwierdzone($czyZatwierdzone)
    {
        $this->czyZatwierdzone = $czyZatwierdzone;

        return $this;
    }

    /**
     * Get czyUkryte
     *
     * @return bool
     */
    public function czyZatwierdzone()
    {
        return $this->czyZatwierdzone;
    }

    /**
     * Set isAdmin
     *
     * @param boolean $czyAktualne
     *
     * @return Miejsce
     */

    public function setCzyAktualne($czyAktualne)
    {
        $this->czyAktualne = $czyAktualne;

        return $this;
    }

    /**
     * Get czyUkryte
     *
     * @return bool
     */
    public function czyAktualne()
    {
        return $this->czyAktualne;
    }


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

    /**
     * Set name
     *
     * @param string $adresM
     *
     * @return Miejsce
     */
    public function setAdresM($adresM)
    {
        $this->adresM = $adresM;

        return $this;
    }

    /**
     * Get fullname
     *
     * @return string
     */
    public function getAdresM()
    {
        return $this->adresM;
    }

    /**
     * Get lat
     *
     * @return int
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * Get lng
     *
     * @return int
     */
    public function getLng()
    {
        return $this->lng;
    }

    /**
     * Set name
     *
     * @param string $opisM
     *
     * @return Miejsce
     */
    public function setOpisM($opisM)
    {
        $this->opisM = $opisM;

        return $this;
    }

    /**
     * Get fullname
     *
     * @return string
     */
    public function getOpisM()
    {
        return $this->opisM;
    }

    /**
     * Set name
     *
     * @param string $nazwaM
     *
     * @return Miejsce
     */
    public function setNazwaM($nazwaM)
    {
        $this->nazwaM = $nazwaM;

        return $this;
    }

    /**
     * Get fullname
     *
     * @return string
     */
    public function getNazwaM()
    {
        return $this->nazwaM;
    }


    /**
     * Set lng
     *
     * @param string $lng
     *
     * @return Miejsce
     */
    public function setLng($lng)
    {
        $this->lng = $lng;

        return $this;
    }


    /**
     * Set lat
     *
     * @param string $lat
     *
     * @return Miejsce
     */
    public function setLat($lat)
    {
        $this->lat = $lat;

        return $this;
    }


    /**
     * @param $obrazekM
     * @return $this
     */
    public function setObrazekM($obrazekM)
    {
        $this->obrazekM = $obrazekM;
        return $this;
    }

    /**
     * @return string
     */
    public function getObrazekM()
    {
        return $this->obrazekM;
    }


    public function getStatusWidocznosci()
    {
        $statusWid = [
            'STATUS_NIEUKRYTE',
        ];

        if ($this->czyUkryte()) {
            $statusWid[] = 'STATUS_UKRYTE';
        }

        return $statusWid;
    }

    public function getStatusZatwierdzenia()
    {
        $statusZatw = [
            'STATUS_NIEZATWIERDZONE',
        ];

        if ($this->czyZatwierdzone()) {
            $statusZatw[] = 'STATUS_ZATWIERDZONE';
        }

        return $statusZatw;
    }

    public function getStatusAktualnosci()
    {
        $statusAkt = [
            'STATUS_AKTUALNE',
        ];

        if ($this->czyAktualne()) {
            $statusAkt[] = 'STATUS_NIEAKTUALNE';
        }

        return $statusAkt;
    }

    /**
     * @return int
     */
    public function getIdKategoria()
    {
        return $this->idKategoria;
    }


    /**
     * @param $kategoria
     * @return $this
     */
    public function setIdKategoria($kategoria)
    {
        $this->idKategoria = $kategoria;
        return $this;
    }

    /**
     * @return int
     */
    public function getIdMiejsce()
    {
        return $this->idMiejsce;
    }


    /**
     * @param int $idMiejsce
     * @return $this
     */
    public function setIdMiejsce(int $idMiejsce)
    {
        $this->idMiejsce = $idMiejsce;
        return $this;
    }

    /**
     *
     * @return \DateTime
     */
    public function getDataCzasMiejsce()
    {
        return $this->dataCzasMiejsce;
    }

    /**
     *
     * @param \DateTime $dataCzasMiejsce
     *
     * @return Miejsce
     */
    public function setDataCzasMiejsce($dataCzasMiejsce)
    {
        $this->dataCzasMiejsce = $dataCzasMiejsce;
        return $this;
    }

}
