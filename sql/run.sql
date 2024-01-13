-- Create the database
CREATE DATABASE pets_care;

-- Use the pets_care database
USE pets_care;

-- Create the customer_details table
CREATE TABLE customer_details (
    UserID INT AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(255) NOT NULL,
    Email VARCHAR(255) NOT NULL,
    PhoneNumber VARCHAR(20) NOT NULL,
    Password VARCHAR(255) NOT NULL
);

CREATE TABLE pets (
    PetID INT AUTO_INCREMENT PRIMARY KEY,
    UserID INT,
    PetName VARCHAR(50),
    PetType TEXT,
    PetGender TEXT,
    Breed TEXT,
    BirthDay DATE,
    Weight INT(11),
    FOREIGN KEY (UserID) REFERENCES customer_details(UserID)
);

CREATE TABLE services (
    ServiceID INT AUTO_INCREMENT PRIMARY KEY,
    PetType TEXT,
    Service TEXT NOT NULL,
    Type TEXT NOT NULL,
    Amount INT NOT NULL,
    Rating INT NOT NULL,
    Info VARCHAR(1000) NOT NULL
);

CREATE TABLE bookings (
    BookingID INT AUTO_INCREMENT PRIMARY KEY,
    UserID INT,
    PetID INT,
    Service VARCHAR(100),
    Type VARCHAR(100),
    AppointmentDate DATE,
    AppointmentTime VARCHAR(50),
    Amount INT,
    PickupAddress VARCHAR(200),
    IsInCart BIT,
    FOREIGN KEY (UserID) REFERENCES customer_details(UserID),
    FOREIGN KEY (PetID) REFERENCES pets(PetID)
);

-- For service = "Veterinary"
INSERT INTO services (PetType, Service, Type, Amount, Rating, Info)
VALUES
    ('Dog','Veterinary', 'General Consultation', 49, 4, 'General Consultation'),
    ('Dog','Veterinary', 'Dog Vaccination Pack', 3999, 5, 'Dog Vaccination Pack'),
    ('Dog','Veterinary', 'Health Checkup', 2500, 5, 'Health Checkup'),
    ('Dog','Veterinary', 'Anti Tick Treatment', 1499, 4, 'Anti Tick Treatment'),
    ('Dog','Veterinary', 'Corona virus Vaccination', 1298, 5, 'Corona virus Vaccination'),
    ('Dog','Veterinary', 'Home Visit Consultation', 999, 5, 'Home Visit Consultation');

-- For service = "Training"
INSERT INTO services (PetType, Service, Type, Amount, Rating, Info)
VALUES
    ('Dog','Training', 'Obedience Store', 499, 5, 'Obedience Store'),
    ('Dog','Training', 'Puppy Program', 499, 5, 'Puppy Program'),
    ('Dog','Training', 'Guarding & IPO Protection Program', 999, 4, 'Guarding & IPO Protection Program'),
    ('Dog','Training', 'Aggression & Behaviour Modification', 999, 4, 'Aggression & Behaviour Modification'),
    ('Dog','Training', 'ADVANCE Obedience Program', 999, 5, 'ADVANCE Obedience Program');

-- For service = "Grooming"
INSERT INTO services (PetType, Service, Type, Amount, Rating, Info)
VALUES
    ('Dog','Grooming', 'Wash-n-Dash', 899, 5, 'Wash-n-Dash'),
    ('Dog','Grooming', 'Mini Grooming', 1099, 5, 'Mini Grooming'),
    ('Dog','Grooming', 'Full Grooming', 1599, 4, 'Full Grooming');

-- For service = "Walking"
INSERT INTO services (PetType, Service, Type, Amount, Rating, Info)
VALUES
    ('Dog','Walking', 'Demo Walk', 0, 5, 'Demo Walk'),
    ('Dog','Walking', '1 Time Walk', 3499, 5, '1 Time Walk'),
    ('Dog','Walking', '2 Time Walk', 6499, 4, '2 Time Walk');
	
	

-- For service = "Veterinary"
INSERT INTO services (PetType, Service, Type, Amount, Rating, Info)
VALUES
    ('Cat','Veterinary', 'General Consultation', 49, 4, 'General Consultation'),
    ('Cat','Veterinary', 'Cat Vaccination Pack', 3999, 5, 'Cat Vaccination Pack'),
    ('Cat','Veterinary', 'Health Checkup', 2500, 5, 'Health Checkup'),
    ('Cat','Veterinary', 'Anti Tick Treatment', 1499, 4, 'Anti Tick Treatment'),
    ('Cat','Veterinary', 'Corona virus Vaccination', 1298, 5, 'Corona virus Vaccination'),
    ('Cat','Veterinary', 'Home Visit Consultation', 999, 5, 'Home Visit Consultation');

-- For service = "Training"
INSERT INTO services (PetType, Service, Type, Amount, Rating, Info)
VALUES
    ('Cat','Training', 'Obedience Store', 499, 5, 'Obedience Store'),
    ('Cat','Training', 'Kitten Program', 499, 5, 'Kitten Program'),
    ('Cat','Training', 'Guarding & IPO Protection Program', 999, 4, 'Guarding & IPO Protection Program'),
    ('Cat','Training', 'Aggression & Behaviour Modification', 999, 4, 'Aggression & Behaviour Modification'),
    ('Cat','Training', 'ADVANCE Obedience Program', 999, 5, 'ADVANCE Obedience Program');

-- For service = "Grooming"
INSERT INTO services (PetType, Service, Type, Amount, Rating, Info)
VALUES
    ('Cat','Grooming', 'Wash-n-Dash', 899, 5, 'Wash-n-Dash'),
    ('Cat','Grooming', 'Mini Grooming', 1099, 5, 'Mini Grooming'),
    ('Cat','Grooming', 'Full Grooming', 1599, 4, 'Full Grooming');

-- For service = "Walking"
INSERT INTO services (PetType, Service, Type, Amount, Rating, Info)
VALUES
    ('Cat','Walking', 'Demo Walk', 0, 5, 'Demo Walk'),
    ('Cat','Walking', '1 Time Walk', 3499, 5, '1 Time Walk'),
    ('Cat','Walking', '2 Time Walk', 6499, 4, '2 Time Walk');

