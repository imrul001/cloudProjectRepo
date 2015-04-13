package orgs.hasan.userClasses;

import java.util.Date;

import javax.xml.bind.annotation.XmlAttribute;
import javax.xml.bind.annotation.XmlElement;
import javax.xml.bind.annotation.XmlRootElement;

@XmlRootElement(name="Object")
public class Employee {
	
	private int emp_no;
	private String first_name;
	private String last_name;
	private String gender;
	private java.util.Date birth_date;
	private java.util.Date from_date;
	private java.util.Date to_date;
	private String dept_no;
	private int salary;
	private String title;
	
	public Employee(){
		
	}
	
	public Employee(int emp_no, String first_name, String last_name,
			String gender, Date birth_date, Date from_date, Date to_date,
			String dept_no, int salary, String title) {
		super();
		this.emp_no = emp_no;
		this.first_name = first_name;
		this.last_name = last_name;
		this.gender = gender;
		this.birth_date = birth_date;
		this.from_date = from_date;
		this.to_date = to_date;
		this.dept_no = dept_no;
		this.salary = salary;
		this.title = title;
	}
	
	@XmlAttribute
	public int getEmp_no() {
		return emp_no;
	}
	public void setEmp_no(int emp_no) {
		this.emp_no = emp_no;
	}
	@XmlElement
	public String getFirst_name() {
		return first_name;
	}
	public void setFirst_name(String first_name) {
		this.first_name = first_name;
	}
	@XmlElement
	public String getLast_name() {
		return last_name;
	}
	public void setLast_name(String last_name) {
		this.last_name = last_name;
	}
	@XmlElement
	public String getGender() {
		return gender;
	}
	public void setGender(String gender) {
		this.gender = gender;
	}
	@XmlElement
	public java.util.Date getBirth_date() {
		return birth_date;
	}
	public void setBirth_date(java.util.Date birth_date) {
		this.birth_date = birth_date;
	}
	@XmlElement
	public java.util.Date getFrom_date() {
		return from_date;
	}
	public void setFrom_date(java.util.Date from_date) {
		this.from_date = from_date;
	}
	@XmlElement
	public java.util.Date getTo_date() {
		return to_date;
	}
	public void setTo_date(java.util.Date to_date) {
		this.to_date = to_date;
	}
	@XmlElement
	public String getDept_no() {
		return dept_no;
	}
	public void setDept_no(String dept_no) {
		this.dept_no = dept_no;
	}
	@XmlElement
	public int getSalary() {
		return salary;
	}
	public void setSalary(int salary) {
		this.salary = salary;
	}
	@XmlElement
	public String getTitle() {
		return title;
	}
	public void setTitle(String title) {
		this.title = title;
	}
	
	

}
