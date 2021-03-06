<?php

    use classes\Email;
    use classes\ReadExcel;

    require 'vendor\autoload.php';

    spl_autoload_register(function ($class_name) {
        require_once $class_name . '.php';
    });
    date_default_timezone_set("Asia/Shanghai");

    $fileName = 'test.xlsx';

    echo "Start ..\n";
    $successNum = 0;
    $faliedNum = 0;

    $readE = new ReadExcel();
    $readE->setColumn('A');
    $email = $readE->getEmail($fileName);

    echo "Loading File [$fileName] ..\n";

    $EmailClass = new Email;
    foreach ($email as $e){
        if(filter_var($e, FILTER_VALIDATE_EMAIL)){
            if($EmailClass->sendSpreadEmail($e)){
                echo 'Email [ '.$e.' ] send Success ! '."\n";
                $successNum++;
            }else{
                echo 'Email [ '.$e.' ] send Failed !'."\n";
                $faliedNum++;
            }
        }
    }

    echo 'Success:['.$successNum.'] , Failed:['.$faliedNum."]\n";

//    var_dump($email_group);




