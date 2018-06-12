<?php

namespace EmpBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Skill
 *
 * @ORM\Table(name="skill")
 * @ORM\Entity(repositoryClass="EmpBundle\Repository\SkillRepository")
 */
class Skill
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
     *
     * @ORM\Column(name="skill_title", type="string", length=255, unique=true)
     */
    private $skillTitle;


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
     * Set skillTitle
     *
     * @param string $skillTitle
     *
     * @return Skill
     */
    public function setSkillTitle($skillTitle)
    {
        $this->skillTitle = $skillTitle;

        return $this;
    }

    /**
     * Get skillTitle
     *
     * @return string
     */
    public function getSkillTitle()
    {
        return $this->skillTitle;
    }

    public function __toString()
    {
        return (string)$this->getSkillTitle();
    }


}

