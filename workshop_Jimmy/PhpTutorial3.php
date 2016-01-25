<html>
	<head>
		<title></title>
	</head>
	<body>
      <p>
        <?php
            function aboutMe($name, $age){
                echo "Hello! My name is ". $name. " and I am " . $age. " years old";
            }
            
            $n = "Jimmy";
            $a = "2334";
            
            aboutMe($n,$a);
                
        ?>
      </p>
    </body>
</html>