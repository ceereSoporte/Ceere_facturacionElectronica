
--FACTURA

ALTER TABLE  Factura
ADD [Impuesto Factura Electronica retenido] bit NULL,  [Concepto Factura Electronica] varchar(50) NULL, EstadoFacturaElectronica int NULL; 


--FACTURAII (Factura items)
ALTER TABLE  FacturaII
ADD [concepto Impuesto] varchar(30) NULL;


--NOTAS CREDITO
ALTER TABLE  [Nota Crédito]
ADD[Id concepto Nota] int NULL,[No Factura] nvarchar(50) NULL,EstadoFace int NULL;

--NOTAS CREDITO
ALTER TABLE  [Nota Débito]
ADD IdConceptoNotaD int NULL,NoFactura nvarchar(50) NULL,EstadoFace int NULL;
/****** Object:  Table [dbo].[ConceptosNotaCredito]    Script Date: 19/11/2018 3:31:21 p.m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[ConceptosNotaCredito](
	[IdTipoConceptoNotaCredito] [int] NULL,
	[CodigoConceptoNotaCredito] [int] NULL,
	[conceptoNotaCredito] [varchar](100) NULL
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[ConceptosNotaDebito]    Script Date: 19/11/2018 3:31:21 p.m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[ConceptosNotaDebito](
	[idconceptoNotaD] [int] NOT NULL,
	[CodigoConceptoNotaD] [int] NULL,
	[conceptoNotaDebito] [varchar](100) NULL,
 CONSTRAINT [PK_ConceptosNotaDebito] PRIMARY KEY CLUSTERED 
(
	[idconceptoNotaD] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
INSERT [dbo].[ConceptosNotaCredito] ([IdTipoConceptoNotaCredito], [CodigoConceptoNotaCredito], [conceptoNotaCredito]) VALUES (1, 1, N'Devolución de parte de los bienes; no aceptación de partes del servicio')
INSERT [dbo].[ConceptosNotaCredito] ([IdTipoConceptoNotaCredito], [CodigoConceptoNotaCredito], [conceptoNotaCredito]) VALUES (2, 2, N'Anulación de factura electrónica')
INSERT [dbo].[ConceptosNotaCredito] ([IdTipoConceptoNotaCredito], [CodigoConceptoNotaCredito], [conceptoNotaCredito]) VALUES (3, 3, N'Rebaja total aplicada')
INSERT [dbo].[ConceptosNotaCredito] ([IdTipoConceptoNotaCredito], [CodigoConceptoNotaCredito], [conceptoNotaCredito]) VALUES (4, 4, N'Descuento total aplicado')
INSERT [dbo].[ConceptosNotaCredito] ([IdTipoConceptoNotaCredito], [CodigoConceptoNotaCredito], [conceptoNotaCredito]) VALUES (5, 5, N'Rescisión: nulidad por falta de requisitos')
INSERT [dbo].[ConceptosNotaCredito] ([IdTipoConceptoNotaCredito], [CodigoConceptoNotaCredito], [conceptoNotaCredito]) VALUES (6, 6, N'Otros')
INSERT [dbo].[ConceptosNotaCredito] ([IdTipoConceptoNotaCredito], [CodigoConceptoNotaCredito], [conceptoNotaCredito]) VALUES (0, 0, N'Sin nota credito
')
INSERT [dbo].[ConceptosNotaDebito] ([idconceptoNotaD], [CodigoConceptoNotaD], [conceptoNotaDebito]) VALUES (1, 1, N'Intereses')
INSERT [dbo].[ConceptosNotaDebito] ([idconceptoNotaD], [CodigoConceptoNotaD], [conceptoNotaDebito]) VALUES (2, 2, N'Gastos por cobrar')
INSERT [dbo].[ConceptosNotaDebito] ([idconceptoNotaD], [CodigoConceptoNotaD], [conceptoNotaDebito]) VALUES (3, 3, N'Cambio del valor')



--entidad profesional por defecto para las notas 
INSERT [dbo].[Entidad Responsable] ([Documento Entidad]) VALUES (0)




/****** Object:  Table [dbo].[ConfiguracionFace]    Script Date: 20/11/2018 8:36:41 a.m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[ConfiguracionFace](
	[IdConfiguracionFace] [int] IDENTITY(1,1) NOT NULL,
	[IdResolucionFactura] [int] NULL,
	[IdresolucionNotaCredito] [int] NULL,
	[IdresolucionNotaDebito] [int] NULL,
	[VersionGrafica] [int] NULL,
	[Estadofactura] [int] NULL,
	[EstadoNotaCredito] [int] NULL,
	[EstadoNotaDebito] [int] NULL,
PRIMARY KEY CLUSTERED 
(
	[IdConfiguracionFace] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO

/****** Object:  View [dbo].[Face Cnsta Factura]    Script Date: 20/11/2018 8:39:56 a.m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE VIEW [dbo].[Face Cnsta Factura]
AS
SELECT       distinct( dbo.Factura.[No Factura]) AS [Id Factura], dbo.Factura.[Fecha Factura] AS IssueDate, dbo.Factura.[Fecha Digitación Factura] AS [Fecha Digitacion Factura], dbo.Factura.[Iva Factura] AS TaxExclusiveAmount, 
                         dbo.Factura.[Total Factura] AS PayableAmount, dbo.Factura.[Id Condición de Pago Factura] AS [Id Condicion de Pago Factura], dbo.Factura.[Valor Acumulado Factura] AS LineExtensionAmount, 
                         dbo.[Recibo de CajaII].[Id Forma de Pago] AS PaymentMeansCode, dbo.[Forma de Pago].[Forma de Pago] AS forma, dbo.Banco.Banco, dbo.[Recibo de CajaII].[Número Cuenta Recibo de CajaII] AS PrimaryAccountNumberID, 
                         dbo.[Recibo de CajaII].[Número Comprobante Recibo de CajaII] AS CV2ID, dbo.FacturaII.[Valor Iva % FacturaII] AS porcentaje, dbo.Factura.[Descuentos Factura] AS Descuentos, 
                         dbo.EmpresaV.[Resolución Facturación EmpresaV] AS ResolucionFac, dbo.EmpresaV.[Prefijo Resolución Facturación EmpresaV] AS PrefijoFac, dbo.Factura.[Id Estado] AS EstadoFactura, 
                         dbo.Estado.Estado AS DescEstadoFactura, dbo.Factura.EstadoFacturaElectronica, dbo.Factura.[Descuento Adicional % Factura] AS porcentDescuento, dbo.Factura.[Valor En Letras Factura] AS valorLetrasFactura, 
                         dbo.Factura.[Documento Usuario] AS DocUsuario, dbo.Factura.[Id Terminal] AS IdTerminal, dbo.Factura.[Impuesto Factura Electronica retenido] AS retencionfacturaElectronica, 
                         dbo.Factura.[Concepto Factura Electronica] AS ConceptoFacturaElectronica
FROM            dbo.FacturaII INNER JOIN
                         dbo.Factura ON dbo.FacturaII.[Id Factura] = dbo.Factura.[Id Factura] INNER JOIN
                         dbo.EmpresaV ON dbo.Factura.[Id EmpresaV] = dbo.EmpresaV.[Id EmpresaV] INNER JOIN
                         dbo.Estado ON dbo.Factura.[Id Estado] = dbo.Estado.[Id Estado] INNER JOIN
                         dbo.[Recibo de CajaII] INNER JOIN
                         dbo.[Recibo de Caja] ON dbo.[Recibo de CajaII].[Id Recibo de Caja] = dbo.[Recibo de Caja].[Id Recibo de Caja] INNER JOIN
                         dbo.[Forma de Pago] ON dbo.[Recibo de CajaII].[Id Forma de Pago] = dbo.[Forma de Pago].[Id Forma de Pago] INNER JOIN
                         dbo.Banco ON dbo.[Recibo de CajaII].[Id Banco] = dbo.Banco.[Id Banco] ON dbo.Factura.[Id Factura] = dbo.[Recibo de Caja].[Id Factura]
GO
/****** Object:  View [dbo].[Face Cnsta FacturaE Empresa]    Script Date: 20/11/2018 8:39:56 a.m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE VIEW [dbo].[Face Cnsta FacturaE Empresa]
AS
SELECT        dbo.Empresa.[Documento Empresa] AS [Id Empresa], dbo.Factura.[No Factura] AS [Id Factura], dbo.Empresa.[Id Tipo de Documento], dbo.Empresa.[Razon Social Empresa] AS [Name Empresa], 
                         dbo.Departamento.Departamento AS Department, dbo.Ciudad.Ciudad AS CityName, dbo.EmpresaIII.[Dirección EmpresaIII] AS LineEmpresa, dbo.Barrio.Barrio AS citySubdivisionName, 
                         dbo.EmpresaII.[Id Régimen Tributario] AS taxlevelcode, dbo.[Tipo de Documento].[Descripción Tipo de Documento] AS DescripcionDoc, dbo.EmpresaIII.[E-mail 1 EmpresaIII] AS emailEmpresa
FROM            dbo.Empresa INNER JOIN
                         dbo.EmpresaIII ON dbo.Empresa.[Documento Empresa] = dbo.EmpresaIII.[Documento Empresa] INNER JOIN
                         dbo.Ciudad ON dbo.Empresa.[Id Ciudad] = dbo.Ciudad.[Id Ciudad] AND dbo.EmpresaIII.[Id Ciudad] = dbo.Ciudad.[Id Ciudad] INNER JOIN
                         dbo.Departamento ON dbo.Ciudad.[Id Departamento] = dbo.Departamento.[Id Departamento] INNER JOIN
                         dbo.Factura ON dbo.Empresa.[Documento Empresa] = dbo.Factura.[Documento Empresa] INNER JOIN
                         dbo.Barrio ON dbo.Ciudad.[Id Ciudad] = dbo.Barrio.[Id Ciudad] INNER JOIN
                         dbo.EmpresaII ON dbo.Empresa.[Documento Empresa] = dbo.EmpresaII.[Documento Empresa] INNER JOIN
                         dbo.[Tipo de Documento] ON dbo.Empresa.[Id Tipo de Documento] = dbo.[Tipo de Documento].[Id Tipo de Documento]
GO
/****** Object:  View [dbo].[Face Cnsta FacturaE Entidad]    Script Date: 20/11/2018 8:39:56 a.m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE VIEW [dbo].[Face Cnsta FacturaE Entidad]
AS
SELECT        dbo.Entidad.[Documento Entidad] AS [Id Entidad], dbo.Entidad.[Primer Apellido Entidad] AS FamilyName, dbo.Entidad.[Primer Nombre Entidad] AS FirstName, dbo.Entidad.[Segundo Nombre Entidad] AS MiddleName, 
                         dbo.EntidadII.[Dirección EntidadII] AS [Line Entidad], dbo.Factura.[No Factura] AS [id Factura], dbo.Ciudad.Ciudad AS CityName, dbo.[Tipo de Documento].[Id Tipo de Documento], dbo.Barrio.Barrio AS citySubdivisionName, 
                         dbo.Entidad.[Nombre Completo Entidad] AS NomComplete, dbo.Entidad.[Segundo Apellido Entidad] AS secondFamilyName, dbo.[Tipo de Documento].[Descripción Tipo de Documento] AS DescripcionDocE, 
                         dbo.EntidadII.[E-mail Nro 1 EntidadII] AS emailEntidad, dbo.EntidadII.[Teléfono No 1 EntidadII] AS telefono, dbo.[Régimen Tributario].[Id Régimen Tributario] AS regimen, 
                         dbo.EntidadXX.[Gran Contribuyente EntidadXX] AS GranContribuyente, dbo.EntidadXX.[Autorretenedor EntidadXX] AS AutoRetenedor, dbo.Ciudad.[Código Ciudad] AS CodigoCiudad, 
                         dbo.Departamento.[Código Departamento] AS CodigoDepartamento, dbo.Departamento.[Id País] AS codigoPais, dbo.Departamento.Departamento, 
                         dbo.[Actividad Económica].[Código Actividad Económica] AS ActividadEconomica
FROM            dbo.Entidad INNER JOIN
                         dbo.EntidadII ON dbo.Entidad.[Documento Entidad] = dbo.EntidadII.[Documento Entidad] INNER JOIN
                         dbo.Factura ON dbo.Entidad.[Documento Entidad] = dbo.Factura.[Documento Paciente] INNER JOIN
                         dbo.Ciudad ON dbo.Entidad.[Id Ciudad] = dbo.Ciudad.[Id Ciudad] AND dbo.EntidadII.[Id Ciudad] = dbo.Ciudad.[Id Ciudad] INNER JOIN
                         dbo.Departamento ON dbo.Ciudad.[Id Departamento] = dbo.Departamento.[Id Departamento] INNER JOIN
                         dbo.[Tipo de Documento] ON dbo.Entidad.[Id Tipo de Documento] = dbo.[Tipo de Documento].[Id Tipo de Documento] INNER JOIN
                         dbo.Barrio ON dbo.EntidadII.[Id Barrio] = dbo.Barrio.[Id Barrio] AND dbo.Ciudad.[Id Ciudad] = dbo.Barrio.[Id Ciudad] INNER JOIN
                         dbo.EntidadXX ON dbo.Entidad.[Documento Entidad] = dbo.EntidadXX.[Documento Entidad] INNER JOIN
                         dbo.[Régimen Tributario] ON dbo.EntidadXX.[Id Régimen Tributario] = dbo.[Régimen Tributario].[Id Régimen Tributario] INNER JOIN
                         dbo.País ON dbo.Departamento.[Id País] = dbo.País.[Id País] INNER JOIN
                         dbo.[Actividad Económica] ON dbo.EntidadXX.[Id Actividad Económica] = dbo.[Actividad Económica].[Id Actividad Económica]
GO
/****** Object:  View [dbo].[Face Cnsta FacturaEII]    Script Date: 20/11/2018 8:39:56 a.m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE VIEW [dbo].[Face Cnsta FacturaEII]
AS
SELECT        dbo.FacturaII.[Valor Iva $ FacturaII] AS TaxAmount, dbo.FacturaII.[Valor FacturaII], dbo.FacturaII.[Valor Iva % FacturaII] AS Porcentaje, dbo.FacturaII.[Cantidad FacturaII] AS InvoicedQuantity, 
                         dbo.FacturaII.[Descripción FacturaII] AS Description, dbo.FacturaII.[Id FacturaII], dbo.Factura.[No Factura] AS [Id Factura], dbo.FacturaII.[Descuento $ FacturaII] AS DescuentoItem, dbo.FacturaII.[Código Objeto] AS codigoFacturaII, 
                         dbo.FacturaII.[concepto Impuesto] AS CodImpuestoItem
FROM            dbo.FacturaII INNER JOIN
                         dbo.Factura ON dbo.FacturaII.[Id Factura] = dbo.Factura.[Id Factura]
GO
/****** Object:  View [dbo].[Face Cnsta Login]    Script Date: 20/11/2018 8:39:56 a.m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE VIEW [dbo].[Face Cnsta Login]
AS
SELECT        dbo.Contraseña.[Nombre de Usuario] AS NombreUsuario, dbo.Contraseña.Contraseña AS password, dbo.Entidad.[Nombre Completo Entidad] AS NomUsuario
FROM            dbo.Contraseña INNER JOIN
                         dbo.Entidad ON dbo.Contraseña.[Documento Entidad] = dbo.Entidad.[Documento Entidad]
GO
/****** Object:  View [dbo].[face Cnsta Nota Debito]    Script Date: 20/11/2018 8:39:56 a.m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE VIEW [dbo].[face Cnsta Nota Debito]
AS
SELECT        dbo.[Nota Débito].[Número Nota Débito] AS NumNotaDebito, dbo.[Nota Débito].[Fecha Nota Débito] AS fechaNotaND, dbo.[Nota Débito].[Documento Entidad] AS EntidadDocumento, 
                         dbo.[Nota Débito].[Valor Nota Débito] AS ValorNotaD, dbo.[Nota Débito].[Valor % Descuento Nota Débito] AS PorcentajeDescuentoND, dbo.[Nota Débito].[Valor $ Descuento Nota Débito] AS ValorDescuentoND, 
                         dbo.[Nota Débito].[Valor % Iva Nota Débito] AS porcentajeIvaND, dbo.[Nota Débito].NoFactura, dbo.[Nota Débito].IdConceptoNotaD, dbo.Entidad.[Nombre Completo Entidad] AS NombreEntidad
FROM            dbo.[Nota Débito] INNER JOIN
                         dbo.Entidad ON dbo.[Nota Débito].[Documento Entidad] = dbo.Entidad.[Documento Entidad] LEFT OUTER JOIN
                         dbo.ConceptosNotaDebito ON dbo.[Nota Débito].IdConceptoNotaD = dbo.ConceptosNotaDebito.idconceptoNotaD
GO
/****** Object:  View [dbo].[face Cnta Nota Credito]    Script Date: 20/11/2018 8:39:56 a.m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE VIEW [dbo].[face Cnta Nota Credito]
AS
SELECT        dbo.[Nota Crédito].[Número Nota Crédito] AS NumNotaCredito, dbo.[Nota Crédito].[Fecha Nota Crédito] AS fechaNotaNC, dbo.[Nota Crédito].[Documento Entidad] AS EntidadDocumento, 
                         dbo.[Nota Crédito].[Concepto Nota Crédito] AS ConceptoTexto, dbo.[Nota Crédito].[Valor Nota Crédito] AS ValorNotaC, dbo.[Nota Crédito].[Valor % Descuento Nota Crédito] AS PorcentajeDescuentoNC, 
                         dbo.[Nota Crédito].[Valor $ Descuento Nota Crédito] AS ValorDescuentoNC, dbo.[Nota Crédito].[Valor % Iva Nota Crédito] AS porcentajeIvaNC, dbo.[Nota Crédito].[No Factura] AS NoFactura, 
                         dbo.[Nota Crédito].[Id concepto Nota] AS IdConcpetoNC, dbo.Entidad.[Nombre Completo Entidad] AS NombreEntidad
FROM            dbo.[Nota Crédito] INNER JOIN
                         dbo.Entidad ON dbo.[Nota Crédito].[Documento Entidad] = dbo.Entidad.[Documento Entidad]
GO
/****** Object:  View [dbo].[Face Ultima Nota Credito]    Script Date: 20/11/2018 8:39:56 a.m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE VIEW [dbo].[Face Ultima Nota Credito]
AS
SELECT        TOP (1) [Id Nota Crédito] AS idNotaC, [Número Nota Crédito] AS NumNotaC
FROM            dbo.[Nota Crédito]
ORDER BY idNotaC DESC
GO
/****** Object:  StoredProcedure [dbo].[Face_PA_Insertar_Nota_Credito_anulada]    Script Date: 26/11/2018 10:52:50 a.m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
ALTER Procedure [dbo].[Face_PA_Insertar_Nota_Credito_anulada]
(
 @NoNotaCredito  nVarChar(50),
 @fechaActual DateTime,
 @docE nVarChar(50),
 @conseptoNotaText nvarchar(255),
 @totF int,
 @porcentDescuento int,
 @Descuentos int,
 @ivaF int,
 @valorLetrasFactura nVarChar(255),
 @docEmpresa nVarChar(50),
 @DocUsuario nVarChar(50),
 @idTerminal int,
 @NumeroFac int

)
as
begin
 INSERT INTO [Nota Crédito]
                      ([Número Nota Crédito], [Fecha Nota Crédito], [Id Moneda], [Tasa de Cambio Vigente], [Documento Entidad], [Concepto Nota Crédito], 
                      [Valor Nota Crédito], [Valor % Descuento Nota Crédito], [Valor $ Descuento Nota Crédito], [Valor % Iva Nota Crédito],  
                       [Valor en Letras Nota Crédito], [Observaciones Nota Crédito], [Documento Empresa], [Documento Usuario], [Id Estado], 
                      [Id Estado Contabilidad], [Id Terminal], [Documento Profesional],[Estado Relación Recibo],[Id concepto Nota],[No Factura],EstadoFace)
     VALUES
           (@NoNotaCredito, @fechaActual,'2','2', @docE,@conseptoNotaText,@totF,@porcentDescuento,@Descuentos,@ivaF,@valorLetrasFactura,'N / A',@docEmpresa,@DocUsuario,'12','1',@idTerminal,'0',0,'2',@NumeroFac,'1')
end
GO
EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties = 
   Begin PaneConfigurations = 
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[26] 4[39] 2[22] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1[51] 4[49] 3) )"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1[76] 4) )"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 1
   End
   Begin DiagramPane = 
      Begin Origin = 
         Top = -384
         Left = -232
      End
      Begin Tables = 
         Begin Table = "FacturaII"
            Begin Extent = 
               Top = 445
               Left = 1036
               Bottom = 575
               Right = 1270
            End
            DisplayFlags = 280
            TopColumn = 8
         End
         Begin Table = "Factura"
            Begin Extent = 
               Top = 305
               Left = 559
               Bottom = 565
               Right = 874
            End
            DisplayFlags = 280
            TopColumn = 44
         End
         Begin Table = "EmpresaV"
            Begin Extent = 
               Top = 141
               Left = 938
               Bottom = 271
               Right = 1260
            End
            DisplayFlags = 280
            TopColumn = 4
         End
         Begin Table = "Estado"
            Begin Extent = 
               Top = 159
               Left = 677
               Bottom = 289
               Right = 866
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "Recibo de CajaII"
            Begin Extent = 
               Top = 6
               Left = 270
               Bottom = 136
               Right = 567
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "Recibo de Caja"
            Begin Extent = 
               Top = 138
               Left = 270
               Bottom = 268
               Right = 603
            End
            DisplayFlags = 280
            TopColumn = 6
         End
         Begin Table = "Forma de Pago"
            Begin Extent = 
               Top = 270
               Left = 270
               Bottom = 400
               Right = 504
          ' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'Face Cnsta Factura'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane2', @value=N'  End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "Banco"
            Begin Extent = 
               Top = 0
               Left = 711
               Bottom = 130
               Right = 898
            End
            DisplayFlags = 280
            TopColumn = 0
         End
      End
   End
   Begin SQLPane = 
      PaneHidden = 
   End
   Begin DataPane = 
      Begin ParameterDefaults = ""
      End
      Begin ColumnWidths = 15
         Width = 284
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
      End
   End
   Begin CriteriaPane = 
      Begin ColumnWidths = 11
         Column = 2805
         Alias = 4740
         Table = 1170
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
         Filter = 1350
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'Face Cnsta Factura'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=2 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'Face Cnsta Factura'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties = 
   Begin PaneConfigurations = 
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[40] 4[20] 2[20] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1[50] 4[42] 3) )"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1[54] 4) )"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 9
   End
   Begin DiagramPane = 
      Begin Origin = 
         Top = 0
         Left = 0
      End
      Begin Tables = 
         Begin Table = "Empresa"
            Begin Extent = 
               Top = 112
               Left = 370
               Bottom = 242
               Right = 608
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "EmpresaIII"
            Begin Extent = 
               Top = 0
               Left = 618
               Bottom = 130
               Right = 840
            End
            DisplayFlags = 280
            TopColumn = 8
         End
         Begin Table = "Ciudad"
            Begin Extent = 
               Top = 149
               Left = 826
               Bottom = 279
               Right = 1004
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "Departamento"
            Begin Extent = 
               Top = 2
               Left = 1024
               Bottom = 132
               Right = 1231
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "Factura"
            Begin Extent = 
               Top = 31
               Left = 20
               Bottom = 227
               Right = 335
            End
            DisplayFlags = 280
            TopColumn = 37
         End
         Begin Table = "Barrio"
            Begin Extent = 
               Top = 123
               Left = 1155
               Bottom = 253
               Right = 1325
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "EmpresaII"
            Begin Extent = 
               Top = 248
               Left = 121
               Bottom = 378
               Right = 368
            End
            Displ' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'Face Cnsta FacturaE Empresa'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane2', @value=N'ayFlags = 280
            TopColumn = 1
         End
         Begin Table = "Tipo de Documento"
            Begin Extent = 
               Top = 378
               Left = 38
               Bottom = 508
               Right = 298
            End
            DisplayFlags = 280
            TopColumn = 0
         End
      End
   End
   Begin SQLPane = 
      PaneHidden = 
   End
   Begin DataPane = 
      PaneHidden = 
      Begin ParameterDefaults = ""
      End
   End
   Begin CriteriaPane = 
      Begin ColumnWidths = 11
         Column = 2415
         Alias = 2400
         Table = 1170
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
         Filter = 1350
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'Face Cnsta FacturaE Empresa'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=2 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'Face Cnsta FacturaE Empresa'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties = 
   Begin PaneConfigurations = 
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[40] 4[20] 2[20] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1[57] 4[21] 3) )"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1[62] 4) )"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 1
   End
   Begin DiagramPane = 
      Begin Origin = 
         Top = -288
         Left = 0
      End
      Begin Tables = 
         Begin Table = "Entidad"
            Begin Extent = 
               Top = 6
               Left = 38
               Bottom = 129
               Right = 273
            End
            DisplayFlags = 280
            TopColumn = 5
         End
         Begin Table = "EntidadII"
            Begin Extent = 
               Top = 6
               Left = 311
               Bottom = 136
               Right = 536
            End
            DisplayFlags = 280
            TopColumn = 3
         End
         Begin Table = "Factura"
            Begin Extent = 
               Top = 6
               Left = 574
               Bottom = 277
               Right = 889
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "Ciudad"
            Begin Extent = 
               Top = 6
               Left = 927
               Bottom = 136
               Right = 1105
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "Departamento"
            Begin Extent = 
               Top = 138
               Left = 38
               Bottom = 268
               Right = 245
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "Tipo de Documento"
            Begin Extent = 
               Top = 270
               Left = 38
               Bottom = 400
               Right = 298
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "Barrio"
            Begin Extent = 
               Top = 159
               Left = 363
               Bottom = 289
               Right = 533
            End
            Displ' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'Face Cnsta FacturaE Entidad'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane2', @value=N'ayFlags = 280
            TopColumn = 0
         End
         Begin Table = "EntidadXX"
            Begin Extent = 
               Top = 282
               Left = 336
               Bottom = 487
               Right = 586
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "Régimen Tributario"
            Begin Extent = 
               Top = 402
               Left = 38
               Bottom = 515
               Right = 294
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "País"
            Begin Extent = 
               Top = 282
               Left = 624
               Bottom = 412
               Right = 799
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "Actividad Económica"
            Begin Extent = 
               Top = 414
               Left = 624
               Bottom = 544
               Right = 890
            End
            DisplayFlags = 280
            TopColumn = 0
         End
      End
   End
   Begin SQLPane = 
      PaneHidden = 
   End
   Begin DataPane = 
      Begin ParameterDefaults = ""
      End
      Begin ColumnWidths = 21
         Width = 284
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
      End
   End
   Begin CriteriaPane = 
      Begin ColumnWidths = 11
         Column = 3180
         Alias = 4155
         Table = 1170
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
         Filter = 1350
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'Face Cnsta FacturaE Entidad'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=2 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'Face Cnsta FacturaE Entidad'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties = 
   Begin PaneConfigurations = 
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[40] 4[20] 2[20] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1[38] 4[41] 3) )"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1[48] 4) )"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 9
   End
   Begin DiagramPane = 
      Begin Origin = 
         Top = 0
         Left = 0
      End
      Begin Tables = 
         Begin Table = "FacturaII"
            Begin Extent = 
               Top = 6
               Left = 38
               Bottom = 211
               Right = 272
            End
            DisplayFlags = 280
            TopColumn = 11
         End
         Begin Table = "Factura"
            Begin Extent = 
               Top = 8
               Left = 473
               Bottom = 138
               Right = 788
            End
            DisplayFlags = 280
            TopColumn = 3
         End
      End
   End
   Begin SQLPane = 
      PaneHidden = 
   End
   Begin DataPane = 
      PaneHidden = 
      Begin ParameterDefaults = ""
      End
      Begin ColumnWidths = 11
         Width = 284
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
      End
   End
   Begin CriteriaPane = 
      Begin ColumnWidths = 11
         Column = 2460
         Alias = 3060
         Table = 1170
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
         Filter = 1350
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'Face Cnsta FacturaEII'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=1 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'Face Cnsta FacturaEII'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties = 
   Begin PaneConfigurations = 
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[40] 4[20] 2[20] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 0
   End
   Begin DiagramPane = 
      Begin Origin = 
         Top = 0
         Left = 0
      End
      Begin Tables = 
         Begin Table = "Contraseña"
            Begin Extent = 
               Top = 6
               Left = 38
               Bottom = 199
               Right = 298
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "Entidad"
            Begin Extent = 
               Top = 7
               Left = 475
               Bottom = 195
               Right = 710
            End
            DisplayFlags = 280
            TopColumn = 21
         End
      End
   End
   Begin SQLPane = 
   End
   Begin DataPane = 
      Begin ParameterDefaults = ""
      End
   End
   Begin CriteriaPane = 
      Begin ColumnWidths = 11
         Column = 1440
         Alias = 2295
         Table = 1995
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
         Filter = 1350
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'Face Cnsta Login'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=1 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'Face Cnsta Login'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties = 
   Begin PaneConfigurations = 
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[40] 4[20] 2[20] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1[50] 4[25] 3) )"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1[53] 4) )"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 9
   End
   Begin DiagramPane = 
      Begin Origin = 
         Top = 0
         Left = 0
      End
      Begin Tables = 
         Begin Table = "Nota Débito"
            Begin Extent = 
               Top = 6
               Left = 38
               Bottom = 136
               Right = 293
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "Entidad"
            Begin Extent = 
               Top = 6
               Left = 481
               Bottom = 136
               Right = 716
            End
            DisplayFlags = 280
            TopColumn = 20
         End
         Begin Table = "ConceptosNotaDebito"
            Begin Extent = 
               Top = 168
               Left = 455
               Bottom = 281
               Right = 669
            End
            DisplayFlags = 280
            TopColumn = 0
         End
      End
   End
   Begin SQLPane = 
      PaneHidden = 
   End
   Begin DataPane = 
      PaneHidden = 
      Begin ParameterDefaults = ""
      End
   End
   Begin CriteriaPane = 
      Begin ColumnWidths = 11
         Column = 2655
         Alias = 2370
         Table = 1170
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
         Filter = 1350
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'face Cnsta Nota Debito'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=1 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'face Cnsta Nota Debito'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties = 
   Begin PaneConfigurations = 
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[40] 4[20] 2[20] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1[48] 4) )"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 9
   End
   Begin DiagramPane = 
      Begin Origin = 
         Top = -96
         Left = 0
      End
      Begin Tables = 
         Begin Table = "Nota Crédito"
            Begin Extent = 
               Top = 102
               Left = 38
               Bottom = 232
               Right = 297
            End
            DisplayFlags = 280
            TopColumn = 5
         End
         Begin Table = "Entidad"
            Begin Extent = 
               Top = 102
               Left = 425
               Bottom = 352
               Right = 660
            End
            DisplayFlags = 280
            TopColumn = 13
         End
      End
   End
   Begin SQLPane = 
      PaneHidden = 
   End
   Begin DataPane = 
      PaneHidden = 
      Begin ParameterDefaults = ""
      End
   End
   Begin CriteriaPane = 
      Begin ColumnWidths = 11
         Column = 2430
         Alias = 2670
         Table = 1170
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
         Filter = 1350
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'face Cnta Nota Credito'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=1 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'face Cnta Nota Credito'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties = 
   Begin PaneConfigurations = 
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[40] 4[20] 2[20] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 0
   End
   Begin DiagramPane = 
      Begin Origin = 
         Top = 0
         Left = 0
      End
      Begin Tables = 
         Begin Table = "Nota Crédito"
            Begin Extent = 
               Top = 6
               Left = 38
               Bottom = 136
               Right = 297
            End
            DisplayFlags = 280
            TopColumn = 0
         End
      End
   End
   Begin SQLPane = 
   End
   Begin DataPane = 
      Begin ParameterDefaults = ""
      End
   End
   Begin CriteriaPane = 
      Begin ColumnWidths = 11
         Column = 1440
         Alias = 900
         Table = 1170
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
         Filter = 1350
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'Face Ultima Nota Credito'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=1 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'Face Ultima Nota Credito'
GO
