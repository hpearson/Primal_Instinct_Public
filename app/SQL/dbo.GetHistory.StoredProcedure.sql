USE [TestDB]
GO
/****** Object:  StoredProcedure [dbo].[GetHistory]    Script Date: 4/28/2019 12:04:11 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[GetHistory]
	@Location UNIQUEIDENTIFIER
AS
BEGIN

	SELECT TOP 100 * 
	FROM TileLog 
	WHERE EventLocation = @Location
	ORDER BY EventTime DESC

END
GO
