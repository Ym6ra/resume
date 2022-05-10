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
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_URL, $url);
        $response = curl_exec($ch);
        $data = json_decode($response, 1);
        curl_close($ch);
        $n = $_POST['n'] - 1;

        }?>
    <div>
        <p>Id Работника: 
            <?php echo ($data["rows"][$n]["id"]);?></p>
        <p>Доступная информация:<br></p>
            <form name="update" action="worker_update.php" method="post"> 
                <p><input type="hidden" name="n" value="<?php echo $n ?>"></p>
                <p><input type="hidden" name="id" value="<?php echo $data['rows'][$n]['id']?>"></p>
                <p><input type="hidden" name="login" value="<?php echo base64_encode($login)?>"></p>
                <p><input type="hidden" name="password" value="<?php echo base64_encode($password)?>"></p>                
                <button>Изменить</button>
                <p>Имя: 
                    <input name="firstName" value='<?php echo($data["rows"][$n]['firstName']) ?>'>
                    <br></p>
                <p>Фамилия: 
                    <input name="lastName" value='<?php echo($data["rows"][$n]['lastName']) ?>'>
                    <br></p>
                <p>Отчество: 
                    <input name="middleName" value='<?php echo($data["rows"][$n]['middleName']) ?>'>
                    <br></p>
                <p>ФИО: 
                    <?php echo($data["rows"][$n]['shortFio']) ?><br></p>
                <p>email: 
                    <input name="email" value='<?php echo($data["rows"][$n]['email']) ?>'>
                    <br></p>
                <p>Дата создания: 
                    <?php echo($data["rows"][$n]['created']) ?><br></p>
                <p>Последнее обновление: 
                    <?php echo($data["rows"][$n]['updated']) ?></p></form>
    <div> 
        <form action="Worker_Delete.php" method="post">
            <p><input type="hidden" name="id" value="<?php echo ($data["rows"][$n]['id'])?>"></p>
            <p><input type="hidden" name="login" value="<?php echo base64_encode($login)?>"></p>
            <p><input type="hidden" name="password" value="<?php echo base64_encode($password)?>"></p>
            <button>Удалить</button></form></div>
    <div> 
        <form action="Worker_List.php" method="post">
            <p><input type="hidden" name="login" value="<?php echo base64_encode($login)?>"></p>
            <p><input type="hidden" name="password" value="<?php echo base64_encode($password)?>"></p>
            <button>Назад</button></form></div>
</BODY>
</HTML>