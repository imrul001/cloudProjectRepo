<style>
    #searchBox{
        left: 20px;
        position: relative;
        width: 266px;
        height: 27px;
        background: #f2f2f2;
    }
    #fieldSearch{
        width: 185px;
    }
    #searchForm:hover{
        background-position: -546px 106px;
    }
    .studentIdLabel{
        font-weight: normal;
        line-height: 8px;
        margin-left: 210px;
        float: left;
    }
    #fieldsearch {
        left: 0px;
        position: relative;
        width: 185px;
        margin-left: 10px;
        top: 10px;
    }
    .searchButton{
        position: relative;
        top: 10px;
        margin-left: 10px
    }
    .subButton{
        border: 1px solid #DDD;
        background-color: #F2F2F2;
        color: black;
        text-transform: uppercase;
        text-decoration: none;
        padding: 4px;
        margin-right: 5px;
    }
    .hoverButtonClass{
        border: 1px solid blue;
    }
    .searchFormClass{
        border: 1px solid #DDD;
        width: 900px;
        height: auto;
        overflow: hidden;
        clear: both;
        padding: 10px
    }
    #dynamic_filtering_tab{
        overflow: hidden;
        position: relative;
        width: 83%;
        margin: 0 auto;
    }
    #batchInputField{
        padding-left: 10px;
    }
    #submitDiv{
        padding-left: 10px;
    }
    .filteringParamSelection{
        float: left;
        margin: 1%;
    }
    .resultContainer{
        padding-top: 3%;
    }
</style>
<div id="dynamic_filtering_tab">
    <div class="filteringParamSelection">
        <select id="paramSelector">
            <option value="emp_id" nameVal="Employee Id">Employee Id</option>
            <option value="first_name" nameVal="First Name">First Name</option>
            <option value="last_name" nameVal="Last Name">Last Name</option>
            <option value="gender" nameVal="Gender">Gender</option>
            <option value="dept" nameVal="Department">Department</option>
            <option value="post" nameVal="Postiton">Position</option>
            <option value="salary" nameVal="Salary">Salary</option>
        </select>
    </div>
    <div class="filteringParamSelection">
        <span id="searchParamLabel" style="float: left;">Employee ID:</span>
        <div id="inputField" style="float: left;">
            <input style="float: left;" type="text" id="paramField" name="emp_id" value="" />
            <select id="gender" style="display:none">
                <option value="M">Male</option>
                <option value="F">Female</option>
            </select>
            <select id="dept" style="display: none;">
                <?php
                if (!empty($dept)) {
                    foreach ($dept as $row) {
                        echo '<option value=' . $row->dept_no . '>' . $row->dept_name . '</option>';
                    }
                }
                ?>
            </select>
            <select id="post" style="display: none;">
                <?php
                if (!empty($positions)) {
                    foreach ($positions as $row) {
                        echo '<option value' . $row->title . '>' . $row->title . '</option>';
                    }
                }
                ?>
            </select>
        </div>

        <div id="rowInputField" style="float: left; padding-left: 10px;">
            <div style="float:left;">Row count:</div>
            <div style="float:left;"><input type="text" name="rowNumber" disabled="disabled" id="rowNumber" value="1" /></div>
        </div>

        <div id="submitDiv" style="float:left;">
            <input type="submit" id="submitBTn" value="submit" />
        </div>
    </div>

    <form id="searchForm" method="POST" action="#">
        <input type="hidden" class="hiddenFld" name="method" id="method" value="" />
        <input type="hidden" class="hiddenFld" name="methodValue" id="method_value" value="" />
        <input type="hidden" class="hiddenFld" name="rowCount" id="row_count" value="" />
        <input type="hidden" class="hiddenFld" name="type" id="type" value="dynamic_search" />
    </form>
    <div class="resultContainer" id="search_result_table"></div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        getLabel();
        getSearchParamList();
        submitSearch();
    })
</script>                   
<script>
    function getLabel() {
        $('#paramSelector').on("change", function () {
            $("#searchParamLabel").html($('option:selected', this).attr("nameVal") + ": ");
            $('#paramField').val("");	
        })
    }
    function getSearchParamList() {
        $('#paramSelector').on("change", function () {
            if ($('option:selected', this).val() == 'gender') {
                hideAll();
                rowCountEnable();
                $('#paramField').attr('name', 'gender')
                $('#gender').show();
            }
            if ($('option:selected', this).val() == 'dept') {
                hideAll();
                rowCountEnable();
                $('#paramField').attr('name', 'dept')
                $('#dept').show();
            }
            if ($('option:selected', this).val() == 'post') {
                hideAll();
                rowCountEnable()
                $('#paramField').attr('name', 'post')
                $('#post').show();
            }
            if ($('option:selected', this).val() == 'emp_id') {
                hideAll();
                rowCountDisable();
                $('#paramField').attr('name', 'emp_id')
                $('#paramField').show();
            }
            if ($('option:selected', this).val() == 'first_name') {
                hideAll();
                rowCountEnable()
                $('#paramField').attr('name', 'first_name')
                $('#paramField').show();
            }
            if ($('option:selected', this).val() == 'last_name') {
                hideAll();
                rowCountEnable();
                $('#paramField').attr('name', 'last_name')
                $('#paramField').show();
            }
            if ($('option:selected', this).val() == 'salary') {
                hideAll();
                rowCountEnable();
                $('#paramField').attr('name', 'salary')
                $('#paramField').show();
            }
        })
    }
    function hideAll() {
        $('#gender').hide();
        $('#dept').hide();
        $('#post').hide();
        $('#paramField').hide();
    }
    function submitSearch() {
        $("#submitBTn").on("click", function () {
            if ($('#paramField').attr("name") == "emp_id" || $('#paramField').attr("name") == "salary" || $('#paramField').attr("name") == "first_name" || $('#paramField').attr("name") == "last_name") {
                if ($('#paramField').val() != "") {
                    $('#method').val($('#paramField').attr("name"));
                    $('#method_value').val($('#paramField').val());
                    $('#row_count').val($('#rowNumber').val());
                    if($('#paramField').attr("name") == "emp_id"){
                    	postQueryParam('getEmployeeById');
                    }
                    if($('#paramField').attr("name") == "first_name"){
                    	postQueryParam('getEmployeeByFn');
                    }
                    if($('#paramField').attr("name") == "last_name"){
                    	postQueryParam('getEmployeeByLn');
                    }

                } else {
                    alert("Empty Input Field");
                }
            } else {
                $('#method').val($('#paramField').attr("name"));
                $('#method_value').val($('#' + $('#paramField').attr("name")).val());
                $('#row_count').val($('#rowNumber').val());
                if($('#paramField').attr("name") == "dept"){
                	postQueryParam('getEmployeesByDept');
                }
                if($('#paramField').attr("name") == "gender"){
                	postQueryParam('getEmployeesByGender');
                }
                if($('#paramField').attr("name") == "post"){
                	postQueryParam('getEmployeeByTitle');
                }
            }

        })
    }

    function postQueryParam(methodName) {
        var url = "<?php echo base_url(); ?>index.php/search_control/" + methodName;
        $.ajax({
            type: "POST",
            url: url,
            data: $("#searchForm").serialize(),
            success: function (data) {
                $("#search_result_table").html(data);
            },
            failure: function () {
                alert("error");
            }
        });
        return false;

    }

    function rowCountDisable(){
    	$("#rowNumber").attr("disabled","disabled")    
    	$("#rowNumber").val(1);
    }
    function rowCountEnable(){
    	$("#rowNumber").removeAttr("disabled")
    }
</script>