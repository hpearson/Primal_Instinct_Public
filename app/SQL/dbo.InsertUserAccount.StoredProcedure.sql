USE [TestDB]
GO
/****** Object:  StoredProcedure [dbo].[InsertUserAccount]    Script Date: 4/28/2019 12:04:11 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[InsertUserAccount]
	@Username NVARCHAR(15),
	@Email NVARCHAR(50),
	@Password NVARCHAR(60)
AS
BEGIN

	INSERT INTO Player (
		Player_Location, Username, Email, Player_Password
    ) VALUES ( 
		( SELECT TOP 1 ID FROM GameBoard WHERE Vegitation != 0 ORDER BY NEWID() ),
        @Username, 
        @Email, 
        @Password
		)

END
GO
