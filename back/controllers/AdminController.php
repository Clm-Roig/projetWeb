<?php
require('models/admin.php');
require('../config/pepper.php');

class AdminController {

    private $Admin;
    private $params;

    function __construct($params = null) {
        $this->Admin = new admin();
        if($params != null) {
            $this->params = $params;
        }
    }

    // Check for admin connection
    function signIn() {
        $token = "";

        $admin = $this->Admin->getAdminsByUsername($this->params['admin_username']);

        if(!empty($admin)) {

            $admin = $admin[0];
            if(is_a($admin,'admin')) {

                // check password
                $isLogOk = password_verify($this->params['admin_password'],$admin->admin_password);

                if($isLogOk) {

                    // give and authentification token
                    $token = generateToken($admin->admin_id);
                    $cookie = ["token" => $token];

                    // isRoot ? (admin_id = 1, username = klum)
                    if($admin->admin_id == 1) {
                        $cookie["isRoot"] = true;
                    }
                    else {
                        $cookie["isRoot"] = false;
                    }

                    return $cookie;
                }
                else {
                    // unauthorized (wrong password)
                    http_response_code(401);
                }
            }
            else {
            // wrong username (unauthorized)
            http_response_code(401);
            }
        }
        else {
            // wrong username (unauthorized)
            http_response_code(401);
        }
    }

    // Return true if the token is autorised i.e is an admin_id hashed
    function isAlreadyLoggedIn() {
        $res = false;
        $token = $this->params["token"];

        if(!empty($token)){
            $valid = false;
            $allAdmins = $this->Admin->getAllAdmins();
            $i = 0;

            // check if token (id hashed) = admin_id
            while(!$valid && $i < count($allAdmins)) {
                if(password_verify($allAdmins[$i]->admin_id,$token)) {
                    $valid = true;
                }
                $i++;
            } // end loop : token valid or allAdmins browsed entirely

            if(!$valid) {
                // not an admin_id (forbidden)
                http_response_code(403);
            }
        }
        else {
            // no token (forbidden)
            http_response_code(403);
        }
    }


    // Register a new admin
    function insertAdmin() {
        $pswHashed = hashPassword($this->params['admin_password']);
        $usernameUsed = $this->Admin->getAdminsByUsername($this->params['admin_username']);

        if(empty($usernameUsed)) {
            // insertAdmin() set the proper HTTP_response_code
            $insertOk = $this->Admin->insertAdmin($this->params['admin_username'],$pswHashed);
        }
        else {
            // username already used (conflict)
            http_response_code(409);
        }
    }

}
