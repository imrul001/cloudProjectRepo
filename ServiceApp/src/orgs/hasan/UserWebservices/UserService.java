package orgs.hasan.UserWebservices;

import java.sql.SQLException;

import javax.jws.WebMethod;
import javax.jws.WebParam;
import javax.jws.WebResult;
import javax.jws.WebService;
import javax.jws.soap.SOAPBinding;
import javax.jws.soap.SOAPBinding.Style;

import orgs.hasan.AdminUserServiceImpl.UserServiceImpl;
import orgs.hasan.userClasses.User;

@WebService(name="USER", serviceName="UserService")
@SOAPBinding(style=Style.RPC)
public class UserService {
	 UserServiceImpl serviceImpl = new UserServiceImpl();
     @WebMethod(operationName="userLogin")
	 @WebResult(partName="userInfo")
	 public User userLoginService(@WebParam(partName="UserName")String username, 
			 @WebParam(partName="Password")String password) throws SQLException{
		 return serviceImpl.userlogin(username, password);
	 }

}
