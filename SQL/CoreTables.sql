CREATE TABLE lu_MenuCategory
(
  id_Category INT NOT NULL,
  Name VARCHAR(30) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (id_Category),
  INDEX (id_Category)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE lu_OrderStatus
(
  id_OrderStatus INT NOT NULL,
  Name VARCHAR(30) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (id_OrderStatus),
  INDEX (id_OrderStatus)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE core_TaxRate
(
  id_TaxRate INT NOT NULL,
  Rate DECIMAL(8,3) NOT NULL,
  PRIMARY KEY (id_TaxRate),
  INDEX (id_TaxRate)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE lu_Department
(
  id_Department INT NOT NULL,
  Name VARCHAR(30) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (id_Department),
  INDEX (id_Department)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE cust_Customer
(
  id_Customer INT NOT NULL AUTO_INCREMENT,
  id_Department INT NOT NULL,
  PRIMARY KEY (id_Customer),
  INDEX (id_Customer),
  FOREIGN KEY (id_Department) REFERENCES lu_Department(id_Department)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE cust_CustomerDetail
(
  id_Customer INT NOT NULL,
  Firstname VARCHAR(50) COLLATE utf8_unicode_ci NULL,
  Lastname VARCHAR(50) COLLATE utf8_unicode_ci NOT NULL,
  Address VARCHAR(100) COLLATE utf8_unicode_ci NULL,
  City VARCHAR(50) COLLATE utf8_unicode_ci NULL,
  State VARCHAR(50) COLLATE utf8_unicode_ci NULL,
  Zip VARCHAR(15) COLLATE utf8_unicode_ci NULL,
  Email VARCHAR(100) COLLATE utf8_unicode_ci NOT NULL,
  INDEX (id_Customer),
  FOREIGN KEY (id_Customer) REFERENCES cust_Customer(id_Customer)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE cust_CustomerLogin
(
  id_Customer INT NOT NULL,
  Password VARCHAR(250) NOT NULL,
  isTempPassword TINYINT(1) NOT NULL,
  INDEX (id_Customer),
  FOREIGN KEY (id_Customer) REFERENCES cust_Customer(id_Customer)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE menu_MenuItem
(
  id_MenuItem INT NOT NULL AUTO_INCREMENT,
  Name VARCHAR(50) COLLATE utf8_unicode_ci NOT NULL,
  Price DECIMAL(8,2) NOT NULL,
  id_Category INT NOT NULL,
  ShortName VARCHAR(50) NULL,
  PRIMARY KEY (id_MenuItem),
  INDEX (id_MenuItem),
  FOREIGN KEY (id_Category) REFERENCES lu_MenuCategory(id_Category)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE emp_Employee
(
  id_Employee INT NOT NULL AUTO_INCREMENT,
  id_Department INT NOT NULL,
  PRIMARY KEY (id_Employee),
  INDEX (id_Employee),
  FOREIGN KEY (id_Department) REFERENCES lu_Department(id_Department)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE emp_EmployeeDetail
(
  id_Employee INT NOT NULL,
  Firstname VARCHAR(50) COLLATE utf8_unicode_ci NOT NULL,
  Lastname VARCHAR(50) COLLATE utf8_unicode_ci NOT NULL,
  Address VARCHAR(100) COLLATE utf8_unicode_ci NOT NULL,
  City VARCHAR(50) COLLATE utf8_unicode_ci NOT NULL,
  State VARCHAR(50) COLLATE utf8_unicode_ci NOT NULL,
  Zip VARCHAR(15) COLLATE utf8_unicode_ci NOT NULL,
  Email VARCHAR(100) COLLATE utf8_unicode_ci NOT NULL,
  INDEX (id_Employee),
  FOREIGN KEY (id_Employee) REFERENCES emp_Employee(id_Employee)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE emp_EmployeeLogin
(
  id_Employee INT NOT NULL,
  Password VARCHAR(250) NOT NULL,
  isTempPassword TINYINT(1) NOT NULL,
  INDEX (id_Employee),
  FOREIGN KEY (id_Employee) REFERENCES emp_Employee(id_Employee)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE menu_Inventory
(
  id_MenuItem INT NOT NULL,
  Inventory INT NOT NULL,
  IsLow INT NULL,
  INDEX (id_MenuItem),
  FOREIGN KEY (id_MenuItem) REFERENCES menu_MenuItem(id_MenuItem)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE order_Order
(
  id_Order INT NOT NULL AUTO_INCREMENT,
  Created TIMESTAMP NOT NULL DEFAULT NOW(),
  CreatedBy INT NULL,
  Subtotal INT NULL,
  CalculatedTax INT NULL,
  GrandTotal INT NULL,
  id_OrderStatus INT NOT NULL DEFAULT 10,
  id_TaxRate INT NOT NULL,
  id_Employee INT NOT NULL,
  id_Customer INT NOT NULL,
  PRIMARY KEY (id_Order),
  INDEX (id_Order),
  FOREIGN KEY (id_OrderStatus) REFERENCES lu_OrderStatus(id_OrderStatus),
  FOREIGN KEY (id_TaxRate) REFERENCES core_TaxRate(id_TaxRate),
  FOREIGN KEY (id_Employee) REFERENCES emp_Employee(id_Employee),
  FOREIGN KEY (id_Customer) REFERENCES cust_Customer(id_Customer)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE order_OrderDetail
(
  id_Order INT NOT NULL,
  id_MenuItem INT NOT NULL,
  ItemPrice DECIMAL(8,2) NOT NULL,
  INDEX (id_Order),
  FOREIGN KEY (id_Order) REFERENCES order_Order(id_Order),
  FOREIGN KEY (id_MenuItem) REFERENCES menu_MenuItem(id_MenuItem)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE core_Schedule
(
  id_Schedule INT NOT NULL AUTO_INCREMENT,
  OpenTime TIME NOT NULL,
  CloseTime TIME NOT NULL,
  PRIMARY KEY (id_Schedule),
  INDEX (id_Schedule),
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

