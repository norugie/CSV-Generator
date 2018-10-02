<<<<<<< HEAD
<!-- 
    
    *********************************
    *********************************
    *****                       *****
    ***** CSV Generator         *****
    ***** Rugie Ann Barrameda   *****
    ***** 29 September 2018     *****
    *****                       *****
    *********************************
    *********************************
    
    This CSV Generator is made to generate a CSV file which contains the student information needed to create student accounts for All-The-Right-Type.
    This program is created for the benefit of School District No. 92 (Nisga'a).

 -->
=======
<?php

    require 'connect.php';
    $database = new Database();
    require 'functions.php';
    $generate = new Generate();

?>
>>>>>>> master
<form action="csvGenerator.php?generate=true" method="POST">
    <label for="school"><b>Generate CSV for Grade Level: </b></label>
    <select name="school" id="school">
        <option value="NESS" selected>NESS</option>
        <option value="AAMES">AAMES</option>
        <option value="GES">GES</option>
        <option value="NBES">NBES</option>
    </select><br />
    <label for="grade"><b>Enter Grade Level: </b></label>
    <select name="grade" id="grade">
        <option value="all">All grade levels</option>
        <option value="K">Kindergarten</option>
        <option value="01">Grade 1</option>
        <option value="02">Grade 2</option>
        <option value="03">Grade 3</option>
        <option value="04">Grade 4</option>
        <option value="05">Grade 5</option>
        <option value="06">Grade 6</option>
        <option value="07">Grade 7</option>
        <option value="08">Grade 8</option>
        <option value="09">Grade 9</option>
        <option value="10">Grade 10</option>
        <option value="11">Grade 11</option>
        <option value="12">Grade 12</option>
    </select>
    <button type="submit">SUBMIT</button>
</form>

<?php

    if(isset($_GET['generate'])) {
        $school = $_POST['school'];
        $grade = '';

        // Sets the actual value for the $grade variable
        if($_POST['grade'] == 'all'){
            $grade = strtolower($school);
        } else {
            $grade = strtolower($school) . $_POST['grade'];
        }

        $generateList = $generate->getUserList($database, $school, $grade);

?>
        <b>Selected School: </b> <?php echo $school; ?><br />
        <b>Student Count: </b><?php echo count($generateList); ?><br />
        <a href="generate.php?school=<?php echo $school; ?>&grade=<?php echo $grade;?>" target="_blank">Download the CSV file for this list</a><hr /><br />
        <table>
            <tr>
                <td>Class Name</td>
                <td>User Type</td>
                <td>User ID</td>
                <td>Password</td>
                <td>First Name</td>
                <td>Last Name</td>
                <td>E-mail</td>
            </tr>
<<<<<<< HEAD
            <?php
                require 'connect.php'; // Connects the database
                $database = new Database(); // Initializes the Database class
                require 'functions.php'; // Connects the file for the methods
                $generate = new Generate(); // Initializes the Generate class
                $generateList = $generate->getUserList($database, $school, $grade);

                foreach ($generateList as $list):
            ?>
=======
            <?php foreach ($generateList as $list): ?>
>>>>>>> master
                <tr>
                    <td>Grade <?php echo $gradeLevel = str_replace(strtolower($school), '', $list['localgroup']); ?></td>
                    <td>student</td>
                    <td><?php echo $list['userid']; ?></td>
                    <td><?php echo $list['pt']; ?></td>
                    <td><?php $fullname = explode(" ", $list['fullname']); echo $fullname[1]; ?></td>
                    <td><?php echo $fullname[0]; ?></td>
                    <td><?php echo $list['userid'] . '@nisgaa.bc.ca'; ?></td>
                </tr>
            <?php endforeach; ?>

        </table>
<?php
    }
?>