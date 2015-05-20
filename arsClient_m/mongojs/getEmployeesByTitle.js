var db = connect('TestMongoDB');
var limit = 5;
var title = "Staff";
var titleObject = db.titles.find({"title": title},{emp_no:1,_id:0}).limit(limit).toArray();
var emp_no = [];
var j =0;
for(var i=0; i < titleObject.length; i++){
	var obj = titleObject[i];
	emp_no[j] = obj["emp_no"];
	print (emp_no[j])
	j++;
}
var empList = db.employees.find( { emp_no:{$in: emp_no} },{emp_no:1,first_name:1,last_name:1,gender:1} ).limit(3).toArray();
var titlesList = db.titles.find( { emp_no:{$in: emp_no} },{title:1,emp_no:1} ).toArray();
var jsonPretty = JSON.stringify(titlesList,null,2);
// for(var i = 0; i<empObject.length; i++){
// 	print (empObject[i].first_name);
// }
print (jsonPretty);