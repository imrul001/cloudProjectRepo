var db = connect('TestMongoDB');
var titles_emp_no = db.titles.find({},{emp_no:1, title:1, _id:0}).limit(30).toArray();
var emp_no = [];
var title_list = [];
var j = 0;
for(var i=0; i<titles_emp_no.length; i++){
	var obj = titles_emp_no[i];
	emp_no[j] = obj['emp_no'];
	title_list[j] = obj['title'];
	j++;
}

var salaries_details = db.salaries.find( {emp_no:{$in: emp_no} } ).limit(30); 
var t = 0;
while (salaries_details.hasNext()){
	var salary = salaries_details.next();
	print('emp_no '+emp_no[t]+' Title '+title_list[t]+ ' Salary '+salary['salary']);
	t++; 
}
