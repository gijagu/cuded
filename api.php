<?php
session_start(); 
$tipo = $_GET['t'];

$url = 'http://aulavirtual.unfv.edu.pe/account/login';

if(!empty($_SESSION['logged_in'])) {
    $user = $_SESSION['user'];
    $password = $_SESSION['pass']; 
    $cursos = $_SESSION['cursos']; 

    // echo "<pre>";
    // echo print_r($_SESSION);
    // echo "</pre>";
}

if($tipo == 'login'){
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
    curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); 
    $result = curl_exec($ch);
    
    preg_match_all('/<input name="__RequestVerificationToken" type="hidden" value="(.*?)" \/><\/form>/', $result, $output_arrayToken);
    $token = $output_arrayToken[1][0];
    
    $data = 'Username='.$user.'&Password='.urlencode($password).'&system_origin=EUD&__RequestVerificationToken='.$token;
    $cabecera = [
        'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3',
        'Accept-Language: es-419,es;q=0.9',
        'Cache-Control: max-age=0',
        'Connection: keep-alive',
        'Content-Type: application/x-www-form-urlencoded',
        'Host: aulavirtual.unfv.edu.pe',
        'Origin: http://aulavirtual.unfv.edu.pe',
        'Referer: http://aulavirtual.unfv.edu.pe/account/login',
        'Upgrade-Insecure-Requests: 1',
        'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36'
    ];
    
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $cabecera);
    curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
    curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); 
    $result = curl_exec($ch);
    
    // curl_setopt($ch, CURLOPT_URL, 'http://aulavirtual.unfv.edu.pe/home/system/change?system=EUD&returnUrl=%2F');
    // curl_setopt($ch, CURLOPT_HTTPHEADER, $cabecera);
    // curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
    // curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); 
    // $result = curl_exec($ch);
    
    curl_setopt($ch, CURLOPT_URL, 'http://aulavirtual.unfv.edu.pe/web/user/info/data');
    curl_setopt($ch, CURLOPT_HTTPHEADER, $cabecera);
    curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
    curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); 
    $result = curl_exec($ch);
    $objAlumno = json_decode($result);
    echo $result;
}else if($tipo == 'cursos'){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
    curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); 
    $result = curl_exec($ch);
    
    preg_match_all('/<input name="__RequestVerificationToken" type="hidden" value="(.*?)" \/><\/form>/', $result, $output_arrayToken);
    $token = $output_arrayToken[1][0];
    
    $data = 'Username='.$user.'&Password='.urlencode($password).'&system_origin=EUD&__RequestVerificationToken='.$token;
    $cabecera = [
        'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3',
        'Accept-Language: es-419,es;q=0.9',
        'Cache-Control: max-age=0',
        'Connection: keep-alive',
        'Content-Type: application/x-www-form-urlencoded',
        'Host: aulavirtual.unfv.edu.pe',
        'Origin: http://aulavirtual.unfv.edu.pe',
        'Referer: http://aulavirtual.unfv.edu.pe/account/login',
        'Upgrade-Insecure-Requests: 1',
        'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36'
    ];
    
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $cabecera);
    curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
    curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); 
    $result = curl_exec($ch);
    
    // curl_setopt($ch, CURLOPT_URL, 'http://aulavirtual.unfv.edu.pe/home/system/change?system=EUD&returnUrl=%2F');
    // curl_setopt($ch, CURLOPT_HTTPHEADER, $cabecera);
    // curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
    // curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); 
    // $result = curl_exec($ch);

    curl_setopt($ch, CURLOPT_URL, 'http://aulavirtual.unfv.edu.pe/web/user/info/system/courseinrole');
    curl_setopt($ch, CURLOPT_HTTPHEADER, $cabecera);
    curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
    curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); 
    $result = curl_exec($ch);
    $objCursos = json_decode($result);
    echo $result;
}else if($tipo == 'tareas'){
    $sectionId = $_POST['sectionId'];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
    curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); 
    $result = curl_exec($ch);
    
    preg_match_all('/<input name="__RequestVerificationToken" type="hidden" value="(.*?)" \/><\/form>/', $result, $output_arrayToken);
    $token = $output_arrayToken[1][0];
    
    $data = 'Username='.$user.'&Password='.urlencode($password).'&system_origin=EUD&__RequestVerificationToken='.$token;
    $cabecera = [
        'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3',
        'Accept-Language: es-419,es;q=0.9',
        'Cache-Control: max-age=0',
        'Connection: keep-alive',
        'Content-Type: application/x-www-form-urlencoded',
        'Host: aulavirtual.unfv.edu.pe',
        'Origin: http://aulavirtual.unfv.edu.pe',
        'Referer: http://aulavirtual.unfv.edu.pe/account/login',
        'Upgrade-Insecure-Requests: 1',
        'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36'
    ];
    
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $cabecera);
    curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
    curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); 
    $result = curl_exec($ch);
    
    // curl_setopt($ch, CURLOPT_URL, 'http://aulavirtual.unfv.edu.pe/home/system/change?system=EUD&returnUrl=%2F');
    // curl_setopt($ch, CURLOPT_HTTPHEADER, $cabecera);
    // curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
    // curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); 
    // $result = curl_exec($ch);

    curl_setopt($ch, CURLOPT_URL, 'http://aulavirtual.unfv.edu.pe/web/homework/listHomeworks?s='.$sectionId);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $cabecera);
    curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
    curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); 
    $result = curl_exec($ch);
    $objTareasCurso = json_decode($result);
    echo $result;
}else if($tipo == 'foros'){
    $sectionId = $_POST['sectionId'];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
    curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); 
    $result = curl_exec($ch);
    
    preg_match_all('/<input name="__RequestVerificationToken" type="hidden" value="(.*?)" \/><\/form>/', $result, $output_arrayToken);
    $token = $output_arrayToken[1][0];
    
    $data = 'Username='.$user.'&Password='.urlencode($password).'&system_origin=EUD&__RequestVerificationToken='.$token;
    $cabecera = [
        'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3',
        'Accept-Language: es-419,es;q=0.9',
        'Cache-Control: max-age=0',
        'Connection: keep-alive',
        'Content-Type: application/x-www-form-urlencoded',
        'Host: aulavirtual.unfv.edu.pe',
        'Origin: http://aulavirtual.unfv.edu.pe',
        'Referer: http://aulavirtual.unfv.edu.pe/account/login',
        'Upgrade-Insecure-Requests: 1',
        'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36'
    ];
    
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $cabecera);
    curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
    curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); 
    $result = curl_exec($ch);
    
    // curl_setopt($ch, CURLOPT_URL, 'http://aulavirtual.unfv.edu.pe/home/system/change?system=EUD&returnUrl=%2F');
    // curl_setopt($ch, CURLOPT_HTTPHEADER, $cabecera);
    // curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
    // curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); 
    // $result = curl_exec($ch);

    curl_setopt($ch, CURLOPT_URL, 'http://aulavirtual.unfv.edu.pe/web/forum/list?s='.$sectionId);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $cabecera);
    curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
    curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); 
    $result = curl_exec($ch);
    $objForosCurso = json_decode($result);
    echo $result;
}else if($tipo == 'videoconferencia'){
    $sectionId = $_POST['sectionId'];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
    curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); 
    $result = curl_exec($ch);
    
    preg_match_all('/<input name="__RequestVerificationToken" type="hidden" value="(.*?)" \/><\/form>/', $result, $output_arrayToken);
    $token = $output_arrayToken[1][0];
    
    $data = 'Username='.$user.'&Password='.urlencode($password).'&system_origin=EUD&__RequestVerificationToken='.$token;
    $cabecera = [
        'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3',
        'Accept-Language: es-419,es;q=0.9',
        'Cache-Control: max-age=0',
        'Connection: keep-alive',
        'Content-Type: application/x-www-form-urlencoded',
        'Host: aulavirtual.unfv.edu.pe',
        'Origin: http://aulavirtual.unfv.edu.pe',
        'Referer: http://aulavirtual.unfv.edu.pe/account/login',
        'Upgrade-Insecure-Requests: 1',
        'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36'
    ];
    
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $cabecera);
    curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
    curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); 
    $result = curl_exec($ch);
    
    // curl_setopt($ch, CURLOPT_URL, 'http://aulavirtual.unfv.edu.pe/home/system/change?system=EUD&returnUrl=%2F');
    // curl_setopt($ch, CURLOPT_HTTPHEADER, $cabecera);
    // curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
    // curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); 
    // $result = curl_exec($ch);

    curl_setopt($ch, CURLOPT_URL, 'http://aulavirtual.unfv.edu.pe/web/conference/list?s='.$sectionId);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $cabecera);
    curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
    curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); 
    $result = curl_exec($ch);
    $objvideoConferenciasCurso = json_decode($result);
    echo $result;
}else{
    echo '<h1>Sapo</h1>';
}

?>