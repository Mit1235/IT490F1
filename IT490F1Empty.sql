CREATE TABLE `brackets` (
  `bracketID` smallint NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `bracketName` varchar(40) NOT NULL,
  `player1Name` varchar(40) NOT NULL,
  `player1Driver1` varchar(40),
  `player1Driver2` varchar(40),
  `player1PitCrew` varchar(40),
  `player1Score` int NOT NULL, 
  `player2Name` varchar(40),
  `player2Driver1` varchar(40),
  `player2Driver2` varchar(40),
  `player2PitCrew` varchar(40),
  `player2Score` int,
  `player3Name` varchar(40),
  `player3Driver1` varchar(40),
  `player3Driver2` varchar(40),
  `player3PitCrew` varchar(40),
  `player3Score` int,
  `player4Name` varchar(40),
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

CREATE TABLE `comments` (
  `commentID` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `bracketName` varchar(40),
  `username` varchar(40) NOT NULL,
  `commentText` varchar(999) NOT NULL
);

CREATE TABLE `versions` (
  `versionNo` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `versionName` varchar(40) NOT NULL,
  `workingStatus` tinyint
);
/*ALTER TABLE `brackets`
  ADD PRIMARY KEY (`bracketID`);


ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);*/
  






