USE [TestDB]
GO
/****** Object:  StoredProcedure [dbo].[InsertTileLog]    Script Date: 4/27/2019 10:57:19 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[InsertTileLog]
	@EventLocation UNIQUEIDENTIFIER,
	@EventDesc NVARCHAR(512)
AS
BEGIN
	
	INSERT INTO TileLog 
	(EventLocation, EventDesc)
	VALUES
	(@EventLocation, @EventDesc)

END
GO
