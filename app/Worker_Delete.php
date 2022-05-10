<HTML>
<HEAD>
<TITLE>Мой склад</TITLE>
</HEAD>
<BODY>
    <?php
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $url = ('https://online.moysklad.ru/api/remap/1.2/entity/employee'); 
        $login = base64_decode($_POST['login']);
        $password = base64_decode($_POST['password']);
        $headers = array(
            'Content-Type:application/json',
            'Authorization: Basic '.base64_encode("$login:$password"),
            );
        $id = $_POST['id'];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_URL, $url.'/'.$id);
        $response = curl_exec($ch);
        $data = json_decode($response, 1);
        curl_close($ch);
        }
        ?>
    <div> Работник удален! </div>
    <div> 
        <form action="Worker_List.php" method="post">
            <p><input type="hidden" name="login" value="<?php echo base64_encode($login)?>"></p>
            <p><input type="hidden" name="password" value="<?php echo base64_encode($password)?>"></p>
            <button>Назад</button></div>
<BR><BR>
</FORM>
</BODY>
</HTML>