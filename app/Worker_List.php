<HTML>
<HEAD>
<TITLE>Мой склад</TITLE>
</HEAD>
<BODY>
    <?php
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $url = ('https://online.moysklad.ru/api/remap/1.2/entity/employee'); 
            if(is_null($_POST['loginde'])){
                $login = base64_decode($_POST['login']);}
            else($login = ($_POST['loginde']));
            if(is_null($_POST['passwordde'])){
                $password = base64_decode($_POST['password']);}
            else($password = ($_POST['passwordde']));
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
            $n = count($data["rows"]);
        }
    ?>
    <div> Id Аккаунта: 
        <?php echo ($data["rows"][0]["accountId"]);?> </div>
    <div> Количество работников:  
        <?php echo $n; ?> </div>
    <div>
        <form name="search" action="worker_inf.php" method="post">
            <p>Доступная информация по работнику №<input name="n" leight="2" value="1"></p>
            <p><input type="hidden" name="login" value="<?php echo base64_encode($login)?>"></p>
            <p><input type="hidden" name="password" value="<?php echo base64_encode($password)?>"></p>
            <button>Поиск</button></form></div>
    <div> 
        <p>Создать нового работника </p>
            <form name="create" action="Worker_Create.php" method="post">
                <p><input type="hidden" name="login" value="<?php echo base64_encode($login)?>"></p>
                <p><input type="hidden" name="password" value="<?php echo base64_encode($password)?>"></p>
                <p>Имя: 
                    <input name="firstName" value='Введите имя'>
                    <br></p>
                <p>Фамилия: 
                    <input name="lastName" value='Введите фамилию'>
                    <br></p>
                <p>Отчество: 
                    <input name="middleName" value='Введите отчество'>
                    <br></p>
                <p>email: 
                    <input name="email" value='Введите email'>
                    <br></p>
                <button>Создать</button></form></div>
</BODY>
</HTML>
