<?php
    if(isset($_SESSION["mensagem"])):
?>

<div class="bg-green-300 border-1 border-green-500 py-[7px] px-[10px] rounded-[7px] mb-[10px]">
    <?= $_SESSION["mensagem"]; ?>
</div>

<?php
    unset($_SESSION["mensagem"]);
    endif;
?>