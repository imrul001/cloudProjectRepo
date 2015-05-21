package orgs.hasan.UserWebservices;

import java.sql.SQLException;
import java.util.List;

import javax.jws.WebMethod;
import javax.jws.WebParam;
import javax.jws.WebResult;
import javax.jws.WebService;
import javax.jws.soap.SOAPBinding;
import javax.jws.soap.SOAPBinding.Style;

import orgs.hasan.AdminUserServiceImpl.SearchServiceImpl;
import orgs.hasan.userClasses.EmpSearchInfo;

@WebService(serviceName="Search")
public class SearchService {
	
	SearchServiceImpl serviceImpl = new SearchServiceImpl();
	
	@WebMethod(operationName="getEmployeeByID")
	@WebResult(name="EmployeeSearhInfo")
	public EmpSearchInfo getEmployeeByID(
			@WebParam(partName="emp_no")int emp_no, @WebParam(partName="limit")int limit) throws SQLException{
		return serviceImpl.getEmployeeById(emp_no, limit);
	}
	
	@WebMethod(operationName="getEmployeesByFirstName")
	@WebResult(name="EmployeeSearhInfo")
	public List<EmpSearchInfo> getEmployeesByFN(
			@WebParam(partName="first_name_pattern")String pattern, @WebParam(partName="limit")int limit) throws SQLException{
		return serviceImpl.getEmployeeByFN(pattern, limit);
	}
	
	@WebMethod(operationName="getEmployeesByLastName")
	@WebResult(name="EmployeeSearhInfo")
	public List<EmpSearchInfo> getEmployeesByLN(
			@WebParam(partName="last_name_pattern")String pattern, @WebParam(partName="limit")int limit) throws SQLException{
		return serviceImpl.getEmployeeByLN(pattern, limit);
	}
	
	@WebMethod(operationName="getEmployeesByGender")
	@WebResult(name="EmployeeSearhInfo")
	public List<EmpSearchInfo> getEmployeesByGender(
			@WebParam(partName="Gender")String gender, @WebParam(partName="limit")int limit) throws SQLException{
		return serviceImpl.getEmployeeByGender(gender, limit);
	}
	
	@WebMethod(operationName="getEmployeesByDepartment")
	@WebResult(name="EmployeeSearhInfo")
	public List<EmpSearchInfo> getEmployeeByDept(
			@WebParam(partName="Department_no")String dept_no, @WebParam(partName="limit")int limit) throws SQLException{
		return serviceImpl.getEmployeesByDept(dept_no, limit);
	}
	
	@WebMethod(operationName="getEmployeesByTitle")
	@WebResult(name="EmployeeSearhInfo")
	public List<EmpSearchInfo> getEmployeeByTitle(
			@WebParam(partName="Title")String title, @WebParam(partName="limit")int limit) throws SQLException{
		return serviceImpl.getEmployeesByTitle(title, limit);
	}

}
