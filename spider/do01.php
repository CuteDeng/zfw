<?php
// 设置永不超时
set_time_limit(0);
include __DIR__ . '/function.php';
include __DIR__ . '/vendor/autoload.php';

use QL\QueryList;
//采集文章标题，图片等
try {
    $pdo = new PDO('mysql:host=localhost;dbname=zfw;charset=utf8mb4', 'root', 'root');
} catch (PDOException $exception) {
    exit($exception->getMessage());
}
// 采集页码
$range = range(1, 2);
foreach ($range as $page) {
    // 采集网站的路径
    $url = 'https://news.ke.com/bj/baike/0033/pg' . $page . '/';
    $html = http_request($url);
    // 采集图片，标题等信息
    $datalist = QueryList::Query($html, [
        'pic' => ['.lj-lazy', 'data-original', '', function ($item) {
            // 得到文件的扩展名
            $ext = pathinfo($item, PATHINFO_EXTENSION);
            // 生成文件名
            $filename = md5($item) . '_' . time() . '.' . $ext;
            // 生成本地路径
            $filepath = dirname(__DIR__) . '/public/uploads/article/' . $filename;
            file_put_contents($filepath, http_request($item));
            return '/uploads/article/' . $filename;
        }
        ],
        'title' => ['.item .text .LOGCLICK', 'text'],
        'desc' => ['.item .text .summary', 'text'],
        'url' => ['.item .text > a', 'href'],
    ])->data;
    // 入库
    foreach ($datalist as $val) {
        $sql = "insert into zfw_articles (title,`desc`,pic,url,body) values (?,?,?,?,'')";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$val['title'], $val['desc'], $val['pic'], $val['url']]);
    }
}


