<?php include_page_title('紹介文を作成する') ?>
<form action="<?php echo url_for('introessay/index?id=' . $id) ?>" method="post">
<?php echo $form ?>
<br><br>
<center><input type="submit" value="作成"></center>
</form>

