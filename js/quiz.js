score = 0;
var text2display = "";
var answers = new Array (3);
answers[0] = "1. IP stands for Internet Protocol \n";
answers[1] = "2. IPv6 is needed to increase the number of uniqueness \n";
answers[2] = "3. World IPv6 day is June 6, 2012 \n";

var questions = new Array(3);
questions[0] = "q1";
questions[1] = "q2";
questions[2] = "q3";

function checkQs(s)
{
	var qs = document.getElementsByName(s);
	var noOfRadios = q.length;
	
	for ( var i = 0; i < noOfRadios; i++ )
	{
		if(qs[i].checked)
		{
			if (qs[i].value=="correct")
			{
			text2display = text2display + "you got that correct\n";
			score ++;
			}
		else text2display = text2display + answers[questions.indexof(s)];
			break;	
		}
	}
}

function checkALL()
{
	for (var i = 0; i < questions.lenth; i++)
	{
		checkQs(questions[i]);
	}
	quiz.answersBox.value = text2display + "\n\nYour score is: + score";
}