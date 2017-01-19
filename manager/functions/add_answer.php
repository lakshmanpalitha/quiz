<?php
require_once '../dbconnect.php';


$q_id = $_GET['edit_q'];

if (isset($_POST['add-question-btn'])) {
    $qName = $_POST['question'];
    $qDetails = $_POST["question-details"];
    $category = $_POST["category"];

    if(!empty($qName) && !empty($category)){


        if($db_add)
        {
            $msg = 'Question Added';
        }
        else
        {
            $error = 'There was a error please try again';
        }
    }else{
        $error = 'please fill required field';
    }
}

/*if(isset($q_id))
{
//update table
    if (isset($_POST['edit-question-btn'])) {
        $qName = $_POST['question'];
        $qDetails = htmlentities($_POST["question-details"]);
        $category = $_POST["category"];


        if(!empty($qName) && !empty($category)){

            $update_q = 'UPDATE questions SET `category_id` = '.$category.',  `question` = "'.$qName.'", `q_details` = "'.$qDetails.'" WHERE q_id = '.$q_id.'';
            $db_update = mysql_query($update_q);
            var_dump($db_update);
            if($db_update)
            {
                $msg = 'Record updated successfully';
            }
            else
            {
                $error = 'There was a error please try again';
            }
        }else{
            $error = 'please fill required field';
        }
    }

    //Select Questions table
    $to_edit =mysql_query('SELECT * FROM questions where q_id = '.$q_id.'');
    $editRow=mysql_fetch_array($to_edit);

    //Select Questions table
    $to_cat =mysql_query('SELECT * FROM categories where cat_id = '.$editRow[1].'');
    $cat_row=mysql_fetch_array($to_cat);

}*/

?>
