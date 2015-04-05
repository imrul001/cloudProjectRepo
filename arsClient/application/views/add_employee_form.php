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
  <input id="firstname" name="firstname" type="text" placeholder="Enter First Name" class="form-control input-md">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="lastName">Last Name</label>  
  <div class="col-md-5">
  <input id="lastName" name="lastName" type="text" placeholder="Enter Lastname" class="form-control input-md">
    
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
  <input id="dob" name="dob" type="text" placeholder="Enter Date of Birth" class="form-control input-md">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="hiredate">Hire Date</label>  
  <div class="col-md-5">
  <input id="hiredate" name="hiredate" type="text" placeholder="Enter Hire Date" class="form-control input-md">
    
  </div>
</div>

<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="deptname">Department</label>
  <div class="col-md-5">
    <select id="deptname" name="deptname" class="form-control">
      <option value="">Customer Service</option>
    </select>
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="insertButton"></label>
  <div class="col-md-4">
    <button id="insertButton" name="insertButton" class="btn btn-primary">Submit</button>
  </div>
</div>

</fieldset>
</form>
