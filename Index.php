<?php

    use classes\Email;
    use classes\ReadExcel;

    require 'vendor\autoload.php';

    spl_autoload_register(function ($class_name) {
        require_once $class_name . '.php';
    });
    date_default_timezone_set("Asia/Shanghai");


    $readE = new ReadExcel();
    $readE->setColumn('A');
    $email = $readE->getEmail('test.xlsx');

    foreach ($email as $e){
        if(filter_var($e, FILTER_VALIDATE_EMAIL)){
            if(Email::sendEmail($e)){
                echo 'Email'.$e.' send Success ! '."\n";
            }else{
                echo 'Email'.$e.' send failed !'."\n";
            }
        }
    }




    echo 'done ..';
//    var_dump($email_group);




