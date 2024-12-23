<div class="wrap">
    <h1 class="wp-heading-inline" >
        <?php _e('New Address', 'mr-9') ?>
    </h1>
    <form action="" method="post">
        <table class="form-table">
           <tbody>
                <tr scope="row <?php echo $this->has_error( 'name' ) ? 'form-invalid' : ''; ?>" >
                    <th>
                        <label for="name"><?php _e('Name', 'mr-9' ) ?></label>
                    </th>
                    <td>
                        <input type="text" placeholder="Name" name="name" id="name" class="regular-text">
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
                        <textarea name="address" placeholder="address" id="address" class="regular-text"></textarea>
                    </td>
                </tr>
                <tr scope="row <?php echo $this->has_error( 'phone' ) ? 'form-invalid' : ''; ?>">
                    <th>
                        <label for="phone"><?php _e('Phone', 'mr-9' ) ?></label>
                    </th>
                    <td>
                        <input type="text" placeholder="Phone" name="phone" id="phone" class="regular-text">
                        <?php if( $this->has_error( 'phone' ) ){ ?>
                            <p class="description error"><?php echo $this->get_errors( 'phone' ); ?></p>
                        <?php } ?>
                    </td>
                </tr>
           </tbody>
        </table>
        <?php wp_nonce_field( 'new-mr9' ); ?>
        <?php submit_button(__('Submit Address', 'mr-9'), 'primary', 'submit_address', true, null ); ?>
    </form>
</div>