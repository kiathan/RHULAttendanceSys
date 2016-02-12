<html>
  <head>
    <title>Modifying Elements</title>
  </head>
  <body>
    <p>
      <?php
        $languages = array("HTML/CSS",
        "JavaScript", "PHP", "Python", "Ruby");
        
        // Write the code to modify
        // the $languages array!
        $languages[1] = "red";
        echo $languages[1];
        
      ?>
    </p>
  </body>
</html>