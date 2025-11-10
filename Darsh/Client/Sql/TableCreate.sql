CREATE TABLE Shipment_Details (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    Full_Name VARCHAR(100) NOT NULL,
    Company_Name VARCHAR(100),
    Email VARCHAR(100) NOT NULL,
    Phone VARCHAR(30) NOT NULL,
    Shipment_Type ENUM('import', 'export') NOT NULL,
    Transport_Mode ENUM('Sea Freight', 'Air Freight', 'Road Transport') NOT NULL,
    Origin_Country VARCHAR(100) NOT NULL,
    Origin_Port VARCHAR(100) NOT NULL,
    Dest_Country VARCHAR(100) NOT NULL,
    Dest_Port VARCHAR(100) NOT NULL,
    Product_Description VARCHAR(255) NOT NULL,
    HS_Code VARCHAR(20),
    Weight DECIMAL(10,2) NOT NULL,
    Quantity INT NOT NULL,
    Dimensions VARCHAR(50),
    Instructions TEXT,
    Shipment_Charge DECIMAL(10,2) DEFAULT 0.00,
    Shipment_Time DATE,
    User_ID INT,
    FOREIGN KEY (User_ID) REFERENCES user_details (ID) ON DELETE SET NULL
);

-- Create Users table for authentication
CREATE TABLE User_details (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    Username VARCHAR(50) NOT NULL UNIQUE,
    Email VARCHAR(100) NOT NULL UNIQUE,
    Password VARCHAR(255) NOT NULL,
);