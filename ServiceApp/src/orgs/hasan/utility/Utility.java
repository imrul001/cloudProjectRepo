package orgs.hasan.utility;

import java.text.ParseException;
import java.text.SimpleDateFormat;

public class Utility {
	
	public static java.sql.Date getDateFromString(String sdate){
		 SimpleDateFormat dateFormat =new SimpleDateFormat("MM/dd/yyyy"); 
		 java.util.Date date = new java.util.Date(); 
		 try{
			 date = dateFormat.parse(sdate);
//			 System.out.println("Converted Date");
//			 System.out.println(date);
//			 System.out.println(dateFormat.format(date));
			 
		 }catch(ParseException e){
			 e.printStackTrace();
		 }
		 java.sql.Date dsql = new java.sql.Date(date.getTime());
		 return dsql;
	}

}
