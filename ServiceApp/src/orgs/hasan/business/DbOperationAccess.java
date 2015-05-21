package orgs.hasan.business;

import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ArrayList;
import java.util.List;

import com.mysql.jdbc.PreparedStatement;

import orgs.hasan.mysqlJDBC.MysqlJDBC;
import orgs.hasan.userClasses.Department;
import orgs.hasan.userClasses.EmpSearchInfo;
import orgs.hasan.userClasses.Employee;
import orgs.hasan.userClasses.Title;
import orgs.hasan.utility.Utility;

public class DbOperationAccess {
	
	 public boolean isValidUser(String username, String password) throws SQLException{
		 MysqlJDBC jdbc = new MysqlJDBC();
		 Connection connection = jdbc.getConnection();
		 Statement statement = connection.createStatement();
		 String query = "SELECT * FROM users WHERE username='"+username+"' AND password='"+password+"' limit 1";
		 boolean checkFlag = false;
		 ResultSet resultSet = statement.executeQuery(query);
		 if(resultSet.next()){
			 while(resultSet.next()){
			     int id = resultSet.getInt("userid");
				 System.out.println(id);
			 }
			 checkFlag = true;
		 }
		 boolean flag = jdbc.closeConnection(connection, statement);
		 return checkFlag;
	 }
	 
	 public boolean isValidEmployee(int emp_no) throws SQLException{
		 MysqlJDBC jdbc = new MysqlJDBC();
		 Connection connection = jdbc.getConnection();
		 Statement statement = connection.createStatement();
		 String query = "SELECT * FROM employees WHERE emp_no="+emp_no+"";
		 boolean checkFlag = true;
		 ResultSet resultSet = statement.executeQuery(query);
		 if(resultSet.next()){
			 checkFlag = false;
		 }
		 boolean flag = jdbc.closeConnection(connection, statement);
	     return checkFlag;
	 }
	 
	 public boolean addNewEmployee(Employee employee) throws SQLException{
		 MysqlJDBC jdbc = new MysqlJDBC();
		 Connection connection = jdbc.getConnection();
		 Statement statement = connection.createStatement();
		 
		 String q1 ="INSERT INTO employees (emp_no, first_name, last_name, gender, birth_date, hire_date)"
		 		+ "VALUES ("+employee.getEmp_no()+", '"+employee.getFirst_name()+"','"+employee.getLast_name()+"', '"+employee.getGender()
		 		+"','"+employee.getBirth_date()+"','"+employee.getFrom_date()+"')";
		 statement.executeUpdate(q1);
		 
		 String q2 ="INSERT INTO dept_emp (emp_no, dept_no, from_date, to_date)"
			 		+ "VALUES ("+employee.getEmp_no()+", '"+employee.getDept_no()+"','"+employee.getFrom_date()+"', '"+employee.getTo_date()+"')";
		 statement.executeUpdate(q2);
		 
		 String q3 ="INSERT INTO titles (emp_no, title, from_date, to_date)"
			 		+ "VALUES ("+employee.getEmp_no()+", '"+employee.getTitle()+"','"+employee.getFrom_date()+"', '"+employee.getTo_date()+"')";
		 statement.executeUpdate(q3);
		 
		 String q4 ="INSERT INTO salaries (emp_no, salary, from_date, to_date)"
			 		+ "VALUES ("+employee.getEmp_no()+", "+employee.getSalary()+",'"+employee.getFrom_date()+"', '"+employee.getTo_date()+"')";
		 statement.executeUpdate(q4);
		 boolean flag = jdbc.closeConnection(connection, statement);
		 
		 return true;
	 }
	 
	 public boolean deleteEmployee(int emp_no) throws SQLException{
		 
		 MysqlJDBC jdbc = new MysqlJDBC();
		 Connection connection = jdbc.getConnection();
		 
		 String q1 ="DELETE FROM employees WHERE emp_no="+emp_no;
		 java.sql.PreparedStatement s1 = connection.prepareStatement(q1);
		 s1.executeUpdate(q1);
		 
		 String q2 ="DELETE FROM dept_emp WHERE emp_no="+emp_no;
		 java.sql.PreparedStatement s2 = connection.prepareStatement(q2);
		 s2.executeUpdate(q2);
		 
		 String q3 ="DELETE FROM titles WHERE emp_no="+emp_no;
		 java.sql.PreparedStatement s3 = connection.prepareStatement(q3);
		 s3.executeUpdate(q3);
		 
		 String q4 ="DELETE FROM salaries WHERE emp_no="+emp_no;
		 java.sql.PreparedStatement s4 = connection.prepareStatement(q3);
		 s4.executeUpdate(q4);
		 
		 boolean f1 = jdbc.closeConnection(connection, s1);
		 boolean f2 = jdbc.closeConnection(connection, s2);
		 boolean f3 = jdbc.closeConnection(connection, s3);
		 boolean f4 = jdbc.closeConnection(connection, s4);
		 return true;
	 }
	 
