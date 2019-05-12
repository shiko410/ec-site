<?php
class UserLoginModel{
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
        if(isset($_SESSION['user']['id']) && $_SESSION['user']['time'] + 3600 > time()){
        //ログインしている
        $_SESSION['user']['time'] = time();
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
                $sql = 'SELECT * FROM members WHERE email=? AND password=?';
                $login = $this->pdo->prepare($sql);
                $login->execute(array(
                    $_POST['email'],
                    sha1($_POST['password'])
                ));
                $member = $login->fetch();
                //ログイン成功
                if($member){
                    $_SESSION['user']['id'] = $member['id'];
                    $_SESSION['user']['time'] = time();
                    header('Location: ./index.php');
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