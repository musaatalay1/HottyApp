<div class="mainMenuOuterWrapper">

      <ul class="mainMenuWrapper">

        <li><a href="index.html"><?=$language["index"];?></a></li>

        <li><a href="typography.html"><?=$language["profile"];?></a> </li>

        <?php

        $categories = $Connection->Query("SELECT * FROM categories");

        while($fetch=mysql_fetch_object($categories)){

        ?>

        <li><a href="category&view-<?=$fetch->id;?>"><?=$language[$fetch->index];?></a></li>

        <?php } ?>

        <li class="currentPage"><a href="contact.html"><?=$language["contact_us"];?></a></li>

      </ul>

    </div>