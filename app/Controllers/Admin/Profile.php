<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Profile extends BaseController
{
    public $commonmodel;

    public function __construct()
    {
        $this->commonmodel = model('App\Models\CommonModel', false);
    }

    public function index()
    {
        $id = session('id');

        if (!$id) {
            return redirect()->to('/admin');
        }

        $data['profile'] = $this->commonmodel
            ->getOneRecord('admin', ['id' => $id]);

        return view('Admin/profile/index', $data);
    }

    public function change_password()
    {
        $id = session('id'); // Logged-in user id

        if (!$id) {
            return redirect()->to('/admin');
        }

        if ($this->request->getMethod() == 'POST') {

            // Validation
            $validation = $this->validate([
                /*'oldpwd' => [
                    'rules' => 'required|min_length[5]|max_length[12]',
                    'errors' => [
                        'required' => 'Old Password is required',
                        'min_length' => 'Old Password must have at least 5 characters',
                        'max_length' => 'Old Password must not have more than 12 characters'
                    ]
                ],*/
                'pwd' => [
                    'rules' => 'required|min_length[5]|max_length[12]',
                    'errors' => [
                        'required' => 'New Password is required',
                        'min_length' => 'New Password must have at least 5 characters',
                        'max_length' => 'New Password must not have more than 12 characters'
                    ]
                ],
                'cpwd' => [
                    'rules' => 'required|matches[pwd]',
                    'errors' => [
                        'required' => 'Confirm Password is required',
                        'matches' => 'Confirm Password does not match New Password'
                    ]
                ]
            ]);

            if (!$validation) {
                // Validation failed
                $data['validation'] = $this->validator;
                $data['profile'] = $this->commonmodel->getOneRecord('admin', ['id' => $id]);
                return view('Admin/profile/change_password', $data);
            }

            // Get current user data
            $profile = $this->commonmodel->getOneRecord('admin', ['id' => $id]);

            // Check old password (CI4 / PHP native)
            // $oldPassword = $this->request->getPost('oldpwd');
            // if (!password_verify($oldPassword, $profile->password)) {
            //     session()->setFlashdata('message', '<div class="alert alert-danger">Incorrect Old Password</div>');
            //     return redirect()->to('admin/profile/change_password')->withInput();
            // }

            // Update password (CI4 / PHP native)
            $newPassword = $this->request->getPost('pwd');
            $updated = $this->commonmodel->updateRecord(
                'admin',
                ['password' => password_hash($newPassword, PASSWORD_DEFAULT)],
                ['id' => $id]
            );

            if ($updated) {
                session()->setFlashdata('message', '<div class="alert alert-success">Password changed successfully.</div>');
            } else {
                session()->setFlashdata('message', '<div class="alert alert-danger">Something went wrong.</div>');
            }

            return redirect()->to('admin/profile/change_password');

        } else {
            // GET request, show form
            $data['profile'] = $this->commonmodel->getOneRecord('admin', ['id' => $id]);
            return view('Admin/profile/change_password', $data);
        }
    }
}
