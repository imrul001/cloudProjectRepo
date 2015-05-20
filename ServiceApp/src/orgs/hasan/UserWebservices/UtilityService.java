package orgs.hasan.UserWebservices;

import java.sql.SQLException;
import java.util.List;

import javax.jws.WebMethod;
import javax.jws.WebService;

import orgs.hasan.AdminUserServiceImpl.UtilityServiceImpl;
import orgs.hasan.userClasses.Department;
import orgs.hasan.userClasses.Title;

@WebService(serviceName="Utility")
public class UtilityService {
	
	UtilityServiceImpl serviceImpl = new UtilityServiceImpl();
	
	@WebMethod(operationName="getDepartments")
	public List<Department> getDepartments() throws SQLException{
		return serviceImpl.getDepartments();
	}
	
	@WebMethod(operationName="getTitles")
	public List<Title> getTitles() throws SQLException{
		return serviceImpl.getTitles();
	}

}
