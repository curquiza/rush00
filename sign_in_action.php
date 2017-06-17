<?php

session_start();

?>

<html>
    <head>
        <?php include("settings.php"); ?>
    </head>
    <body>
    <?php include("header.php"); ?>
    <H1>Sign in</H1> <br />

<?php

session_start();
       
function ft_auth($login, $passwd)
{
    if ($login === NULL || $passwd === NULL || file_exists("private/passwd") === FALSE)
        return (FALSE);
    $list = unserialize(file_get_contents("private/passwd"));
    foreach($list as $elem)
    {
        if ($elem['login'] === $login && $elem['passwd'] === hash("whirlpool", $passwd))
            return (TRUE);
    }
    return (FALSE);
}

if (ft_auth($_POST['login'], $_POST['passwd']) === TRUE)
{
    $_SESSION['logged_on_user'] = $_POST['login'];
    echo "Welcome back ".$_POST['login']." !\n";
    echo '<br /><a href="index.php">Let\'s go shopping !</a>';
}
else
{
    $_SESSION['logged_on_user'] = "";
    echo "Sorry, we were enable to log you in...\n";
    echo '<br /><a href="sign_in.php">Try again</a>';
}

?>     
    <?php include("footer.php"); ?>
    </body>
</html>
