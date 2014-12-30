This is the PHP code you should hoist on your server/domain in order to record your page views and map loads and/or Page Views for use with the Google Maps Mobile SDKs.

In order for this code to work there are two requirements:

1) An sql server active on the domain. This will need to have an active database which can be authenticated to.  Inside each php file is a section where the credentials of the database need to be added.

2)The database needs to have a table called Applications with at least a column called App.  From there it will create its own tables as nessecary.


To Record maps usage you need to have your mobile application request the add_data.php file over the internet with the parameter app=YourAppName/Channel

For example:

To add a page view for an app or channel called test:
http://quickaccess.orgfree.com/add_data.php?app=test

You can then view its usage directly with 
http://quickaccess.orgfree.com/get_usage.php?app=test

or open get_usage.php for more detailed options
