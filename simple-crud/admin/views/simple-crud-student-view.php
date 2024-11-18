<?php
global $wpdb;

// Fetch all student data from the database
$allData = $wpdb->get_results(
    "SELECT * FROM simple_crud",
    ARRAY_A
);
?>
<div class="container student-info">
    <h1>Student Management CRUD</h1>
    <table class="table student-list-view" id="table">
        <thead>
            <tr>
                <th><?php echo esc_html( 'ID', 'simple-crud' ); ?></th>
                <th><?php echo esc_html( 'Student Name', 'simple-crud' ); ?></th>
                <th><?php echo esc_html( 'Student ID', 'simple-crud' ); ?></th>
                <th><?php echo esc_html( 'Email', 'simple-crud' ); ?></th>
                <th><?php echo esc_html( 'Message', 'simple-crud' ); ?></th>
                <th><?php echo esc_html( 'Action', 'simple-crud' ); ?></th>
            </tr>
        </thead>
        <tbody id="tbody">
            <?php if ( ! empty( $allData ) ) : ?>
                <?php foreach ( $allData as $single_data ) : ?>
                    <tr>
                        <td><?php echo esc_html( $single_data['id'] ); ?></td>
                        <td><?php echo esc_html( $single_data['student_name'] ); ?></td>
                        <td><?php echo esc_html( $single_data['student_id'] ); ?></td>
                        <td><?php echo esc_html( $single_data['student_email'] ); ?></td>
                        <td><?php echo esc_html( $single_data['student_message'] ); ?></td>
                        <td>
                            <a href="<?php echo esc_url( admin_url( 'admin.php?page=simple-crud-add&action=view&id=' . intval( $single_data['id'] ) ) ); ?>">
                                <span class="dashicons dashicons-list-view"></span>
                            </a>
                            <a href="<?php echo esc_url( admin_url( 'admin.php?page=simple-crud-add&action=edit&id=' . intval( $single_data['id'] ) ) ); ?>">
                                <span class="dashicons dashicons-edit"></span>
                            </a>
                            <a href="<?php echo esc_url( admin_url( 'admin.php?page=simple-crud-add&action=delete&id=' . intval( $single_data['id'] ) ) ); ?>" onclick="return confirm('Are you sure you want to delete this record?');">
                                <span class="dashicons dashicons-trash"></span>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="6"><?php echo esc_html( 'No data available.', 'simple-crud' ); ?></td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
