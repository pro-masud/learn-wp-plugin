<?php
    global $wpdb;

    $allData = $wpdb->get_results(
        $wpdb->prepare( "SELECT * FROM  simple_crud", ""),
        ARRAY_A
    );
?>
<div class="container">
    <h1>Student Management CRUD</h1>
    <table class="table" id="table">
        <thead>
            <tr>
                <th><?php echo esc_html( 'ID', 'simple-crud'); ?></th>
                <th><?php echo esc_html( 'Student Name', 'simple-crud'); ?></th>
                <th><?php echo esc_html( 'Student ID', 'simple-crud'); ?></th>
                <th><?php echo esc_html( 'Email', 'simple-crud'); ?></th>
                <th><?php echo esc_html( 'Message', 'simple-crud'); ?></th>
                <th><?php echo esc_html( 'Action', 'simple-crud'); ?></th>
            </tr>
        </thead>
        <tbody id="tbody">
            <?php foreach($allData as $index => $single_data ){ ?>
                <tr>
                    <td>01</td>
                    <td>Masud Rana</td>
                    <td>42240101334</td>
                    <td>promasudbd@gmail.com</td>
                    <td>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Vero, architecto?</td>
                    <td>
                        <a href="">Edite</a>
                        <a href="">view</a>
                        <a href="">delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>