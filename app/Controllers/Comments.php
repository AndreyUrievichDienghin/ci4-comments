<?php

namespace App\Controllers;

use App\Libraries\CommentManager;
use App\Traits\CommentTrait;

class Comments extends BaseController
{

    use CommentTrait;
    protected $commentManager;

    public function __construct()
    {
        $this->commentManager = new CommentManager();
    }

    public function index()
    {

        $sortField = $this->request->getGet('sort');
        $sortDirection = $this->request->getGet('dir');

        if($sortField && $sortDirection) {
            $this->commentManager->setOrder($sortField, $sortDirection);
        }

        $currentPage = $this->request->getGet('page') ?? 1;




        $comments = $this->commentManager->pagination($currentPage);
        $pager = $this->commentManager->getPager();

        $pager->setPath('comments/');

        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'comments' => view('comments/_comments', ['comments' => $comments]),
                'pagination' => $pager->links('default', 'custom_pagination'),
            ]);
        }

        $data = [
            'comments' => $comments,
            'pager' => $pager,
            'sortField' => $sortField,
            'sortDirection' => $sortDirection,
        ];

        return view('comments/index', $data);
    }

    public function create()
    {
        $rules = [
            'email' => 'required|valid_email',
            'text' => 'required',
            'date' => 'required|valid_date',
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'status' => 'error',
                'errors' => $this->validator->getErrors(),
            ]);
        }


        $result = $this->commentManager->saveComment(
            $this->request->getPost('email'),
            $this->request->getPost('text'),
            $this->request->getPost('date')
        );
        if($result['error']){
            return $this->response->setJSON([
                'status' => 'error',
                'message' => implode('<br>', $result['errors']),
            ]);
        }


        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Комментарий успешно добавлен!',
        ]);
    }
    public function createBatch()
    {
        if($this->request->isAJAX()) {
            if($createCount = $this->request->getPost('createCount')){
                if ($createCount <= 0) {
                    return $this->response->setJSON([
                        'status' => 'error',
                        'message' => 'Количество комментариев должно быть больше 0.',
                    ]);
                }
                $data = $this->createCommentsData($createCount);
            }
            else{
                $data = [$this->createCommentData()];
            }

            $result = $this->commentManager->insertBatch($data);
            if($result['error']){
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => implode('<br>', $result['errors']),
                ]);
            }
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Комментарии успешно добавлены!',
            ]);
        }

        return false;
    }

    public function delete(){
        $id = $this->request->getPost('commentId');
        $result = $this->commentManager->deleteComments($id);
        if($result['error']){
            return $this->response->setJSON([
                'status' => 'error',
                'message' => implode('<br>', $result['errors']),
            ]);
        }
        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Комментарии удален',
        ]);
    }
}