<?php
class UserAccountInfoModel{
    public $pdo = null;
    public $id = '';
    
    function __construct(){
        $this->connectdb();
    }
    
    function connectdb(){
        $this->pdo = d();
    }
    
    function login_check(){
        // var_dump($_SESSION);
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
        }
        return 0;
    }

    private function readMember(){
        $members = $this->pdo->prepare('SELECT * FROM members WHERE id=?');
        $members->execute(array($_SESSION['user']['id']));
        $member = $members->fetch();
        $this->id = $_SESSION['user']['id'] ?? "";
        $this->name = $member['name'] ?? "";
        $this->email = $member['email'] ?? "";
        $this->address = $member['address'] ?? "";
        $this->tel = $member['tel'] ?? "";
    }
    
}