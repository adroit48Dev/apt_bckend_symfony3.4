<?php

namespace EmpBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EdCategory
 *
 * @ORM\Table(name="ed_category")
 * @ORM\Entity(repositoryClass="EmpBundle\Repository\EdCategoryRepository")
 */
class EdCategory
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
     * @ORM\Column(name="edu_title", type="string", length=255)
     */
    private $eduTitle;


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
     * Set eduTitle
     *
     * @param string $eduTitle
     *
     * @return EdCategory
     */
    public function setEduTitle($eduTitle)
    {
        $this->eduTitle = $eduTitle;

        return $this;
    }

    /**
     * Get eduTitle
     *
     * @return string
     */
    public function getEduTitle()
    {
        return $this->eduTitle;
    }
}

