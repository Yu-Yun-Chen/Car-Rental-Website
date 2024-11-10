DROP DATABASE IF EXISTS rental;
CREATE DATABASE rental;
USE rental;

CREATE TABLE user (
    UserID VARCHAR(50) PRIMARY KEY,
    Password VARCHAR(255),
    Name VARCHAR(50),
    IDNumber VARCHAR(20),
    Phone VARCHAR(15),
    Email VARCHAR(100),
    Address VARCHAR(255),
    Birthday DATE,
    License LONGBLOB
);

CREATE TABLE RentalMoney (
    Model VARCHAR(20) NOT NULL UNIQUE,
    RentalRate VARCHAR(20) NOT NULL
);

CREATE TABLE Location (
    LocationID VARCHAR(30) NOT NULL UNIQUE,
    LocationName VARCHAR(15) NOT NULL,
    Address VARCHAR(30) NOT NULL,
    ManagerID VARCHAR(15),
    used VARCHAR(15) NOT NULL CHECK (used IN ('站點使用中', '站點關閉中'))
);

CREATE TABLE Manager (
    ManagerID VARCHAR(15) NOT NULL UNIQUE,
    Password VARCHAR(25),
    Name VARCHAR(15) NOT NULL,
    Email VARCHAR(30) NOT NULL,
    Phone VARCHAR(10) NOT NULL,
    LocationName VARCHAR(30)
);


CREATE TABLE vehicle (
    vehicleID VARCHAR(15) NOT NULL UNIQUE,
    Model VARCHAR(30) NOT NULL,
    LicensePlate VARCHAR(30) NOT NULL,
    AvailabilityStatus VARCHAR(15) NOT NULL CHECK (AvailabilityStatus IN ('未被租借', '借用中')),
    LocationName VARCHAR(30) NOT NULL,
    RentalRate VARCHAR(15) NOT NULL
);

CREATE TABLE Review (
    ReviewID VARCHAR(15) NOT NULL UNIQUE,
    UserID VARCHAR(15) NOT NULL,
    vehicleID VARCHAR(15) NOT NULL,
    Rating INT CHECK (Rating BETWEEN 1 AND 5),
    Comment VARCHAR(255) NOT NULL,
    ReviewDate DATE NOT NULL,
    Processed BOOLEAN NOT NULL DEFAULT FALSE
);


CREATE TABLE Booking (
    BookingID VARCHAR(15) NOT NULL UNIQUE,
    UserID VARCHAR(15) NOT NULL,
    vehicleID VARCHAR(15) NOT NULL,
    StartDate DATE NOT NULL,
    PickupLocationID VARCHAR(30) NOT NULL,
    ReturnLocationID VARCHAR(30) NOT NULL,
    EndDate DATE NOT NULL,
    TotalCost INT NOT NULL,
    PaymentMethod VARCHAR(15) NOT NULL CHECK (PaymentMethod IN ('現金', '行動支付', '信用卡')),
    PaymentStatus VARCHAR(15) NOT NULL DEFAULT '未付款' CHECK (PaymentStatus IN ('已付款', '未付款')),
    BookingStatus VARCHAR(15) NOT NULL DEFAULT '訂購完成' CHECK (BookingStatus IN ('進行中', '訂購完成'))
);

-- Insert initial data

INSERT INTO user (UserID, Password, Name, IDNumber, Phone, Email, Address, Birthday, License) VALUES
('U001', 'password123', 'Alice', 'A123456789', '0912345678', 'alice@example.com', '123 Wonderland Ave', '1990-01-01', 'sample_license_1'),
('U002', 'password456', 'Bob', 'B987654321', '0923456789', 'bob@example.com', '456 Nowhere St', '1985-02-02', 'sample_license_2'),
('U003', 'password789', 'Charlie', 'C112233445', '0934567890', 'charlie@example.com', '789 Dreamland Rd', '1995-03-03', 'sample_license_3'),
('U004', 'password101', 'David', 'D556677889', '0945678901', 'david@example.com', '101 Freedom Blvd', '1992-04-04', 'sample_license_4'),
('U005', 'password202', 'Eve', 'E998877665', '0956789012', 'eve@example.com', '202 Liberty Ave', '1993-05-05', 'sample_license_5'),
('U006', 'password303', 'Frank', 'F554433221', '0967890123', 'frank@example.com', '303 Peace St', '1994-06-06', 'sample_license_6');


INSERT INTO RentalMoney (Model, RentalRate) VALUES
('TOYOTA YARIS', '1800'),
('NISSAN TIIDA', '2000'),
('TOYOTA SIENTA', '2600'),
('TESLA Model_3', '3100');

INSERT INTO Location (LocationID, LocationName, Address, ManagerID, used) VALUES
('01', '台北', '101 Taipei St', 'M001', '站點使用中'),
('02', '桃園', '202 Taoyuan St', 'M002', '站點使用中'),
('03', '新竹', '303 Hsinchu St', 'M003', '站點使用中'),
('04', '台中', '404 Taichung St', 'M001', '站點使用中'),
('05', '台南', '505 Tainan St', 'M002', '站點使用中'),
('06', '高雄', '606 Kaohsiung St', 'M003', '站點使用中');

