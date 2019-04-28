USE [TestDB]
GO
/****** Object:  StoredProcedure [dbo].[UpdateAP]    Script Date: 4/28/2019 10:21:33 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[UpdateAP]
	@Player UNIQUEIDENTIFIER,
	@Amount INT
AS
BEGIN

	UPDATE Player
	SET AP = 
	CASE 
		WHEN AP + @Amount >= 99 THEN 99
		ELSE AP + @Amount
	END
	WHERE ID = @Player

END
GO
