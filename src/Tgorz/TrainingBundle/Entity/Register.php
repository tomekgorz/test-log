<?php


namespace Tgorz\TrainingBundle\Entity;


class Register {
   
    private $name;
//    private $email;
//    private $sex;
//    private $birthdate;
//    private $country;
//    private $course;
//    private $invest;
//    private $comments;
//    private $paymentFile;
    
    public function getName() {
        return $this->name;
    }

//    public function getEmail() {
//        return $this->email;
//    }
//
//    public function getSex() {
//        return $this->sex;
//    }
//
//    public function getBirthdate() {
//        return $this->birthdate;
//    }
//
//    public function getCountry() {
//        return $this->country;
//    }
//
//    public function getCourse() {
//        return $this->course;
//    }
//
//    public function getInvest() {
//        return $this->invest;
//    }
//
//    public function getComments() {
//        return $this->comments;
//    }
//
//    public function getPaymentFile() {
//        return $this->paymentFile;
//    }

    public function setName($name) {
        $this->name = $name;
        return $this;
    }

//    public function setEmail($email) {
//        $this->email = $email;
//        return $this;
//    }
//
//    public function setSex($sex) {
//        $this->sex = $sex;
//        return $this;
//    }
//
//    public function setBirthdate($birthdate) {
//        $this->birthdate = $birthdate;
//        return $this;
//    }
//
//    public function setCountry($country) {
//        $this->country = $country;
//        return $this;
//    }
//
//    public function setCourse($course) {
//        $this->course = $course;
//        return $this;
//    }
//
//    public function setInvest($invest) {
//        $this->invest = $invest;
//        return $this;
//    }
//
//    public function setComments($comments) {
//        $this->comments = $comments;
//        return $this;
//    }
//
//    public function setPaymentFile($paymentFile) {
//        $this->paymentFile = $paymentFile;
//        return $this;
//    }

//    public function save($savePath){
//
//            $paramsNames = array('name','email','sex','birthdate','country','course','invest','comments');
//            $formData = array();
//            
//            foreach($paramsNames as $name){
//                $formData[$name] = $this->{$name};
//            }
//            
//            $randVal = rand(1000, 99999);
//            $dataFileName = sprintf('data_%d.txt', $randVal);
//
//            file_put_contents($savePath . $dataFileName, print_r($formData, TRUE));
//
//            $file = $this->getPaymentFile();
//            if (NULL !== $file) {
//                $newName = sprintf('file_%d.%s', $randVal, $file->guessExtension());
//                $file->move($savePath, $newName);
//            }
//    }
    
}
