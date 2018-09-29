<?php

	Class Generate {

		public function getUserList($datacon,$school,$grade){
			$array = array();
			$sql = "SELECT users.userid, users.fullname, users.pt, lglist.localgroup
            FROM lglist
            LEFT JOIN users 
            ON (users.userid = lglist.userid)
            WHERE users.comment LIKE '%$school%' 
            AND users.flags = '2'
            AND lglist.localgroup LIKE '%$grade%'
            AND lglist.localgroup NOT LIKE '%stud%'
            AND lglist.localgroup NOT LIKE '%adult%'";
    		$query = mysqli_query($datacon->con,$sql);
			if(!$query) {
			    echo("Error description: " . mysqli_error($datacon->con));
			} else {
				while($row = mysqli_fetch_array($query)){
					$array[] = $row;
				}
				return $array;
			}
		}
	}

?>