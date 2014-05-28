<?php
    $_SESSION['site'] = array('login');

?>

<form class="formular" action="index.php" method="post" name="loginform">
    <ul>
        <li>
             <h2>Login</h2>
             <span class="required_notification">* Ben&ouml;tigte Felder</span>
        </li>
        <li>
            <label for="username">Username:</label>
            <input id="username" name="username" type="text" placeholder="Username" required />
        </li>
        <li>
            <label for="password">Passwort:</label>
            <input id="password" name="password" type="password" name="password" required />
        </li>
        <li>
        	<button class="submit" name="login" type="submit">Login</button>
        </li>
    </ul>
</form>
