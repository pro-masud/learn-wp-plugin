<div class="mr9-enquiry-form" id="mr9-enuiry-form">
    <form action="" method="post">

        <div class="form-row">
            <label for="name"><?php _e( "Name", 'mr-9' ); ?></label>
            <input type="text" id="name" name="name" value="" required >
        </div>

        <div class="form-row">
            <label for="email"><?php _e( "E-mail", 'mr-9' ); ?></label>
            <input type="email" id="email" name="email" value="" required >
        </div>

        <div class="form-row">
            <label for="message"><?php _e( "Message", 'mr-9' ); ?></label>
            <textarea name="message" id="message" required></textarea>
        </div>

        <div class="form-row">
            <?php wp_nonce_field( 'mr9-enquiry-form') ?>
            <input type="hidden" name="action" value="mr_enquiry">
            <input type="submit" name="send_enquiry" value="<?php esc_attr_e( 'Send Enquiry', 'mr-9' ); ?>">
        </div>
        
    </form>
</div>