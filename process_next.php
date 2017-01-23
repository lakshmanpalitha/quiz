<?php
session_start();
$session = session_id();

require_once 'manager/dbconnect.php';

$quiz_id = $_POST['quiz_id'];
$question_id = $_POST['question_id'];
$answer = $_POST['answer'];
$time = $_POST['time'];


//Select Questions table
$select_challenge =mysql_query('SELECT * FROM quiz where quiz_id = '.$challenge_id.'');
$challenge_row = mysql_fetch_array($select_challenge);

$question_list = explode(",", $challenge_row[3]);


//session work
$_SESSION["next_question"] = 1;
$currant_question = $_SESSION["next_question"] - 1;


//Select Currant question
$select_question =mysql_query('SELECT * FROM questions where q_id = '.$question_list[$currant_question].'');
$question_row = mysql_fetch_array($select_question);


//answers for current question
$select_answer =mysql_query('SELECT * FROM answers where q_id = '.$question_list[$currant_question].'');
$answer_row = mysql_fetch_array($select_answer);




?>

