MySQL Command

=====

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
    Username VARCHAR(30) NOT NULL, 
    reportDate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, 
    reportDescript VARCHAR(200) NOT NULL, 
    reportLoc VARCHAR(25) NOT NULL, 
    reportStatus SMALLINT NOT NULL DEFAULT 0, 
    reportType VARCHAR(40) NOT NULL, 
    reportVotes INT NOT NULL DEFAULT 1 
) ENGINE=InnoDB;

ALTER TABLE report ADD CONSTRAINT report_refs FOREIGN KEY (Username) REFERENCES accounts (Username);

CREATE TABLE votes ( reportID INT, Username VARCHAR(25), val INT, PRIMARY KEY (reportID, Username) ) ENGINE=InnoDB;

ALTER TABLE votes ADD CONSTRAINT vote_refs FOREIGN KEY (reportID) REFERENCES report (reportID); 
ALTER TABLE votes ADD CONSTRAINT vote_refs2 FOREIGN KEY (Username) REFERENCES accounts (Username);

INSERT INTO accounts (Username, Password, Firstname, Lastname, Phone, Email) VALUES ('brucelee123' ,'dsadsadsa', 'bruce', 'lee', '4169671111', 'brucelee@gmail.com');
INSERT INTO accounts (Username, Password, Firstname, Lastname, Phone, Email) VALUES ('biggerthan','dsadsadsa', 'big', 'small', '4169671111', 'medium@gmail.com');
INSERT INTO accounts (Username, Password, Firstname, Lastname, Phone, Email) VALUES ('fatman' ,'dsadsadsa', 'fat', 'skinny', '4169671111', 'obese@gmail.com');
INSERT INTO accounts (Username, Password, Firstname, Lastname, Phone, Email) VALUES ('test123' ,'dsadsadsa', 'ult', 'test', '4169671111', 'test@hotmail.com');
INSERT INTO accounts (Username, Password, Firstname, Lastname, Phone, Email) VALUES ('lalala' ,'dsadsadsa', 'lo', 'ly', '4169671111', 'lalelo@gmail.com');
INSERT INTO accounts (Username, Password, Firstname, Lastname, Phone, Email) VALUES ('rijw' ,'dsadsadsa', 'abc', 'def', '4169671111', 'ghijkl@ryerson.ca');

INSERT INTO report (Username, reportDescript, reportLoc, reportType, reportVotes) VALUES ('brucelee123', 'There is a mountain of geese litter around my house. Please clean.', 'Dundas and Bay', 'Garbage or Other Road Blocking Objects', 70);
INSERT INTO report (Username, reportDescript, reportLoc, reportType, reportVotes) VALUES ('brucelee123', 'There is a pothole at the South West corner of the intersection. It is ruining cars.', 'Dundas and Bay', 'Potholes', 10);
INSERT INTO report (Username, reportDescript, reportLoc, reportType, reportVotes) VALUES ('brucelee123', 'A storm blew down the willow tree and damaged power lines near my University.', 'Dundas and Yonge', 'Tree Collapse', 700);
INSERT INTO report (Username, reportDescript, reportLoc, reportType, reportVotes) VALUES ('biggerthan', 'Winter erosion made the roads outside my house crappy.', 'Eglinton and Bayview', 'Eroded Streets', 100);
INSERT INTO report (Username, reportDescript, reportLoc, reportType, reportVotes) VALUES ('biggerthan', 'Mould inside my apartment. Landlord will not fix.', 'Eglinton and Bayview', 'Mould and Spore Growth', 1000);
INSERT INTO report (Username, reportDescript, reportLoc, reportType, reportVotes) VALUES ('biggerthan', 'Water main for my apartment burst. Need help. Dying of thirst.', 'Eglinton and Bayview', 'Utility Failure', 40);
INSERT INTO report (Username, reportDescript, reportLoc, reportType, reportVotes) VALUES ('fatman', 'Stinking kids vandalized the statue at my park.', 'Gerrard and Jones', 'Vandalism', 500);
