<<<<<<< HEAD
<?php
//Скрипт створений Костянтином Стадником
//https://github.com/kxnst
//

require_once "TreeNode.php";
$start = microtime(true);

$connection = new mysqli("localhost","root","","solomono");

$query = $connection->query("SELECT * FROM `categories` ORDER BY categories_id");
$array = [];
while ($tmp = ($query->fetch_object())){
    if($tmp->parent_id==0) {
        $res = new TreeNode(null, $tmp->categories_id);
        $array[] = $res;
    }
    else {
        $res = new TreeNode($array[$tmp->parent_id], $tmp->categories_id);
        $parent = $array[$tmp->parent_id-1];
        $parent->setChildren($res);
        $array[] = $res;

    }

}
foreach($array as $node)
    printNode($node);

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
    else{
        for($i = 0; $i<$shift;$i++){
            echo "-";
        }
        echo $node->getId()."\r\n";
    }

}
echo 'Время выполнения скрипта: '.round(microtime(true) - $start, 4).' сек.';
=======
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
        $res = new TreeNode($array[$tmp->parent_id], $tmp->categories_id);
        $parent = $array[$tmp->parent_id - 1];
        $parent->setChildren($res);
        $array[] = $res;
    }
}

$count = count($array);
for($i = 0;$i<$count;$i++){
    if($array[$i]->parent!=null)
        unset($array[$i]);
}
foreach ($array as $node)
    printNode($node);


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
>>>>>>> ba02eda... changes
