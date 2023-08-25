INSERT INTO Platform VALUES ('X', 'Elon Musk', 'Networking');
INSERT INTO Platform VALUES ('Facebook', 'Mark Zuckerberg', 'Networking');
INSERT INTO Platform VALUES ('Youtube', 'Neal Mohan', 'Video Sharing');
INSERT INTO Platform VALUES ('Twitch', 'Dan Clancy', 'Streaming Service');
INSERT INTO Platform VALUES ('Pinterest', 'Bill Ready', 'Image Sharing');

INSERT INTO Agencies VALUES ('CREATIVE ARTISTS AGENCY', 'Michael Ovitz', 1000, 'Los Angeles, California');
INSERT INTO Agencies VALUES ('Integral Artists', 'Ben Silverman', 1500, 'Vancouver, British Columbia');
INSERT INTO Agencies VALUES ('JYP Entertainment', 'J.Y. Park', 1300, 'Seoul, South Korea');
INSERT INTO Agencies VALUES ('INTERNATIONAL CREATIVE MANAGEMENT PARTNERS', 'Marvin Josephson', 600, 'Los Angeles, California');
INSERT INTO Agencies VALUES ('PARADIGM TALENT AGENCY', 'Sam Gores', 800, 'Los Angeles, New York');

INSERT INTO Contracts1 VALUES (1, '2023-08-09', 80000);
INSERT INTO Contracts1 VALUES (2, '2023-09-18', 100000);
INSERT INTO Contracts1 VALUES (3, '2023-10-05', 60000);
INSERT INTO Contracts1 VALUES (4, '2023-10-09', 50000);
INSERT INTO Contracts1 VALUES (5, '2023-10-27', 75000);
INSERT INTO Contracts1 VALUES (6, '2023-10-17', 91822);
INSERT INTO Contracts1 VALUES (7, '2023-11-02', 87368);
INSERT INTO Contracts1 VALUES (8, '2023-11-03', 61956);
INSERT INTO Contracts1 VALUES (9, '2023-12-04', 196285);
INSERT INTO Contracts1 VALUES (10, '2023-12-27', 94382);

INSERT INTO ContentCreators VALUES (1870, 'active', 'Ben', 'CREATIVE ARTISTS AGENCY', 'Michael Ovitz', 1, 'TotallyNotBen');
INSERT INTO ContentCreators VALUES (6438, 'active', 'Jake', 'Integral Artists', 'Ben Silverman', 2, 'SpoonHalfFull');
INSERT INTO ContentCreators VALUES (9051, 'suspended', 'Linus', 'JYP Entertainment', 'J.Y. Park', 3, 'TheRealGamer');
INSERT INTO ContentCreators VALUES (8762, 'inactive', 'Jekyll', 'INTERNATIONAL CREATIVE MANAGEMENT PARTNERS', 'Marvin Josephson', 4, 'DaringReading301');
INSERT INTO ContentCreators VALUES (7592, 'suspended', 'Hyde', 'PARADIGM TALENT AGENCY', 'Sam Gores', 5, 'OffBeatTakes');

INSERT INTO ContentCreators VALUES (1234, 'active', 'Brad', 'CREATIVE ARTISTS AGENCY', 'Michael Ovitz', 6, 'FakeFilms');
INSERT INTO ContentCreators VALUES (4567, 'active', 'Fujii', 'Integral Artists', 'Ben Silverman', 7, 'Fujiisan');
INSERT INTO ContentCreators VALUES (7890, 'suspended', 'Carl', 'JYP Entertainment', 'J.Y. Park', 8, 'CandyCorn');
INSERT INTO ContentCreators VALUES (4004, 'inactive', 'Tim', 'INTERNATIONAL CREATIVE MANAGEMENT PARTNERS', 'Marvin Josephson', 9, 'TimmyTrumpet');
INSERT INTO ContentCreators VALUES (2548, 'suspended', 'Karen', 'PARADIGM TALENT AGENCY', 'Sam Gores', 10, 'KazooKid');

