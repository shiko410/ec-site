<?php
class VenderItemPost{
    public $pdo = null;
    public $error = array();
    public $name = "";
    public $item = "";
    public $price = "";
    public $stock = "";
    public $info = "";
    
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
        return false;
        }
    }
    
    function main(){
        $this->readVender();
        $this->readPost();
        $this->itemPost();
        $this->login_check();
    }
    
    function readVender(){
        $sql = 'SELECT * FROM venders WHERE id=?';
        $venders = $this->pdo->prepare($sql);
        $venders->execute(array($_SESSION['vender']['id']));
        $vender = $venders->fetch();
        $this->name = $vender['name'];
    }
    
    private function readPost(){
        $this->email = $_POST['email'] ?? "";
        $this->item = $_POST['item'] ?? "";   
        $this->price = $_POST['price'] ?? "";   
        $this->stock = $_POST['stock'] ?? "";   
        $this->info = $_POST['info'] ?? "";   
    }
    #投稿を記録する
    function itemPost(){
        if(!empty($_POST)) {  #登録ボタンがクリックされたら以下を実行
            if($this->item == '') $this->error['item'] = 'blank';
            if($this->price == '') {
                $this->error['price'] = 'blank';
            } elseif (!is_numeric($this->price)){
                $this->error['price'] = 'num';
            }
            if($this->stock == '') {
                $this->error['stock'] = 'blank';
            } elseif (!is_numeric($this->stock)){
                $this->error['stock'] = 'num';
            }
            if($this->info == '') $this->error['info'] = 'blank';
            if(empty($this->error)){
                if ($_POST['info'] != '') {
                    $sql = 'INSERT INTO items SET vender_id=?, item=?, price=?, stock=?, info=?, created=NOW()';
    		        $info = $this->pdo->prepare($sql);
    		        $info->execute(array(
    			        $_SESSION['vender']['id'],
    			        $this->item,
                        $this->price,
    			        $this->stock,
    			        $this->info
    		        ));
                    header('Location: vender_account.php'); exit();
                }
            }
        }
    }
}