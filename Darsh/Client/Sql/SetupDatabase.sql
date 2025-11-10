-- Database Setup Script for Global Logistic Portal
-- Run this script to create the necessary tables

-- Use the existing database
USE global_logistic_portal;

-- Create Users table first (referenced by Shipment_Details)
CREATE TABLE IF NOT EXISTS Users (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    Username VARCHAR(50) NOT NULL UNIQUE,
    Email VARCHAR(100) NOT NULL UNIQUE,
    Password VARCHAR(255) NOT NULL,
    Full_Name VARCHAR(100) NOT NULL,
);

-- Update existing Shipment_Details table to add User_ID column if it doesn't exist
ALTER TABLE Shipment_Details 
ADD COLUMN IF NOT EXISTS User_ID INT,
ADD COLUMN IF NOT EXISTS Created_At TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
ADD COLUMN IF NOT EXISTS Updated_At TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP;

-- Add foreign key constraint if it doesn't exist
-- Note: This might fail if there are existing records with NULL User_ID, which is fine
SET FOREIGN_KEY_CHECKS = 0;
ALTER TABLE Shipment_Details 
ADD CONSTRAINT fk_shipment_user 
FOREIGN KEY (User_ID) REFERENCES Users(ID) ON DELETE SET NULL;
SET FOREIGN_KEY_CHECKS = 1;

-- Update Shipment_Charge and Shipment_Time to allow NULL values
ALTER TABLE Shipment_Details 
MODIFY COLUMN Shipment_Charge DECIMAL(10,2) DEFAULT 0.00,
MODIFY COLUMN Shipment_Time DATE NULL;

-- Create an index on User_ID for better performance
CREATE INDEX IF NOT EXISTS idx_shipment_user_id ON Shipment_Details(User_ID);

-- Create an index on email for faster login queries
CREATE INDEX IF NOT EXISTS idx_users_email ON Users(Email);

-- Insert a default admin user (password: admin123)
-- Password hash for 'admin123' using PHP's password_hash()
INSERT IGNORE INTO Users (Username, Email, Password, Full_Name, Role, Status, Email_Verified) 
VALUES (
    'admin', 
    'admin@globallogistic.com', 
    '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 
    'System Administrator', 
    'admin', 
    'active', 
    TRUE
);

-- Show tables to verify creation
SHOW TABLES;

-- Show Users table structure
DESCRIBE Users;

-- Show Shipment_Details table structure  
DESCRIBE Shipment_Details;
