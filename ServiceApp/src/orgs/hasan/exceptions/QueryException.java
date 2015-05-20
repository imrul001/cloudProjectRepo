package orgs.hasan.exceptions;

public class QueryException extends Exception {
	
	public String errorDetails;
	
	public QueryException(String reason, String errorDetails){
		super(reason);
		this.errorDetails = errorDetails;
	}
	
	public String getFaultInfo(){
		return errorDetails;
	}

}
