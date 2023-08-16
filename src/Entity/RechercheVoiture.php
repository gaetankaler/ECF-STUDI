<?php

namespace App\Entity;

use Symfony\Component\Form\AbstractType;

class RechercheVoiture extends AbstractType
{

    /**
     * @var int|null
     */

    private $prixMax;

    /**
     * @var int|null
     */

    private $anneeMax;

    /**
     * @var int|null
     */

    private $kilometreMax;

        /**
     * @return int|null
     */
    public function getPrixMax(): ?int
    {
        return $this->prixMax;
    }
    
    /**
    *@param int|null $anneeMax
    * @return RechercheVoiture
    */
    public function setPrixMax(int $prixMax): RechercheVoiture
    {
        $this->prixMax = $prixMax;
        return $this;
    }


    /**
     * @return int|null
     */
    public function getAnneeMax(): ?int
    {
        return $this->anneeMax;
    }
    
    
    /**
    *@param int|null $anneeMax
    * @return RechercheVoiture
    */
    public function setAnneeMax(int $anneeMax): RechercheVoiture
    {
        $this->anneeMax = $anneeMax;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getKilometreMax(): ?int
    {
        return $this->kilometreMax;
    }
    
    
    /**
    *@param int|null $kilometreMax
    * @return RechercheVoiture
    */
    public function setKilometreMax(int $kilometreMax): RechercheVoiture
    {
        $this->kilometreMax = $kilometreMax;
        return $this;
    }
        /**
     * @return string
     */
        public function getBlockPrefix(): string
    {
        return '';
    }
}