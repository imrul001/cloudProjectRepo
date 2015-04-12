package orgs.hasan.business;

import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;

import orgs.hasan.mysqlJDBC.MysqlJDBC;

public class DbOperationAccess {
	
	 public boolean isValidUser(String username, String password) throws SQLException{
		 MysqlJDBC jdbc = new MysqlJDBC();
		 Connection connection = jdbc.getConnection();
		 Statement statement = connection.createStatement();
		 String query = "SELECT * FROM users WHERE username='"+username+"' AND password='"+password+"' limit 1";
		 boolean checkFlag = false;
		 ResultSet resultSet = statement.executeQuery(query);
		 if(resultSet.next()){
			 while(resultSet.next()){
			     int id = resultSet.getInt("userid");
				 System.out.println(id);
			 }
			 boolean flag = jdbc.closeConnection(connection, statement);
			 checkFlag = true;
		 }
		 return checkFlag;
	 }
	 
	 public static void main(String args[]) throws SQLException{
		 
		 DbOperationAccess access = new DbOperationAccess();
		 if(access.isValidUser("hasan", "123")){
			 System.out.println("Correct");
		 }else{
			 System.out.println("Incorrect");
		 }
	 }
}
