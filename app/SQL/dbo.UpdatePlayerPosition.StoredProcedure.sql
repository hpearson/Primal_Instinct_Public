USE [TestDB]
GO
/****** Object:  StoredProcedure [dbo].[UpdatePlayerPosition]    Script Date: 4/28/2019 12:04:11 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[UpdatePlayerPosition]
	@LocationTo UNIQUEIDENTIFIER,
	@Player UNIQUEIDENTIFIER
AS
BEGIN

	DECLARE @LocationFrom UNIQUEIDENTIFIER
	SET @LocationFrom = (SELECT Player_Location FROM Player WHERE ID = @Player)

	EXEC InsertTileLog @LocationFrom, 'A player has left this location.'

	UPDATE Player 
	SET Player_Location = @LocationTo
	WHERE ID = @Player

	EXEC InsertTileLog @LocationTo , 'A player entered this location.'

END
GO
