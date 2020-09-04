<?php
//Скрипт створений Костянтином Стадником
//https://github.com/kxnst
//

require_once "TreeNode.php";
    $start = microtime(true);

    $connection = new mysqli("localhost", "root", "", "solomono");
    $query = $connection->query("SELECT * FROM `categories` ORDER BY categories_id");
    $array = [];
    while ($tmp = ($query->fetch_object())) {
        if ($tmp->parent_id == 0) {
            $res = new TreeNode(null, $tmp->categories_id);
            $array[] = $res;
        } else {
            $res = new TreeNode($array[$tmp->parent_id]->getSelf(), $tmp->categories_id);
            $parent = $array[$tmp->parent_id - 1];
            $parent->setChildren($res);
            $array[] = $res;
        }
    }
$nullObject = new TreeNode(null,null);

    for($i = 0;$i<count($array);$i++){
        if($array[$i]->parent!=null)
            $array[$i] = $nullObject;
    }



function printNode($node,$shift=0){
    if(!is_null($node->getChildren())){
        for($i = 0; $i<$shift;$i++){
            echo "-";
        }
        echo $node->getId()."\r\n";
        foreach ($node->getChildren() as $child) {
            printNode($child,($shift+1));
        }
    }
    elseif (is_null($node->getId())){
        return;
    }
    else{
        for($i = 0; $i<$shift;$i++){
            echo "-";
        }
        echo $node->getId()."\r\n";
    }

}
