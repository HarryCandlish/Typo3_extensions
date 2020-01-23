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
	categories int(11) unsigned DEFAULT '0' NOT NULL,

);

#
# Table structure for table 'tx_productview_domain_model_category'
#
CREATE TABLE tx_productview_domain_model_category (

	product int(11) unsigned DEFAULT '0' NOT NULL,

);
