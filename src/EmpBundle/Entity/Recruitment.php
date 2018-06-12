<?php

namespace EmpBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * recruitment
 *
 * @ORM\Table(name="recruitment")
 * @ORM\Entity(repositoryClass="EmpBundle\Repository\RecruitmentRepository")
 */
class Recruitment
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
     * @ORM\OneToMany(targetEntity="EmpBundle\Entity\JobList", mappedBy="id", cascade={"persist", "all"}, orphanRemoval=true)
     * @ORM\Column(name="rec_all", nullable=false)
     */
    private $recAll;


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
        $this->recAll = new ArrayCollection();
    }

    /**
     * Add recAll
     *
     * @param \EmpBundle\Entity\JobList $recAll
     *
     * @return Recruitment
     */
    public function addRecAll(\EmpBundle\Entity\JobList $recAll)
    {
        $this->recAll->add($recAll);

        $recAll->setListRec($this);

        return $this;
    }

    /**
     * Remove recAll
     *
     * @param \EmpBundle\Entity\JobList $recAll
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     *
     */
    public function removeRecAll(\EmpBundle\Entity\JobList $recAll)
    {
        return $this->recAll->removeElement($recAll);
    }

    /**
     * Get recAll
     *
     * @return \Doctrine\Common\Collections\Collection JobList[]
     */
    public function getRecAll()
    {
        return $this->recAll;
    }
}

