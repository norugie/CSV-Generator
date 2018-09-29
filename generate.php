<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "k12admin";
    // create connection
    $con = new mysqli($servername, $username, $password, $dbname);
    // check connection
    if ($con->connect_error) {
        die("Connection failed: " . $conn ->connect_error);
    }

    $school = $_GET['school'];
    $grade = $_GET['grade'];

    $sql = "SELECT users.userid, users.fullname, users.pt, lglist.localgroup
            FROM lglist
            LEFT JOIN users 
            ON (users.userid = lglist.userid)
            WHERE users.comment LIKE '%$school%' 
            AND users.flags = '2'
            AND lglist.localgroup LIKE '%$grade%'
            AND lglist.localgroup NOT LIKE '%stud%'
            AND lglist.localgroup NOT LIKE '%adult%'";
    $result = mysqli_query($con,$sql);
    $data = array(array("Class Name","User Type","User ID","Password","First Name","Last Name","E -Mail"));
    
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){
            $gradeLevel = str_replace(strtolower($school), '', $row['localgroup']);
            $name = explode(" ", $row['fullname']);
            array_push($data,array('Class Grade '.$gradeLevel,'student',$row['userid'],$row['pt'],$name[1],$name[0],$row['userid'].'@nisgaa.bc.ca'));
        }
    }

    //The name of the CSV file that will be downloaded by the user.
    $fileName = 'example.csv';
    
    //Set the Content-Type and Content-Disposition headers.
    header('Content-Type: application/excel');
    header('Content-Disposition: attachment; filename="' . $fileName . '"');
    
    //Open up a PHP output stream using the function fopen.
    $fp = fopen('php://output', 'w');
    
    //Loop through the array containing our CSV data.
    foreach ($data as $csv) {
        //fputcsv formats the array into a CSV format.
        //It then writes the result to our output stream.
        fputcsv($fp, $csv);
    }
    
    //Close the file handle.
    fclose($fp);
?>