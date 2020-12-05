var FiltersEnabled = 0; // if your not going to use transitions or filters in any of the tips set this to 0
var spacer="&nbsp; &nbsp; &nbsp; ";

// email notifications to admin
notifyAdminNewMembers0Tip=["", spacer+"No email notifications to admin."];
notifyAdminNewMembers1Tip=["", spacer+"Notify admin only when a new member is waiting for approval."];
notifyAdminNewMembers2Tip=["", spacer+"Notify admin for all new sign-ups."];

// visitorSignup
visitorSignup0Tip=["", spacer+"If this option is selected, visitors will not be able to join this group unless the admin manually moves them to this group from the admin area."];
visitorSignup1Tip=["", spacer+"If this option is selected, visitors can join this group but will not be able to sign in unless the admin approves them from the admin area."];
visitorSignup2Tip=["", spacer+"If this option is selected, visitors can join this group and will be able to sign in instantly with no need for admin approval."];

// customers table
customers_addTip=["",spacer+"This option allows all members of the group to add records to the 'Customers' table. A member who adds a record to the table becomes the 'owner' of that record."];

customers_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Customers' table."];
customers_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Customers' table."];
customers_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Customers' table."];
customers_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Customers' table."];

customers_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Customers' table."];
customers_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Customers' table."];
customers_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Customers' table."];
customers_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Customers' table, regardless of their owner."];

customers_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Customers' table."];
customers_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Customers' table."];
customers_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Customers' table."];
customers_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Customers' table."];

// employees table
employees_addTip=["",spacer+"This option allows all members of the group to add records to the 'Employees' table. A member who adds a record to the table becomes the 'owner' of that record."];

employees_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Employees' table."];
employees_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Employees' table."];
employees_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Employees' table."];
employees_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Employees' table."];

employees_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Employees' table."];
employees_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Employees' table."];
employees_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Employees' table."];
employees_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Employees' table, regardless of their owner."];

employees_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Employees' table."];
employees_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Employees' table."];
employees_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Employees' table."];
employees_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Employees' table."];

// orders table
orders_addTip=["",spacer+"This option allows all members of the group to add records to the 'Orders' table. A member who adds a record to the table becomes the 'owner' of that record."];

orders_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Orders' table."];
orders_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Orders' table."];
orders_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Orders' table."];
orders_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Orders' table."];

orders_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Orders' table."];
orders_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Orders' table."];
orders_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Orders' table."];
orders_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Orders' table, regardless of their owner."];

orders_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Orders' table."];
orders_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Orders' table."];
orders_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Orders' table."];
orders_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Orders' table."];

// order_details table
order_details_addTip=["",spacer+"This option allows all members of the group to add records to the 'Order Items' table. A member who adds a record to the table becomes the 'owner' of that record."];

order_details_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Order Items' table."];
order_details_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Order Items' table."];
order_details_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Order Items' table."];
order_details_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Order Items' table."];

order_details_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Order Items' table."];
order_details_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Order Items' table."];
order_details_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Order Items' table."];
order_details_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Order Items' table, regardless of their owner."];

order_details_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Order Items' table."];
order_details_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Order Items' table."];
order_details_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Order Items' table."];
order_details_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Order Items' table."];

// products table
products_addTip=["",spacer+"This option allows all members of the group to add records to the 'Products' table. A member who adds a record to the table becomes the 'owner' of that record."];

products_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Products' table."];
products_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Products' table."];
products_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Products' table."];
products_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Products' table."];

products_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Products' table."];
products_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Products' table."];
products_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Products' table."];
products_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Products' table, regardless of their owner."];

products_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Products' table."];
products_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Products' table."];
products_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Products' table."];
products_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Products' table."];

// categories table
categories_addTip=["",spacer+"This option allows all members of the group to add records to the 'Product Categories' table. A member who adds a record to the table becomes the 'owner' of that record."];

categories_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Product Categories' table."];
categories_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Product Categories' table."];
categories_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Product Categories' table."];
categories_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Product Categories' table."];

categories_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Product Categories' table."];
categories_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Product Categories' table."];
categories_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Product Categories' table."];
categories_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Product Categories' table, regardless of their owner."];

categories_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Product Categories' table."];
categories_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Product Categories' table."];
categories_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Product Categories' table."];
categories_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Product Categories' table."];

// suppliers table
suppliers_addTip=["",spacer+"This option allows all members of the group to add records to the 'Suppliers' table. A member who adds a record to the table becomes the 'owner' of that record."];

suppliers_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Suppliers' table."];
suppliers_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Suppliers' table."];
suppliers_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Suppliers' table."];
suppliers_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Suppliers' table."];

suppliers_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Suppliers' table."];
suppliers_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Suppliers' table."];
suppliers_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Suppliers' table."];
suppliers_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Suppliers' table, regardless of their owner."];

suppliers_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Suppliers' table."];
suppliers_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Suppliers' table."];
suppliers_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Suppliers' table."];
suppliers_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Suppliers' table."];

// shippers table
shippers_addTip=["",spacer+"This option allows all members of the group to add records to the 'Shippers' table. A member who adds a record to the table becomes the 'owner' of that record."];

shippers_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Shippers' table."];
shippers_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Shippers' table."];
shippers_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Shippers' table."];
shippers_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Shippers' table."];

shippers_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Shippers' table."];
shippers_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Shippers' table."];
shippers_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Shippers' table."];
shippers_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Shippers' table, regardless of their owner."];

shippers_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Shippers' table."];
shippers_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Shippers' table."];
shippers_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Shippers' table."];
shippers_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Shippers' table."];

/*
	Style syntax:
	-------------
	[TitleColor,TextColor,TitleBgColor,TextBgColor,TitleBgImag,TextBgImag,TitleTextAlign,
	TextTextAlign,TitleFontFace,TextFontFace, TipPosition, StickyStyle, TitleFontSize,
	TextFontSize, Width, Height, BorderSize, PadTextArea, CoordinateX , CoordinateY,
	TransitionNumber, TransitionDuration, TransparencyLevel ,ShadowType, ShadowColor]

*/

toolTipStyle=["white","#00008B","#000099","#E6E6FA","","images/helpBg.gif","","","","\"Trebuchet MS\", sans-serif","","","","3",400,"",1,2,10,10,51,1,0,"",""];

applyCssFilter();
