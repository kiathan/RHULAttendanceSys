<html>
    <p>
    <?php
    // Use rand() to print a random number to the screen
    print rand(20,200);
    ?>
    </p>
    <p>
    <?php
    // Use your knowledge of strlen(), substr(), and rand() to
    // print a random character from your name to the screen.
    $myName ="Jimmy";
    $rand = rand(0,strlen($myName));
    print substr($myName, $rand);
    ?>
    </p>
</html>