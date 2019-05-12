<?php
class IndexModel{
    var $items = Array();
    var $name = "";
    var $pdo = null;

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
            $this->readItems();
        }
        return 0;
    }

    private function readMember(){
        $members = $this->pdo->prepare('SELECT * FROM members WHERE id=?');
        $members->execute(array($_SESSION['user']['id']));
        $member = $members->fetch();
        $this->name = $member['name'] ?? "";
    }

    private function readItems(){
        #商品情報の呼び出し
        $sql = 'SELECT * FROM items ORDER BY modified DESC LIMIT 0, 12';
        $this->items = $this->pdo->query($sql);
    }
}