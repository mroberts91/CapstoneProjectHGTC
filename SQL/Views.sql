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

--CREATE PROCEDURE sp_cust_CreateNewCustomer(
--	IN pFirstname VARCHAR(50),
--    IN pLastname VARCHAR(50),
--    IN pAddress VARCHAR(100),
--    IN pCity VARCHAR(50),
--    IN pState VARCHAR(50),
--    IN pZip VARCHAR(15),
--    IN pEmail VARCHAR(100)
--    IN pPassword VARCHAR(250)
--)
--BEGIN
--INSERT INTO cust_Customer
--(id_Department)
--VALUES
--(5000)

--DECLARE pid INT
--SELECT pid = id_Customer 
--FROM cust_Customer
--ORDER BY id_Customer DESC
--LIMIT 1

--INSERT INTO cust_CustomerDetail
--(
-- 	`id_Customer`
-- 	,`Firstname`
-- 	,`Lastname`
-- 	,`Address`
-- 	,`City`
-- 	,`State`
-- 	,`Zip`
-- 	,`Email`
--)
-- VALUES
-- (
--     pid
--     ,pFirstname
--     ,pLastname
--     ,pAddress
--     ,pCity
--     ,pState
--     ,pZip
--     ,pEmail
    
-- )
 
-- INSERT INTO cust_CustomerLogin
-- (
--     id_Customer
--     ,Password
--     ,idTempPassword
-- )
-- VALUES
-- (
--     pid
--     ,pPassword
--     ,1
-- )
--END