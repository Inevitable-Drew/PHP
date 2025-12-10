<!DOCTYPE html>
<html>
<head>
    <title>Result</title>
</head>
<body>
<?php	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $score = $_POST["score"];

        if ($score >= 98 && $score <= 100) {
            $grade = "1.0";
            $remark = "Excellent!";
        } elseif ($score >= 95 && $score <= 97) {
            $grade = "1.5";
            $remark = "Perfect!";
        } elseif ($score >= 90 && $score <= 94) {
            $grade = "1.75";
            $remark = "Very Good!";
        } elseif ($score >= 85 && $score <= 89) {
            $grade = "2.0";
            $remark = "Good!";
        } elseif ($score >= 75 && $score <= 84) {
            $grade = "3.0";
            $remark = "Passed.";
        } elseif ($score >= 50 && $score <= 74) {
			$grade = "5.0";
			$remark = "Failed.";
		} else {
			$grade = "INC";
			$remark = "Grade Undefine";
		}
		

        echo "<h3>Result:</h3>";
		echo $_POST["Firstname"];
		echo " ";
		echo $_POST["Lastname"];
		echo"<br>";
		echo $_POST["StudentId"];
		echo"<br>";
        echo "Score: $score <br>";
        echo "Grade: $grade <br>";
        echo "Remark: $remark <br>";
    }
    ?>
	
	</body>
</html>
