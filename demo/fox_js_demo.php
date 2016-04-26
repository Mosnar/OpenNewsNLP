<!DOCTYPE html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="markup.css">
<script type="text/javascript" src="fox_js_demo.js"></script>

</head>

<h2> This is part of a passage from Fox News </h2>
<br>
<br><br>
<br><br>

<p> Passages will appear larger and in blue. Enter whether or not you think they are biased. The algorithm will then print the passage in red text if it thinks its biased, and black text if it finds the text objective </p>
<br><br>
<hr>
<?php

 echo "<MPQASENT autoclass1=\"unknown\" id=\"1\" autoclass2=\"subj\">Russia's ambassador to NATO accused the U.S. Wednesday of trying to intimidate Moscow by sailing a Navy destroyer in the Baltic Sea, and vowed Russia would respond to future incidents with \"all necessary measures.\"</MPQASENT>";
 
 echo "<MPQASENT autoclass1=\"unknown\" id=\"2\"  autoclass2=\"obj\">Alexander Grushko spoke following a meeting of the NATO-Russia council in Brussels, the first in nearly two years.</MPQASENT> <MPQASENT autoclass1=\"unknown\" autoclass2=\"obj\" id=\"3\">The meeting, which involved Grushko and ambassadors from NATO's 28 member states, ran over its allotted time by about 90 minutes, but produced no major breakthroughs.</MPQASENT>

<MPQASENT autoclass1=\"unknown\" id=\"4\" autoclass2=\"obj\">\"It's better to talk than not to talk,\" Grushko told reporters, before adding that relationships between NATO and Russia would not improve \"without real steps on NATO's side to downgrade military activity in the area adjacent to the Russian Federation.\"</MPQASENT>

<MPQASENT autoclass1=\"unknown\" id=\"5\"  autoclass2=\"obj\">Reuters reported that U.S. ambassador to NATO Douglas Lute pressed Grushko about the April 11 incident in which two Russian Su-24 attack aircraft buzzed the USS Donald Cook in the Baltic Sea.</MPQASENT>";


?>

<script>
		for(var i=1; i<=5; i++) {
			var idString = i.toString();
			document.getElementById(idString).style.display = 'none'; 
		}
		for(var i=1; i<=5; i++) {
			var idString = i.toString();
			document.getElementById(idString).style.display = 'block'; 

			document.getElementById(idString).style.fontSize = 'x-large'; 
			document.getElementById(idString).style.color = 'blue'; 
			var thinksBiased = prompt("Do you think the large blue phrase is biased? Enter y for yes and n for no", "");
			// They think it's biased
			if(thinksBiased.indexOf("y") != -1) {
				var biasedBool = true;
			}
			else {
				var biasedBool = false;
			}
			var biasBool 
			// Biased passages
			if(i==1) {
				if(biasedBool) {
					alert("You and the algorithm agree this phrase is biased");
				}
				else {
					alert("You and the algorithm disagree. It thinks this is biased");
				}
				document.getElementById(idString).style.color = 'red'; 
				
			}
			else {
				if(!biasedBool) {
					alert("You and the algorithm agree this phrase is unbiased");
				}
				else {
					alert("You and the algorithm disagree. It thinks this is unbiased");
				}
			document.getElementById(idString).style.color = 'black'; 
			}
				document.getElementById(idString).style.fontSize = 'medium'; 

		}
</script>