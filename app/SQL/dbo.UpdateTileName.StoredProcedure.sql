USE [TestDB]
GO
/****** Object:  StoredProcedure [dbo].[UpdateTileName]    Script Date: 4/28/2019 12:04:11 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[UpdateTileName]
	@Location UNIQUEIDENTIFIER,
	@Name NVARCHAR(255)
AS
BEGIN

	UPDATE GameBoard
	SET LocationName = @Name
	WHERE ID = @Location

END
GO
