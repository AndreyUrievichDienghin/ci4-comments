<?php

namespace App\Libraries;

use App\Models\CommentModel;
use CodeIgniter\Pager\Pager;

class CommentManager {

    protected int $pageCountShow = 3;
    protected CommentModel $commentModel;

    public function __construct()
    {
        $this->commentModel = new CommentModel();
    }

    public function setOrder(string $field, string $direction): CommentManager {
        $this->commentModel->orderBy($field, $direction);
        return $this;
    }

    public function setCountShow(int $countShow): void {
        $this->pageCountShow = $countShow;
    }

    public function pagination(int $page) {
        return $this->commentModel->paginate($this->pageCountShow, 'default', $page);
    }

    public function getPager(): Pager {
        return $this->commentModel->pager;
    }

    public function saveComment($email, $text, $date) {
        $result = $this->commentModel->save([
            'name' => $email,
            'text' => $text,
            'date' => $date
        ]);
        if($result){
            return [
                'success' => true,
                'error' => false,
            ];
        }
        else{
            return [
                'success' => false,
                'error' => true,
                'errors' => $this->commentModel->errors()
            ];
        }
    }

    public function insertBatch(array $data){
        $result = $this->commentModel->insertBatch($data);
        if($result){
            return [
                'success' => true,
                'error' => false,
            ];
        }
        else{
            return [
                'success' => false,
                'error' => true,
                'errors' => $this->commentModel->errors()
            ];
        }
    }
}