	public List<Department> getDepartmentList() throws SQLException{
		 MysqlJDBC jdbc = new MysqlJDBC();
		 Connection connection = jdbc.getConnection();
		 List<Department> deptList = new ArrayList<Department>();
		 String q1 ="SELECT * FROM departments";
		 java.sql.PreparedStatement s1 = connection.prepareStatement(q1);
		 ResultSet rs = s1.executeQuery(q1);
		 while(rs.next()){
			 Department dept = new Department();
			 String dept_no = rs.getString("dept_no");
			 String dept_name = rs.getString("dept_name");
			 dept.setDept_no(dept_no);
			 dept.setDept_name(dept_name);
			 deptList.add(dept);
		 }
		 return deptList;
	}
	
	public List<Title> getTitleList() throws SQLException{
		 MysqlJDBC jdbc = new MysqlJDBC();
		 Connection connection = jdbc.getConnection();
		 List<Title> titleList = new ArrayList<Title>();
		 String q1 ="SELECT DISTINCT title FROM titles";
		 java.sql.PreparedStatement s1 = connection.prepareStatement(q1);
		 ResultSet rs = s1.executeQuery(q1);
		 while(rs.next()){
			 Title title = new Title();
			 String title_name = rs.getString("title");
			 title.setTitle(title_name);
			 titleList.add(title);
		 }
		 return titleList;
	}
	
	public List<EmpSearchInfo> getEmployeesByFN(String pattern, int limit) throws SQLException {
		 MysqlJDBC jdbc = new MysqlJDBC();
		 Connection connection = jdbc.getConnection();
		 List<EmpSearchInfo> employeeList = new ArrayList<EmpSearchInfo>();
		 String q1 =" SELECT e.emp_no, e.first_name, e.last_name, e.gender, dp.dept_name,t.title"+
	     " FROM employees e,dept_emp de,departments dp,titles t"+
	     " WHERE e.first_name LIKE '%"+pattern+"%' AND e.emp_no=t.emp_no AND dp.dept_no=de.dept_no AND t.emp_no=de.emp_no"+
	     " AND t.from_date IN (SELECT MAX(tt.from_date) FROM titles tt WHERE tt.emp_no=e.emp_no)"+
	     " ORDER BY e.emp_no"+
	     " LIMIT "+limit;
		 java.sql.PreparedStatement s1 = connection.prepareStatement(q1);
		 ResultSet rs = s1.executeQuery(q1);
		 if(rs!=null){
			 while(rs.next()){
				 EmpSearchInfo employee = new EmpSearchInfo();
				 String first_name = rs.getString("first_name");
				 String last_name = rs.getString("last_name");
				 String gender = rs.getString("gender");
				 String dept_name = rs.getString("dept_name"); 
				 String title = rs.getString("title");
				 int emp_no = rs.getInt("emp_no");
				 employee.setEmp_no(emp_no);
				 employee.setFirst_name(first_name);
				 employee.setLast_name(last_name);
				 employee.setGender(gender);
				 employee.setDept_name(dept_name);
				 employee.setTitle(title);
				 employeeList.add(employee);
			 }
			return employeeList;
		 }else{
			 return null;
		 }
	}
	
	public List<EmpSearchInfo> getEmployeesByLN(String pattern, int limit) throws SQLException {
		 MysqlJDBC jdbc = new MysqlJDBC();
		 Connection connection = jdbc.getConnection();
		 List<EmpSearchInfo> employeeList = new ArrayList<EmpSearchInfo>();
		 String q1 =" SELECT e.emp_no, e.first_name, e.last_name, e.gender, dp.dept_name,t.title"+                   
	     " FROM employees e,dept_emp de,departments dp,titles t"+
	     " WHERE e.last_name LIKE '%"+pattern+"%' AND e.emp_no=t.emp_no AND dp.dept_no=de.dept_no AND t.emp_no=de.emp_no"+
	     " AND  t.from_date IN (SELECT MAX(tt.from_date) FROM titles tt WHERE tt.emp_no=e.emp_no)"+
	     " ORDER BY e.emp_no"+
	     " LIMIT "+limit;
		 java.sql.PreparedStatement s1 = connection.prepareStatement(q1);
		 ResultSet rs = s1.executeQuery(q1);
		 if(rs!=null){
			 while(rs.next()){
				 EmpSearchInfo employee = new EmpSearchInfo();
				 String first_name = rs.getString("first_name");
				 String last_name = rs.getString("last_name");
				 String gender = rs.getString("gender");
				 String dept_name = rs.getString("dept_name"); 
				 String title = rs.getString("title");
				 int emp_no = rs.getInt("emp_no");
				 employee.setEmp_no(emp_no);
				 employee.setFirst_name(first_name);
				 employee.setLast_name(last_name);
				 employee.setGender(gender);
				 employee.setDept_name(dept_name);
				 employee.setTitle(title);
				 employeeList.add(employee);
			 }
			return employeeList;
		 }else{
			 return null;
		 }
	}
	
