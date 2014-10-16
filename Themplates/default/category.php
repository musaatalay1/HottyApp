<!DOCTYPE html>
<html>
<?php require_once "Themplates/default/includes/head.php"; ?>
<body onload="javascript:runCategory('<?=$_GET["category_id"];?>','1');">

<div class="websiteWrapper"> 

  <div class="headerOuterWrapper">

    <?php require_once 'Themplates/default/includes/top.php'; ?>

    <?php require_once "Themplates/default/includes/top-menu.php"; ?>

  </div>
  
  <!-- page wrapper starts -->
  <div class="pageWrapper portfolioTwoFilterablePageWrapper"> 
    
    <!-- filterable portfolio menu starts -->
    <ul class="portfolioMenuWrapper" id="portfolioMenuWrapper">
      <li><a href="" data-type="all" class="currentPortfolioFilter"><?=$language["all"];?></a></li>
      <li><a href="" data-type="free"><?=$language["free"];?></a></li>
      <li><a href="" data-type="paid"><?=$language["paid"];?></a></li>
    </ul>
    <!-- filterable portfolio menu ends --> 
    
    <!-- portfolio wrapper starts -->
    <div class="portfolioTwoFilterableWrapper"></div>
    <!-- portfolio wrapper ends -->
      
    <div class="pageNumbersWrapper"></div>
          
  </div>
  <!-- page wrapper ends --> 
  
<?php require_once 'Themplates/default/includes/footer.php'; ?>

</div>
<!-- website wrapper ends -->
</body>
</html>
