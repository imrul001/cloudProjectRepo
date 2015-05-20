package orgs.hasan.AdminUserServiceImpl;

import java.sql.SQLException;
import java.util.ArrayList;
import java.util.List;

import orgs.hasan.business.DbOperationAccess;
import orgs.hasan.userClasses.Department;
import orgs.hasan.userClasses.Title;

public class UtilityServiceImpl {

	public List<Department> getDepartments() throws SQLException{
		DbOperationAccess access = new DbOperationAccess();
		List<Department> deptList = new ArrayList<Department>();
		deptList = access.getDepartmentList();
		return deptList;
	}
	
	public List<Title> getTitles() throws SQLException{
		DbOperationAccess access = new DbOperationAccess();
		List<Title> titleList = new ArrayList<Title>();
		titleList = access.getTitleList();
		return titleList;
	}
}
