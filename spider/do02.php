<?php
// 设置永不超时
set_time_limit(0);
include __DIR__ . '/function.php';
include __DIR__ . '/vendor/autoload.php';

use QL\QueryList;

//采集文章内容
try {
    $pdo = new PDO('mysql:host=localhost;dbname=zfw;charset=utf8mb4', 'root', 'root');
} catch (PDOException $exception) {
    exit($exception->getMessage());
}
$sql = "select id,url from zfw_articles where body = ''";
$rows = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
foreach ($rows as $row) {
    $url = $row['url'];
    $id = $row['id'];
    $html = http_request($url);
    $ret = QueryList::Query($html, [
        'body' => ['.bd', 'html'],
    ])->data;
    $body = $ret[0]['body'];
    // 入库
    $sql = "update zfw_articles set body = ? where id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$body, $id]);
}


