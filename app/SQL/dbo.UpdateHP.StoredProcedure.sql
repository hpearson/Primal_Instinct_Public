USE [TestDB]
GO
/****** Object:  StoredProcedure [dbo].[UpdateHP]    Script Date: 4/28/2019 12:04:11 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[UpdateHP]
	@Player UNIQUEIDENTIFIER,
	@Amount INT
AS
BEGIN
	SET NOCOUNT ON 
	DECLARE @Location UNIQUEIDENTIFIER
	DECLARE @Killed BIT

	SET @Killed = 0
	SET @Location = (SELECT Player_Location FROM Player WHERE ID = @Player)

	IF @Amount < 0 
	BEGIN 
		EXEC InsertTileLog 
			@EventLocation = @Location, 
			@EventDesc = 'A player was attacked!'
	END

	UPDATE Player
	SET HP = 
	CASE 
		WHEN HP + @Amount >= 99 THEN 99
		WHEN HP + @Amount <= 0 THEN 0
		ELSE HP + @Amount
	END
	WHERE ID = @Player

	IF (SELECT HP FROM Player WHERE ID = @Player) = 0 
	BEGIN
		UPDATE Player SET RespawnTime = DATEADD(HOUR,2,GETDATE()), AP = 0 WHERE ID = @player
		EXEC InsertTileLog 
			@EventLocation = @Location, 
			@EventDesc = 'A player has been killed.'
			SET @Killed = 1
	END

	SELECT @Killed AS 'Killed'
END
GO