INSERT INTO ContentCreated_FoundOn VALUES ('Turning paint thinner into cherry soda', 1,	'Science', 'Video', 'https://www.youtube.com/watch?v=NIVkBs7oWDI', 'Youtube', 'Neal Mohan', 1234);
INSERT INTO ContentCreated_FoundOn VALUES ('EG vs TSM | 2023 LCS Summer Playoffs - Upper Bracket Round 1', 2, 'Gaming',	'Stream', 'https://www.twitch.tv/lcs', 'Twitch', 'Dan Clancy', 4567);
INSERT INTO ContentCreated_FoundOn VALUES ('Beauty in all things...	', 3, 'Animals', 'Image', 'https://www.pinterest.ca/pin/324681454400300295/', 'Pinterest', 'Bill Ready', 7890);
INSERT INTO ContentCreated_FoundOn VALUES ('Why Are 96,000,000 Black Balls on This Reservoir?', 4, 'Science', 'Video', 'https://www.youtube.com/watch?v=uxPdPpi5W4o', 'Youtube', 'Neal Mohan', 4004);
INSERT INTO ContentCreated_FoundOn VALUES ('Magical Mountains', 5, 'Nature', 'Image', 'https://www.pinterest.ca/pin/294000681939446922/', 'Pinterest', 'Bill Ready', 2548);

INSERT INTO MerchandiseSold1 VALUES (1, 'shirt', 'gap', 1234);
INSERT INTO MerchandiseSold1 VALUES (2, 'energy drink', 'Kool-Aid', 4567);
INSERT INTO MerchandiseSold1 VALUES (3, 'skin care prod', 'Neutrogena', 7890);
INSERT INTO MerchandiseSold1 VALUES (4,	'audioBook', 'Scholastic', 4004);
INSERT INTO MerchandiseSold1 VALUES (5, 'game', 'Nintendo', 2548);
INSERT INTO MerchandiseSold1 VALUES (6, 'software', 'Nintendo', 2548);

INSERT INTO MerchandiseSold2 VALUES ('shirt', 'gap', 15);
INSERT INTO MerchandiseSold2 VALUES ('energy drink', 'Kool-Aid', 7);
INSERT INTO MerchandiseSold2 VALUES ('skin care product', 'Neutrogena', 40);
INSERT INTO MerchandiseSold2 VALUES ('audioBook', 'Scholastic', 12);
INSERT INTO MerchandiseSold2 VALUES ('game', 'Nintendo', 90);
INSERT INTO MerchandiseSold2 VALUES ('software', 'Nintendo', 45);

INSERT INTO Youtubers VALUES (1234, 900000);
INSERT INTO Youtubers VALUES (4004, 128000);
INSERT INTO Youtubers VALUES (4567, 4000);
INSERT INTO Youtubers VALUES (2548, 37000);
INSERT INTO Youtubers VALUES (7890, 28046);
INSERT INTO Youtubers VALUES (9051, 2548);

INSERT INTO Musicians VALUES (4004, 'Trumpet');
INSERT INTO Musicians VALUES (1234, 'Kazoo');
INSERT INTO Musicians VALUES (4567, 'Drums');
INSERT INTO Musicians VALUES (7890, 'Guitar');
INSERT INTO Musicians VALUES (2548, 'Piano');

INSERT INTO Photographers VALUES (1234, 'Nikon');
INSERT INTO Photographers VALUES (4567, 'Fujifilm');
INSERT INTO Photographers VALUES (4004, 'Canon');
INSERT INTO Photographers VALUES (7890, 'Sony');
INSERT INTO Photographers VALUES (2548, 'Kodak');

INSERT INTO ManagersAssigned VALUES (1, 'Sharon Chapman', 1234, 5);
INSERT INTO ManagersAssigned VALUES (2, 'Zayn Morse', NULL, 10);
INSERT INTO ManagersAssigned VALUES (3, 'Gail Savage', 4567, 15);
INSERT INTO ManagersAssigned VALUES (4, 'Deanna Ray', 7890, 20);
INSERT INTO ManagersAssigned VALUES (5, 'Shauna Gomez', 2548, 25);

INSERT INTO Event1 VALUES ('Musician Recruitment', '2023-09-14', 1000);
INSERT INTO Event1 VALUES ('Youtuber Meetup', '2023-11-03', 1500);
INSERT INTO Event1 VALUES ('Artist Recruitment', '2023-11-27', 1200);
INSERT INTO Event1 VALUES ('Streamer Awards', '2023-12-20', 900);
INSERT INTO Event1 VALUES ('Manager Recruitment', '2023-12-22', 250);

