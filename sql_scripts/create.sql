CREATE TABLE Platform (
    platform_name CHAR(20), 
    platform_founder CHAR(25), 
    platform_type CHAR(40) NOT NULL,
    PRIMARY KEY (platform_name, platform_founder)
);

CREATE TABLE Agencies (
    agency_name char(50), 
    agency_founder char(25), 
    employee_count integer NOT NULL, 
    aLocation char(50),
    PRIMARY KEY (agency_name, agency_founder)
);


CREATE TABLE Contracts1 (
    contracts_id integer PRIMARY KEY, 
    cDate char(20) NOT NULL, 
    pay_rate integer NOT NULL
);



CREATE TABLE ContentCreators (
    content_creator_contact integer PRIMARY KEY, 
    cStatus char(10), 
    content_creator_name char(20) NOT NULL, 
    agency_name char(50), 
    agency_founder char(25), 
    contracts_id integer,
    handle char(20),
    FOREIGN KEY (agency_name, agency_founder) REFERENCES Agencies (agency_name, agency_founder),
    FOREIGN KEY (contracts_id) REFERENCES Contracts1 (contracts_id)
);

CREATE TABLE ContentCreated_FoundOn (
    title char(100), 
    content_id integer, 
    genre char(20), 
    content_type char(20), 
    URL_value char(150) NOT NULL,  
    platform_name char(20) NOT NULL, 
    platform_founder char(25) NOT NULL, 
    content_creator_contact integer NOT NULL,
    PRIMARY KEY (title, content_id, platform_name, platform_founder),
    FOREIGN KEY (content_creator_contact) REFERENCES ContentCreators (content_creator_contact) ON DELETE CASCADE,
    FOREIGN KEY (platform_name, platform_founder) REFERENCES Platform (platform_name, platform_founder)
);

CREATE TABLE MerchandiseSold1 (
    itemNumber integer PRIMARY KEY,
    mType char(20), 
    manufacturer char(20),
    content_creator_contact integer NOT NULL,
    FOREIGN KEY (content_creator_contact) REFERENCES ContentCreators (content_creator_contact)
        ON DELETE CASCADE    
);


CREATE TABLE MerchandiseSold2 (
    mType char(20), 
    manufacturer char(20),
    price integer NOT NULL,
    PRIMARY KEY (mType, manufacturer)
);


CREATE TABLE Youtubers (
    content_creator_contact integer PRIMARY KEY, 
    subscriber_count integer NOT NULL,
    FOREIGN KEY (content_creator_contact) REFERENCES ContentCreators (content_creator_contact)
    ON DELETE CASCADE    
);


CREATE TABLE Musicians (
    content_creator_contact integer PRIMARY KEY, 
    instrument char(20) NOT NULL,
    FOREIGN KEY (content_creator_contact) REFERENCES ContentCreators (content_creator_contact)
    ON DELETE CASCADE    
);


CREATE TABLE Photographers (
    content_creator_contact integer PRIMARY KEY, 
    camera char(20) NOT NULL,
    FOREIGN KEY (content_creator_contact) REFERENCES ContentCreators (content_creator_contact)
    ON DELETE CASCADE    
);


CREATE TABLE ManagersAssigned (
    manager_contact integer PRIMARY KEY, 
    manager_name char(20) NOT NULL, 
    content_creator_contact integer UNIQUE, 
    industry_experince integer,
    FOREIGN KEY (content_creator_contact) REFERENCES ContentCreators (content_creator_contact)
        ON DELETE CASCADE    
);

CREATE TABLE Event1 (
    event_name char(20), 
    eDate char(20),
    participant_count integer NOT NULL,
    PRIMARY KEY (event_name, eDate)
);


CREATE TABLE Event2 (
    event_name char(20), 
    event_type char(20) NOT NULL,
    PRIMARY KEY (event_name)
);


CREATE TABLE Host (
    agency_name char(50), 
    agency_founder char(25), 
    event_name char(20), 
    eDate char(20),
    PRIMARY KEY (agency_name, agency_founder, event_name, eDate),
    FOREIGN KEY (agency_name, agency_founder) REFERENCES Agencies (agency_name, agency_founder),
    FOREIGN KEY (event_name, eDate) REFERENCES Event1 (event_name, eDate),
    FOREIGN KEY (event_name) REFERENCES Event2 (event_name)
);

CREATE TABLE Sponsors (
    sponsors_name char(20), 
    company_name char(50), 
    sService char(20),
    PRIMARY KEY (sponsors_name, company_name)
);

CREATE TABLE Negotiate (
    agency_name char(50), 
    agency_founder char(25), 
    sponsors_name char(20), 
    sponsors_company char(50),
    PRIMARY KEY (agency_name, agency_founder, sponsors_name, sponsors_company),
    FOREIGN KEY (agency_name, agency_founder) REFERENCES Agencies (agency_name, agency_founder),
    FOREIGN KEY (sponsors_name, sponsors_company) REFERENCES Sponsors (sponsors_name, company_name)
);


CREATE TABLE Offer (
    agency_name char(50), 
    agency_founder char(25), 
    contracts_id integer,
    PRIMARY KEY (agency_name, agency_founder, contracts_id),
    FOREIGN KEY (agency_name, agency_founder) REFERENCES Agencies (agency_name, agency_founder),
    FOREIGN KEY (contracts_id) REFERENCES Contracts1 (contracts_id)
);

CREATE TABLE Contracts2 (
    cDate char(20), 
    pay_rate integer,
    duration integer NOT NULL,
    PRIMARY KEY(pay_rate, cDate)
);

grant select on Agencies to public;
grant select on Contracts1 to public;
grant select on ContentCreators to public;
grant select on MerchandiseSold1 to public;
grant select on MerchandiseSold2 to public;
grant select on Youtubers to public;
grant select on Offer to public;
grant select on Platform to public;
grant select on ContentCreated_FoundOn to public;
grant select on Musician to public;
grant select on Photographers to public;
grant select on ManagersAssigned to public;
grant select on Event1 to public;
grant select on Event2 to public;
grant select on Host to public;
grant select on Sponsors to public;
grant select on Negotiate to public;
grant select on Contracts2 to public;
