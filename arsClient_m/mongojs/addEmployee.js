var db = connect('test');
var empCheck = db.employees.find({"emp_no":1},{emp_no:1, first_name:1}).count();

// Demo Information
var emp_no=1;
var first_name ="Imrul";
var last_name ="Hasan";
var gender = "M";
var birthdate= "1988-09-11";
var hire_date = "2015-02-11";
var dept_no = "d001";
var to_date = "2100-02-11";
var title = "Staff";
var salary = 25000;


if(empCheck == 0){
     db.employees.insert({"emp_no": emp_no, "first_name":first_name, "last_name":last_name, "gender": gender,
		"birth_date":new Date(birthdate),"hire_date":new Date(hire_date)});
	db.dept_emp.insert({"emp_no": emp_no, "dept_no": dept_no,"from_date":new Date(hire_date),"to_date":new Date(to_date)});
	db.titles.insert({"emp_no": emp_no, "title": title,"from_date":new Date(hire_date),"to_date":new Date(to_date)});
	db.salaries.insert({"emp_no": emp_no, "salary": salary,"from_date":new Date(hire_date),"to_date":new Date(to_date)});
 }else{
	print("Documents exists")
}
