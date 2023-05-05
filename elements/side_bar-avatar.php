<div class="image" style="margin-top: 2%; margin-left: -4%;">
    <img src="assets/adminLTE-3/img/user.png" class="img-circle elevation-2" alt="User Image">
</div>
<div class="info">
    <?php
        $stmt = $DB->prepare("SELECT * FROM users where id=?");
        $stmt->bind_param("i", $_SESSION[AUTH_ID]);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_object();
    ?>
    <a href="./profile" class="d-block"><?php echo $user->fname ?></a>
    <a href="./profile" style="font-size: 10pt">
        <i class="fa fa-circle text-success" style="font-size: 8pt"></i> <?php echo $user->usertype ?>
    </a>
</div>