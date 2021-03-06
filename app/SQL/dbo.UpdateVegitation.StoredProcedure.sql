USE [TestDB]
GO
/****** Object:  StoredProcedure [dbo].[UpdateVegitation]    Script Date: 4/28/2019 12:04:11 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[UpdateVegitation]
	@Location UNIQUEIDENTIFIER,
	@Amount INT
AS
BEGIN

	UPDATE GameBoard
	SET Vegitation = 
	CASE 
		WHEN Vegitation + @Amount <= 0 THEN 1 
		WHEN Vegitation + @Amount >= 99 THEN 99
		ELSE Vegitation + @Amount
	END
	WHERE ID = @Location

END
GO
