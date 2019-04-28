USE [TestDB]
GO
/****** Object:  StoredProcedure [dbo].[GetPlayerLocation]    Script Date: 4/28/2019 10:51:05 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[GetPlayerLocation]
	@Player uniqueidentifier
AS
BEGIN

	SELECT *
	FROM Player
	LEFT JOIN GameBoard
	ON Player.Player_Location = Gameboard.ID
	WHERE Player.ID = @Player

END
GO
