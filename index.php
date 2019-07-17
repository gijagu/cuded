<?php 


session_start(); 

$msg = '';

$plataforma = false;
      



    if (!empty($_POST['user']) && !empty($_POST['pass'])) {


        $url = 'http://aulavirtual.unfv.edu.pe/account/login';
        $user = $_POST['user'];
        $password = $_POST['pass'];

        date_default_timezone_set('america/lima');
        // echo date('l jS \of F Y h:i:s A');
        // echo '<br>';
        
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


        
        curl_setopt($ch, CURLOPT_URL, 'http://aulavirtual.unfv.edu.pe/home/system/change?system=EUD&returnUrl=%2F');
        curl_setopt($ch, CURLOPT_HTTPHEADER, $cabecera);
        curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
        curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); 
        $result = curl_exec($ch);
        



        //http://aulavirtual.unfv.edu.pe/web/homework?s=83ed552d-a7ef-4149-aefa-08d6d99c38ba
        curl_setopt($ch, CURLOPT_URL, 'http://aulavirtual.unfv.edu.pe/web/user/info/data');
        curl_setopt($ch, CURLOPT_HTTPHEADER, $cabecera);
        curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
        curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); 
        $result = curl_exec($ch);
        $objAlumno = json_decode($result);

      


        
        if(isset($objAlumno)) {


            curl_setopt($ch, CURLOPT_URL, 'http://aulavirtual.unfv.edu.pe/web/user/info/system/courseinrole');
            curl_setopt($ch, CURLOPT_HTTPHEADER, $cabecera);
            curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
            curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); 
            $result = curl_exec($ch);
            $objCursos = json_decode($result);

            // echo "<pre>";
            // print_r($objCursos);
            // echo "</pre>";

            

            $_SESSION['logged_in'] = true;
            $_SESSION['timeout'] = time();
            $_SESSION['user'] = $_POST['user'];
            $_SESSION['pass'] = $_POST['pass'];

            $_SESSION['alumno']= $objAlumno;
            $_SESSION['cursos']= $objCursos;
            $msg = "usuario registrado";



            $objTareasPorCurso = new stdClass();
                

                
                    
                function get_format($df) {
                
                    $str = '';
                    $str .= ($df->invert == 1) ? ' - ' : '';
                    if ($df->y > 0) {
                        // years
                        $str .= ($df->y > 1) ? $df->y . ' Años ' : $df->y . ' año ';
                    } if ($df->m > 0) {
                        // month
                        $str .= ($df->m > 1) ? $df->m . ' Meses ' : $df->m . ' Mes ';
                    } if ($df->d > 0) {
                        // days
                        $str .= ($df->d > 1) ? $df->d . ' Dias ' : $df->d . ' Dia ';
                    } if ($df->h > 0) {
                        // hours
                        $str .= ($df->h > 1) ? $df->h . ' Horas ' : $df->h . ' Hora ';
                    } if ($df->i > 0) {
                        // minutes
                        $str .= ($df->i > 1) ? $df->i . ' Minutos ' : $df->i . ' Minuto ';
                    } if ($df->s > 0) {
                        // seconds
                        $str .= ($df->s > 1) ? $df->s . ' Segundos ' : $df->s . ' Segundo ';
                    }
                
                    // echo $str;
                }
                

                $plataforma = true;





        } else {
            $msg = "usuario no existe";
        }







    } else {
        $msg = 'Ingrese usuario y contraseña';
    }


