USE [TestDB]
GO
/****** Object:  StoredProcedure [dbo].[GetMap]    Script Date: 4/28/2019 12:04:11 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[GetMap]
	@Location uniqueidentifier
AS
BEGIN
	DECLARE @X int 
    DECLARE @Y int

    SELECT @X = Grid_X, @Y = Grid_Y FROM GameBoard WHERE ID = @Location
    SELECT *, (SELECT COUNT(*) FROM Player WHERE Player_Location = GameBoard.ID AND HP != 0) AS 'Players' FROM GameBoard WHERE @X = Grid_X - 1 AND @Y = Grid_Y - 1
    UNION
    SELECT *, (SELECT COUNT(*) FROM Player WHERE Player_Location = GameBoard.ID AND HP != 0) AS 'Players' FROM GameBoard WHERE @X = Grid_X AND @Y = Grid_Y - 1
    UNION
    SELECT *, (SELECT COUNT(*) FROM Player WHERE Player_Location = GameBoard.ID AND HP != 0) AS 'Players' FROM GameBoard WHERE @X = Grid_X + 1 AND @Y = Grid_Y - 1
    UNION
    SELECT *, (SELECT COUNT(*) FROM Player WHERE Player_Location = GameBoard.ID AND HP != 0) AS 'Players' FROM GameBoard WHERE @X = Grid_X - 1 AND @Y = Grid_Y
    UNION
    SELECT *, (SELECT COUNT(*) FROM Player WHERE Player_Location = GameBoard.ID AND HP != 0) AS 'Players' FROM GameBoard WHERE @X = Grid_X AND @Y = Grid_Y
    UNION
    SELECT *, (SELECT COUNT(*) FROM Player WHERE Player_Location = GameBoard.ID AND HP != 0) AS 'Players' FROM GameBoard WHERE @X = Grid_X + 1 AND @Y = Grid_Y
    UNION
    SELECT *, (SELECT COUNT(*) FROM Player WHERE Player_Location = GameBoard.ID AND HP != 0) AS 'Players' FROM GameBoard WHERE @X = Grid_X - 1 AND @Y = Grid_Y + 1
    UNION
    SELECT *, (SELECT COUNT(*) FROM Player WHERE Player_Location = GameBoard.ID AND HP != 0) AS 'Players' FROM GameBoard WHERE @X = Grid_X AND @Y = Grid_Y + 1
    UNION
    SELECT *, (SELECT COUNT(*) FROM Player WHERE Player_Location = GameBoard.ID AND HP != 0) AS 'Players' FROM GameBoard WHERE @X = Grid_X + 1 AND @Y = Grid_Y + 1
    ORDER BY Grid_Y, Grid_X

END
GO
