<?php

namespace EmpBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RealCategory
 *
 * @ORM\Table(name="real_category")
 * @ORM\Entity(repositoryClass="EmpBundle\Repository\RealCategoryRepository")
 */
class RealCategory
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
     * @ORM\Column(name="real_title", type="string", length=255)
     */
    private $realTitle;


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
     * Set realTitle
     *
     * @param string $realTitle
     *
     * @return RealCategory
     */
    public function setRealTitle($realTitle)
    {
        $this->realTitle = $realTitle;

        return $this;
    }

    /**
     * Get realTitle
     *
     * @return string
     */
    public function getRealTitle()
    {
        return $this->realTitle;
    }
}

