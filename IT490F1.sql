CREATE TABLE `brackets` (
  `bracketID` smallint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


CREATE TABLE `users` (
  `userID` tinyint NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `screenName` varchar(20) NOT NULL,
  `friendCode` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


ALTER TABLE `brackets`
  ADD PRIMARY KEY (`bracketID`);


ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);


ALTER TABLE `brackets`
  MODIFY `bracketID` smallint NOT NULL AUTO_INCREMENT;


ALTER TABLE `users`
  MODIFY `userID` tinyint NOT NULL AUTO_INCREMENT;




