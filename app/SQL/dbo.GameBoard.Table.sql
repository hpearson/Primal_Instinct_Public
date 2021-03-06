USE [TestDB]
GO
/****** Object:  Table [dbo].[GameBoard]    Script Date: 4/28/2019 12:04:11 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[GameBoard](
	[ID] [uniqueidentifier] NOT NULL,
	[Grid_X] [int] NOT NULL,
	[Grid_Y] [int] NOT NULL,
	[LocationName] [nvarchar](255) NULL,
	[Vegitation] [smallint] NULL,
PRIMARY KEY CLUSTERED 
(
	[ID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
ALTER TABLE [dbo].[GameBoard] ADD  DEFAULT (newid()) FOR [ID]
GO
