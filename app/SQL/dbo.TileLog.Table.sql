USE [TestDB]
GO
/****** Object:  Table [dbo].[TileLog]    Script Date: 4/28/2019 12:04:11 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[TileLog](
	[ID] [uniqueidentifier] NOT NULL,
	[EventLocation] [uniqueidentifier] NOT NULL,
	[EventTime] [datetime] NOT NULL,
	[EventDesc] [nvarchar](512) NULL,
 CONSTRAINT [PK_TileLog] PRIMARY KEY CLUSTERED 
(
	[ID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
ALTER TABLE [dbo].[TileLog] ADD  DEFAULT (newid()) FOR [ID]
GO
ALTER TABLE [dbo].[TileLog] ADD  DEFAULT (getdate()) FOR [EventTime]
GO
ALTER TABLE [dbo].[TileLog]  WITH CHECK ADD  CONSTRAINT [FK_TileLog_GameBoard1] FOREIGN KEY([EventLocation])
REFERENCES [dbo].[GameBoard] ([ID])
GO
ALTER TABLE [dbo].[TileLog] CHECK CONSTRAINT [FK_TileLog_GameBoard1]
GO
