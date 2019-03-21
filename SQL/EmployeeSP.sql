DELIMITER $$
CREATE PROCEDURE `sp_emp_CreateNewEmployee`(
   IN pDepartment INT,
   IN pFirstname VARCHAR(50),
   IN pLastname VARCHAR(50),
   IN pAddress VARCHAR(100),
   IN pCity VARCHAR(50),
   IN pState VARCHAR(50),
   IN pZip VARCHAR(15),
   IN pEmail VARCHAR(100),
   IN pPassword VARCHAR(250)
)
BEGIN

DECLARE i INT;

INSERT INTO emp_Employee
(emp_Employee.id_Department)
VALUES
(pDepartment);

SELECT id_Employee
INTO i
FROM emp_Employee
ORDER BY id_Employee DESC
LIMIT 1;

INSERT INTO emp_EmployeeDetail
(
	`id_Employee`
	,`Firstname`
	,`Lastname`
	,`Address`
	,`City`
	,`State`
	,`Zip`
	,`Email`
)
VALUES
(
    i
    ,pFirstname
    ,pLastname
    ,pAddress
    ,pCity
    ,pState
    ,pZip
    ,pEmail

);

INSERT INTO emp_EmployeeLogin
(
    id_Employee
    ,Password
    ,isTempPassword
)
VALUES
(
    i
    ,pPassword
    ,1
);
COMMIT;
END$$
DELIMITER ;