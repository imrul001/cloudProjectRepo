<?php
		set_time_limit(0);
	// connect to mongodb
		$m = new MongoClient();  
    // select a database
		$db = $m->employees;
	// connect to mysql
		$con = mysql_connect("localhost", "root", "123imrul");
		$con or die(mysql_error());
		mysql_select_db("employees") or die(mysql_error());

	// selecting all from table "locations" : successful!
		$result = mysql_query("SELECT * FROM employees ORDER BY emp_no") 
		or die(mysql_error()); 
     
	// Loop through each row in the result set	
	while($row = mysql_fetch_assoc($result))
	{
		
		//table: dept_emp
		$dept_emp = mysql_query("SELECT * FROM dept_emp WHERE emp_no=".$row["emp_no"])
		or die(mysql_error());
		
		$i=0;$a="";$b="";$c="";$d="";
		while($rde = mysql_fetch_assoc($dept_emp))
		{    $dn="";	
			//table: departments
			$dept = mysql_query("SELECT * FROM departments WHERE dept_no='".$rde["dept_no"]."'")
			or die(mysql_error());
					
			while($rd = mysql_fetch_assoc($dept))$dn=$rd["dept_name"];
				
			$a[$i]=array("from_date" => new MongoDate(strtotime($rde["from_date"])),
				"to_date"=>new MongoDate(strtotime($rde["to_date"])),
				"dept_name"=>$dn,
				"dept_no"=>$rde["dept_no"]);
			$i=$i+1; 
		}
		
		//table: dept_manager
		$dept_manager = mysql_query("SELECT * FROM dept_manager WHERE emp_no=".$row["emp_no"])
		or die(mysql_error());
		
		$i=0;
		while($rdm = mysql_fetch_assoc($dept_manager))
		{    $dn="";	
			//table: departments
			$dept = mysql_query("SELECT * FROM departments WHERE dept_no='".$rde["dept_no"]."'")
			or die(mysql_error());
					
			while($rdm = mysql_fetch_assoc($dept))$dn=$rd["dept_name"];
						
			$b[$i]=array("from_date" => new MongoDate(strtotime($rdm["from_date"])),"to_date"=>new MongoDate(strtotime($rdm["to_date"])),"dept_name"=>$dn);
			$i=$i+1; 
		}
		
		//table: salaries
		$salaries = mysql_query("SELECT * FROM salaries WHERE emp_no=".$row["emp_no"])
		or die(mysql_error());
		
		$i=0;
		while($rs = mysql_fetch_assoc($salaries))
		{  					
			
			$c[$i]= array("from_date" => new MongoDate(strtotime($rs["from_date"])),"to_date"=>new MongoDate(strtotime($rs["to_date"])),"salary"=> (int) $rs["salary"]);
			$i=$i+1;
		}	
		
		//table: titles
		$titles = mysql_query("SELECT * FROM titles WHERE emp_no=".$row["emp_no"])
		or die(mysql_error());
		$i=0;	
		while($rt = mysql_fetch_assoc($titles))
		{ 				
			
			$d[$i]=array("from_date" => new MongoDate(strtotime($rt["from_date"])),"to_date"=>new MongoDate(strtotime($rt["to_date"])),"title"=>$rt["title"]);
			$i=$i+1;
		}
		
		//set document
		$doc_emp = array( 
							"emp_no" => (int) $row["emp_no"],
							"birth_date" => new MongoDate(strtotime($row["birth_date"])),
							"first_name" => $row["first_name"],		
							"last_name" => $row["last_name"],		
							"gender" => $row["gender"],
							"hire_date" => new MongoDate(strtotime($row["hire_date"])),
							"dept_emp" => $a,
							"dept_manager" => $b,
							"salaries" => $c,
							"titles" => $d
        );
		
		//insert employees document to mongodb	
		$db->empCollection->insert($doc_emp);
		
		
		//clear array 
		unset($a);unset($b);unset($c); unset($d);
				
	}
	//	table: users	
	$users = mysql_query("SELECT * FROM users")
		      or die(mysql_error());
	while($ru = mysql_fetch_assoc($users))
	{ 				
		$doc_user = array( 
						"userid" => (int) $ru["userid"],
						"username" => $ru["username"],		
						"password" => $ru["password"]		
					);
		//insert users document to mongodb	
		$db->users->insert($doc_user);
	}
	   
echo "Document inserted successfully";
// closing connection : successful!
mysql_close($con);
?>