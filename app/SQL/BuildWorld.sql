
DECLARE @X int
DECLARE @Y int
SET @X = 0
SET @Y = 0

WHILE @X < 101
BEGIN 
	print @X 
	WHILE @Y < 101
	BEGIN 
		print @Y 
		INSERT INTO GameBoard (Grid_X,Grid_Y,Vegitation) VALUES (@X,@Y,ROUND(((100 - 1 -1) * RAND() + 1), 0))
		SET @Y = @Y + 1
	END
	SET @Y = 0
	SET @X = @X + 1
END


UPDATE GameBoard SET Vegitation = 0 WHERE Grid_X = 0 OR Grid_Y = 0
UPDATE GameBoard SET Vegitation = 0 WHERE Grid_X = 100 OR Grid_Y = 100


