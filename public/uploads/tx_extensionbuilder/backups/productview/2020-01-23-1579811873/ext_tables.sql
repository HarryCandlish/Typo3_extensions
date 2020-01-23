#
# Table structure for table 'tx_productview_domain_model_category'
#
CREATE TABLE tx_productview_domain_model_category (

	product int(11) unsigned DEFAULT '0' NOT NULL,

	category varchar(255) DEFAULT '' NOT NULL,

);

#
# Table structure for table 'tx_productview_domain_model_product'
#
CREATE TABLE tx_productview_domain_model_product (

	title varchar(255) DEFAULT '' NOT NULL,
	price varchar(255) DEFAULT '' NOT NULL,
	name varchar(255) DEFAULT '' NOT NULL,
	start_date int(11) DEFAULT '0' NOT NULL,
	end_date int(11) DEFAULT '0' NOT NULL,
	featured_event int(11) DEFAULT '0' NOT NULL,
	categories int(11) unsigned DEFAULT '0' NOT NULL,

);

#
# Table structure for table 'tx_productview_domain_model_category'
#
CREATE TABLE tx_productview_domain_model_category (

	product int(11) unsigned DEFAULT '0' NOT NULL,

);
