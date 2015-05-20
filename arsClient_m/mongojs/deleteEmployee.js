var db = connect('TestMongoDB');
var emp_no=1;
var checkEmp = db.employees.find({"emp_no": emp_no}).count();
if(checkEmp == 1){

	db.employees.remove({"emp_no":1});
	db.titles.remove({"emp_no":1});
	db.dept_emp.remove({"emp_no":1});
	db.salaries.remove({"emp_no":1});

}else{
	print("Nothing to delete");
}




