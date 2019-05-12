<?php
class VenderLoginModel{
    var $pdo = null;
    var $login = "";
    var $error = "";
    var $email = "";
    var $password = "";
    
    function __construct(){
        $this->connectdb();
    }
    
    function connectdb(){
        $this->pdo = d();
    }
    
    function login_check(){
        #idがセションに記録されている&&最後の行動から1時間以内
        if(isset($_SESSION['vender']['id']) && $_SESSION['vender']['time'] + 3600 > time()){
        //ログインしている
        $_SESSION['vender']['time'] = time();
        return true;
        } else {
        false;
        }
    }
    
    function main(){
        $this->readPost();
        $this->login();
        $this->login_check();
    }
    
    function login(){
        if(!empty($_POST)){
            if($_POST['email'] != '' && $_POST['password'] != ''){
                $sql = 'SELECT * FROM venders WHERE email=? AND password=?';
                $login = $this->pdo->prepare($sql);
                $login->execute(array(
                    $_POST['email'],
                    sha1($_POST['password'])
                ));
                $member = $login->fetch();
                //ログイン成功
                if($member){
                    $_SESSION['vender']['id'] = $member['id'];
                    $_SESSION['vender']['time'] = time();
                    header('Location: ./vender_account.php');
                } else {
                    #ログイン失敗
                    $this->error = 'failed';
                } 
            } else {
                #$_POSTが空白時の処理
                $this->error = 'blank';
            }
        }
    }
    private function readPost(){
        $this->email = $_POST['email'] ?? "";
        $this->password = $_POST['password'] ?? "";   
    }
}