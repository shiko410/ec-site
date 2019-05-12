<?php
class UserAccountModel{
    function __construct(){
        $this->dbconnect();
    }
    
    function dbconnect(){
        $this->pdo = d();
    }
    
    function login_check(){
        #idがセッションに記録されている && 最後の行動から1時間以内
        if (isset($_SESSION['user']['id']) && $_SESSION['user']['time'] + 3600 > time()) {
            //ログインしている
            $_SESSION['user']['time'] = time();
            return true;
        }else{
            return false;
        }
    }
    function main(){
        if($this->login_check()){
            // data取得
            $this->readMember();
        } else {
            header('Location: ./user_login.php');
        }
        return 0;
    }
        private function readMember(){
        $members = $this->pdo->prepare('SELECT * FROM members WHERE id=?');
        $members->execute(array($_SESSION['user']['id']));
        $member = $members->fetch();
        $this->name = $member['name'] ?? "";
    }
}