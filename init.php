<?php
session_start();

global $config;

function __autoload($classe)
{
    include_once 'php/' . $classe . ".php";
}

$system = new SystemIntegration(
    array(
        'clientSecretKey' => '2ab64f0053ff977a9a1093642cd993df',
        'sandbox' => TRUE
    )
);

include_once 'extraconfig.php';
include_once 'php/Tools.php';

define('_PROJECT_', 'http://' . Tools::getHttpHost() . ((Tools::getServerName() == 'localhost') ? '/SERVICOS/ehealthschool/' : '/clientes/ehealthschool/'));
define('_SYSTEM_', 'http://' . Tools::getHttpHost() . ((Tools::getServerName() == 'localhost') ? '/SERVICOS/ehealthschool/system/' : '/clientes/ehealthschool/system/'));
define('_SYSTEM_FILES_', 'http://' . Tools::getHttpHost() . ((Tools::getServerName() == 'localhost') ? '/SERVICOS/ehealthschool/system/files/' : '/clientes/ehealthschool/system/files/'));

$config = array(
    'title' => 'eHealthSchool',
    'description' => '',
    'keywords' => '',
    'rights' => '',
    'menu' => 0,
    'mundipagg' => array(
        'secretKey' => 'sk_test_mKVqy1oSb0tV6qeL:',
        'merchantKey' => 'a6be0823-1992-4a19-979c-43afbaeb09b3',
        'sandbox' => FALSE
    ),
    'eadbox' => array(
        'email' => 'daniel@visanacomunicacao.com.br',
        'password' => 'Bananada@1'
    ),
    'blog' => 'http://localhost/SERVICOS/ehealthschool_blog/'
);

$numberOfPosts = 3;
$feedUrl = $config['blog'] . 'feed/';

$content = file_get_contents($feedUrl);
$rss = new SimpleXmlElement($content);
$count = 0;
$blogData = array();

foreach ($rss->channel->item as $item) {
    if ($count <= 2) {
        $blogData[$count]['pubDate'] = date('d/m/Y H:i', strtotime($item->pubDate));
        $blogData[$count]['title'] = (string)$item->title;
        $blogData[$count]['link'] = (string)$item->link;
        $blogData[$count]['image'] = Tools::xml_attribute($rss->channel->item->enclosure, 'url');

        if (++$count == $numberOfPosts) break;
    }
}
?>