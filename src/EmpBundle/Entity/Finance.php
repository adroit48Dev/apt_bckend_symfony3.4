<?php

namespace EmpBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Finance
 *
 * @ORM\Table(name="finance")
 * @ORM\Entity(repositoryClass="EmpBundle\Repository\FinanceRepository")
 */
class Finance
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
    *@ORM\OneToMany(targetEntity="EmpBundle\Entity\FinList", mappedBy="id", cascade={"persist", "all"}, orphanRemoval=true)
     * @ORM\Column(name="fin_all", nullable=false)
     */
    private $finAll;


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
        $this->finAll = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add finAll
     *
     * @param \EmpBundle\Entity\FinList $finAll
     *
     * @return Finance
     */
    public function addFinAll(\EmpBundle\Entity\FinList $finAll)
    {
        $this->finAll->add($finAll);

        $finAll->setListFin($this);

        return $this;
    }

    /**
     * Remove finAll
     *
     * @param \EmpBundle\Entity\FinList $finAll
     * @return  boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeFinAll(\EmpBundle\Entity\FinList $finAll)
    {
        return $this->finAll->removeElement($finAll);
    }

    /**
     * Get finAll
     *
     * @return \Doctrine\Common\Collections\Collection FinList[]
     */
    public function getFinAll()
    {
        return $this->finAll;
    }
}
