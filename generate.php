<?php
    $school = $_GET['school'];
    $grade = $_GET['grade'];

    require 'connect.php';
    $database = new Database();
    require 'functions.php';
    $generate = new Generate();
    $generateList = $generate->getUserList($database, $school, $grade);

    $data = array(array("Class Name", "User Type", "User ID", "Password", "First Name", "Last Name", "E -Mail")); // Initializes the main array used for the CSV
    
    // Loops through the data from the database then pushes to the array
    foreach($generateList as $list):
        $gradeLevel = str_replace(strtolower($school), '', $list['localgroup']);
        $name = explode(" ", $list['fullname']);
<<<<<<< HEAD
        array_push($data,array('Grade '.$gradeLevel, 'student', $list['userid'], $list['pt'], $list[1], $list[0], $list['userid'].'@nisgaa.bc.ca'));
=======
        array_push($data,array('Class Grade '.$gradeLevel, 'student', $list['userid'], $list['pt'], $name[1], $name[0], $list['userid'].'@nisgaa.bc.ca'));
>>>>>>> master
    endforeach;

    $fileName = 'ATRT_Grade_'. $gradeLevel .'.csv';

    // Sets the page's header to directly download the generated CSV
    header('Content-Type: application/excel');
    header('Content-Disposition: attachment; filename="' . $fileName . '"');
    
    // Opens a php output stream
    $fp = fopen('php://output', 'w');

    // Loops through the main array to add data into the CSV
    foreach ($data as $csv):
        fputcsv($fp, $csv);
    endforeach;

    fclose($fp);
?>