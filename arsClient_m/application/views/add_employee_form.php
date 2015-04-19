<form class="form-horizontal">
    <fieldset>

        <!-- Form Name -->
        <legend>Add Employee Form</legend>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="emp_no">Employee No</label>  
            <div class="col-md-5">
                <input id="emp_no" name="emp_no" type="text" placeholder="Enter Employee No." class="form-control input-md">

            </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="firstname">First Name</label>  
            <div class="col-md-5">
                <input id="first_name" name="firstname" type="text"  class="form-control input-md">

            </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="lastName">Last Name</label>  
            <div class="col-md-5">
                <input id="last_name" name="lastName" type="text"  class="form-control input-md">

            </div>
        </div>

        <!-- Multiple Radios (inline) -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="gender">Gender</label>
            <div class="col-md-4"> 
                <label class="radio-inline" for="gender-0">
                    <input type="radio" name="gender" id="gender-0" value="M" checked="checked">
                    Male
                </label> 
                <label class="radio-inline" for="gender-1">
                    <input type="radio" name="gender" id="gender-1" value="F">
                    Female
                </label>
            </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="dob">Date of Birth</label>  
            <div class="col-md-5">
                <input id="birth_date" name="dob" type="text" placeholder="Enter Date of Birth" class="form-control input-md">

            </div>
        </div>


        <!-- Select Basic -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="deptname">Department</label>
            <div class="col-md-5">
                <select id="dept_no" name="deptname" class="form-control">
                    <?php
                    if (!empty($dept)) {
                        foreach ($dept as $row) {
                            echo '<option value=' . $row . '>' . $row . '</option>';
                        }
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label" for="title">Title</label>
            <div class="col-md-5">
                <select id="title" name="deptname" class="form-control">
                    <?php
                    if (!empty($positions)) {
                        foreach ($positions as $row) {
                            echo '<option value' . $row . '>' . $row . '</option>';
                        }
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label" for="fromdate">From Date</label>  
            <div class="col-md-5">
                <input id="from_date" name="fromdate" type="text"  class="form-control input-md">

            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label" for="todate">To Date</label>  
            <div class="col-md-5">
                <input id="to_date" name="todate" type="text"  class="form-control input-md">

            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label" for="todate">Salary</label>  
            <div class="col-md-5">
                <input id="salary" name="salary" type="text"  class="form-control input-md">

            </div>
        </div>

        <!-- Button -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="insertButton"></label>
            <div class="col-md-4">
                <button id="addemployee_button" name="insertButton" class="btn btn-primary">Submit</button>
                <button id="clearemployee_button" name="insertButton" class="btn btn-primary">Clear</button><br>
            </div>
        </div>

    </fieldset>
</form>
