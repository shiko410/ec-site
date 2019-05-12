<?php
class VenderAccountModel{
    function __construct(){
        $this->dbconnect();
    }
    
    function dbconnect(){
        $this->pdo = d();
    }
    
    function login_check(){
        #idがセッションに記録されている && 最後の行動から1時間以内
        if (isset($_SESSION['vender']['id']) && $_SESSION['vender']['time'] + 3600 > time()) {
            //ログインしている
            $_SESSION['vender']['time'] = time();
            return true;
        }else{
            return false;
        }
    }
    function main(){
        if($this->login_check()){
            // data取得
            $this->readVender();
        } else {
            header('Location: ./vender_login.php');
        }
        return 0;
    }
        private function readVender(){
        $venders = $this->pdo->prepare('SELECT * FROM venders WHERE id=?');
        $venders->execute(array($_SESSION['vender']['id']));
        $vender = $venders->fetch();
        $this->name = $vender['name'] ?? "";
    }
}