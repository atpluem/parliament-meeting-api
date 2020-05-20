CREATE TABLE CostsType(
    CostTypeID   INT PRIMARY KEY AUTO_INCREMENT,
    CostTypeName VARCHAR(60) NOT NULL
);

INSERT INTO CostsType
VALUES (1,"place rent");

INSERT INTO CostsType
VALUES (2,"hire people");

INSERT INTO CostsType
VALUES (3,"food and drink");

INSERT INTO CostsType
VALUES (4,"tools");

INSERT INTO CostsType
VALUES (5,"other");

CREATE TABLE ConferenceType(
    ConferenceTypeID   INT PRIMARY KEY AUTO_INCREMENT,
    ConferenceTypeName VARCHAR(60) NOT NULL
);



CREATE TABLE DocumentsType(
    DocumentsTypeID   INT PRIMARY KEY AUTO_INCREMENT,
    DocumentsTypeName VARCHAR(60) NOT NULL
);


CREATE TABLE PartyPos(
    PartyPosID      INT PRIMARY KEY AUTO_INCREMENT,
    PartyPosName    VARCHAR(60) NOT NULL,
    PartyPosDetail  VARCHAR(300)
);

CREATE TABLE CouncilPos(
    CouncilPosID     INT PRIMARY KEY AUTO_INCREMENT,
    CouncilPosName   VARCHAR(60) NOT NULL,
    CouncilPosDetail VARCHAR(300)
);


CREATE TABLE MinistryPos(
    MinistryPosID     INT PRIMARY KEY AUTO_INCREMENT,
    MinistryPosName   VARCHAR(60) NOT NULL,
    MinistryPosDetail VARCHAR(300)
);


CREATE TABLE Areas(
    Zipcode             INT PRIMARY KEY ,
    DistrictName        VARCHAR(60),
    ProvinceName        VARCHAR(60)
);

CREATE TABLE Building(
    BuildingName        VARCHAR(60) PRIMARY KEY,
    BuildingType        VARCHAR(60),
    BuildingNO          VARCHAR(10),
    BuildingStreet      VARCHAR(60),
    BuildingDetail      VARCHAR(300),
    BuildingPicture     BLOB,
    SubDistrictName     VARCHar(60),
    Zipcode             INT,
    FOREIGN KEY(Zipcode) REFERENCES Areas(Zipcode) ON DELETE SET NULL ON UPDATE CASCADE
);


CREATE TABLE Room(
    BuildingName    VARCHAR(60) ,
    RoomNo          INT , 
    PRIMARY KEY(BuildingName,RoomNo),
    FOREIGN KEY(BuildingName) REFERENCES Building(BuildingName) ON DELETE CASCADE ON UPDATE CASCADE
);


CREATE TABLE Ministry(
    MinistryName     VARCHAR(60) PRIMARY KEY ,
    MinisterID       VARCHAR(13),  
    MinistryDetail   VARCHAR(300),
    MinistrySymbol   BLOB
);

