CREATE TABLE accounts ( 
    Username VARCHAR(25) PRIMARY KEY, 
    Password VARCHAR(25) NOT NULL, 
    Firstname VARCHAR(25) NOT NULL, 
    Lastname VARCHAR(25) NOT NULL, 
    Phone VARCHAR(25) NOT NULL, 
    Email VARCHAR(25) NOT NULL 
);

CREATE TABLE report ( 
    reportID INT PRIMARY KEY AUTO_INCREMENT, 
    accUsername VARCHAR(30) NOT NULL, 
    reportDate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, 
    reportDescript VARCHAR(200) NOT NULL, 
    reportLoc VARCHAR(25) NOT NULL, 
    reportStatus SMALLINT NOT NULL DEFAULT 0, 
    reportType VARCHAR(40) NOT NULL, 
    reportVotes INT NOT NULL DEFAULT 1 
) ENGINE=InnoDB;

ALTER TABLE report ADD CONSTRAINT report_refs FOREIGN KEY (accUsername) REFERENCES accounts (Username);

CREATE TABLE votes ( reportID INT, Username VARCHAR(25), val INT, PRIMARY KEY (reportID, Username) ) ENGINE=InnoDB;

ALTER TABLE votes ADD CONSTRAINT vote_refs FOREIGN KEY (reportID) REFERENCES report (reportID); 
ALTER TABLE votes ADD CONSTRAINT vote_refs2 FOREIGN KEY (Username) REFERENCES accounts (Username);
