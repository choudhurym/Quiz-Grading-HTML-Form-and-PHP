<?php
session_start();
$instructor = $_SESSION["instructor"];
$questionNumber = $_SESSION["question"];
?>
<html>
<body>
<?php

   if ($instructor==""){
      print "You are not allowed to use this web page. You are not logged in.";
   }
   else 
   {   
		print "<p>Instructor: $instructor</p>"; 
		$filename = $_SESSION["filename"];

		if ($questionNumber > 0 && $_POST["question"] != " ") {
			
        $keyfile = fopen($_SESSION["answerkey"],"a");
      	$filevar = fopen($filename,"a");
			if (!$filevar || !$keyfile)
				print "ERROR, internal server error.  Could open file\n";
			else
			{
				fwrite($filevar,"<p>$questionNumber. ");
				fwrite($filevar,$_POST["question"]);
				fwrite($filevar,"<br/><ol type='A'>\n");
				$answer = $_POST["answerA"];
				if ($answer != " ")
					fwrite($filevar,"<li><input type=\"radio\" name=\"q$questionNumber\" value=\"A\">$answer</li>\n");
				$answer = $_POST["answerB"];
				if ($answer != " ")
					fwrite($filevar,"<li><input type=\"radio\" name=\"q$quuestionNumber\" value=\"B\">$answer</li>\n");
				$answer = $_POST["answerC"];
				if ($answer! = " ")
					fwrite($filevar,"<li><input type=\"radio\" name=\"q$questionNumber\" value=\"C\">$answer</li>\n");
				$answer = $_POST["answerD"];
				if ($answer != " ")
					fwrite($filevar,"<li><input type=\"radio\" name=\"q$questionNumber\" value=\"D\">$answer</li>\n");
				$answer = $_POST["answerE"];
				if ($answer != " ")
					fwrite($filevar,"<li><input type=\"radio\" name=\"q$questionNumber\" value=\"E\">$answer</li>\n");

				$correctanswer = $questionNumber." ".$_POST["correct"]."\n";
				fwrite($keyfile,$correctanswer);
				fclose($keyfile);

				fwrite($filevar,"</ol></p>\n");
				fclose($filevar);
			}
		}
   }
   $done = $_POST["done"];
   print "DONE=".$done."  ";
   
   if ($done!="Done") 
   {
      $done=false;
      print "NOT done<br>";
   }
   else 
   {
		print "<p>Done = (".$done.")</p>";
		print "<script>";
		print 'window.location = "endsession.php";';
		print "</script>";
		$filevar = fopen($filename,"a");
		fwrite($filevar,"<input type=\"submit\">\n</form>\n");
		fwrite($filevar,"</body>\n</html>\n");
		fclose($filevar);
	}
?>
<h1>Quiz Question Query</h1>
<form name="QuestionEntry" method="post" action="questionentry.php">
<table>
<tr>
<th>
<?php
$questionNumber++;
print "$questionNumber.";
$_SESSION["question"] = $questionNumber;
?>
</th>
<td colspan="2">
    <textarea name="question" rows="5" cols="70"></textarea>
</td>
</tr>
<tr>
<th>A.</th>
<td><input type="text" name="answerA" size="60"/></td>
<td><input type="radio" name="correct" value="A" /></td>
</tr>
<tr>
<th>B.</th>
<td><input type="text" name="answerB" size="60"/></td>
<td><input type="radio" name="correct" value="B"/></td>
</tr>
<tr>
<th>C.</th>
<td><input type="text" name="answerC" size="60"/></td>
<td><input type="radio" name="correct" value="C"/></td>
</tr>
<tr>
<th>D.</th>
<td><input type="text" name="answerD" size="60"/></td>
<td><input type="radio" name="correct" value="D"/></td>
</tr>
<tr>
<th>E.</th>
<td><input type="text" name="answerE" size="60"/></td>
<td><input type="radio" name="correct" value="E"/></td>
</tr>
</table>
<p><input type="submit"/></p>
<p><input type="submit" name="done" value="Done"/></p>
</form>

</body>
</html>
