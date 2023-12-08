*******************************************************************************************************
KIT502 Web Development - Assignment 2 - Tassie Green Energy Trading Company
*******************************************************************************************************

*******************************************************************************************************
Submitted By
*******************************************************************************************************

Group 14
Sachin Johnson(668690)
Dongyi Guo(662970)
Ahmed All Razi(661826)

*******************************************************************************************************
Project URL on Usermin
*******************************************************************************************************

Home Page URL: https://ictteach-www.its.utas.edu.au/groupwork/kit502-group-14/asm2/

*******************************************************************************************************
Configuration Information
*******************************************************************************************************

Database Used : MySQL
Database Host : 127.0.0.1
Database Port : 3306
Database Name : kit502-group-14 
User Name     : kit502-group-14
Password      : BjGNdNVjLnkA

*******************************************************************************************************
Credentials
*******************************************************************************************************

Service Manager 1
Name		 : Mia Thomas
Email        : mia@yahoo.com
Password     : mia@1234

Service Manager 2
Name		 : Harper Smith
Email        : harper@aol.com
Password     : harper@1234

Buyer/Seller 1
Name		 : Sam Jones
Email        : sam@gmail.com
Password     : sam@1234

Buyer/Seller 2
Name		 : Liam Johnson
Email        : liam@outlook.com
Password     : liam@1234

Buyer/Seller 3
Name		 : Noah Smith
Email        : noah@gmail.com
Password     : noah@1234

Buyer/Seller 4
Name		 : Oliver Brown
Email        : oliver@yahoo.com
Password     : oliver@1234

Buyer/Seller 5
Name		 : James Miller
Email        : james@aol.com
Password     : james@1234

Buyer/Seller 6
Name		 : Olivia Johnson
Email        : olivia@gmail.com
Password     : olivia@1234

Buyer/Seller 7
Name		 : Emma Martinez
Email        : emma@outlook.com
Password     : emma@1234

Buyer/Seller 8
Name		 : Ava Lopez
Email        : ava@gmail.com
Password     : ava@1234

*******************************************************************************************************
Tables and Views
*******************************************************************************************************

users				: Stores all user information (name, email, password, address, ismanager, zone and account balance).
energy_products     : Stores inventory information for each user (energy type, zone, seller price and volume).
energy_transactions : Stores information on all trading activity.
energy_types 		: Stores various avialable energy types for trading (wind, solar, geothermal, hydroelectric, biomass).
fee_history 		: Stores fee history information(market price, administation fees, tax rate). Updated by the service manager.
home_searches       : View for search bar.
trading_positions   : Stores various avialable trading positions (Buy, Sell, Buy/Sell, Restrict).
zones   			: Stores various avialable zones(A, B, C, D, E).
 
*******************************************************************************************************
Laravel Views 
*******************************************************************************************************

Start Folder
home            	  : Home page for the project.
home-about            : About us page.
home-footer 		  : Footer for all screens before user login.
home-header 		  : Header for all screens before user login - contains the search bar to search for energy types and zones.
home-layout 		  : Layout for all screens before user login.
home-login  		  : Login screen.
home-privacy		  : Privacy policy page.
home-register      	  : Registration page.
home-terms-conditions : Terms and conditions page.
home-trading          : Trading page before user login.

Logged Folder
dashboard			  : Dashboard screen layout.
fee					  : Fee and tax management.
footer				  : Will show the contents of footer for authorized users
header                : Will show the contents of header for authorized users
layout                : Layout will contain header, body contents and footer. Also all references to external CSS and JS files will be inside layout
master-trading        : Offers buy/sell products to users
profile               : User can see his/her own details here. This page also has the option to top-up/withdraw money.
trading               : Offers buy/sell products to users
user-management       : Service managers can manage users from this page. If necessary, they can disable any member.

*******************************************************************************************************
Laravel Routes
*******************************************************************************************************

web.php 			  : Contains all routes for the project.

*******************************************************************************************************
Laravel Controllers 
*******************************************************************************************************

LoginController       : For user login.
RegisterController    : To register a new user.
FeeController         : For fee and tax management.
HomeSearchController  : For searching and displaying results.
HomeController        :
LoggedInController    :

*******************************************************************************************************
Laravel Models
*******************************************************************************************************

EnergyProduct		  : Model for 'energy_products' table.
EnergyTransaction     : Model for 'energy_transactions' table.
EnergyType			  : Model for 'energy_types' table.
FeeHistory			  : Model for 'fee_history' table.
HomeSearch			  : Model for 'home_searches'view.
TradingPosition       : Model for 'trading_positions' table.
User				  : Model for 'users' table.
Zone				  : Model for 'zones' table.

*******************************************************************************************************
Laravel Migrations
*******************************************************************************************************

2012_12_12_000000_create_energy_types_table         : Migration file for 'energy_types' table.
2012_12_12_000000_create_trading_positions_table	: Migration file for 'trading_positions' table.
2012_12_12_000000_create_zones_table				: Migration file for 'zones' table.
2014_10_12_000000_create_users_table				: Migration file for 'users' table.
2023_05_21_000001_create_fee_histories_table		: Migration file for 'fee_history' table.
2023_05_21_000002_create_energy_products_table		: Migration file for 'energy_products' table.
2023_05_21_000003_create_energy_transactions_table  : Migration file for 'energy_transactions' table.
2023_05_24_020524_create_home_searches_table		: Migration file for 'home_searches'view.