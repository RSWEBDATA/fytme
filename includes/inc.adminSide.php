<?php

    //get new trainer app info
    $newTrainer = getNewTr($dbconn);

?>


<!--new trainer applications-->
<div style="color: #ffffff">
    <h3>VIEW NEW TRAINER INFO:</h3>
    <select onchange="location = this.options[this.selectedIndex].value;">
        <option value="">--Select--</option>
        <?php foreach ($newTrainer AS $rowNT) {
            echo "<option value='adminTrNew.php?trTempId=" .$rowNT['trTempId'] ."'>" .$rowNT['lastName'] .", " .$rowNT['firstName'] ."</option>";
        } ?>
    </select>
</div>