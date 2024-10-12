<div class="wrap">
    <h1 class="wp-heading-inline" >
        <?php _e('New Address', 'mr-9') ?>
    </h1>

    <form action="" method="">
        <table class="form-table">
           <tbody>
                <tr scope="row">
                    <th>
                        <label for="name"><?php _e('Name', 'mr-9' ) ?></label>
                    </th>
                    <td>
                        <input type="text" placeholder="Name" name="name" id="name" class="regular-text">
                    </td>
                </tr>
                <tr scope="row">
                    <th>
                        <label for="address"><?php _e('Address', 'mr-9' ) ?></label>
                    </th>
                    <td>
                        <input type="text" placeholder="address" name="address" id="address" class="regular-text">
                    </td>
                </tr>
                <tr scope="row">
                    <th>
                        <label for="phone"><?php _e('Phone', 'mr-9' ) ?></label>
                    </th>
                    <td>
                        <input type="text" placeholder="Phone" name="phone" id="phone" class="regular-text">
                    </td>
                </tr>
           </tbody>
        </table>
        <?php submit_button(__('Submit Address', 'mr-9'), 'primary', 'submit', true, null ); ?>
    </form>
</div>