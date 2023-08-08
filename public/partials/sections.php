<?php require_once $_SERVER['DOCUMENT_ROOT'].'/partials/getdata.php'; ?>
<div class="sections">
    <section>
        <h3 class="green">Events</h3>
        <?php displayRecords("events", $allRecords); ?>
    </section>
    <section>
        <h3 class="red">Broadcast & live</h3>
        <?php displayRecords("broadcast", $allRecords); ?>
        <h3 class="oger">Documentary</h3>
        <?php displayRecords("docu", $allRecords); ?>
    </section>        
    <section>
        <h3 class="blue">Commercials & corporate</h3>
        <?php displayRecords("commercial", $allRecords); ?>
        <h3 class="purple">Music videos</h3>
        <?php displayRecords("musicvideos", $allRecords); ?>
  <section>
</div>