USE [TestDB]
GO
/****** Object:  Table [dbo].[Player]    Script Date: 4/28/2019 12:04:11 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Player](
	[ID] [uniqueidentifier] NOT NULL,
	[Created] [datetime] NOT NULL,
	[Username] [nvarchar](15) NOT NULL,
	[Email] [nvarchar](50) NOT NULL,
	[Player_Password] [nvarchar](60) NOT NULL,
	[Player_Location] [uniqueidentifier] NOT NULL,
	[HP] [smallint] NOT NULL,
	[AP] [smallint] NOT NULL,
	[RespawnTime] [datetime] NULL,
	[Kills] [int] NOT NULL,
PRIMARY KEY CLUSTERED 
(
	[ID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
ALTER TABLE [dbo].[Player] ADD  DEFAULT (newid()) FOR [ID]
GO
ALTER TABLE [dbo].[Player] ADD  DEFAULT (getdate()) FOR [Created]
GO
ALTER TABLE [dbo].[Player] ADD  DEFAULT ((100)) FOR [HP]
GO
ALTER TABLE [dbo].[Player] ADD  DEFAULT ((100)) FOR [AP]
GO
ALTER TABLE [dbo].[Player] ADD  DEFAULT ((0)) FOR [Kills]
GO
ALTER TABLE [dbo].[Player]  WITH CHECK ADD  CONSTRAINT [FK_Player_GameBoard] FOREIGN KEY([Player_Location])
REFERENCES [dbo].[GameBoard] ([ID])
GO
ALTER TABLE [dbo].[Player] CHECK CONSTRAINT [FK_Player_GameBoard]
GO
