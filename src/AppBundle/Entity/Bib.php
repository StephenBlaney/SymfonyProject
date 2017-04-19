<?php
/**
 * Created by PhpStorm.
 * User: Stephen
 * Date: 19/04/2017
 * Time: 13:13
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="bibs")
 */

class Bib
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */


    private $name;
    /**
     * @ORM\Column(type="string", length=100)
     */

    public function __construct($id, $name){
        $this->id = $id;
        $this->name = $name;
    }
    public function getId()
    {
        return $this->id;
    }
    public function getName()
    {
        return $this->name;
    }


    /**
     * Set name
     *
     * @param string $name
     *
     * @return Bib
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
}
