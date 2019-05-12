<?php
class UserSignUpModel{
    public $pdo = null;
    public $name = '';
    public $email = '';
    public $password = '';
    public $error = array();
    
    function __construct(){
        $this->connectdb();
    }
    
    function connectdb(){
        $this->pdo = d();
    }
    
    function main(){
        $this->signup();   
        $this->post();   
    }
    #(質問)
    #DBにメールアドレスの登録がないか確認する
    // function duplicate(){
    //     $sql = 'SELECT COUNT(*) AS cnt FROM members WHERE email=?';
    //     $member = $this->pdo->prepare($sql);
    //     $member->execute(array($_POST['email']));
    //     $record = $member->fetch();
    //     if($record > 0){
    //         return true;
    //     } else {
    //         return false;
    //     }
        
    // }
    private function signup(){
        if(!empty($_POST)){
            if($_POST['name'] == '') $this->error['name'] = 'blank';
            if ($_POST['email'] == '') {
                $this->error['email'] = 'blank';
            } 
            // elseif($this->duplicate()){
            //     $this->error['email'] = 'duplicate';
            // }
            if ($_POST['password'] == ''){
                $this->error['password'] = 'blank';
            } elseif (strlen($_POST['password']) < 4){
                $this->error['password'] = 'length';
            }
        if(empty($this->error)){
            $_SESSION['user'] = $_POST;
            header('Location: ./user_check.php'); 
            exit();
        }
        }
    }
    #入力エラー時のpostの表示
    private function post(){
        $this->name = $_POST['name'] ?? "";
        $this->email = $_POST['email'] ?? "";
        $this->password = $_POST['password'] ?? "";
    }
}