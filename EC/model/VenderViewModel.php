<?php
class VenderViewModel{
    public $pdo = null;
    public $page = '';
    public $start = '';
    public $item = array();
    
    function __construct(){
        $this->dbconnect();
    }
    
    function dbconnect(){
        $this->pdo = d();
    }
    
    function main(){
        $this->login_check();
        $this->paging();
    }
    #ログイン確認
    function login_check(){
               #idがセションに記録されている&&最後の行動から1時間以内
        if(isset($_SESSION['vender']['id']) && $_SESSION['vender']['time'] + 3600 > time()){
            //ログインしている
            $_SESSION['vender']['time'] = time();
            return true;
        } else{
            return false;
        }
    }
    
    function paging(){
        $this->page = $_REQUEST['page'] ?? (INT)'1';
        $this->start = 5 * ($this->page -1);
        #商品内容を取得
        if(isset($this->page)){
            $sql = 'SELECT v.name, i.* FROM venders v, items i WHERE v.id=i.vender_id ORDER BY i.modified DESC LIMIT ?,5';
            $items = $this->pdo->prepare($sql);
            $items->bindParam(1, $this->start, PDO::PARAM_INT);
            $this->item = $items->execute();
        } else {
            //$pageに値がなければ0を代入して表示
            $sql = 'SELECT v.name, i.* FROM venders v, items i WHERE v.id=i.vender_id ORDER BY i.modified DESC LIMIT 0, 5';
        	$this->item = $this->pdo->query($sql);
        }
    }
    
    function max_page(){
        $counts = $this->pdo->query('SELECT COUNT(*) AS cnt FROM items');
		$count = $counts->fetch();
		$max_page = floor($count['cnt'] / 5) + 1;
		if($this->page < $max_page){
		    return true;
		}
		return false;
    }
}