INSERT INTO Event2 VALUES ('Musician Recruitment', 'Recruitment');
INSERT INTO Event2 VALUES ('Youtuber Meetup', 'Meetup');
INSERT INTO Event2 VALUES ('Artist Recruitment', 'Recruitment');
INSERT INTO Event2 VALUES ('Streamer Awards', 'Award Ceremony');
INSERT INTO Event2 VALUES ('Manager Recruitment', 'Recruitment');

INSERT INTO Host VALUES ('CREATIVE ARTISTS AGENCY', 'Michael Ovitz', 'Musician Recruitment', '2023-09-14');
INSERT INTO Host VALUES ('Integral Artists', 'Ben Silverman', 'Youtuber Meetup', '2023-11-03');
INSERT INTO Host VALUES ('JYP Entertainment', 'J.Y. Park', 'Artist Recruitment', '2023-11-27');
INSERT INTO Host VALUES ('INTERNATIONAL CREATIVE MANAGEMENT PARTNERS', 'Marvin Josephson', 'Streamer Awards', '2023-12-20');
INSERT INTO Host VALUES ('PARADIGM TALENT AGENCY', 'Sam Gores', 'Manager Recruitment', '2023-12-22');

INSERT INTO Sponsors VALUES ('Tide', 'Procter', 'Detergent');
INSERT INTO Sponsors VALUES ('RedBull', 'RedBull GmbH', 'Drinks');
INSERT INTO Sponsors VALUES ('Subway','Doctors Associates, Inc.', 'Food');
INSERT INTO Sponsors VALUES ('Nike', 'Nike', 'Hoodie');
INSERT INTO Sponsors VALUES ('Adidas', 'Adidas AG', 'Shoes');

INSERT INTO Negotiate VALUES ('CREATIVE ARTISTS AGENCY', 'Michael Ovitz', 'Tide', 'Procter');
INSERT INTO Negotiate VALUES ('Integral Artists', 'Ben Silverman', 'RedBull', 'RedBull GmbH');
INSERT INTO Negotiate VALUES ('JYP Entertainment', 'J.Y. Park', 'Subway', 'Doctors Associates, Inc.');
INSERT INTO Negotiate VALUES ('INTERNATIONAL CREATIVE MANAGEMENT PARTNERS', 'Marvin Josephson', 'Nike',	'Nike');
INSERT INTO Negotiate VALUES ('PARADIGM TALENT AGENCY', 'Sam Gores', 'Adidas', 'Adidas AG');
 
INSERT INTO Offer VALUES ('CREATIVE ARTISTS AGENCY', 'Michael Ovitz', 1);
INSERT INTO Offer VALUES ('CREATIVE ARTISTS AGENCY', 'Michael Ovitz', 2);
INSERT INTO Offer VALUES ('CREATIVE ARTISTS AGENCY', 'Michael Ovitz', 3);
INSERT INTO Offer VALUES ('CREATIVE ARTISTS AGENCY', 'Michael Ovitz', 4);
INSERT INTO Offer VALUES ('CREATIVE ARTISTS AGENCY', 'Michael Ovitz', 5);
INSERT INTO Offer VALUES ('CREATIVE ARTISTS AGENCY', 'Michael Ovitz', 6);
INSERT INTO Offer VALUES ('CREATIVE ARTISTS AGENCY', 'Michael Ovitz', 7);
INSERT INTO Offer VALUES ('CREATIVE ARTISTS AGENCY', 'Michael Ovitz', 8);
INSERT INTO Offer VALUES ('CREATIVE ARTISTS AGENCY', 'Michael Ovitz', 9);
INSERT INTO Offer VALUES ('CREATIVE ARTISTS AGENCY', 'Michael Ovitz', 10);
INSERT INTO Offer VALUES ('Integral Artists', 'Ben Silverman', 2);
INSERT INTO Offer VALUES ('JYP Entertainment', 'J.Y. Park', 3);
INSERT INTO Offer VALUES ('INTERNATIONAL CREATIVE MANAGEMENT PARTNERS', 'Marvin Josephson',	4);
INSERT INTO Offer VALUES ('PARADIGM TALENT AGENCY',	'Sam Gores', 5);


INSERT INTO Contracts2 VALUES ('2023-09-14', 80000,	8);
INSERT INTO Contracts2 VALUES ('2023-11-03', 100000, 10);
INSERT INTO Contracts2 VALUES ('2023-11-27', 60000, 2);
INSERT INTO Contracts2 VALUES ('2023-12-20', 50000, 4);
INSERT INTO Contracts2 VALUES ('2023-12-22', 75000, 20);