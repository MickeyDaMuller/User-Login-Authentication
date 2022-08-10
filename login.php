<?php
namespace dbn;
use \dbn\DataSource;

$message = "";
if (count($_POST) > 0) {
    $isSuccess = 0;
    require_once __DIR__ . '/DataSource.php';
    $conn = new DataSource();
    $query = 'SELECT * FROM used WHERE userName= ?';
    $paramType = 's';
    $paramValue = array(
        $_POST["userName"]
    );
    $result = $conn->select($query, $paramType, $paramValue);

    if (! empty($result)) {

        $hashedPassword = $result[0]["password"];
        if (password_verify($_POST["password"], $hashedPassword)) {
            $isSuccess = 1;
        }
    }
    if ($isSuccess == 0) {
        $message = "Invalid Username or Password!";
    } else {
        header("Location:  ./success-message.php");
    }
}
?>

<html>
<head>
<title>User Login</title>
<link rel="stylesheet" type="text/css" href="styles.css" />
</head>
<body>
    <form name="frmUser" method="post" action="">
        <div class="message"><?php if($message!="") { echo $message; } ?></div>
        <table border="0" cellpadding="10" cellspacing="1" width="500"
            align="center" class="tblLogin">
            <tr class="tableheader">
                <td align="center" colspan="2">Enter Login Details</td>
            </tr>
            <tr class="tablerow">
                <td><input type="text" name="userName"
                    placeholder="User Name" class="login-input"></td>
            </tr>
            <tr class="tablerow">
                <td><input type="password" name="password"
                    placeholder="Password" class="login-input"></td>
            </tr>
            <tr class="tableheader">
                <td align="center" colspan="2"><input type="submit"
                    name="submit" value="Submit" class="btnSubmit"></td>
            </tr>
        </table>
    </form>
</body>
</html>
