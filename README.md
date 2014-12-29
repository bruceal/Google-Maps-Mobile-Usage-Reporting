In order for this code to work there are two requirements:

1) An sql server active on the domain. This will need to have an active database which can be authenticated to.  Inside each php file is a section where the credentials of the database need to be added.

2)The database needs to have a table called Applications with at least a column called App.  From there it will create its own tables as nessecary.
