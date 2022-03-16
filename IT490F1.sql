CREATE TABLE `brackets` (
  `bracketID` smallint NOT NULL AUTO_INCREMENT,
  `bracketName` varchar(40) NOT NULL,
  `player1ID` int NOT NULL,
  `player1Driver` varchar(40),
  `player1PitCrew` varchar(40),
  `player1Score` int NOT NULL, 
) DEFAULT CHARSET=utf8mb4;


CREATE TABLE `users` (
  `userID` int NOT NULL AUTO_INCREMENT,
  `username` varchar(40) NOT NULL,
  `hashPass` varchar(40) NOT NULL,
  'email' varchar (40) NOT NULL,
  'isNotif' tinyint NOT NULL,
) DEFAULT CHARSET=utf8mb4;

CREATE TABLE `races` (
  `raceName` varchar(40) NOT NULL,
  `raceLocation` varchar(50) NOT NULL,
  `raceDT` datetime NOT NULL,
) DEFAULT CHARSET=utf8mb4


ALTER TABLE `brackets`
  ADD PRIMARY KEY (`bracketID`);


ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);
  
ALTER TABLE `races`
  ADD PRIMARY KEY (`raceName`)






