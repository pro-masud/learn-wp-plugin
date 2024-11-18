<div class="form">      
    <div class="tab-content">
        <div id="signup">   
            <h1 class="simple-crud-title">Sign Up for Free</h1>

            <form class="simple-crud-form" action="<?php echo $_SERVER['PHP_SELF']; ?>?page=simple-crud-add" method="post">
                <div class="top-row">
                    <div class="field-wrap">
                        <input type="text" name="student_name" placeholder="Student Name" />
                    </div>
                
                    <div class="field-wrap">
                        <input type="text" name="student_id" placeholder="Student ID"/>
                    </div>
                </div>
                <div class="field-wrap">
                    <input type="email" name="student_email" placeholder="Student Email" />
                </div>
                <div class="field-wrap">
                    <textarea placeholder="Message" name="student_msg" ></textarea>
                </div>
                <button type="submit" name="insert-student-btn" class="button button-block">Get Started</button>
            </form>

        </div>
    </div><!-- tab-content -->
</div> <!-- /form -->