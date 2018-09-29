<?php
    $school = $_GET['school'];
    $grade = $_GET['grade'];

    require 'connect.php';
    $database = new Database();
    require 'functions.php';
    $generate = new Generate();
    $generateList = $generate->getUserList($database, $school, $grade);

    $data = array(array("Class Name", "User Type", "User ID", "Password", "First Name", "Last Name", "E -Mail"));
    
    foreach($generateList as $list):
        $gradeLevel = str_replace(strtolower($school), '', $list['localgroup']);
        $name = explode(" ", $list['fullname']);
        array_push($data,array('Grade '.$gradeLevel, 'student', $list['userid'], $list['pt'], $list[1], $list[0], $list['userid'].'@nisgaa.bc.ca'));
    endforeach;

    $fileName = 'ATRT_Grade_'. $gradeLevel .'.csv';

    header('Content-Type: application/excel');
    header('Content-Disposition: attachment; filename="' . $fileName . '"');
    
    $fp = fopen('php://output', 'w');

    foreach ($data as $csv):
        fputcsv($fp, $csv);
    endforeach;

    fclose($fp);
?>