
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
,c.id_Location
,l.Name AS 'LocationName'
FROM cust_Customer c
JOIN cust_CustomerDetail cd
	ON cd.id_Customer = c.id_Customer
JOIN lu_Department d
	ON d.id_Department = c.id_Department
JOIN lu_Location l
  ON l.id_Location = c.id_Location

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
,ed.Email
,el.Password
,el.isTempPassword
FROM emp_Employee e
JOIN emp_EmployeeDetail ed
  ON ed.id_Employee = e.id_Employee
JOIN emp_EmployeeLogin el
	ON el.id_Employee = e.id_Employee

CREATE VIEW vw_emp_manage
AS
SELECT
	e.id_Employee
 	,ed.Firstname
 	,ed.Lastname
 	,e.id_Department
 	,d.Name AS 'DeptName'
 	,ed.Email
FROM emp_Employee e
	JOIN emp_EmployeeDetail ed
		ON ed.id_Employee = e.id_Employee
 	JOIN lu_Department d
		ON d.id_Department = e.id_Department

CREATE VIEW vw_cust_Manage
AS
SELECT
	c.id_Customer
		 ,c.id_Location
		 ,l.Name AS 'PrefLocation'
		 ,cd.Firstname
		 ,cd.Lastname
		 ,cd.Address
		 ,cd.State
		 ,cd.Zip
		 ,cd.Email
FROM cust_Customer c
			 JOIN cust_CustomerDetail cd
						ON cd.id_Customer = c.id_Customer
			 JOIN lu_Location l
						ON l.id_Location = c.id_Location



CREATE VIEW vw_order_OpenOrders
AS
SELECT
	o.`id_Order`
		 ,o.`Created`
		 ,o.`Subtotal`
		 ,o.`GrandTotal`
		 ,o.`id_Employee`
		 ,o.id_Customer
		 ,ed.Firstname
		 ,ed.Lastname
		 ,(SELECT COUNT(id_Order) FROM order_OrderDetail WHERE order_OrderDetail.id_Order = o.id_Order) AS "Item Count"
		 ,o.id_OrderStatus
		 ,os.Name
		 ,o.TableNumber
		 ,o.DateReady
FROM order_Order o
			 JOIN emp_EmployeeDetail ed
						ON ed.id_Employee = o.id_Employee
			 JOIN lu_OrderStatus os
						ON os.id_OrderStatus = o.id_OrderStatus

CREATE VIEW vw_order_DisplayOrder
AS
SELECT
	 od.id_Order
	,od.id_MenuItem
	,od.ItemPrice
	,od.Notes
 	,od.IsCooked
 	,mi.Name
FROM order_OrderDetail od
			 JOIN menu_MenuItem mi
						ON mi.id_MenuItem = od.id_MenuItem

CREATE VIEW vw_inventory
AS
SELECT DISTINCT
	m.id_MenuItem
							,mc.id_Category
							,m.Name AS 'ItemName'
							,i.Inventory
							,i.IsLow
							,mc.Name AS 'CategoryName'
FROM menu_MenuItem m
			 join menu_Inventory i
						on m.id_MenuItem = i.id_MenuItem
			 join lu_MenuCategory mc
						on mc.id_Category = m.id_Category
ORDER BY mc.id_Category ASC