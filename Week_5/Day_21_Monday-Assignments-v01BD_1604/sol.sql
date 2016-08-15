DROP DATABASE IF EXISTS MedicalMalpractice;

CREATE DATABASE MedicalMalpractice;
USE MedicalMalpractice;
CREATE TABLE Claims (
    claim_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
    patient_name VARCHAR(30) NOT NULL
);

INSERT INTO Claims (patient_name) Values ('Bassem Dghaidi');
INSERT INTO Claims (patient_name) Values ('Omar Breidi');
INSERT INTO Claims (patient_name) Values ('Marwan Sawwan');

CREATE TABLE Defendants (
    claim_id INT UNSIGNED NOT NULL,
    defendant_name VARCHAR(30) NOT NULL,
    FOREIGN KEY (claim_id)
        REFERENCES Claims (claim_id)
);

INSERT INTO Defendants Values ('1' , 'Jean Skaff');
INSERT INTO Defendants Values ('1' , 'Elie Meouchi');
INSERT INTO Defendants Values ('1' , 'Radwan Sameh');
INSERT INTO Defendants Values ('2' , 'Joseph Eid'); 
INSERT INTO Defendants Values ('2' , 'Paul Syoufi'); 
INSERT INTO Defendants Values ('2' , 'Radwan Sameh'); 
INSERT INTO Defendants Values ('3' , 'Issam Awwad');

CREATE TABLE ClaimStatusCodes (
    claim_status VARCHAR(2) NOT NULL PRIMARY KEY,
    claim_status_desc VARCHAR(40) NOT NULL,
    claim_seq INT UNSIGNED NOT NULL
);

INSERT INTO ClaimStatusCodes Values ('AP', 'Awaiting review panel', '1');
INSERT INTO ClaimStatusCodes Values ('OR', 'Panel opinion rendered', '2');
INSERT INTO ClaimStatusCodes Values ('SF', 'Suit filed', '3');
INSERT INTO ClaimStatusCodes Values ('CL', 'Closed', '4');

CREATE TABLE LegalEvents (
    claim_id INT UNSIGNED NOT NULL,
    defendant_name VARCHAR(30) NOT NULL,
    claim_status VARCHAR(2) NOT NULL,
    change_date DATE NOT NULL,
    FOREIGN KEY (claim_id)
        REFERENCES Claims (claim_id),
    FOREIGN KEY (claim_status)
        REFERENCES ClaimStatusCodes (claim_status)
);

INSERT INTO LegalEvents Values ('1' , 'Jean Skaff', 'AP', '2016-01-01');
INSERT INTO LegalEvents Values ('1' , 'Jean Skaff', 'OR', '2016-02-02');
INSERT INTO LegalEvents Values ('1' , 'Jean Skaff', 'SF', '2016-03-01');
INSERT INTO LegalEvents Values ('1' , 'Jean Skaff', 'CL', '2016-04-01');
INSERT INTO LegalEvents Values ('1' , 'Radwan Sameh', 'AP', '2016-01-01');
INSERT INTO LegalEvents Values ('1' , 'Radwan Sameh','OR', '2016-02-02');
INSERT INTO LegalEvents Values ('1' , 'Radwan Sameh', 'SF', '2016-03-01');
INSERT INTO LegalEvents Values ('1' , 'Elie Meouchi', 'AP', '2016-01-01');
INSERT INTO LegalEvents Values ('1' , 'Elie Meouchi', 'OR', '2016-02-02');
INSERT INTO LegalEvents Values ('2' , 'Radwan Sameh', 'AP', '2016-01-01');
INSERT INTO LegalEvents Values ('2' , 'Radwan Sameh', 'OR', '2016-02-01');
INSERT INTO LegalEvents Values ('2' , 'Paul Syoufi', 'AP', '2016-01-01');
INSERT INTO LegalEvents Values ('3', 'Issam Awwad', 'AP', '2016-01-01');

SELECT 
    Claims.claim_id,
    Claims.patient_name,
    Def_Claim_Status.claim_status
FROM
    Claims
        INNER JOIN
    (SELECT 
        claim_id, claim_status
    FROM
        (SELECT 
        *
    FROM
        (SELECT 
        LE . *, CS.claim_seq
    FROM
        LegalEvents AS LE
    INNER JOIN ClaimStatusCodes AS CS ON LE.claim_status = CS.claim_status
    ORDER BY claim_seq DESC) AS LE_CS
    GROUP BY claim_id , defendant_name
    ORDER BY claim_seq) Cid_DefName_Cseq
    GROUP BY claim_id) AS Def_Claim_Status ON Def_Claim_Status.claim_id = Claims.claim_id;  













