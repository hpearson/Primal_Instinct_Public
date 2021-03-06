USE [TestDB]
GO
/****** Object:  StoredProcedure [dbo].[InsertErrorReport]    Script Date: 4/28/2019 12:04:11 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[InsertErrorReport]
	@Reporter UNIQUEIDENTIFIER,
	@ReportText NVARCHAR(255)
AS
BEGIN

	INSERT INTO UserReports
	(ReportText, Reporter)
	VALUES
	(@ReportText, @Reporter)

END
GO
