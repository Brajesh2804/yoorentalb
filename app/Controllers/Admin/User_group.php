<?php

namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\AuthModel;
use App\Libraries\Hash;
use CodeIgniter\HTTP\RedirectResponse;

class User_group extends BaseController
{
    public $data;
    public $authmodel;
    public $commonmodel;
    public function __construct()
    {
        $this->authmodel = model('App\Models\AuthModel', false);
        $this->commonmodel = model('App\Models\CommonModel', false);
    }
    public function index()
    {
        $data = [];
        $data['usersgrouplist'] = $this->commonmodel->getAllRecord('tbl_role_privilege', null, ['privilege_id', 'ASC']);
        return view('Admin/usergroup/usergroup_index', $data);
    }
    public function user_group()
    {
        $this->data['usersgrouplist'] = $this->commonmodel->getAllRecord('tbl_role_privilege');
        return view("Admin/usergroup/usergroup_index", $this->data);
    }
    public function add_group()
    {
        if ($this->request->getMethod() === 'POST') {
            $validation = \Config\Services::validation();

            $validation->setRule('_name', 'Group Name', 'required', ['required' => 'Group name is required']);
            // $validation->setRule('status', 'Status', 'required', ['required' => 'Status is required']);
            if ($validation->withRequest($this->request)->run()) {
                $post = $this->request->getPost();
                $data = array();
                $data['_name'] = $this->request->getPost('_name');
                $data['status'] = $this->request->getPost('status');
                $data['create_at'] = date('Y-m-d');
                $data['updated_at'] = date('Y-m-d');
                $groupId = $this->commonmodel->insertRecord('tbl_role_privilege', $data);
                if (isset($post['menu_id']) && isset($post['crudid'])) {
                    foreach ($post['menu_id'] as $key => $menuid) {
                        $prvlgarr = array();
                        $prvlgarr['privilege_id'] = $groupId;
                        $prvlgarr['menu_id'] = $menuid;
                        $prvlgarr['crud_ids'] = implode(',', $post['crudid'][$key]);
                        $prvlgarr['added_at'] = date('Y-m-d');
                        $this->commonmodel->insertRecord('tbl_privilege', $prvlgarr);
                    }
                    //echo '<pre>';print_r($post);exit;	
                }
                if ($groupId) {
                    session()->setFlashdata(['message' => 'User Group Added Successfully', 'type' => 'success']);
                } else {
                    session()->setFlashdata(['message' => 'Something went wrong. Please Try After Sometimes...', 'type' => 'danger']);
                }
                return redirect()->to(base_url('admin/usergroup'));
            } else {
                $this->data['validation'] = $validation->getErrors();
            }
        }
        $this->data['menulist'] = $this->commonmodel->getAllRecord('tbl_menu_list', ['status' => 1]);
        return view('Admin/usergroup/add_group', $this->data);
    }
    public function edit_group($id)
    {
        if ($this->request->getMethod() === 'POST') {
            $validation = \Config\Services::validation();

            $validation->setRule('_name', 'Group Name', 'required', ['required' => 'Group name is required']);
            // $validation->setRule('status', 'Status', 'required', ['required' => 'Status is required']);
            if ($validation->withRequest($this->request)->run()) {
                $post = $this->request->getPost();
                $id = $this->request->getPost('id');
                $data = array();
                $data['_name'] = $this->request->getPost('_name');
                $data['status'] = $this->request->getPost('status');
                $data['updated_at'] = date('Y-m-d');
                $updated = $this->commonmodel->updateRecord('tbl_role_privilege', $data, ['privilege_id' => $id]);
                $loginId = session('user_id');
                //echo $loginId; exit;
                if ($loginId == 1 || $loginId == 20) {
                    $deleteAllPrivilege = $this->commonmodel->deleteRecord('tbl_privilege', ['privilege_id' => $id, 'menu_id !=' => 2]);
                } else {
                    $deleteAllPrivilege = $this->commonmodel->deleteRecord('tbl_privilege', ['privilege_id' => $id]);
                }
                if (isset($post['menu_id']) && isset($post['crudid'])) {
                    foreach ($post['menu_id'] as $key => $menuid) {
                        $prvlgarr = array();
                        $prvlgarr['privilege_id'] = $id;
                        $prvlgarr['menu_id'] = $menuid;
                        $prvlgarr['crud_ids'] = implode(',', $post['crudid'][$key]);
                        $prvlgarr['added_at'] = date('Y-m-d');
                        $inserted = $this->commonmodel->insertRecord('tbl_privilege', $prvlgarr);
                    }
                    //echo '<pre>';print_r($post);exit;	
                }
                if ($updated) {
                    session()->setFlashdata(['message' => 'User Group Updated Successfully', 'type' => 'success']);
                } else if (isset($inserted) || $deleteAllPrivilege) {
                    session()->setFlashdata(['message' => 'Privilege Updated Successfully', 'type' => 'success']);
                } else {
                    session()->setFlashdata(['message' => 'Something went wrong.', 'type' => 'danger']);
                }
                return redirect()->to(base_url('admin/usergroup'));
            } else {
                $this->data['validation'] = $validation->getErrors();
            }
        }
        $this->data['prev_details'] = $this->commonmodel->getOneRecord('tbl_role_privilege', array('privilege_id' => $id));
        $this->data['menulist'] = $this->commonmodel->getAllRecord('tbl_menu_list', ['status' => 1]);
        return view('Admin/usergroup/edit_group', $this->data);
    }
    public function delete_group($id = false)
    {
        if ($id == 1) {
            session()->setFlashdata(['message' => 'Admin Group can not delete!', 'type' => 'danger']);
            return redirect()->to('admin/usergroup');
        }
        $deleteAllPrivilege = $this->commonmodel->deleteRecord('tbl_privilege', ['privilege_id' => $id]);
        $deleted = $this->commonmodel->deleteRecord('tbl_role_privilege', array('privilege_id' => $id));
        if ($deleted && $deleteAllPrivilege) {
            session()->setFlashdata(['message' => 'Group deleted successfully', 'type' => 'success']);
        } else {
            session()->setFlashdata(['message' => 'Something went wrong.', 'type' => 'danger']);
        }
        return redirect()->to(base_url('admin/usergroup'));
    }


}
?>