<!-- ============== | head | =================-->
<?php  

session_start();
if(isset($_SESSION["user"]))
{
include "layouts/head.php";     
?>
<!--==========================================-->


<!-- =========== | contenido | ===============-->
<div class="app-content content container-fluid">
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
        <?php

        echo $_SESSION["user"]["nombre"].' '.$_SESSION["user"]["apellidos"];

        ?>
        </div>
    </div>
</div>
<!--==========================================-->

<!-- ========= | scripts robust | ============-->
<?php  include "layouts/main_scripts.php"; ?>
<!--==========================================-->

<!-- ============= | footer | ================-->
<?php  include "layouts/footer.php";     
}
else
{
    header("location:../");
}
?>
<!--==========================================-->



