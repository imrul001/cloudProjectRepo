package orgs.hasan.UserWebservices;

import java.sql.SQLException;

import javax.jws.WebMethod;
import javax.jws.WebService;

import orgs.hasan.AdminUserServiceImpl.UserServiceImpl;
import orgs.hasan.userClasses.User;

@WebService
public class UserService {
	 UserServiceImpl serviceImpl = new UserServiceImpl();
	 
	 @WebMethod
	 public User userLoginService(String username, String password) throws SQLException{
		 return serviceImpl.userlogin(username, password);
	 }

}
