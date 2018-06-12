<?php

namespace EmpBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Misd\PhoneNumberBundle\Validator\Constraints\PhoneNumber;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;






/**
 * Employee
 *
 * @ORM\Table(name="employee")
 * @ORM\Entity(repositoryClass="EmpBundle\Repository\EmployeeRepository")
 *
 * @UniqueEntity(fields={"empPerMail"}, message="This Mail is already taken")
 */
class Employee implements UserInterface

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
     * @ORM\Column(name="username")
     */
    private $username;


    /**
     * @ORM\Column(name="emp_name", type="string")
     *
     *
     */
    private $empName;

    /**
     * @Assert\Email()
     * @ORM\Column(name="emp_mail", type="string", unique=true)
     *
     *
     */
    private $empMail;

    /**
     * @Assert\Email()
     * @ORM\Column(name="emp_per_mail", type="string")
     *
     */
    private $empPerMail;

    /**
     *
     *
     *
     *
     * @ORM\Column(name="emp_mobile",  length=255, unique=true)
     *
     */
    private $empMobile;

    /**
    *
     *
     *
     *
     * @ORM\Column(name="emp_mobile_two")
     */
    private $empMobileTwo;

    /**
     * @ORM\Column(name="emp_dob", type="date")
     *
     */
    private $empDob;

    /**
     * @ORM\Column(name="emp_do_join", type="datetime")
     *
     *
     * @var \DateTime
     */
    private $empDoJoin;

    /**
     * @ORM\Column(name="emp_address_field_one", type="string", nullable=false)
     *
     *
     *
     */
    private $empAddressFieldOne;


    /**
     * @ORM\Column(name="emp_address_field_two", type="string", nullable=false)
     *
     *
     *
     */
    private $empAddressFieldTwo;

    /**
     * @ORM\Column(name="city", type="string", nullable=false)
     *
     *
     *
     */
    private $city;

    /**
     * @ORM\Column(name="state", type="string", nullable=false)
     *
     *
     *
     */
    private $state;


    /**
     * @ORM\Column(name="emp_dept", type="string")
     *
     */
    private $empDept;

    /**
     * @ORM\Column(name="emp_status", type="string")
     *
     */
    private $empStatus;

    /**
     * @ORM\Column(name="emp_type", type="string")
     *
     */
    private $empType;

    /**
     * @var string
     * @ORM\Column(name="emp_id", length=10)
     *
     */
    private $empId;


    /**
     * @var string
     * @ORM\Column(name="password")
     */
    private $password;




    /**
     *
     * @ORM\Column(name="roles", type="array")
     *
     */
    private $roles;

    public function __construct() {
        $this->roles = array('ROLE_ADMIN');
    }

    

    public function getRoles()
    {
        return $this->roles;
    }

    public function getPassword()
    {
        return $this->password;

    }

    public function getSalt()
    {
        return null;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function eraseCredentials()
    {
        $this->password = null;
    }



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set username
     *
     * @param string $username
     *
     * @return Employee
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Set empName
     *
     * @param string $empName
     *
     * @return Employee
     */
    public function setEmpName($empName)
    {
        $this->empName = $empName;

        return $this;
    }

    /**
     * Get empName
     *
     * @return string
     */
    public function getEmpName()
    {
        return $this->empName;
    }

    /**
     * Set empMail
     *
     * @param string $empMail
     *
     * @return Employee
     */
    public function setEmpMail($empMail)
    {
        $this->empMail = $empMail;

        return $this;
    }

    /**
     * Get empMail
     *
     * @return string
     */
    public function getEmpMail()
    {
        return $this->empMail;
    }

    /**
     * Set empPerMail
     *
     * @param string $empPerMail
     *
     * @return Employee
     */
    public function setEmpPerMail($empPerMail)
    {
        $this->empPerMail = $empPerMail;

        return $this;
    }

    /**
     * Get empPerMail
     *
     * @return string
     */
    public function getEmpPerMail()
    {
        return $this->empPerMail;
    }

    /**
     * Set empMobile
     *
     * @param string $empMobile
     *
     * @return Employee
     */
    public function setEmpMobile($empMobile)
    {
        $this->empMobile = $empMobile;

        return $this;
    }

    /**
     * Get empMobile
     *
     * @return string
     */
    public function getEmpMobile()
    {
        return $this->empMobile;
    }

    /**
     * Set empMobileTwo
     *
     * @param string $empMobileTwo
     *
     * @return Employee
     */
    public function setEmpMobileTwo($empMobileTwo)
    {
        $this->empMobileTwo = $empMobileTwo;

        return $this;
    }

    /**
     * Get empMobileTwo
     *
     * @return string
     */
    public function getEmpMobileTwo()
    {
        return $this->empMobileTwo;
    }

    /**
     * Set empDob
     *
     * @param \DateTime $empDob
     *
     * @return Employee
     */
    public function setEmpDob($empDob)
    {
        $this->empDob = $empDob;

        return $this;
    }

    /**
     * Get empDob
     *
     * @return \DateTime
     */
    public function getEmpDob()
    {
        return $this->empDob;
    }

    /**
     * Set empDoJoin
     *
     * @param \DateTime $empDoJoin
     *
     * @return Employee
     */
    public function setEmpDoJoin($empDoJoin)
    {
        $this->empDoJoin = $empDoJoin;

        return $this;
    }

    /**
     * Get empDoJoin
     *
     * @return \DateTime
     */
    public function getEmpDoJoin()
    {
        return new \DateTime('now', (new \DateTimeZone('Asia/Kolkata')));
    }

    /**
     * Set empAddressFieldOne
     *
     * @param string $empAddressFieldOne
     *
     * @return Employee
     */
    public function setEmpAddressFieldOne($empAddressFieldOne)
    {
        $this->empAddressFieldOne = $empAddressFieldOne;

        return $this;
    }

    /**
     * Get empAddressFieldOne
     *
     * @return string
     */
    public function getEmpAddressFieldOne()
    {
        return $this->empAddressFieldOne;
    }

    /**
     * Set empAddressFieldTwo
     *
     * @param string $empAddressFieldTwo
     *
     * @return Employee
     */
    public function setEmpAddressFieldTwo($empAddressFieldTwo)
    {
        $this->empAddressFieldTwo = $empAddressFieldTwo;

        return $this;
    }

    /**
     * Get empAddressFieldTwo
     *
     * @return string
     */
    public function getEmpAddressFieldTwo()
    {
        return $this->empAddressFieldTwo;
    }

    /**
     * Set city
     *
     * @param string $city
     *
     * @return Employee
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set state
     *
     * @param string $state
     *
     * @return Employee
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set empDept
     *
     * @param string $empDept
     *
     * @return Employee
     */
    public function setEmpDept($empDept)
    {
        $this->empDept = $empDept;

        return $this;
    }

    /**
     * Get empDept
     *
     * @return string
     */
    public function getEmpDept()
    {
        return $this->empDept;
    }

    /**
     * Set empStatus
     *
     * @param string $empStatus
     *
     * @return Employee
     */
    public function setEmpStatus($empStatus)
    {
        $this->empStatus = $empStatus;

        return $this;
    }

    /**
     * Get empStatus
     *
     * @return string
     */
    public function getEmpStatus()
    {
        return $this->empStatus;
    }

    /**
     * Set empType
     *
     * @param string $empType
     *
     * @return Employee
     */
    public function setEmpType($empType)
    {
        $this->empType = $empType;

        return $this;
    }

    /**
     * Get empType
     *
     * @return string
     */
    public function getEmpType()
    {
        return $this->empType;
    }

    /**
     * Set empId
     *
     * @param string $empId
     *
     * @return Employee
     */
    public function setEmpId($empId)
    {
        $this->empId = $empId;

        return $this;
    }

    /**
     * Get empId
     *
     * @return string
     */
    public function getEmpId()
    {
        return $this->empId;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return Employee
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Set roles
     *
     * @param string $roles
     *
     * @return Employee
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;

        return $this;
    }
}
