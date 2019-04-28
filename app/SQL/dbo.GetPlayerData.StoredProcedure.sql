USE [TestDB]
GO
/****** Object:  StoredProcedure [dbo].[GetPlayerData]    Script Date: 4/28/2019 12:04:11 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[GetPlayerData]
	@Player uniqueidentifier
AS
BEGIN
	SELECT * 
	FROM Player 
	WHERE ID = @Player
END
GO
