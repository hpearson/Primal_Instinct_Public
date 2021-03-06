USE [TestDB]
GO
/****** Object:  Table [dbo].[UserReports]    Script Date: 4/28/2019 12:04:11 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[UserReports](
	[ReportID] [uniqueidentifier] NOT NULL,
	[ReportText] [nvarchar](255) NOT NULL,
	[ReportTime] [datetime] NOT NULL,
	[Reporter] [uniqueidentifier] NULL,
PRIMARY KEY CLUSTERED 
(
	[ReportID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
ALTER TABLE [dbo].[UserReports] ADD  DEFAULT (newid()) FOR [ReportID]
GO
ALTER TABLE [dbo].[UserReports] ADD  DEFAULT (getdate()) FOR [ReportTime]
GO
ALTER TABLE [dbo].[UserReports]  WITH CHECK ADD  CONSTRAINT [FK_UserReports_Player1] FOREIGN KEY([Reporter])
REFERENCES [dbo].[Player] ([ID])
GO
ALTER TABLE [dbo].[UserReports] CHECK CONSTRAINT [FK_UserReports_Player1]
GO
