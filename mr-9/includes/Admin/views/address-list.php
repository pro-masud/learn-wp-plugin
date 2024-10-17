<div class="wrap">
    <h1 class="wp-heading-inline" ><?php _e('Address Book', 'mr-9') ?></h1>

    <a class="page-title-action" href="<?php echo admin_url("admin.php?page=mr-9&action=new"); ?>"><?php _e('Add New', 'mr-9'); ?></a>

    <form action="" method="post">
        <?php
            $table = new Promasud\MR_9\Admin\Address_List();
            $table->prepare_items();
            $table->display();
        ?>
    </form>

</div>