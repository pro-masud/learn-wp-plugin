<div class="wrap">

    <h1 class="wp-heading-inline" ><?php _e('Address Book', 'mr-9') ?></h1>

    <a class="page-title-action" href="<?php echo admin_url("admin.php?page=mr-9&action=new"); ?>"><?php _e('Add New', 'mr-9'); ?></a>
    
    <?php if( isset( $_GET['inserted'] )){ ?>
        <div class="notice notice-success">
            <p><?php echo __( 'Address Book Data Insert Successfully', 'mr-9'); ?></p>
        </div>
    <?php } ?>

    <?php if( isset( $_GET['address-delete'] ) && $_GET['address-delete'] == 'true' ){ ?>
        <div class="notice notice-success">
            <p><?php echo __( 'Address Book Data Delete Successfully', 'mr-9'); ?></p>
        </div>
    <?php } ?>
       
    <form action="" method="post">
        <?php
            $table = new Promasud\MR_9\Admin\Address_List();
            $table->prepare_items();
            $table->display();
        ?>
    </form>

</div>