<div class="wrap">
    <h1 class="wp-heading-inline" >
        <?php _e('Edit Address', 'mr-9') ?>
    </h1>
    <?php if( isset( $_GET['address-updated'] )){ ?>
        <div class="notice notice-success">
            <p><?php echo __( 'Address Book Data Updated Successfully', 'mr-9'); ?></p>
        </div>
    <?php } ?>
    <form action="" method="post">
        <table class="form-table">
           <tbody>
                <tr scope="row <?php echo $this->has_error( 'name' ) ? 'form-invalid' : ''; ?>" >
                    <th>
                        <label for="name"><?php _e('Name', 'mr-9' ) ?></label>
                    </th>
                    <td>
                        <input type="text" placeholder="Name" name="name" id="name" value="<?php echo esc_attr($address->name ); ?>" class="regular-text">
                        <?php if( $this->has_error( 'name' ) ){ ?>
                            <p class="description error"><?php echo $this->get_errors( 'name' ); ?></p>
                        <?php } ?>
                    </td>
                </tr>
                <tr scope="row">
                    <th>
                        <label for="address"><?php _e('Address', 'mr-9' ) ?></label>
                    </th>
                    <td>
                        <textarea name="address" id="address" placeholder="address" class="regular-text"><?php echo esc_textarea($address->address ); ?></textarea>
                    </td>
                </tr>
                <tr scope="row <?php echo $this->has_error( 'phone' ) ? 'form-invalid' : ''; ?>">
                    <th>
                        <label for="phone"><?php _e('Phone', 'mr-9' ) ?></label>
                    </th>
                    <td>
                        <input type="text" placeholder="Phone" name="phone" id="phone" value="<?php echo esc_attr($address->phone ); ?>" class="regular-text">
                        <?php if( $this->has_error( 'phone' ) ){ ?>
                            <p class="description error"><?php echo $this->get_errors( 'phone' ); ?></p>
                        <?php } ?>
                    </td>
                </tr>
           </tbody>
        </table>
        <input type="hidden" name="id" value="<?php echo esc_attr($address->id); ?>" >
        <?php wp_nonce_field( 'new-mr9' ); ?>
        <?php submit_button(__('Submit Address', 'mr-9'), 'primary', 'submit_address', true, null ); ?>
    </form>
</div>