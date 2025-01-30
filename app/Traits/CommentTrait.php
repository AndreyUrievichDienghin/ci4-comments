<?php

namespace App\Traits;

trait CommentTrait{

    private $emailNameVar = ['test','example','rand'];
    private $emailDomenVar = ['test.ru','test.com','example.com','rand.uz'];
    public function createCommentData() {
        return [
            'name' => $this->getRandomEmail(),
            'text' => $this->getRandomText(),
            'date' => $this->getRandomDate(),
        ];
    }

    public function createCommentsData(int $count) {
        $resultArr = [];
        for ($i = 0; $i < $count; $i++) {
            $resultArr[] = $this->createCommentData();
        }
        return $resultArr;
    }

    public function getRandomEmail() {
        return $this->emailNameVar[array_rand($this->emailNameVar)].'@'.$this->emailDomenVar[array_rand($this->emailDomenVar)];
    }

    public function getRandomText() {
        return uniqid();
    }

    public function getRandomDate() {
        $int= mt_rand(946690254,1735695054);
        return date("Y-m-d",$int);
    }
}