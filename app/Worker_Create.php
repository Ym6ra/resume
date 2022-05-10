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
            'Authorization: Basic '.base64_encode("$login:$password")
            );
        $ch = curl_init();
        $data_worker = array(
            "firstName" => (string)$_POST['firstName'],
            "middleName" => (string)$_POST['middleName'],
            "lastName" => (string)$_POST['lastName'],
            "email" => (string)$_POST['email'],
            );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data_worker, JSON_UNESCAPED_UNICODE)); 
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_URL, $url);
        $response = curl_exec($ch);
        $data = json_decode($response, 1);
        curl_close($ch);
        }
        ?>
    <div> Изменения внесены! </div>
    <div> 
        <form action="Worker_List.php" method="post">
            <p><input type="hidden" name="login" value="<?php echo base64_encode($login)?>"></p>
            <p><input type="hidden" name="password" value="<?php echo base64_encode($password)?>"></p>
            <button>Назад</button></div>
<BR><BR>
</FORM>
</BODY>
</HTML>