<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller
{

    public function index()
    {
        $data = $this->db->query("SELECT `users`.*,`country`.name as country,`state`.name as state,`city`.name as city FROM `users` left join `country`on `country`.`id`=`users`.`country_id` left join `state`on `state`.`id`=`users`.`state_id` left join `city`on `city`.`id`=`users`.`city_id`");
        $this->data['user'] = $data->result();
        $this->load->view('list', $this->data);
    }

    public function add()
    {
        $this->data['data'] = $this->db->get("country")->result();
        $this->load->view('add', $this->data);
    }

    public function getcitystate()
    {
        $id = $this->input->post('id');
        $table = $this->input->post('table');
        if ($table == "state") {
            $param = 'country_id';
            $file = "state_id";

        } else if ($table == "city") {
            $param = 'state_id';
            $file = "city_id";
        }
        $data = $this->db->get_where($table, array($param => $id))->result();
        $html = '<select name="' . $file . '" id="' . $file . '" class="form-control" disabled>
                    <option value="">Select ' . $table . '</option>';

        foreach ($data as $row) {
            $html .= '<option value="' . $row->id . '">' . $row->name . '</option>';
        }
        $html .= "</select>";
        echo $html;
    }

    public function save()
    {
        $dataArray = array(
            'name' => $this->input->post('name'),
            'gender' => $this->input->post('gender'),
            'birthdate' => date("Y-m-d", strtotime($this->input->post('birthdate'))),
            'country_id' => $this->input->post('country_id'),
            'state_id' => $this->input->post('state_id'),
            'city_id' => $this->input->post('city_id'),
            'address' => $this->input->post('address'),
            'email' => $this->input->post('email'),
            'username' => $this->input->post('username'),
            'password' => md5($this->input->post('password'))
        );
        if ($_FILES['profile']['name'] != "") {
            $dataArray['profile'] = $this->do_upload();
        }
        $this->db->insert("users", $dataArray);
        redirect("user");
    }

    public function do_upload()
    {
        $config['upload_path'] = "./uploads/";
        $config['allowed_types'] = "jpg|png";
        $this->load->library("upload", $config);
        if (!$this->upload->do_upload('profile')) {
            return "error";
        } else {
            $data = $this->upload->data();
            return $data['file_name'];
        }

    }

    public function edit($id)
    {
        $this->data['data'] = $this->db->get_where("users", array('id' => $id))->row();
        $this->data['country'] = $this->db->get("country")->result();
        $this->data['state'] = $this->db->get_where("state", array('country_id' => $this->data['data']->country_id))->result();
        $this->data['city'] = $this->db->get("city")->result();
        $this->load->view('edit', $this->data);
    }


    public function update($id)
    {

        $dataArray = array(
            'name' => $this->input->post('name'),
            'gender' => $this->input->post('gender'),
            'birthdate' => date("Y-m-d", strtotime($this->input->post('birthdate'))),
            'country_id' => $this->input->post('country_id'),
            'state_id' => $this->input->post('state_id'),
            'city_id' => $this->input->post('city_id'),
            'address' => $this->input->post('address'),
            'email' => $this->input->post('email'),
            'username' => $this->input->post('username'),
            'password' => md5($this->input->post('password'))
        );
        if ($_FILES['profile']['name'] != "") {
            $data = $this->db->get_where('users', array('id' => $id))->row();
            @unlink("./uploads/" . $data->profile);
            $dataArray['profile'] = $this->do_upload();
        }
        $this->db->update("users", $dataArray, array('id' => $id));
        redirect("user");
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('users');
        redirect("user");
    }
}
