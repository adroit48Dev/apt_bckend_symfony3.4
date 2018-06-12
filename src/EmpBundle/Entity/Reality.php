<?php

namespace EmpBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Reality
 *
 * @ORM\Table(name="reality")
 * @ORM\Entity(repositoryClass="EmpBundle\Repository\RealityRepository")
 */
class Reality
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
     * @ORM\OneToMany(targetEntity="EmpBundle\Entity\ReList", mappedBy="id", cascade={"persist", "all"}, orphanRemoval=true)
     * @ORM\Column(name="real_all", nullable=false)
     */
    private $realAll;



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
        $this->realAll = new \Doctrine\Common\Collections\ArrayCollection();

    }

    /**
     * Add realAll
     *
     * @param \EmpBundle\Entity\ReList $realAll
     *
     * @return Reality
     */
    public function addRealAll(\EmpBundle\Entity\ReList $realAll)
    {
        $this->realAll->add($realAll);

        $realAll->setListReal($this);

        return $this;
    }

    /**
     * Remove realAll
     *
     * @param \EmpBundle\Entity\ReList $realAll
     *
     * @return  boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeRealAll(\EmpBundle\Entity\ReList $realAll)
    {
       return $this->realAll->removeElement($realAll);
    }

    /**
     * Get realAll
     *
     * @return \Doctrine\Common\Collections\Collection ReList[]
     */
    public function getRealAll()
    {
        return $this->realAll;
    }
}
