<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserApplied
 *
 * @ORM\Table(name="user_applied")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserAppliedRepository")
 */
class UserApplied
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
     * @var \DateTime
     *
     * @ORM\Column(name="addedBy", type="datetime")
     */
    private $addedBy;




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
     * Set addedBy
     *
     * @param \DateTime $addedBy
     *
     * @return UserApplied
     */
    public function setAddedBy($addedBy)
    {
        $this->addedBy = $addedBy;

        return $this;
    }

    /**
     * Get addedBy
     *
     * @return \DateTime
     */
    public function getAddedBy()
    {
        return $this->addedBy;
    }
}

