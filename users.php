<?php
require_once("databases.php");
require_once("functions.php");
navigation($user_id);

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT user_id AS loanee_id, fname, lname,gender, id_no, email, user_type, user_status,reg_date
  FROM users WHERE user_type = 'Member'";
    $result = $conn->query($sql);
    $result->setFetchMode(PDO::FETCH_ASSOC);
     echo "<table>";
 echo "<thead>";
 echo "<tr>";
     echo "<th>UserId</th>";
         echo "<th>First Name</th>";
            echo "<th>Last Name</th>";
            echo "<th>ID Number</th>";
            echo "<th>Gender</th>";
            echo " <th>E-mail</th>";
            echo "<th>Role</th>";
            echo "<th>Date Joined</th>";
            echo "<th>User Status</th>";
            echo "</tr>";
        echo "</thead>";
        echo "<tbody>";

        while($loanee = $result->fetch()):
        $loanee_user_id = test_input($loanee['loanee_id']);
        $loanee_fname = test_input($loanee['fname']);
        $loanee_lname = test_input($loanee['lname']);
            $loanee_id_no = test_input($loanee['id_no']);
        $loanee_gender = test_input($loanee['gender']);
        $loanee_email = test_input($loanee['email']);
        $loanee_user_type = test_input($loanee['user_type']);
        $loanee_reg_date = date("j F Y g:i:s", strtotime($loanee['reg_date']));
        $loanee_user_status = test_input($loanee['user_status']);

      echo "<tr>";
      echo "<td> $loanee_user_id </td>";
      echo "<td> $loanee_fname  </td>";
      echo "<td> $loanee_lname  </td>";
            echo "<td> $loanee_id_no  </td>";
      echo "<td> $loanee_gender </td>";
      echo "<td> $loanee_email  </td>";
      echo "<td> $loanee_user_type  </td>";
      echo "<td> $loanee_reg_date  </td>";
      if($loanee_user_status === "Activated") {
               echo "<td><a href='update_user_status.php?loanee_user_id=$loanee_user_id'>".$loanee_user_status."</a></td>";
               } else {
               echo "<td><a href='update_user_status.php?loanee_user_id=$loanee_user_id'>".$loanee_user_status."</a></td>";
           }

            echo "</tr>";
        endwhile;
    echo "</tbody>";
    echo "</table>";

}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
    $conn = null;
?>