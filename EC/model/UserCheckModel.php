<?php
class UserCheckModel{
    public $pdo = null;
    
    function __construct(){
        $this->connectdb();
    }
    
    function connectdb(){
        $this->pdo = d();
    }
    
    function main(){
        $this->check();
        $this->register();
    }
    #セッションに内容確認
    private function check(){
        if(!isset($_SESSION['user'])){
            header('Location:./user_signup.php'); exit();
        }
    }
    function register(){
        if(!empty($_POST)){
            $sql = 'INSERT INTO members SET name=?, email=?, password=?, created=NOW()';
            $stmt = $this->pdo->prepare($sql);
            $res = $stmt->execute(array(
                $_SESSION['user']['name'],
                $_SESSION['user']['email'],
                sha1($_SESSION['user']['password'])
            ));
            #登録後、セッションデータ削除
            unset($_SESSION['user']);
            header('Location: ./user_thanks.php'); exit();
        }
    }
}