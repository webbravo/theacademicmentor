<?php require_once("../../core/initialize.php"); ?>
<?php
    $name            =   $_SESSION['name'];
    $email           =   $_SESSION['email'];
    $careerInterest  =   isset($_POST['careerInterest']); 
?>
<?php 
  // Call the Instance of the student object
    global $student;
    if (isset($careerInterest) && !empty($careerInterest)) {

        // Before We Save(Database) the Career Interest, let Store in a Session file
        $_SESSION['careerInterest'] = $careerInterest;

        if($student->saveCareerInterest($name, $email, $careerInterest) === true){
            echo "Succeeded";
        }else{
            echo "Failed";
        }

    }


    if (isset($_POST['firstOption']) && isset($_POST['secondOption'])) {

        $firstOption  =  $_POST['firstOption'];
        $secondOption =  $_POST['secondOption'];
        $update = $student->saveStudentCareerOption($firstOption, $secondOption, $name, $email);
        if($update === true){
            echo "Succeeded";
        }else{
            echo print_r($update, true);
        }
    }
        
?>