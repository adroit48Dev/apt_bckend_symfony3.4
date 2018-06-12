<?php

namespace EmpBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FinCategory
 *
 * @ORM\Table(name="fin_category")
 * @ORM\Entity(repositoryClass="EmpBundle\Repository\FinCategoryRepository")
 */
class FinCategory
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
     * @ORM\Column(name="fin_type", type="string")
     */
    private $finType;




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
     * Set finType
     *
     * @param string $finType
     *
     * @return FinCategory
     */
    public function setFinType($finType)
    {
        $this->finType = $finType;

        return $this;
    }

    /**
     * Get finType
     *
     * @return string
     */
    public function getFinType()
    {
        return $this->finType;
    }
}
