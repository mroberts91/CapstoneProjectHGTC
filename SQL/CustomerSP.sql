DELIMITER $$
CREATE PROCEDURE `sp_cust_CreateNewCustomer`(
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

INSERT INTO cust_Customer
(cust_Customer.id_Department)
VALUES
(5000);

SELECT id_Customer
INTO i
FROM cust_Customer
ORDER BY id_Customer DESC
LIMIT 1;

INSERT INTO cust_CustomerDetail
(
	`id_Customer`
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

INSERT INTO cust_CustomerLogin
(
    id_Customer
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