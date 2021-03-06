USE [TestDB]
GO
/****** Object:  StoredProcedure [dbo].[GetLocalPlayers]    Script Date: 4/28/2019 12:04:11 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[GetLocalPlayers]
	@Location UNIQUEIDENTIFIER,
	@Player UNIQUEIDENTIFIER,
	@Alive BIT
AS
BEGIN

	SELECT *
	FROM Player 
	WHERE Player_Location = @Location 
	AND ID != @Player
	AND ( 
		(@Alive = 1 AND HP != 0)
		OR
		(@Alive = 0 AND HP = 0)
	) 

END
GO
