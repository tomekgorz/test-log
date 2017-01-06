<?php

namespace Tgorz\TrainingBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="registrations")
 */
class Register {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     *
     * @ORM\Column(type="string", length=255)
     * 
     * @Assert\NotBlank
     * 
     * @Assert\Regex(
     *      pattern = "/^[a-zA-Z]+ [a-zA-Z]+$/",
     *      message ="Musisz podać imię i nazwisko"
     * )
     */
    private $name;

    /**
     *
     *  @ORM\Column(type="string", length=255)
     * 
     * @Assert\NotBlank
     * 
     * @Assert\Email
     */
    private $email;
    
    /**
     *
     *  @ORM\Column(type="string", length=1, nullable=true)
     */
    private $sex;

    /**
     * @ORM\Column(type="date", nullable=true)
     * 
     * @Assert\Date
     * 
     * 
     */
    private $birthdate;

    /**
     *  @ORM\Column(type="string", length=2)
     *
     * @Assert\NotBlank
     * 
     * 
     */
    private $country;

    /**
     *
     *  @ORM\Column(type="string", length=255)
     * 
     * @Assert\NotBlank
     * 
     * 
     */
    private $course;

    /**
     *  @ORM\Column(type="array")
     *
     * @Assert\NotBlank
     * 
     * @Assert\Count(
     *          min = 2
     * )
     */
    private $invest;
    
    /**
     *
     *  @ORM\Column(type="text", nullable=true) 
     * 
     */
    private $comments;

    /**
     *
     * @Assert\NotBlank
     * 
     * @Assert\File(
     *          maxSize ="1M",
     *          mimeTypes = {"application/pdf","application/x-pdf"},
     *          mimeTypesMessage = "Potwierdzenie przelewu musi być w formie PDF"
     * )
     */
    private $paymentFile;

    public function getName() {
        return $this->name;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getSex() {
        return $this->sex;
    }

    public function getBirthdate() {
        return $this->birthdate;
    }

    public function getCountry() {
        return $this->country;
    }

    public function getCourse() {
        return $this->course;
    }

    public function getInvest() {
        return $this->invest;
    }

    public function getComments() {
        return $this->comments;
    }

    public function getPaymentFile() {
        return $this->paymentFile;
    }

    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    public function setEmail($email) {
        $this->email = $email;
        return $this;
    }

    public function setSex($sex) {
        $this->sex = $sex;
        return $this;
    }

    public function setBirthdate($birthdate) {
        $this->birthdate = $birthdate;
        return $this;
    }

    public function setCountry($country) {
        $this->country = $country;
        return $this;
    }

    public function setCourse($course) {
        $this->course = $course;
        return $this;
    }

    public function setInvest($invest) {
        $this->invest = $invest;
        return $this;
    }

    public function setComments($comments) {
        $this->comments = $comments;
        return $this;
    }

    public function setPaymentFile($paymentFile) {
        $this->paymentFile = $paymentFile;
        return $this;
    }

    public function save($savePath) {

        $paramsNames = array('name', 'email', 'sex', 'birthdate', 'country', 'course', 'invest', 'comments');
        $formData = array();

        foreach ($paramsNames as $name) {
            $formData[$name] = $this->{$name};
        }

        $randVal = rand(1000, 99999);
        $dataFileName = sprintf('data_%d.txt', $randVal);

        file_put_contents($savePath . $dataFileName, print_r($formData, TRUE));

        $file = $this->getPaymentFile();
        if (NULL !== $file) {
            $newName = sprintf('file_%d.%s', $randVal, $file->guessExtension());
            $file->move($savePath, $newName);
        }
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
}
