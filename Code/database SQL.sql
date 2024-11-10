Drop database rental;
CREATE database rental;
use rental;

CREATE TABLE user (
    UserID VARCHAR(50) PRIMARY KEY,
    Password VARCHAR(255),
    Name VARCHAR(50),
    IDNumber VARCHAR(10),
    Phone VARCHAR(15),
    Email VARCHAR(100),
    Address VARCHAR(255),
    Birthday DATE,
    License LONGBLOB
);


CREATE TABLE RentalMoney (
    Model VARCHAR(15) NOT NULL UNIQUE,
    RentalRate VARCHAR(15) NOT NULL
);

CREATE TABLE Location (
    LocationID VARCHAR(30) NOT NULL UNIQUE,
    LocationName VARCHAR(15) NOT NULL,
    Address VARCHAR(15) NOT NULL,
    ManagerID VARCHAR(15),
    used TINYINT NOT NULL DEFAULT 1 CHECK (used IN (0, 1))
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
    Model VARCHAR(15) NOT NULL,
    LicensePlate VARCHAR(30) NOT NULL,
    AvailabilityStatus TINYINT NOT NULL DEFAULT 0 CHECK (AvailabilityStatus IN (0, 1)),
    RentalRate  VARCHAR(15) NOT NULL
);


CREATE TABLE Review (
    ReviewID VARCHAR(15) NOT NULL UNIQUE,
    UserID VARCHAR(15) NOT NULL,
    vehicleID VARCHAR(15) NOT NULL,
    Rating INT CHECK (Rating BETWEEN 1 AND 5),
    Comment VARCHAR(30) NOT NULL,
    ReviewDate VARCHAR(15) NOT NULL
);


CREATE TABLE Booking (
    BookingID VARCHAR(15) NOT NULL UNIQUE,
    UserID VARCHAR(15) NOT NULL,
    vehicleID VARCHAR(15) NOT NULL,
    StartDate VARCHAR(15) NOT NULL,
    PickupLocationID VARCHAR(15) NOT NULL,
    ReturnLocationID VARCHAR(15) NOT NULL,
    EndDate VARCHAR(15) NOT NULL,
    TotalCost VARCHAR(15) NOT NULL,
    BookingStatus INT
);

show tables;

INSERT INTO user (UserID, Password, Name, IDNumber, Phone, Email, Address, Birthday, License) VALUES
('U001', 'password123', 'Alice', 'A123456789', '0912345678', 'alice@example.com', '123 Wonderland Ave', '1990-01-01', 'sample_license_1'),
('U002', 'password456', 'Bob', 'B987654321', '0923456789', 'bob@example.com', '456 Nowhere St', '1985-02-02', 'sample_license_2'),
('U003', 'password789', 'Charlie', 'C112233445', '0934567890', 'charlie@example.com', '789 Dreamland Rd', '1995-03-03', 'sample_license_3');


INSERT INTO RentalMoney (Model, RentalRate) VALUES
('TOYOTA YARIS', '1800'),
('NISSAN TIIDA', '2000'),
('TOYOTA SIENTA', '2600'),
('TESLA Model_3', '3100');


INSERT INTO Location (LocationID, LocationName, Address, ManagerID, used) VALUES
('01', '台北', '101 Taipei St', 'M001', 1),
('02', '桃園', '202 Taoyuan St', 'M002', 1),
('03', '新竹', '303 Hsinchu St', 'M003', 1),
('04', '台中', '404 Taichung  St', 'M001', 1),
('05', '台南', '505 Tainan St', 'M002', 1),
('06', '高雄', '606 Kaohsiung St', 'M003', 1);


INSERT INTO Manager (ManagerID, Password, Name, Email, Phone, LocationName) VALUES
('M001','111', 'Manager1', 'manager1@example.com', '0911111111', '台北'),
('M002','222', 'Manager2', 'manager2@example.com', '0922222222', '桃園'),
('M003','333', 'Manager3', 'manager3@example.com', '0933333333', '新竹'),
('M004','444', 'Manager4', 'manager4@example.com', '0944444444', '台中'),
('M005','555', 'Manager5', 'manager5@example.com', '0955555555', '台南'),
('M006','666', 'Manager6', 'manager6@example.com', '0966666666', '高雄');


INSERT INTO vehicle (vehicleID, Model, LicensePlate, AvailabilityStatus,RentalRate) VALUES
('V001', 'TOYOTA YARIS', 'ABC123', '0', '1800'),
('V002', 'NISSAN TIIDA', 'DEF456', '0', '2000'),
('V003', 'TOYOTA SIENTA', 'GHI789', '0', '2600'),
('V004', 'TESLA Model_3', 'JKL123', '0', '3100');


INSERT INTO Review (ReviewID, UserID, vehicleID, Rating, Comment, ReviewDate) VALUES
('R001', 'U001', 'V001', 5, 'Great car!', '2023-01-01'),
('R002', 'U002', 'V002', 4, 'Good service.', '2023-02-01'),
('R003', 'U003', 'V003', 3, 'Average experience.', '2023-03-01');


INSERT INTO Booking (BookingID, UserID, vehicleID, StartDate, PickupLocationID, ReturnLocationID, EndDate,TotalCost, BookingStatus) VALUES
('B001', 'U001', 'V001', '2023-04-01', '台北', '台北', '2023-04-30', '1800','1'),
('B002', 'U002', 'V002', '2023-05-01', '新竹', '新竹', '2023-05-30', '2000','1'),
('B003', 'U003', 'V003', '2023-06-01', '台南', '台南', '2023-06-30', '2600','1');