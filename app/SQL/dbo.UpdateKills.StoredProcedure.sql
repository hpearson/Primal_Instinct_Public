USE [TestDB]
GO
/****** Object:  StoredProcedure [dbo].[UpdateKills]    Script Date: 4/28/2019 12:04:11 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[UpdateKills]
	@Player UNIQUEIDENTIFIER,
	@Amount INT
AS
BEGIN

	UPDATE Player
	SET Kills = (Kills + @Amount)
	WHERE ID = @Player

END
GO
