<?php 

global $wpdb;

$action 	= isset( $_GET['action'] ) ? trim( $_GET['action'] ) : '';
$id 		= isset( $_GET['id'] ) ? intval( $_GET['id'] ) : 0;

// Use $wpdb->prepare for safer SQL query
$simple_data = $wpdb->get_row(
    $wpdb->prepare("SELECT * FROM simple_crud WHERE id = %d", $id),
    ARRAY_A
);

// Check if $simple_data has data and assign default values
$student_name  = $simple_data['student_name'] ?? '';
$student_id    = $simple_data['student_id'] ?? '';
$student_email = $simple_data['student_email'] ?? '';
$student_msg   = $simple_data['student_message'] ?? '';

?>
<div class="form">      
    <div class="tab-content">
        <div id="signup">   
            <h1 class="simple-crud-title">Student Form</h1>
            <form action="<?php echo esc_url(add_query_arg(['page' => 'simple-crud-add', 'action' => $action, 'id' => $id], admin_url('admin.php'))); ?>" method="post">
                <div class="field-wrap">
                    <input type="text" name="student_name" placeholder="Student Name" value="<?php echo esc_attr($student_name); ?>" required />
                </div>
                <div class="field-wrap">
                    <input type="text" name="student_id" placeholder="Student ID" value="<?php echo esc_attr($student_id); ?>" required />
                </div>
                <div class="field-wrap">
                    <input type="email" name="student_email" placeholder="Student Email" value="<?php echo esc_attr($student_email); ?>" required />
                </div>
                <div class="field-wrap">
                    <textarea name="student_msg" placeholder="Message"><?php echo esc_textarea($student_msg); ?></textarea>
                </div>
                <button type="submit" name="insert-student-btn" class="button button-block">Submit</button>
            </form>
        </div>
    </div><!-- tab-content -->
</div> <!-- /form -->
