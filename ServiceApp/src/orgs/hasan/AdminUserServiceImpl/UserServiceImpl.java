package orgs.hasan.AdminUserServiceImpl;

import java.sql.SQLException;

import orgs.hasan.business.DbOperationAccess;
import orgs.hasan.userClasses.User;

public class UserServiceImpl {
	public User userlogin(String username, String password) throws SQLException{
		User user = new User();
		DbOperationAccess access = new DbOperationAccess();
		if(access.isValidUser(username, password)){
			user.setUsername(username);
			user.setPassword(password);
		}
		return user;
	}
}
