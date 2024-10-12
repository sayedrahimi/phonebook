<?php
    session_start();
    include_once 'db.php';
    class users extends db{

        public function login($data){
            $this->setTbl('user_tbl');
            if($this->searchData('email', $data['email'])){
                $_SESSION['email'] = $data['email'];
                header('location:dashbord.php');
            }else{
                header('location:index.php?login=incorectLogin');
            }
        }

        public function logout(){
            session_destroy();
            header('location:index.php?logout=ok');
        }
    }


?>