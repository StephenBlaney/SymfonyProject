<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Basket
 *
 * @ORM\Table(name="basket")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BasketRepository")
 */
class Basket
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="referenceCode", type="string", length=255)
     */
    private $referenceCode;

    /**
     * @var string
     *
     * @ORM\Column(name="referenceTitle", type="string", length=255)
     */
    private $referenceTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="SubmittedBy", type="string", length=255)
     */
    private $submittedBy;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set referenceCode
     *
     * @param string $referenceCode
     *
     * @return Basket
     */
    public function setReferenceCode($referenceCode)
    {
        $this->referenceCode = $referenceCode;

        return $this;
    }

    /**
     * Get referenceCode
     *
     * @return string
     */
    public function getReferenceCode()
    {
        return $this->referenceCode;
    }

    /**
     * Set referenceTitle
     *
     * @param string $referenceTitle
     *
     * @return Basket
     */
    public function setReferenceTitle($referenceTitle)
    {
        $this->referenceTitle = $referenceTitle;

        return $this;
    }

    /**
     * Get referenceTitle
     *
     * @return string
     */
    public function getReferenceTitle()
    {
        return $this->referenceTitle;
    }

    /**
     * Set submittedBy
     *
     * @param string $submittedBy
     *
     * @return Basket
     */
    public function setSubmittedBy($submittedBy)
    {
        $this->submittedBy = $submittedBy;

        return $this;
    }

    /**
     * Get submittedBy
     *
     * @return string
     */
    public function getSubmittedBy()
    {
        return $this->submittedBy;
    }
}

