<?php
	session_start();
	$name = $_SESSION["instructor"];
	$quiz = $_SESSION["quiz"];
	$course = $_SESSION["course"];
?>

<!DOCTYPE html>
<head>
<html>
	<body>
	<?php
		if($name != " ")
		{
			print "<h1>$course Quiz #$quiz</h1>";
			print "<h2> $name </h2>";
			$answerkey = $course."Quiz".$quiz.".txt";
			$keyfile = fopen($answerkey,"r");
			$question_position = 1;
			$correctCount = 0;
			
			while(!feof($keyfile))
			{
				$savedAnswer = fgets($keyfile);
				if($savedAnswer != "")
				{
					
					$checkAnswer = $_POST["q".$question_position];
					$saved_Answer_array = explode(" ", $savedAnswer);
					$saved_Answer_string = $saved_Answer_array[1];
					$saved_Answer_string = substr($saved_Answer_string, 0, 1);
					print "<br/>";
					$correct_answer = $saved_Answer_string;
					$student_answer = $checkAnswer;
					
					if($correct_answer == $student_answer)
					{
						$correctCount++;
						print "$name 's answer is: $student_answer<br/>";
						print "Correct Answer: $correct_answer";
						print "<br/>Right Answer!<br/>";
						
					}
					else
					{
						print "$name 's answer is: $student_answer<br/>";
						print "Correct Answer: $correct_answer";
						print "<br>Wrong Answer!<br/>";
					}
					$question_position++;					
				}	
			}
			fclose($keyfile);
			$question_position--;
			$percentage = round((($correctCount/$question_position) * 100),1);
			print "<h2> $correctCount / $question_position  ($percentage)% </h2>";
			
			$answerkey = "Results.txt";
			$keyfile = fopen($answerkey,"a");
			fwrite($keyfile, $name.":".$course."#".$quiz.":".$percentage."\r\n");
			fclose($keyfile);
		}
		else
			print "<h1> Failed! </h1>";
	?>
	</body>
</html>