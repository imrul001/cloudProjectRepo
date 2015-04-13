package orgs.hasan.AdminUserServiceImpl;

import java.sql.SQLException;

import orgs.hasan.business.DbOperationAccess;
import orgs.hasan.userClasses.Employee;

public class HRServiceImpl {
	public boolean addNewEmployee(Employee employee) throws SQLException{
		DbOperationAccess access = new DbOperationAccess();
		boolean checkflag = false;
		if(access.isValidEmployee( employee.getEmp_no())){
			access.addNewEmployee(employee);
			checkflag = true;
		}
		return checkflag;
	}
	
	public boolean deleteEmployee(int emp_no) throws SQLException{
		DbOperationAccess access = new DbOperationAccess();
		boolean checkflag = false;
		if(access.isValidEmployee(emp_no)){
			access.deleteEmployee(emp_no);
			checkflag = true;
		}
		return checkflag;
	}
}
