<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\NewsModel;

class News extends Controller {

    public function index() {

        $model = new NewsModel();

        $data = [
            'news' => $model->getNews()
        ];

        echo view('templates/header');
        echo view('news/overview', $data);
        echo view('templates/footer');

    }

    public function view($id = null) {

        $model = new NewsModel();
        $data['news'] = $model->getNews($id);

        if(empty($data['news'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException(("I couldn't find this item: ".$id));
        }

        $data['title'] = $data['news']['title'];
        echo view('templates/header');
        echo view('news/view', $data);
        echo view('templates/footer');

    }

    public function create() {
        helper('form');

        echo view('templates/header');
        echo view('news/form');
        echo view('templates/footer');
    }

    public function store() {
        $request = \Config\Services::request();

        helper('form');
        $model = new NewsModel();

        $rules = [
            'title' => 'required|min_length[3]|max_length[255]',
            'body' => 'required'
        ];

        if ($this->validate($rules)) {
            $model->save([
                'id'    => $request->getVar('id'),
                'title' => $request->getVar('title'),
                'slug'  => url_title($request->getVar('title')),
                'body'  => $request->getVar('body')
            ]);
        
        echo view('templates/header');
        echo view('news/success');
        echo view('templates/footer');

        } else {
            echo view('templates/header');
            echo view('news/form');
            echo view('templates/footer');
        }
    }

    public function edit($id = null) {

        $model = new NewsModel();
        $data['news'] = $model->getNews($id);

        if (empty($data['news'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("We couldn't find this report");
        }

        $data = [
            'title' => $data['news']['title'],
            'id'    => $data['news']['id'],
            'body'  => $data['news']['body']
        ];

        echo view('templates/header');
        echo view('news/form', $data);
        echo view('templates/footer');
    }

    public function delete($id = null) {

        $model = new NewsModel();
        $model -> delete($id);

        echo view('templates/header');
        echo view('news/delete_success');
        echo view('templates/footer');
    }

}