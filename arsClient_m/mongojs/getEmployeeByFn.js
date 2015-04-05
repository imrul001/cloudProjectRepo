// ouput format: emp_no, first_name, last_name, gender, department, title

var db = connect('TestMongoDB');
var titles_emp_no = db.employees.find({"first_name": /.*mar.*/},{emp_no:1,first_name:1,last_name:1,gender:1, _id:0}).limit(5).toArray();

var emp_no = [];
var j = 0;
for(var i=0; i<titles_emp_no.length; i++){
	var obj = titles_emp_no[i];
	emp_no[j] = obj['emp_no'];
	print(emp_no[j]+" "+obj['first_name'])
	j++;
}

// var emp_dept = db.dept_emp.find({emp_no:{$in: emp_no} },{dept_no:1,emp_no:1,_id:0}).toArray(); 
var e = [];
var emp_dept = [];
for(var i=0; i<titles_emp_no.length; i++){
	var obj = titles_emp_no[i];
    e[i]=obj['emp_no'];
	emp_dept[i] = db.dept_emp.findOne({"emp_no":e[i]},{dept_no:1,emp_no:1,_id:0}); 
	print(emp_dept[i].dept_no+" "+emp_dept[i].emp_no)
}


// var dept_no = [];
// var emp_no1 = [];
// var k=0
// for(var i=0; i<emp_dept.length; i++){
// 	var obj = emp_dept[i];
// 	dept_no[k] = obj['dept_no'];
// 	emp_no1[k] = obj['emp_no'];
// 	print(dept_no[k]+" "+emp_no1[k])
// 	k++;
// }

// print(emp_dept);