?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="main.css?v=<?php echo(rand()); ?>">
    </head>
    <body>
        <div class="h-100">

            <?php 


                if(!empty($_SESSION['logged_in'])) { ?>

                    




                        <div id="app-container" class="menu-default menu-sub-hidden menu-mobile">  
                            <main>
                                <div class="container-fluid">
                                    <div>  
                                        <div class="row">
                                            <div class="col col-12">
                                                <div class="card mb-4 d-flex flex-row  align-items-center">                                   
                                                        <a href="/app/ui/cards" class="d-flex router-link-exact-active active"><img src="<?php echo $_SESSION['alumno'] ->image;?>" alt="Card image cap" class="img-thumbnail list-thumbnail  rounded-circle align-self-center m-4 small"></a>
                                                        <div class=" d-flex flex-grow-1 min-width-zero">
                                                            <div class=" pl-0 align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero">
                                                                <div class="min-width-zero"><a href="/app/ui/cards" class="router-link-exact-active active"><h6 class="mb-1 card-subtitle truncate"><?php echo $_SESSION['alumno'] ->name;?></h6></a>
                                                                    <p class="text-muted text-small mb-2"><?php echo date('l jS \of F Y h:i:s A'); ?></p>
                                                                </div>
                                                            </div>
                                                        </div> 

                                                        <div class="position-relative d-lg-inline-block"><a target="_top" href="/cuded/logout.php" class="btn btn-outline-primary btn-sm ml-2">Salir</a></div>                                           
                                                    </div>
                                                </div>
                                            </div>

                                            <ul class="nav nav-tabs mt-4" id="myTab" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" id="tareas-tab" data-toggle="tab" href="#tareas" role="tab" aria-controls="tareas" aria-selected="true">Tareas</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="foros-tab" data-toggle="tab" href="#foros" role="tab" aria-controls="foros" aria-selected="false">Foros</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="videos-tab" data-toggle="tab" href="#videos" role="tab" aria-controls="videos" aria-selected="false">Videoconferencia</a>
                                                </li>
                                
                                            </ul>
                                            <div class="tab-content" id="myTabContent">

                                                
                                                    <div class="tab-pane fade show active" id="tareas" role="tabpanel" aria-labelledby="tareas-tab">                                   <ul class="list-unstyled my-4">
                                                                <div role="radiogroup" tabindex="-1" class="pt-2 d-flex justify-content-around" id="items_tareas">
                                                                    <div class="custom-control custom-radio">
                                                                        <input type="radio" autocomplete="off" class="custom-control-input" value="Flexbox" id="tareas_todos" name="tareas_todos">
                                                                        <label class="custom-control-label" for="tareas_todos"><span>Todos</span></label>
                                                                    </div>
                                                                    <div class="custom-control custom-radio">
                                                                        <input type="radio" autocomplete="off" class="custom-control-input" value="Sass" id="tareas_pendientes" name="tareas_pendientes">
                                                                        <label class="custom-control-label" for="tareas_pendientes"><span>Pendientes</span></label>
                                                                    </div>
                                                                    <div class="custom-control custom-radio">
                                                                        <input type="radio" autocomplete="off" class="custom-control-input" value="Vue" id="tareas_vencidos" name="tareas_vencidos">
                                                                        <label class="custom-control-label" for="tareas_vencidos"><span>Vencidos</span></label>
                                                                    </div>                                                     
                                                                </div>
                                                            </ul>
                                                        <?php    


                                                                // curl_setopt($ch, CURLOPT_URL, 'http://aulavirtual.unfv.edu.pe/web/homework/listbysection?s='.$sectionId);
                                                                // curl_setopt($ch, CURLOPT_HTTPHEADER, $cabecera);
                                                                // curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
                                                                // curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
                                                                // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                                                // curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                                                                // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                                                                // $result = curl_exec($ch);
                                                                // $objNotaTareaCurso = json_decode($result);


                                                                // echo '<pre>';
                                                                // print_r($objNotaTareaCurso);
                                                                // echo '</pre>';
                                                        ?>
                                                        <div id="inner-tareas">
                                                        </div>
                                                        <div id="loader" class="lds-css ng-scope">
                                                            <div style="width:100%;height:100%" class="lds-ellipsis"><div><div></div></div><div><div></div></div><div><div></div></div><div><div></div></div><div><div></div></div></div>
                                                        </div>

                                                    </div>
                                               
                                                    <?php /** 
                                                    <div class="tab-pane fade" id="foros" role="tabpanel" aria-labelledby="foros-tab">
                                                        
                                                            <?php 
                                                            
                                                            for ($n = 0; $n <= count($objCursos); $n++) {

                                                                $sectionId = $objCursos[$n]->sectionId;
                                                                $nombreCurso = $objCursos[$n]->name;
                                                                curl_setopt($ch, CURLOPT_URL, 'http://aulavirtual.unfv.edu.pe/web/forum/list?s='.$sectionId);
                                                                curl_setopt($ch, CURLOPT_HTTPHEADER, $cabecera);
                                                                curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
                                                                curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
                                                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                                                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                                                                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                                                                $result = curl_exec($ch);
                                                                $objForosCurso = json_decode($result);

                                                            

                                                                curl_setopt($ch, CURLOPT_URL, 'http://aulavirtual.unfv.edu.pe/web/Qualification/listForums?o=true&s='.$sectionId);
                                                                curl_setopt($ch, CURLOPT_HTTPHEADER, $cabecera);
                                                                curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
                                                                curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
                                                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                                                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                                                                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                                                                $result = curl_exec($ch);
                                                                $objEstadoNotaForoCurso = json_decode($result);


                                                                // echo '<pre>';
                                                                // print_r($objEstadoNotaForoCurso);
                                                                // echo '</pre>';
                                                                
                                                            

                                                                ?>
                                                                <div class="row survey-app">
                                                                    <div class="col col-12">
                                                                
                                                                        <div class="mb-2 pt-4"><h3><?php echo $nombreCurso; ?></h3></div>
                                                                        
                                                                        <div class="separator mb-4"></div>

                                                                        <?php
                                                                        
                                                                            for ($r = 0; $r < count($objForosCurso); $r++) { 
                                                                                ?> 


                                                                                <div class="row">
                                                                                    <div class="col col-12">
                                                                                        <div class="card d-flex mb-3 active">
                                                                                            
                                                                                            <div class="d-flex flex-grow-1 min-width-zero">
                                                                                                <div class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center pb-2">
                                                                                                    <a  class="list-item-heading mb-0 truncate w-40 w-xs-100  mb-1 mt-1"><i class="heading-icon simple-icon-refresh"></i> <span class="align-middle d-inline-block color-theme-1"><?php echo $objForosCurso[$r]->unidadName; ?> </span></a>
                                                                                                    <p class="mb-1 text-muted text-small w-15 w-xs-100">Fecha de inicio: <br><?php echo $objForosCurso[$r]->dateBegin; ?></p>
                                                                                                    <p class="mb-1 text-muted text-small w-15 w-xs-100">Fecha de cierre: <br><?php echo $objForosCurso[$r]->dateEnd; ?></p>

                                                                                                    <div class="w-15 w-xs-100">                                                                                            
                                                                                                        <?php     if( empty($objForosCurso[$r]->state)) { 
                                                                                                            echo '<span class="badge badge-light badge-pill">Vencido</span>'; 


                                                                                                            
                                                                                                        } else { 
                                                                                                            echo '<span class="badge badge-primary badge-pill">Pendiente</span>'; 

                                                                                                        }; 
                                                                                                        ?>
                                                                                                    </div>
                                                                                                
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="card-body pt-1">
                                                                                                <p class="mb-0"><?php echo $objForosCurso[$r]->name; ?></p>
                                                                                                <p><div role="alert" aria-live="polite" aria-atomic="true" class="rounded alert alert-primary">Estado: <?php echo $objEstadoNotaForoCurso[$r]->state; ?> | Nota: <?php echo $objEstadoNotaForoCurso[$r]->qualification; ?> </div></p>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                </div>

                                                                        <?php   } ?> 

                                                                    </div>
                                                                </div>
                                                                <?php 
                                                                }
                                                            ?>
                                                    </div>
                                                    <div class="tab-pane fade" id="videos" role="tabpanel" aria-labelledby="videos-tab">
                                                        
                                                                <?php

                                                                    for ($j = 0; $j <= count($objCursos); $j++) {
                                                                        $sectionId = $objCursos[$j]->sectionId;
                                                                        $nombreCurso = $objCursos[$j]->name;
                                                                        curl_setopt($ch, CURLOPT_URL, 'http://aulavirtual.unfv.edu.pe/web/conference/list?s='.$sectionId);
                                                                        curl_setopt($ch, CURLOPT_HTTPHEADER, $cabecera);
                                                                        curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
                                                                        curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
                                                                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                                                        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                                                                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                                                                        $result = curl_exec($ch);
                                                                        $objvideoConferenciasCurso = json_decode($result);
                                                                        
                                                                        // echo '<pre>';
                                                                        // print_r($objvideoConferenciasCurso);
                                                                        // echo '</pre>';
                                                                        


                                                                        ?>
                                                                        <div class="row survey-app">
                                                                            <div class="col col-12">
                                                                        
                                                                                <div class="mb-2 pt-4"><h3><?php echo $nombreCurso; ?></h3></div>
                                                                                
                                                                                <div class="separator mb-4"></div>
                    
                                                                                <?php
                                                                                
                                                                                    for ($i = 0; $i < count($objvideoConferenciasCurso); $i++) { 
                                                                                        ?> 
                    
                    
                                                                                        <div class="row">
                                                                                            <div class="col col-12">
                                                                                                <div class="card d-flex mb-3 active">
                                                                                                    
                                                                                                    <div class="d-flex flex-grow-1 min-width-zero">
                                                                                                        <div class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center pb-2">
                                                                                                            <a  class="list-item-heading mb-0 truncate w-40 w-xs-100  mb-1 mt-1"><i class="heading-icon simple-icon-refresh"></i> <span class="align-middle d-inline-block color-theme-1"><?php echo $objvideoConferenciasCurso[$i]->title; ?> </span></a>
                                                                                                            <p class="mb-1 text-muted text-small w-15 w-xs-100">Fecha y hora de inicio: <br><?php echo $objvideoConferenciasCurso[$i]->startTime; ?></p>
                                                                                                            
                                                                                                            <div class="w-15 w-xs-100"><span class="badge badge-primary badge-pill">
                                                                                                            <?php echo $objvideoConferenciasCurso[$i]->state; ?>
                                                                                                            
                                                                                                            </span>
                                                                                                        </div>





                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="card-body pt-1">
                                                                                                        <p class="mb-0">
                                                                                                            <a href="<?php echo $objvideoConferenciasCurso[$i]->recordUrl; ?>" target="_blank">Ver grabación</a></p>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                    
                                                                                        </div>
                    
                                                                                <?php   } ?> 
                    
                                                                            </div>
                                                                        </div>
                                                            <?php  }?>
                                                    </div>
                                                */ ?>
                                                    
                                            </div>
                                    </div>
                                </div>
                            </main>
                        </div>


            <?php  } else { ?>
                    <div id="root">
                        <div class="fixed-background"></div>
                        <main>
                            <div class="container">
                                <div class="row h-100">
                                    <div class="mx-auto my-auto col-md-6 col-12">
                                        <div class="card auth-card">

                                     
                                            <div class="form-side">
                                                <a href="/" class="active" style="display: block;width: 150px;margin: 0 auto 30px auto;">
                                                    <img src="http://cuded.unfv.edu.pe/Fotos/logo2.png" alt="" style="display: block;max-width: 100%;">
                                                <!-- <span class="logo-single"></span> -->
                                                </a>
                                                    <h6 class="mb-4">Aula Virtual de Pregrado </h6>
                                                    <p><?php echo $msg; ?></p>
                                                    <form class="" method="post" action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
                                                        <label class="form-group has-float-label mb-4">
                                                            <input type="text" class="form-control" name="user"> <span>Usuario</span></label>
                                                        <label class="form-group has-float-label mb-4">
                                                            <input type="password" class="form-control" name="pass"> <span>Contraseña</span></label>
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <button id="btn_login" type="input" class="btn btn-shadow btn-primary btn-lg" name="login">Ver Pendientes</button>
                                                            <!-- <input type="submit" class="btn btn-shadow btn-primary btn-lg" value="Ver Pendientes" name="login"> -->
                                                        </div>
                                                    </form>
                                            </div>
                             
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </main>
                    </div>
            <?php  }  ?>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

                <script>


                $(document).ready(function(){ 

                    <?php  if(!empty($_SESSION['logged_in'])) { ?>                     
          
                        var counter=0;
                        // $('#tareas').html("cargando ajax");
                        


                        function recursively_ajax() {

                            var pass_data=5;
                            let $html = '';
                            
                            var cursos = [<?php                           
                            for ($i=0; $i < count($_SESSION['cursos']); $i++) {                             
                                    echo '["'.$_SESSION['cursos'][$i]->sectionId.'",';
                                    echo '"'.$_SESSION['cursos'][$i]->name.'"] ,';                        
                                }
                            ?> ];


                            
                            $.ajax({
                                    type:"POST",
                                    async:false, // set async false to wait for previous response
                                    url: "http://localhost:8080/cuded/api.php?t=tareas",
                                    dataType:"json",
                                    data: {  sectionId:  cursos[counter][0] },
                                    success: function(data){

                                        $html += '<div class="row survey-app"><div class="col col-12">';
                                        $html += '<div class="mb-2 pt-4"><h3>'+cursos[counter][1]+'</h3></div>';//name course
                                        $html += '<div class="separator mb-4"></div>';


                                        for (let index = data.length ; 0 < index; index--) {
                                                const element = data[index-1];
                                                let state_t;

                                                element.state =="INA" ? state_t = "t_vencido" : state_t = "t_pendiente";

                                                $html += '<div class="row task '+state_t+'"><div class="col col-12"><div class="card d-flex mb-3 active">'

                                                    $html += '<div class="d-flex flex-grow-1 min-width-zero"><div class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center pb-2">';

                                                        $html += '<a  class="list-item-heading mb-0 truncate w-40 w-xs-100  mb-1 mt-1"><i class="heading-icon simple-icon-refresh"></i> <span class="align-middle d-inline-block color-theme-1">'+ element.title+'</span></a>';
                                                        $html += '<p class="mb-1 text-muted text-small w-15 w-xs-100">Fecha de inicio: <br>'+ element.dateBegin+'</p>';
                                                        $html += '<p class="mb-1 text-muted text-small w-15 w-xs-100">Fecha de cierre: <br>'+ element.dateEnd+'</p>';


                                                            $html += '<div class="w-15 w-xs-100">';
                                                                
                                                                if(element.state =="INA"){
                                                                    $html += '<span class="badge badge-light badge-pill">Vencido</span>';

                                                                } else {
                                                                    $html += '<span class="badge badge-primary badge-pill">Pendiente</span>';
                                                                }
                                                            

                                                            $html += '</div>';

                                                    $html += '</div></div>';

                                                    $html += '<div class="card-body pt-1">';
            
                                                        $html += '<p class="mb-0">'+ element.content+'</p>';

                                                        $html += '<p><div role="alert" aria-live="polite" aria-atomic="true" class="rounded alert alert-primary">';
                                                            
                                                
                                                        
                                                        <?php /*
                                                        if(count($objNotaTareaCurso[$j]->homeworkstds) > 0) { ?>                                      
                                                            Nota: <?php   echo $objNotaTareaCurso[$j]->homeworkstds[0]->score;   
                                                        } else {
                                                            echo "Nota: ";
                                                        }
                                                            */?>
                                                            
                                                        $html += '</div></p>';                                                   
                                                

                                                    $html += '</div>';


                                                $html += '</div></div></div>';

                                                
                                            };

                                        
                                        $html += '</div></div>';

                                        $('#inner-tareas').append($html); 
                                                                    
                                                                                                       
                                                                        
                                                                        
                                                                        

                                        


                                        console.log(cursos[counter][1]);
                                        console.log(data);
                                        counter++;
                                        if(counter < cursos.length){
                                            recursively_ajax();
                                        } else {
                                            $('#loader').remove();
                                        }
                                    }
                                });

                            

                        }   

                        recursively_ajax();    
                        




                    
                    <?php } ?> 

                     

                
                })

                
                </script>
    </body>
</html>

