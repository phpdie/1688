```php
require_once __DIR__ . '/vendor/autoload.php';

$client = new \Notify\DingDing('你的机器人webhook地址');

/*
$text = 'hello靓仔';
$result = $client->sendText($text);
print_r($result);
*/

/*
$title = '你好靓仔';
$text = 'hello靓仔';
$picUrl = 'https://www.baidu.com/img/flexible/logo/pc/result.png';
$messageUrl = 'https://www.baidu.com/';
$result = $client->sendLink($title, $text, $picUrl, $messageUrl);
print_r($result);
*/

/*
$title = '杭州天气';
$text = "#### 杭州天气\n > 9度，西北风1级，空气良89，相对温度73%\n > ![screenshot](https://img.alicdn.com/tfs/TB1NwmBEL9TBuNjy1zbXXXpepXa-2400-1218.png)\n > ###### 10点20分发布 [天气](https://www.dingtalk.com) \n";
$result = $client->sendMarkdown($title,$text);
print_r($result);
*/

/*
$title = '乔布斯 20 年前想打造一间苹果咖啡厅，而它正是 Apple Store 的前身';
$text = "![screenshot](https://gw.alicdn.com/tfs/TB1ut3xxbsrBKNjSZFpXXcXhFXa-846-786.png)
 ### 乔布斯 20 年前想打造的苹果咖啡厅 
 Apple Store 的设计正从原来满满的科技感走向生活化，而其生活化的走向其实可以追溯到 20 年前苹果一个建立咖啡馆的计划";
$singleTitle = "阅读全文";
$singleURL = "https://www.dingtalk.com/";
$result = $client->sendActionCardSingle($title,$text,$singleTitle,$singleURL);
print_r($result);
*/

/*
$btn1['title'] = '百度1';
$btn1['actionURL'] = 'https://www.baidu.com';

$btn2['title'] = '百度2';
$btn2['actionURL'] = 'https://www.baidu.com';

$title = '乔布斯 20 年前想打造一间苹果咖啡厅，而它正是 Apple Store 的前身';
$text = "![screenshot](https://gw.alicdn.com/tfs/TB1ut3xxbsrBKNjSZFpXXcXhFXa-846-786.png)
 ### 乔布斯 20 年前想打造的苹果咖啡厅 
 Apple Store 的设计正从原来满满的科技感走向生活化，而其生活化的走向其实可以追溯到 20 年前苹果一个建立咖啡馆的计划";
$btnOrientation = 0;//0：按钮竖直排列  1：按钮横向排列
$btns = [(object)$btn1, (object)$btn2];
$result = $client->sendActionCardMulti($title, $text, $btnOrientation, $btns);
print_r($result);
*/

/*
$link1['title'] = '百度1';
$link1['messageURL'] = 'https://www.baidu.com';
$link1['picURL'] = 'https://www.baidu.com/img/flexible/logo/pc/result.png';

$link2['title'] = '百度2';
$link2['messageURL'] = 'https://www.baidu.com';
$link2['picURL'] = 'https://www.baidu.com/img/flexible/logo/pc/result.png';

$links = [(object)$link1, (object)$link2];
$result = $client->sendFeedCard($links);
print_r($result);
*/