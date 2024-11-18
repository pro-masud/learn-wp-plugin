<?php
    global $wpdb;

    $allData = $wpdb->get_results(
        $wpdb->prepare( "SELECT * FROM  simple_crud", ""),
        ARRAY_A
    );
?>
<div class="container">
    <h1>Student Management CRUD</h1>
    <table class="table student-list-view" id="table">
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
                    <td><?php echo esc_html( $single_data['id'], 'simple-crud' ); ?></td>
                    <td><?php echo esc_html( $single_data['student_name'], 'simple-crud' ); ?></td>
                    <td><?php echo esc_html( $single_data['student_id'], 'simple-crud' ); ?></td>
                    <td><?php echo esc_html( $single_data['student_email'], 'simple-crud' ); ?></td>
                    <td><?php echo esc_html( $single_data['student_message'], 'simple-crud' ); ?></td>
                    <td>
                        <a href=""><span class="dashicons dashicons-list-view"></span></a>
                        <a href=""><span class="dashicons dashicons-edit"></span></a>
                        <a href=""><span class="dashicons dashicons-trash"></span></a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>