package orgs.hasan.mongoDBJDBC;

import java.util.Set;

import com.mongodb.DB;
import com.mongodb.MongoClient;


//test mongo bd
public class MongoDbJDBC {
	
	public static void main(String args[]){
		try{
			MongoClient mongoClient = new MongoClient("localhost",27017);
			DB db = mongoClient.getDB("TestMongoDB");
			System.out.println("Successfully Connected to the Database");			
			Set<String> collections = db.getCollectionNames();
			System.out.println(collections);					
		}
		catch(Exception e){
			System.err.println(e.getClass().getName()+":"+e.getMessage());
		}
	}
}
