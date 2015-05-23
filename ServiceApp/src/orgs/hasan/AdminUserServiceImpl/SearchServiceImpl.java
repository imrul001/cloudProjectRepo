package orgs.hasan.AdminUserServiceImpl;

import java.sql.SQLException;
import java.util.List;

import orgs.hasan.business.DbOperationAccess;
import orgs.hasan.userClasses.EmpSearchInfo;

public class SearchServiceImpl {
	
	public List<EmpSearchInfo> getEmployeeById(int emp_no, int limit) throws SQLException{
		DbOperationAccess access = new DbOperationAccess();
		return access.getEmpById(emp_no, limit);
	}

	public List<EmpSearchInfo> getEmployeeByFN(String pattern, int limit) throws SQLException {
		DbOperationAccess access = new DbOperationAccess();
		return access.getEmployeesByFN(pattern,limit);
	}

	public List<EmpSearchInfo> getEmployeeByLN(String pattern, int limit) throws SQLException {
		DbOperationAccess access = new DbOperationAccess();
		return access.getEmployeesByLN(pattern,limit);
	}

	public List<EmpSearchInfo> getEmployeeByGender(String gender, int limit) throws SQLException {
		DbOperationAccess access = new DbOperationAccess();
		return access.getEmployeesByGender(gender,limit);
	}

	public List<EmpSearchInfo> getEmployeesByDept(String dept_no, int limit) throws SQLException {
		DbOperationAccess access = new DbOperationAccess();
		return access.getEmployeesByDept(dept_no,limit);
	}

	public List<EmpSearchInfo> getEmployeesByTitle(String title, int limit) throws SQLException {
		DbOperationAccess access = new DbOperationAccess();
		return access.getEmployeesByTitle(title,limit);
	}

}
