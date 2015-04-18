package orgs.hasan.UserWebservices;

import java.sql.SQLException;

import javax.jws.WebMethod;
import javax.jws.WebParam;
import javax.jws.WebResult;
import javax.jws.WebService;
import javax.jws.soap.SOAPBinding;
import javax.jws.soap.SOAPBinding.Style;

import orgs.hasan.AdminUserServiceImpl.HRServiceImpl;
import orgs.hasan.userClasses.Employee;
import orgs.hasan.utility.Utility;

@WebService(name="HR", serviceName="HRService")
@SOAPBinding(style=Style.RPC)
public class HRService {

	HRServiceImpl impl = new HRServiceImpl();	
	@WebMethod(operationName = "addNewEmployee")
	@WebResult(partName="IsEmployeeAdded")
	public boolean addNewEmployee(@WebParam(partName="emp_no")int emp_no, @WebParam(partName="first_name")String first_name, 
			@WebParam(partName="last_name")String last_name, @WebParam(partName="birth_date")String birth_date, 
			@WebParam(partName="gender")String gender,@WebParam(partName="from_date")String from_date, 
			@WebParam(partName="to_date")String to_date, @WebParam(partName="title")String title, 
			@WebParam(partName="dept_no")String dept_no, @WebParam(partName="salary")int salary) throws SQLException{
		Employee employee = new Employee(emp_no,first_name, last_name, gender, Utility.getDateFromString(birth_date),
		    Utility.getDateFromString(from_date),Utility.getDateFromString(to_date), dept_no, salary, title);
		return impl.addNewEmployee(employee);
	}
	
	@WebMethod(operationName="deleteEmployee")
	@WebResult(partName="IsEmployeeDeleted")
	public boolean deleteEmployee(@WebParam(partName="emp_no")int emp_no) throws SQLException{
		return impl.deleteEmployee(emp_no);
	}
}
