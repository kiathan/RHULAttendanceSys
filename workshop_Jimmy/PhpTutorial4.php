<!DOCTYPE html>
<html>
	<head>
	  <title>Reconstructing the Person Class</title>
      <link type='text/css' rel='stylesheet' href='style.css'/>
	</head>
	<body>
      <p>
        <?php 
            class person{
                public $isAlive =true;
                public $firstname;
                public $lastname;
                public $age;
            
            
            public function __construct($firstname, $lastname,$age){
                $this->firstname = $firstname;
                $this->lastname = $lastname;
                $this->age = $age;
            }
        }
            
            $teacher = new person("boring","12345",12345);
            $student= new person("Jimmy","Chen",23);
            echo $teacher-> isAlive;
            echo $student->age;
        
        ?>
        
      </p>
    </body>
</html>