	public EmpSearchInfo getEmpById(int emp_no, int limit) throws SQLException {
		 MysqlJDBC jdbc = new MysqlJDBC();
		 Connection connection = jdbc.getConnection();
		 EmpSearchInfo employee = new EmpSearchInfo();
		 String q1 ="SELECT employees.emp_no, employees.first_name, employees.last_name,employees.gender,departments.dept_name, titles.title, salaries.salary"+
         " FROM employees,dept_emp,departments,titles,salaries"+
         " WHERE employees.emp_no="+emp_no+" AND dept_emp.emp_no="+emp_no+" AND departments.dept_no=dept_emp.dept_no AND titles.emp_no="+emp_no+" AND salaries.emp_no="+emp_no+
         " ORDER BY employees.emp_no "+ 
         " LIMIT "+limit;
		 java.sql.PreparedStatement s1 = connection.prepareStatement(q1);
		 ResultSet rs = s1.executeQuery(q1);
		 if(rs!=null){
			 while(rs.next()){
				 String first_name = rs.getString("first_name");
				 String last_name = rs.getString("last_name");
				 String gender = rs.getString("gender");
				 String dept_name = rs.getString("dept_name"); 
				 String title = rs.getString("title");
				 employee.setEmp_no(emp_no);
				 employee.setFirst_name(first_name);
				 employee.setLast_name(last_name);
				 employee.setGender(gender);
				 employee.setDept_name(dept_name);
				 employee.setTitle(title);
			 }
			return employee;
		 }else{
			 return null;
		 }
	}
	
	public List<EmpSearchInfo> getEmployeesByGender(String gender, int limit) throws SQLException {
		 MysqlJDBC jdbc = new MysqlJDBC();
		 Connection connection = jdbc.getConnection();
		 List<EmpSearchInfo> employees = new ArrayList<EmpSearchInfo>();
		 String q1 =" SELECT e.emp_no, e.first_name, e.last_name, e.gender, dp.dept_name,t.title"+
	     " FROM employees e,dept_emp de,departments dp,titles t"+
	     " WHERE e.gender='"+gender+"' AND e.emp_no=de.emp_no AND dp.dept_no=de.dept_no AND t.emp_no=de.emp_no"+
	     " AND  t.from_date IN (SELECT MAX(tt.from_date) FROM titles tt WHERE tt.emp_no=e.emp_no)"+
	     " ORDER BY e.emp_no"+ 
	     " LIMIT "+limit;
		 java.sql.PreparedStatement s1 = connection.prepareStatement(q1);
		 ResultSet rs = s1.executeQuery(q1);
		 if(rs!=null){
			 while(rs.next()){
				 EmpSearchInfo employee = new EmpSearchInfo();
				 String first_name = rs.getString("first_name");
				 String last_name = rs.getString("last_name");
				 String rs_gender = rs.getString("gender");
				 String dept_name = rs.getString("dept_name"); 
				 String title = rs.getString("title");
				 int emp_no = rs.getInt("emp_no");
				 employee.setEmp_no(emp_no);
				 employee.setFirst_name(first_name);
				 employee.setLast_name(last_name);
				 employee.setGender(rs_gender);
				 employee.setDept_name(dept_name);
				 employee.setTitle(title);
				 employees.add(employee);
			 }
			return employees;
		 }else{
			 return null;
		 }
	}
	