CREATE TABLE SubMinistry(
    SubMinistryName     VARCHAR(60) PRIMARY KEY ,
    MinistryName        VARCHAR(60) NOT NULL, 
    SubMinistryDetail   VARCHAR(300),
    BuildingName        VARCHAR(60),
    BuildingNO          VARCHAR(10),
    BuildingStreet      VARCHAR(60),
    BuildingDetail      VARCHAR(300),
    BuildingPicture     BLOB,
    SubDistrictName     VARCHar(60),
    Zipcode             INT,
    FOREIGN KEY(Zipcode) REFERENCES Areas(Zipcode) ON DELETE SET NULL ON UPDATE CASCADE,
    FOREIGN KEY(MinistryName) REFERENCES Ministry(MinistryName) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE PoliticalParty(
    PartyName           VARCHAR(60) PRIMARY KEY ,
    FounderID           VARCHAR(13),  
    FoundingTime        DATETIME,
    PartyTel            VARCHAR(10),
    PartyLogo           BLOB,
    BuildingName        VARCHAR(60),
    BuildingNO          VARCHAR(10),
    BuildingStreet      VARCHAR(60),
    BuildingDetail      VARCHAR(300),
    BuildingPicture     BLOB,
    SubDistrictName     VARCHar(60),
    Zipcode             INT,
    BuildingType        VARCHar(60),
    FOREIGN KEY(Zipcode) REFERENCES Areas(Zipcode) ON DELETE SET NULL ON UPDATE CASCADE
); 

CREATE TABLE CouncilConference(
    ConferenceID        INT AUTO_INCREMENT PRIMARY KEY,
    ConferenceTopic     VARCHAR(300),
    StartTime           TIME,
    EndTime             TIME,
    Dates               DATE,
	ConferenceTypeID    INT, 
	ChairmanID          VARCHAR(13),
	BuildingName        VARCHAR(60),
    RoomNo              INT, 
	FOREIGN KEY(ConferenceTypeID) REFERENCES ConferenceType(ConferenceTypeID) ON DELETE SET NULL ON UPDATE CASCADE,
	FOREIGN KEY(BuildingName,RoomNo) REFERENCES Room(BuildingName,RoomNo) ON DELETE SET NULL ON UPDATE CASCADE
);

CREATE TABLE SubTopic(
	ConferenceID        INT,  
	SubTopicName        VARCHAR(60), 
	SpeakerID           VARCHAR(13) NOT NULL,
    StartTopicTime      DATETIME    NOT NULL,
    EndTopicTime        DATETIME,
    NumberAcceptor      INT,
    NumberRejector      INT,
    NumberNonvoter      INT,
    PRIMARY KEY(ConferenceID,SubTopicName),
    FOREIGN KEY(ConferenceID) REFERENCES CouncilConference(ConferenceID) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE CouncilMember(
    PersonalID          VARCHAR(13) PRIMARY KEY,
    PartyName           VARCHAR(60), 
    PartyPosID          INT, 
    SubMinistryName     VARCHAR(60), 
    CouncilPosID        INT, 
    MinistryPosID       INT, 
    Surname             VARCHAR(60),
    Lastname            VARCHAR(60), 
    DOB                 DATETIME,
    EducationDegree     VARCHAR(60), 
    Password           VARCHAR(60), 
    MemberPicture       BLOB,
    FOREIGN KEY(PartyName)       REFERENCES PoliticalParty(PartyName)     ON DELETE SET NULL ON UPDATE CASCADE,
    FOREIGN KEY(PartyPosID)      REFERENCES PartyPos(PartyPosID)          ON DELETE SET NULL ON UPDATE CASCADE,
    FOREIGN KEY(SubMinistryName) REFERENCES SubMinistry(SubMinistryName)  ON DELETE SET NULL ON UPDATE CASCADE,
    FOREIGN KEY(CouncilPosID)    REFERENCES CouncilPos(CouncilPosID)      ON DELETE SET NULL ON UPDATE CASCADE,
    FOREIGN KEY(MinistryPosID)   REFERENCES MinistryPos(MinistryPosID)    ON DELETE SET NULL ON UPDATE CASCADE
);

ALTER TABLE CouncilConference
ADD FOREIGN KEY(ChairmanID)
REFERENCES CouncilMember(PersonalID)
ON DELETE SET NULL  ON UPDATE CASCADE;

ALTER TABLE Ministry
ADD FOREIGN KEY(MinisterID)
REFERENCES CouncilMember(PersonalID)
ON DELETE SET NULL  ON UPDATE CASCADE;

ALTER TABLE PoliticalParty
ADD FOREIGN KEY(FounderID)
REFERENCES CouncilMember(PersonalID)
ON DELETE SET NULL  ON UPDATE CASCADE;

ALTER TABLE Ministry
ADD FOREIGN KEY(MinisterID) 
REFERENCES CouncilMember(PersonalID) 
ON DELETE SET NULL ON UPDATE CASCADE;

CREATE TABLE Documents (
	DocumentID          INT AUTO_INCREMENT PRIMARY KEY,
    DocumentsTypeID     INT ,
    ConferenceID        INT , #FK1
    SubTopicName        VARCHAR(60), #FK1
    ApproverID          VARCHAR(13),
    DocumentTopic       VARCHAR(300) NOT NULL,
    ApprovedDate        DATETIME NOT NULL,
    FOREIGN KEY(ApproverID)     REFERENCES CouncilMember(PersonalID) ON DELETE SET NULL ON UPDATE CASCADE,
    FOREIGN KEY(DocumentsTypeID) REFERENCES DocumentsType(DocumentsTypeID) ON DELETE SET NULL ON UPDATE CASCADE,
    FOREIGN KEY(ConferenceID,SubTopicName) REFERENCES SubTopic(ConferenceID,SubTopicName) ON DELETE SET NULL ON UPDATE CASCADE
);

CREATE TABLE Argumentation (
    ArgumentatorID          VARCHAR(13),
    StartArgumentTime       TIME,
    SubTopicName            VARCHAR(60),
    ConferenceID            INT,
    EndArgumentTime         TIME,
    PRIMARY KEY(StartArgumentTime,ConferenceID),
    FOREIGN KEY(ArgumentatorID)            REFERENCES CouncilMember(PersonalID) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(ConferenceID,SubTopicName) REFERENCES SubTopic(ConferenceID,SubTopicName) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE Attendees(
	PersonalID              VARCHAR(13),
    ConferenceID            INT ,
    AttendantTime           DATETIME NOT NULL,
    LeaveTime               DATETIME,
	PRIMARY KEY(PersonalID,ConferenceID),
	FOREIGN KEY(PersonalID )   REFERENCES CouncilMember(PersonalID) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(ConferenceID)  REFERENCES CouncilConference(ConferenceID) ON DELETE  CASCADE ON UPDATE CASCADE
);

CREATE TABLE Costs(
    BillingID           INT PRIMARY KEY AUTO_INCREMENT,
	ConferenceID        INT ,
    CostTypeID          INT ,
    CostValue           FLOAT,
    ReceiptName         VARCHAR(300),
    ReceiptApproverID   VARCHAR(13),
    FOREIGN KEY(ConferenceID)       REFERENCES CouncilConference(ConferenceID) ON DELETE  CASCADE  ON UPDATE CASCADE,
    FOREIGN KEY(CostTypeID)         REFERENCES CostsType(CostTypeID)           ON DELETE  SET NULL  ON UPDATE CASCADE,
    FOREIGN KEY(ReceiptApproverID)  REFERENCES CouncilMember(PersonalID)       ON DELETE SET NULL ON UPDATE CASCADE
);




