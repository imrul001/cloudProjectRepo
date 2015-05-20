package orgs.hasan.userClasses;

import javax.xml.bind.annotation.XmlRootElement;

@XmlRootElement(name="Department")
public class Department {
	private String dept_name;
	private String dept_no;
	
	public String getDept_name() {
		return dept_name;
	}
	public void setDept_name(String dept_name) {
		this.dept_name = dept_name;
	}
	public String getDept_no() {
		return dept_no;
	}
	public void setDept_no(String dept_no) {
		this.dept_no = dept_no;
	}
}