	public List<EmpSearchInfo> getEmployeesByDept(String dept_no, int limit) throws SQLException {
		 MysqlJDBC jdbc = new MysqlJDBC();
		 Connection connection = jdbc.getConnection();
		 List<EmpSearchInfo> employees = new ArrayList<EmpSearchInfo>();
		 String q1 =" SELECT e.emp_no, e.first_name, e.last_name, e.gender, dp.dept_name,t.title"+ 
	     " FROM employees e,dept_emp de, departments dp,titles t"+
	     " WHERE de.dept_no='"+dept_no+"' AND e.emp_no=de.emp_no AND dp.dept_no='"+dept_no+"' AND t.emp_no=de.emp_no"+            
	     " AND  t.from_date IN (SELECT MAX(tt.from_date) FROM titles tt WHERE tt.emp_no=e.emp_no)"+
		 " ORDER BY e.emp_no"+  
	     " LIMIT "+limit;
		 java.sql.PreparedStatement s1 = connection.prepareStatement(q1);
		 ResultSet rs = s1.executeQuery(q1);
		 if(rs!=null){
			 while(rs.next()){
				 EmpSearchInfo employee = new EmpSearchInfo();
				 String first_name = rs.getString("first_name");
				 String last_name = rs.getString("last_name");
				 String rs_gender = rs.getString("gender");
				 String dept_name = rs.getString("dept_name"); 
				 String title = rs.getString("title");
				 int emp_no = rs.getInt("emp_no");
				 employee.setEmp_no(emp_no);
				 employee.setFirst_name(first_name);
				 employee.setLast_name(last_name);
				 employee.setGender(rs_gender);
				 employee.setDept_name(dept_name);
				 employee.setTitle(title);
				 employees.add(employee);
			 }
			return employees;
		 }else{
			 return null;
		 }
	}
	
	public List<EmpSearchInfo> getEmployeesByTitle(String title, int limit) throws SQLException {
		 MysqlJDBC jdbc = new MysqlJDBC();
		 Connection connection = jdbc.getConnection();
		 List<EmpSearchInfo> employees = new ArrayList<EmpSearchInfo>();
		 String q1 =" SELECT e.emp_no, e.first_name, e.last_name, e.gender, dp.dept_name,t.title"+
	     " FROM employees e,dept_emp de,departments dp,titles t"+
	     " WHERE t.title='"+title+"' AND e.emp_no=t.emp_no AND dp.dept_no=de.dept_no AND t.emp_no=de.emp_no"+
	     " AND  de.from_date IN (SELECT MAX(dd.from_date) FROM dept_emp dd WHERE dd.emp_no=e.emp_no)"+
	     " ORDER BY e.emp_no"+  
	     " LIMIT "+limit;
		 java.sql.PreparedStatement s1 = connection.prepareStatement(q1);
		 ResultSet rs = s1.executeQuery(q1);
		 if(rs!=null){
			 while(rs.next()){
				 EmpSearchInfo employee = new EmpSearchInfo();
				 String first_name = rs.getString("first_name");
				 String last_name = rs.getString("last_name");
				 String rs_gender = rs.getString("gender");
				 String dept_name = rs.getString("dept_name"); 
				 String res_title = rs.getString("title");
				 int emp_no = rs.getInt("emp_no");
				 employee.setEmp_no(emp_no);
				 employee.setFirst_name(first_name);
				 employee.setLast_name(last_name);
				 employee.setGender(rs_gender);
				 employee.setDept_name(dept_name);
				 employee.setTitle(res_title);
				 employees.add(employee);
			 }
			return employees;
		 }else{
			 return null;
		 }
	}
	 
	 
	public static void main(String args[]) throws SQLException{
		 
		 DbOperationAccess access = new DbOperationAccess();
		 
		 
		 List<EmpSearchInfo> employees = new ArrayList<EmpSearchInfo>();
		 employees = access.getEmployeesByTitle("Staff", 10);
		 
		 for(EmpSearchInfo empSearchInfo : employees){
			 System.out.println(empSearchInfo.getFirst_name()+" "+empSearchInfo.getEmp_no()+" "+empSearchInfo.getGender());
		 }
	     System.out.println("End");
		 
//		 EmpSearchInfo empSearchInfo = new EmpSearchInfo();
//		 empSearchInfo = access.getEmpById(10001, 1);
//		 System.out.println(empSearchInfo.getFirst_name());
//		 List<Department> deptList = new ArrayList<Department>();
//		 deptList = access.getDepartmentList();
//		 for(Department dept : deptList){
//			 System.out.print(dept.getDept_name()+" "+dept.getDept_no());
//		 }
		 
//		 if(access.isValidEmployee(1)){
//			 Employee employee = new Employee();
//			 employee.setEmp_no(1);
//			 employee.setFirst_name("Imrul");
//			 employee.setLast_name("hasan");
//			 employee.setGender("M");
//			 employee.setBirth_date(Utility.getDateFromString("11/09/1988"));
//			 employee.setFrom_date(Utility.getDateFromString("11/04/2015"));
//			 employee.setTo_date(Utility.getDateFromString("11/04/2015"));
//			 employee.setDept_no("d001");
//			 employee.setSalary(20000);
//			 employee.setTitle("Staff");
//			 if(access.addNewEmployee(employee)){
//				 System.out.println("Valid");
//			 }
//		 }else{
//			 System.out.println("Invalid");
//			 if(access.deleteEmployee(1)){
//				 System.out.println("Deleted Successfully");
//			 }else{
//				 System.out.println("Deletion Failed");
//			 }
//		 }
	 }

}
