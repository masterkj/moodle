<?php
require_once(__DIR__.'/../../config.php');
require_once($CFG->dirroot.'/lib/grouplib.php');//groups_is_member//groups_group_exists
include_once '../config/DBClass.php';
include_once '../table/Student_payment.php';
include_once '../table/Real_cours.php';

function first_payment($student_id,$group_id , $Quantity){
    
    $dbclass = new DBClass();
    $connection = $dbclass->getConnection();
    $realcours = new Real_cours($connection);
    $stmt =    $realcours->select_group($group_id);
    if ($st = $stmt->fetch()){
        $realcours_opject= json_decode(json_encode($st));
        $percent =$realcours_opject->price * 40 /100 ;
        if($Quantity > $percent){

            if($Quantity < $realcours_opject->price){
            
                $student_payment = new Student_payment($connection);
                $student_payment->student_id=$student_id;
                $student_payment->realcours_id=$realcours_opject->realcours_id;
                $student_payment->date=date('Y-m-d');
                $student_payment->amount=$Quantity;
             
                if( $student_payment->create()){echo"payment was created"; return true;}else{echo"payment was created"; return false;}

                
            }else{echo "The quantity is larger than the price of the course " . $realcours_opject->price ; return false; }

        }else{echo "Quantity less than 40% of course price (" . $percent . ") "; return false;}



    }else{echo"There is not realcouse";return false;}


}