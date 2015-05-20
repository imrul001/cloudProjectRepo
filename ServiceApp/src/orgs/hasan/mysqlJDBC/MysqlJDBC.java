package orgs.hasan.mysqlJDBC;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;
import java.sql.Statement;

public class MysqlJDBC {
	static final String JDBC_DRIVER = "com.mysql.jdbc.Driver";
	
//	local setup
	
	static final String DB_URL = "jdbc:mysql://localhost:3306/employees";
	static final String USER = "root";
	static final String PASS = "123imrul";
	
//	openshift setup
//	static final String DB_URL = "jdbc:mysql://127.5.68.2:3306/employees";
//	static final String USER = "adminfas3n5L";
//	static final String PASS = "T--fwJQtAdwI";
	private Connection conn = null;
	
	public Connection getConnection(){
		try{
			Class.forName("com.mysql.jdbc.Driver");
			System.out.println("Connecting to database");
			conn = DriverManager.getConnection(DB_URL, USER, PASS);
		}catch(Exception e){
			e.printStackTrace();			
		}
		return conn; 
	}
		
	public boolean closeConnection(Connection conn, Statement stmt){
		try{
			if(stmt!=null){
				conn.close();
			}
		}catch(SQLException se){
			se.printStackTrace();
		}
		return true;
	}
}
