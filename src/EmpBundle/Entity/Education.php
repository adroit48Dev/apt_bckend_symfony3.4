<?php

namespace EmpBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Education
 *
 * @ORM\Table(name="education")
 * @ORM\Entity(repositoryClass="EmpBundle\Repository\EducationRepository")
 */
class Education
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
     * @ORM\OneToMany(targetEntity="EmpBundle\Entity\EduList", mappedBy="id", cascade={"persist", "all"}, orphanRemoval=true)
     * @ORM\Column(name="edu_all", nullable=false)
     */
    private $eduAll;


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
     * Constructor
     */
    public function __construct()
    {
        $this->eduAll = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add eduAll
     *
     * @param \EmpBundle\Entity\EduList $eduAll
     *
     * @return Education
     */
    public function addEduAll(\EmpBundle\Entity\EduList $eduAll)
    {
        $this->eduAll->add($eduAll);

        $eduAll->setListEdu($this);

        return $this;
    }

    /**
     * Remove eduAll
     *
     * @param \EmpBundle\Entity\EduList $eduAll
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeEduAll(\EmpBundle\Entity\EduList $eduAll)
    {
        return $this->eduAll->removeElement($eduAll);
    }

    /**
     * Get eduAll
     *
     * @return \Doctrine\Common\Collections\Collection EduList[]
     */
    public function getEduAll()
    {
        return $this->eduAll;
    }
}
