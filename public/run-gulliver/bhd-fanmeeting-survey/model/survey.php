<?php

class Survey {

    public static function getAllSurvey() {
        $sql = mysqli_query(dbconnect(),"SELECT * FROM `questions` WHERE `type` LIKE 'gulliver'");
		
		$result = array(); 
		while ($row = mysqli_fetch_assoc($sql)) {
            $row['phone'] = "*******". substr($row['phone'], -3);
			$result[] = $row;
		} 
		return $result; 
    }

    public static function getAllSurveyAnswers() {
        $sql = mysqli_query(dbconnect(),"SELECT * FROM `questions` WHERE `type` LIKE 'gulliver' ORDER BY `order` ASC");
		
		$result = array(); 
		while ($row = mysqli_fetch_assoc($sql)) {
            $row['answers'] = self::getAnswersByQuestionId($row['id']);
			$result[] = $row;
		} 
		return $result; 
    }

    public static function getAnswersByQuestionId($id) {
        $sql = mysqli_query(dbconnect(),"SELECT * FROM `question_answers` WHERE `question_id` = $id");
		
		$result = array(); 
		while ($row = mysqli_fetch_assoc($sql)) {
			$result[] = $row;
		} 
		return $result; 
    }

}
?>
