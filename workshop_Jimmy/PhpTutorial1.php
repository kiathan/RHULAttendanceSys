<html>
  <p>
    <?php
    // Get a partial string from within your own name
    // and print it to the screen!
    $myName = "Jimmy";
    $partial = substr($myName,0,4);
    print $partial;

    ?>
  </p>
  <p>
    <?php
    // Make your name upper case and print it to the screen:
    $upper = strtoupper($myName);
    echo $upper;
    
    ?>
  </p>
  <p>
    <?php
    // Make your name lower case and print it to the screen:
    $lower = strtolower($myName);
    echo $lower;
    
    ?>
  </p>
</html>