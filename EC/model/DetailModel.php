<?php
class DetailModel{
    var $login = ""; // ログイン状態管理？
    var $error = ""; // エラー状態？
    var $item = "";
    var $stock = "";
    var $message = "";

    function __construct(){
        // l($_POST);
        $this->connectdb();
    }

    function connectdb(){
        $this->pdo = d();
    }

    function main(){
        # ログイン確認
        # idがセッションに記録されている && 最後の行動から1時間以内
        if (isset($_SESSION['user']['id']) && $_SESSION ['user']['time'] + 3600 > time()) {
            //ログインしている
            $_SESSION['user']['time'] = time();
            $members = $this->pdo->prepare('SELECT * FROM members WHERE id=?');
            $members->execute(array($_SESSION['user']['id']));
            $member = $members->fetch();
        } else {
            //ログインしていない
            $this->login = "unlogin";
        }
        #商品データの呼び出し
        $sql = 'SELECT * FROM items WHERE id=?';
        $items = $this->pdo->prepare($sql);
        $items->execute(array($_REQUEST['id']));
        $this->item = $items->fetch();
        $this->stock = $this->item['stock'];
        
        // POSTされていない場合は処理終了
        if(empty($_POST)) return 1;
        
        // エラーチェック
        $this->error = $this->error_check();
        if($this->error !== "") return 1;

        // カート処理を行う
        $this->cart_func();
        
        // 今すぐ購入するボタンが押された時の処理
        if (!empty($_POST['now'])) {
            // $_SESSION[] = $_POST;
            // $_SESSION[] = $_REQUEST['id'];
            header("Location: comform.php");
        }
    }

    // エラーチェック
    function error_check(){
        // 変数宣言、ならびに初期化
        $error = "";
        
        if ($_POST['p_num'] == '') {
            $error = 'blank';
        } elseif ($_POST['p_num'] <= 0) {
            $error = 'num';
        } elseif ($_POST['p_num'] > $this->item['stock']) {
            $error = 'exceed';
        } elseif ($this->login == "unlogin") {
            $error = 'login';
        }

        // 返却
        return $error;
    }
    
    // エラーチェック結果に基づいて処理を行う
    function cart_func(){
        l("cart_func() start");
        
        // items要素がない場合は配列で初期化
        $_SESSION['items'] = $_SESSION['items'] ?? Array();
        // $_SESSION['items'] = Array();

        $this->message = $this->add_cart();

        // // $_POST['now']がある＝今すぐ買うボタンが押された
        // if (!empty($_POST['now'])) {
        //     $_SESSION[] = $_POST;
        //     $_SESSION[] = $_REQUEST['id'];
        //     header("Location: comform.php");
        //     exit();
        // }

        // // $_POST['cart']がある＝カートに入れるボタンが押された
        // if (!empty($_POST['cart'])) {
        //     $_SESSION['new'][] = $_POST;
        //     header("Location: ./cart/cart.php");
        //     exit();
        // }

    }
    
    // カートへ追加or更新処理
    function add_cart(){
        
        $status = 1; // 1:追加 0:更新
        $cnt = 0;
        $message = "";

        for($i = 0; $i < count($_SESSION['items']); $i++){
            // カートの中に追加したアイテムが存在したら数量を追加
            if($_SESSION['items'][$i]['item_id'] == $_POST["item_id"]){
                $_SESSION['items'][$i]['p_num'] += $_POST["p_num"];
                $cnt = $_SESSION['items'][$i]['p_num'];
                $status = 0;
                $message = "カートを更新しました。現在は". $cnt. "個、入っています";
                break;
            }
        }

        // カートの中にアイテムが無かったらidを追加
        if($status === 1){
            $_SESSION['items'][] = [
                'item_id' => $_POST["item_id"],
                'p_num' => $_POST["p_num"]
            ];
            $cnt = $_POST["p_num"];
            $message = "カートに追加しました。現在は". $cnt. "個、入っています。";
        }

        l($_SESSION);

        return $message;
    }
}