INSERT INTO Manager (ManagerID, Password, Name, Email, Phone, LocationName) VALUES
('M001','111', 'Manager1', 'manager1@example.com', '0911111111', '台北'),
('M002','222', 'Manager2', 'manager2@example.com', '0922222222', '桃園'),
('M003','333', 'Manager3', 'manager3@example.com', '0933333333', '新竹'),
('M004','444', 'Manager4', 'manager4@example.com', '0944444444', '台中'),
('M005','555', 'Manager5', 'manager5@example.com', '0955555555', '台南'),
('M006','666', 'Manager6', 'manager6@example.com', '0966666666', '高雄');


INSERT INTO vehicle (vehicleID, Model, LicensePlate, AvailabilityStatus, RentalRate, LocationName) VALUES
('V001', 'TOYOTA YARIS', 'ABC123', '未被租借', '1800', '台北'),
('V002', 'TOYOTA YARIS', 'DEF124', '未被租借', '1800', '桃園'),
('V003', 'TOYOTA YARIS', 'GHI125', '未被租借', '1800', '新竹'),
('V004', 'NISSAN TIIDA', 'DEF456', '未被租借', '2000', '桃園'),
('V005', 'NISSAN TIIDA', 'JKL127', '未被租借', '2000', '新竹'),
('V006', 'NISSAN TIIDA', 'MNO128', '未被租借', '2000', '台中'),
('V007', 'TOYOTA SIENTA', 'GHI789', '未被租借', '2600', '新竹'),
('V008', 'TOYOTA SIENTA', 'PQR129', '未被租借', '2600', '台中'),
('V009', 'TOYOTA SIENTA', 'STU130', '未被租借', '2600', '台南'),
('V010', 'TESLA Model_3', 'JKL123', '未被租借', '3100', '台中'),
('V011', 'TESLA Model_3', 'VWX131', '未被租借', '3100', '台南'),
('V012', 'TESLA Model_3', 'YZA132', '未被租借', '3100', '高雄');


INSERT INTO Review (ReviewID, UserID, vehicleID, Rating, Comment, ReviewDate, Processed) VALUES
('R001', 'U001', 'V001', 5, 'Great car!', '2023-01-01', FALSE),
('R002', 'U002', 'V002', 4, 'Good service.', '2023-02-01', FALSE),
('R003', 'U003', 'V003', 3, 'Average experience.', '2023-03-01', FALSE),
('R004', 'U001', 'V004', 2, 'Not very clean.', '2023-04-01', FALSE),
('R005', 'U002', 'V005', 5, 'Excellent condition!', '2023-05-01', FALSE),
('R006', 'U003', 'V006', 4, 'Very smooth ride.', '2023-06-01', FALSE),
('R007', 'U001', 'V007', 3, 'It was okay.', '2023-07-01', FALSE),
('R008', 'U002', 'V008', 1, 'Had some issues.', '2023-08-01', FALSE),
('R009', 'U003', 'V009', 5, 'Perfect for the trip!', '2023-09-01', FALSE),
('R010', 'U001', 'V010', 4, 'Really enjoyed it.', '2023-10-01', FALSE),
('R011', 'U002', 'V011', 2, 'Too expensive.', '2023-11-01', FALSE),
('R012', 'U003', 'V012', 3, 'Just fine.', '2023-12-01', FALSE);


INSERT INTO Booking (BookingID, UserID, vehicleID, StartDate, PickupLocationID, ReturnLocationID, EndDate, TotalCost, PaymentMethod, PaymentStatus, BookingStatus) VALUES
('B001', 'U001', 'V001', '2023-04-01', '01', '01', '2023-04-30', 1800, '信用卡', '已付款', '進行中'),
('B002', 'U002', 'V002', '2023-05-01', '03', '03', '2023-05-30', 2000, '現金', '已付款', '進行中'),
('B003', 'U003', 'V003', '2023-06-01', '01', '02', '2023-06-15', 1800, '行動支付', '未付款', '訂購完成'),
('B004', 'U004', 'V004', '2023-07-01', '02', '03', '2023-07-10', 2000, '信用卡', '已付款', '進行中'),
('B005', 'U005', 'V005', '2023-08-01', '03', '04', '2023-08-20', 2000, '現金', '已付款', '進行中'),
('B006', 'U006', 'V006', '2023-09-01', '04', '05', '2023-09-25', 2000, '行動支付', '未付款', '訂購完成'),
('B007', 'U001', 'V007', '2023-10-01', '05', '06', '2023-10-05', 2600, '信用卡', '已付款', '進行中'),
('B008', 'U002', 'V008', '2023-11-01', '06', '01', '2023-11-15', 2600, '現金', '未付款', '訂購完成');


