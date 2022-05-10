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
            $id = $_POST['id'];
            $n = $_POST['n'];
            $data_worker = array(
                "firstName" => (string)$_POST['firstName'],
                "middleName" => (string)$_POST['middleName'],
                "lastName" => (string)$_POST['lastName'],
                "email" => (string)$_POST['email'],
                );
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data_worker, JSON_UNESCAPED_UNICODE)); 
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_URL, $url.'/'.$id);
            $response = curl_exec($ch);
            $data = json_decode($response, 1);
            curl_close($ch);
        }
    ?>
    <div>
        <p>Id Работника: <?php echo ($data["id"]);?></p>
        <p>Доступная информация:<br></p>
    <div> Изменения внесены! </div>
        <p>Имя: 
            <input name="firstName" value='<?php echo($data['firstName']) ?>'>
            <br></p>
        <p>Фамилия: 
            <input name="lastName" value='<?php echo($data['lastName']) ?>'>
            <br></p>
        <p>Отчество: 
            <input name="middleName" value='<?php echo($data['middleName']) ?>'>
            <br></p>
        <p>ФИО: 
            <?php echo($data['shortFio']) ?><br></p>
        <p>email: 
            <input name="email" value='<?php echo($data['email']) ?>'>
            <br></p>
        <p>Дата создания: 
            <?php echo($data['created']) ?><br></p>
        <p>Последнее обновление: 
            <?php echo($data['updated']) ?></p></div>
    <div> 
        <form action="Worker_inf.php" method="post">
            <p><input type="hidden" name="n" value="<?php echo ($n + 1);?>"></p>
            <p><input type="hidden" name="login" value="<?php echo base64_encode($login)?>"></p>
            <p><input type="hidden" name="password" value="<?php echo base64_encode($password)?>"></p>
            <button>Назад</button></div>
</BODY>
</HTML>
