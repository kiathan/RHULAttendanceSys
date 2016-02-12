<html>
    <p>
	<?php
	// Create an array and push on the names
    // of your closest family and friends
    $relatives= array();
    array_push($relatives,"Hank");
    array_push($relatives,"Sam");
    array_push($relatives,"Jack");
    array_push($relatives,"Birney");
    array_push($relatives,"Jonathan");
	// Sort the list
	sort($relatives);

	// Randomly select a winner!
    
	// Print the winner's name in ALL CAPS
	$ans= strtoupper($relatives[rand(0,count($relatives))]);
	print $ans;
	?>
	</p>
</html>