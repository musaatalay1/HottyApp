<!DOCTYPE html>

<html>

<?php require_once "Themplates/default/includes/head.php"; ?>

<body>

<!-- website wrapper starts -->

<div class="websiteWrapper"> 

  

  <div class="headerOuterWrapper">

    <div class="headerWrapper"> <a href="index.html" class="headerLogo"><img src="Themplates/default/images/common/headerLogo.png" alt=""/></a><a style="display: none;" href="" class="mainMenuButton"></a></div>


    <?php //require_once "Themplates/default/includes/top-menu.php"; ?>
    

  </div>

  

  <!-- page wrapper starts -->

  <div class="pageWrapper contactPageWrapper"> 

    

    <!-- social icons wrapper starts -->

  <div class="alert"></div>

    <!-- social icons wrapper ends --> 

    

    <!-- contact form wrapper starts -->

    <div class="contactFormWrapper">

      <h4 class="contactTitle"><?=$language["sign_in"];?></h4>

      <!-- contact form starts -->

      <form onsubmit="javascript:login();return false;" method="post" class="contactForm" id="contactForm">

        <fieldset>

          <div class="formFieldWrapper">

            <label for="contactNameField"><?=$language["username"];?>:</label>

            <input type="text" name="username" value="" class="contactField requiredField" id="contactNameField" data-placeholder=""/>

          </div>

          <div class="formFieldWrapper">

            <label for="contactEmailField"><?=$language["password"];?>:</label>

            <input type="password" name="password" value="" class="contactField requiredField requiredEmailField" id="contactEmailField" data-placeholder=""/>

          </div>

          <div class="formSubmitButtonErrorsWrapper"> 

            <!-- form errors start --> 

            <span style="padding-right:2px;" class="formValidationError" id="contactNameFieldError"><?=$language["required_username"];?></span> &nbsp;&nbsp; <span class="formValidationError" id="contactPasswordFieldError"><?=$language["required_password"];?></span>

            <!-- form errors end -->

            <input type="submit" class="buttonWrapper contactSubmitButton" id="contactSubmitButton" value="<?=$language["sign_in"];?>" data-form-id="contactForm"/>

          </div>

          <input type="hidden" name="formIsReady" value="true"  id="formIsReady" />

        </fieldset>

      </form>

      <!-- contact form ends --> 

    </div>

    <!-- contact form wrapper ends --> 

    

  </div>

  <!-- page wrapper ends --> 

  <?php require_once 'Themplates/default/includes/footer.php'; ?>

  </div>

  <!-- footer wrapper ends --> 

  

</div>

<!-- website wrapper ends -->

</body>

</html>

