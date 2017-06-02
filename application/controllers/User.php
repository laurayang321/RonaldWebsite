<?php

/**
 * Created by PhpStorm.
 * User: rebec
 * Date: 5/3/2017
 * Time: 11:53 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'controllers/Homepage.php');

class user extends Application
{
    /**
     * the homepage for user
     */
    public function index() {
        $record = $this->adminuser->getAllUser();
        $temp_users = array();
        //var_dump($record);
        foreach ($record as $user) {
            $delete = "";
            if($user->role != "manager") {
                $delete = "delete";
            }
            $temp_users[] = array(
                'id' =>  $user->id,
                'username' => $user->username,
                'realname' => $user->realname,
                'delete' => $delete
            );
        }
        //var_dump($temp_users);

        $this->data['menubar'] = $this->parser->parse("menubar", $this->data, true);
        $this->data['footer'] = $this->parser->parse('footer', $this->data, true);
        $this->data['records'] = $temp_users;
        $this->data['pagebody'] = 'showusers';
        $this->render();
    }

    public function go_home() {
        $this->data['pagebody'] = 'homepage';
        $this->data['message'] = '<br>';
        $this->render();
    }
    /**
     * the function that decide which page to go after post login information
     * @return array
     */
    public function check()
    {
        if($this->checkPwd($_POST["user"],$_POST["pwd"])) {
            $this->session->set_userdata('user', $_POST["user"]);
            $this->data['menubar'] = $this->parser->parse("menubar", $this->data, true);
            $this->data['user'] = $_POST["user"];
            $this->data['footer'] = $this->parser->parse('footer', $this->data, true);
            $this->data['pagebody'] = "management";
        } else {
            $this->data['message'] = "<div class='col-md-11 alert alert-danger'> Please verify your username and password"."</div>";
            $this->data['pagebody'] = "homepage";
        }
        $this->render();
    }

    /**
     * the function that connect to database, and get password, and check if the pwd is correct
     * @return array
     */
    public function checkPwd($user,$pwd) {
        $temppwd = $this->adminuser->getPassword($user);
        //var_dump($temppwd)
        if(base64_decode($temppwd) == $pwd && $pwd != null && $user!="") {
            return true;
        }
        return false;
    }

    /**
     * the create page for user
     * @return array
     */
    public function addUser() {
        if(!$this->session->has_userdata('user')) {
            $this->go_home();
        } else {
            $this->data["error"] = "<div></div>";
            $this->data['menubar'] = $this->parser->parse("menubar", $this->data, true);
            $this->data['footer'] = $this->parser->parse('footer', $this->data, true);
            $this->data['pagebody'] = "userform";
            $this->render();
        }

        //http://comp4711.backend/user/addUser
    }

    /**
     * the function that verify if the password and confirm one is same
     * @return array
     */
    public function verify(){
        if($_POST['username'] == "") {
            $this->data["error"] = "<div class='span11 alert alert-danger'>username cannot be empty</div><br>";
        } else {
            if($_POST["pwd"] == $_POST["confirm"]) {
                if($this->checkDuplicateName($_POST["username"])){
                    $role = "";
                    if(!isset($_POST['role'])) {
                        $role = "employee";
                    }  else {
                        $role = "manager";
                    }
                    $resultArray = array(
                        'username' => $_POST["username"],
                        'password' => base64_encode($_POST["pwd"]),
                        'realname' => $_POST['realname'],
                        'role' => $role
                    );
                    $this->db->insert("adminuser",$resultArray);
                    $this->index();
                    return;
                } else {
                    $this->data["error"] = "<div class='span11 alert alert-danger'>The username exits already. Please change another one.</div><br>";
                }
            } else {
                $this->data["error"] = "<div class='span11 alert alert-danger'>your password doesn't match</div><br>";
            }
            $this->data['menubar'] = $this->parser->parse("menubar", $this->data, true);
            $this->data['footer'] = $this->parser->parse('footer', $this->data, true);
            $this->data['pagebody'] = "userform";
            $this->render();
        }

    }

    public function checkDuplicateName($username) {
        return $this->adminuser->checkDuplicate($username);
    }

    public function delete($id) {
        if(!$this->session->has_userdata('user')) {
            $this->go_home();
        } else {
            $this->db->delete('adminuser', array('id' => $id));
            $this->index();
        }
    }

    /**
     * the function that log out
     * @return array
     */
    public function logout() {
        $this->session->unset_userdata('user');
        $this->session->sess_destroy();
        $this->data['pagebody'] = "homepage";
        $this->data['message'] = '<br>';
        $this->render();
    }
}