// ouput format: emp_no, first_name, last_name, gender, department, title

var db = connect('TestMongoDB');
var empObject = db.employees.find({"emp_no": 10001},{emp_no:1,first_name:1,last_name:1,gender:1, _id:0}).limit(1).toArray();
var deptObject = db.dept_emp.findOne({"emp_no": 10001},{dept_no:1, _id:1});
var titleObject = db.titles.findOne({"emp_no": 10001},{title:1, _id:1});
var deptNameObject = db.departments.findOne({"dept_no": deptObject.dept_no},{dept_name:1, _id:1});
print(empObject[0].emp_no+""+deptNameObject.dept_name+" "+titleObject.title);
var jsonObject = {
	"emp_no": empObject[0].emp_no,
	"first_name": empObject[0].first_name,
    "last_name": empObject[0].last_name,
    "gender": empObject[0].gender,
    "dept_name": deptNameObject.dept_name,
    "title": titleObject.title
}
print(jsonObject.emp_no);


