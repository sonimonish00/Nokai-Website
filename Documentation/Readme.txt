1. Make a DB "nokiaus" and import the sql
2. Make Following changes on server while uploading online........
   
===========================================================================================
upload_max_filesize = 500M
post_max_size = 512M
memory limit = 600M (-1 for infinite)

memory limit > post_max_size > upload_max_filesize
    max_input_time : -1 (Alternative - set_time_limit(0) function in your PHP Heading)
    max_execution_time : 0 May b check it
===================================================================
upload_max_filesize is the sum of the sizes 
of all the files that you are uploading. 
post_max_size is the upload_max_filesize + the sum of
lengths of all the other fields in the form plus any 
mime headers that the encoder might include. 
Since these fields are typically small you can 
often approximate the upload max size to the post max size.
 There are several ways to do this:
    If you have direct access to the server config, modify it in the php.ini directly.
    If you are on a shared hosting site, it may be possible to change the size by either
    creating a local php.ini, or by .htaccess flags. 
    However, many hosters restrict increasing this value. 
    You should consider the help documents of your hoster. 
    Search for the variable names.

===============================================================================================
3. 				TECHNOLOGIES - SPECIFICATION
=========================================================================================
Domain & Web hosting (Shared): GoDaddy
	Storage (Space/HDD) - 100 GB 
	Server - (Apache)
	O.S. -  Linux (Redhat)
 	Bandwidth - 100 MB (Need More web traffic volume here )
	No. of Domains & Subdomains - Depends
	Email accounts - 
	Mobile Websites - 
	SSH Support - yes
	Control Panel - Cpanel
	FTP Support - Yes

Backend :
	
	Database - MySQL
		
Frontend :
	
	PHP,CSS3 + Bootstrap + jquery + JS
=======================================================================================
Requirement 

1. Restriced Access to Website
2. Admin Could be able to change for other users (TAB)
3. User Could Upload Any File Upto 500 MB.(While Uploading Should ask: username and password)
4. Different Links or TABS to Redirect.

===================================================
Changes from my side

-If User is Specific that each file uploaded by user should be in his/her own account
then there is no need of secure code in front end of website.Email id and password could work
that time