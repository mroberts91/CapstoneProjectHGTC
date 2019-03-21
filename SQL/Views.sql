CREATE VIEW vw_cust_CustomerFull 
AS 
SELECT 
c.id_Customer 
,c.id_Department
,d.Name
,cd.Firstname 
,cd.Lastname 
,cd.Address 
,cd.City 
,cd.State 
,cd.Zip 
,cd.Email
FROM cust_Customer c 
JOIN cust_CustomerDetail cd 
	ON cd.id_Customer = c.id_Customer
JOIN lu_Department d
	ON d.id_Department = c.id_Department
	

CREATE VIEW vw_cust_Login
AS
SELECT
cd.id_Customer
,cd.Email
,cl.Password
,cl.isTempPassword
FROM cust_CustomerDetail cd
JOIN cust_CustomerLogin cl
	ON cl.id_Customer = cd.id_Customer

CREATE VIEW vw_emp_EmployeeFull
AS
SELECT
e.id_Employee
,e.id_Department
,d.Name
,ed.Firstname
,ed.Lastname
,ed.Address
,ed.City
,ed.State
,ed.Zip
,ed.Email
FROM emp_Employee e
JOIN emp_EmployeeDetail ed
	ON ed.id_Employee = e.id_Employee
JOIN lu_Department d
	ON d.id_Department = e.id_Department

CREATE VIEW vw_emp_Login
AS
SELECT
e.id_Employee
,el.Password
,el.isTempPassword
FROM emp_Employee e
JOIN emp_EmployeeLogin el
	ON el.id_Employee = e.id_Employee
