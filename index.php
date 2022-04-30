<?php
$uri = $_SERVER['REQUEST_URI'];
switch ($uri){
case '/logout?':
    {
    setcookie('loginName', '', time() - 3600, '/');
    $new_url = 'http://dvfu.ga';
    header('Location: '.$new_url); 
    break;
    }
case '/logout':
    {
    setcookie('loginName', '', time() - 3600, '/');
    $new_url = 'http://dvfu.ga';
    header('Location: '.$new_url); 
    break;
    }    
case '/send':
    {
    include('fet.php');
    break;
    }
}
if (isset($_GET['loginName'])&&isset($_GET['password'])) {
    if($_GET['loginName']=='Fedot'&&$_GET['password']=='Fet')
    ||
    ($_GET['loginName']=='Brat'&&$_GET['password']=='Dva'){
        setcookie('loginName', $_GET['loginName']);
        setcookie('Authorized', 1);
        $new_url = 'http://dvfu.ga';
        header('Location: '.$new_url);
    } else {
        ?>
        Неверный пароль или логин!
        <?php
    }
}
if (!isset($_COOKIE['loginName'])):
?>
<form action="/" method="GET">
    <input placeholder="Логин" name="loginName">
    <input placeholder="Пароль" name="password">
    <input type="submit" value="Войти под этим логином">
</form>
<?php else:?>
<h1>Вы <?php echo($_COOKIE['loginName']);?>
</h1>
<form action="/logout" method="GET">
<input type="submit" value="Выйти">
</form>
<form action="/send" method="GET">
<input placeholder="Сообщение" name="message">
<input type="submit" value="Отправить">
</form>
<?php
?>
<?php endif;
if(isset($_GET['message'])){
    include('fet.php');
}
$file = fopen('db_chat.json', 'a+');
$content = file_get_contents('db_chat.json');
$contentArray = json_decode($content);
foreach($contentArray->messages as $message){
    echo("$message->date: $message->text ($message->from) </br>");
}
?>


