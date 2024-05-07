
<div class="box-header with-border">
  <h3 class="box-title">

    <?php
      switch ($type) {
        case 1:
          echo '<i class="fa fa-plus"></i> ' . $text;
        break;
        case 2:
          echo '<i class="fa fa-pencil"></i> ' . $text;
        break;
        case 3:
          echo '<i class="fa fa-search"></i> ' . $text;
        break;
        default:
          echo '<i class="fa fa-search"></i> ' . $text;
        break;
      }
    ?>

  </h3>
</div>
