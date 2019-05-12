<?php
class InquiryModel{
    var $pdo = null;
    var $login = ""; //ログイン状態管理
    var $error = ""; //エラー状態管理
    var $name = "";
    var $email = "";
    var $tel = "";
    var $message = "";
    var $member = "";
    
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
        } else{
            return false;
        }
    }
    
    function main(){
        if ($this->login_check()){
            //data取得
            $this->readMember();
            $this->readMessage();
        }
        return 0;
    }
    
    private function readMember(){
        $members = $this->pdo->prepare('SELECT * FROM members WHERE id=?');
        $members->execute(array($_SESSION['user']['id']));
        $this->member = $members->fetch();
        $this->name = $this->member['name'] ?? "";
        $this->email = $this->member['email'] ?? "";
        $this->tel = $this->member['tel'] ?? "";
    }
     
    private function readMessage(){  
        #エラーメッセージの表示
        if(isset($_POST['confirm'])){
            $error_flg = false;
            //名前の必須入力チェック
            if($_POST['name'] === ''){
                $this->message .= "お名前は必ず入力してください<br>";
                $error_flg = true;
            }
            elseif($_POST['mail'] === ''){
                $this->message = "メールアドレスは必ず入力してください<br>";
                $error_flg = true;
            }
            //エラーがなければ入力内容をセッションに保存して確認画面へ
            if(!$error_flg){
                $_SESSION['inquiry'] = $_POST;
                header('Location: ./confirm.php');
                exit();
            }
        }
        #書き直し
        if(isset($_REQUEST['action']) && $_REQUEST['action'] === 'rewite'){
            $_POST = $_SESSION['inquiry'];
        }
        #メモ(不要？)
        // $uer_id = $_SESSION['user']['id'] ?? "";
        // $stmt = $pdo->prepare('SELECT * FROM members WHERE id=?');
        // $stmt->execute(array($uer_id));
        // $member = $stmt->fetch();
    }
} 