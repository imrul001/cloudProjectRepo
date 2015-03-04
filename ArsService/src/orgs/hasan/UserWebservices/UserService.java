package orgs.hasan.UserWebservices;

import javax.jws.WebMethod;
import javax.jws.WebService;

import orgs.hasan.AdminUserServiceImpl.UserServiceImpl;
import orgs.hasan.userClasses.User;

@WebService
public class UserService {
	 UserServiceImpl serviceImpl = new UserServiceImpl();
	 
	 @WebMethod
	 public User userLoginService(String username, String password){
		 return serviceImpl.userlogin(username, password);
	 }

}
