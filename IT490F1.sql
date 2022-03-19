CREATE TABLE `brackets` (
  `bracketID` smallint NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `bracketName` varchar(40) NOT NULL,
  `player1ID` int NOT NULL,
  `player1Driver1` varchar(40),
  `player1Driver2` varchar(40),
  `player1PitCrew` varchar(40),
  `player1Score` int NOT NULL, 
  `player2ID` int,
  `player2Driver1` varchar(40),
  `player2Driver2` varchar(40),
  `player2PitCrew` varchar(40),
  `player2Score` int,
  `player3ID` int,
  `player3Driver1` varchar(40),
  `player3Driver2` varchar(40),
  `player3PitCrew` varchar(40),
  `player3Score` int,
  `player4ID` int,
  `player4Driver1` varchar(40),
  `player4Driver2` varchar(40),
  `player4PitCrew` varchar(40),
  `player4Score` int
);


CREATE TABLE `users` (
  `userID` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `username` varchar(40) NOT NULL,
  `password` varchar(99) NOT NULL,
  `email` varchar (40) NOT NULL,
  `isNotif` tinyint NOT NULL
);


/*ALTER TABLE `brackets`
  ADD PRIMARY KEY (`bracketID`);


ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);*/
  






