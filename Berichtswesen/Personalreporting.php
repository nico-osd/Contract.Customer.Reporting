<?php
$_SESSION['site'] = array('dashboard', 'Personalreporting');
echo '<a href="index.php?section=dashboard"><button class="submit left r10" name="dashboard" type="submit">Zum Dashboard</button></a>';

?>
<html>
<body>
<form method="post" action="Berichtswesen/ex.php">
    <select name="taskOption">
        <option value="monatlich">Monatlich</option>
        <option value="Quartal">Quartal</option>
        <option value="third">Third</option>
    </select>
   <div  class="submit left r10">
    <button class="submit left r10" type="submit" name="dashboard" value="Generate">Generate</button>
   </div>
</form>
    </body>
</html>