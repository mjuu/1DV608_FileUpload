### Project in  the course 1DV608 - Web developing with PHP
# Project FileUpload
Author: Benjamin Björk

# Description
FileUpload is a simple file upload site where you can upload temporary files or upload a file and send the link to your friend.
You can upload files to the public file list or register a new account and upload to your private file list.

#Server requirements
Apache2 <br>
PHP <br>
MySQL database <br>

#Server setup
##Apache2
###Basic security
###disable directory listing by enabling use of .htaccess in
    /etc/apache2/sites-available/default
###make a .htaccess file in the web root with this:
    Options -Indexes

##PHP
###Change the these values in php.ini to 20M
    post_max_size = 20M
    upload_max_filesize = 20M

##MySQL
SQL script for creating the database is installation directory. If you wan't to set up the database by your self here is the information
on what you need.
###Create two databases
    - file_upload
    - members
    
###Create two tables in file_upload database for file uploads, one for public uploads and the other for private uploads with the fields:
    - public table
        - id
        - filePath
        - type
        - size
        
    - private table
        - id
        - username
        - file
        - type
        - size

###Create a table in member database where user information is saved
    - member table
        - id
        - username
        - password
        
##Installation

1. Download the zip package.
2. Unzip and move the conf folder outside of the webroot. Edit the index.php to your conf folder location.
3. Setup the database and PHP.
4. Set correct read/write rights on the uploads folders.

#Use-cases
##UC1 - Download a file
###Actors
Users - Who want to download a file
###Preconditions
Requires that files are uploaded on the server
###Main Scenarios
1. User enter the site
2. See a file that is interesting and click on the link
3. Server shows the file

###Alternative Scenarios
2a. File is missing and system shows an error page <br>
3. Server gives an option to download the file

##UC2 - Public upload
###Actors
User - Who want to upload a file
###Preconditions
None
###Main Scenarios
1. User enter the site.
2. Clicks on "Upload a file".
3. Chooses a file.
4. Clicks on "Upload" button.
5. System responds with a successful message and show information about the uploaded file, and a URL to the file. 
6. User want to upload more files and clicks on "Choose file" and upload it.
7. User want to go back to main page and clicks on "Back to Start".

###Alternative Scenarios
4a. System shows error about "A problem occurred while uploading your file, please try again". <br>
4b. System shows error about "Something went wrong...".<br>
4c. System shows error about "File is to large".<br>

##UC3 - Sign in
###Actors
User - Who want to sing in to the member area and access the private list of files
###Preconditions
User must be registered
###Main Scenarios
1. User enter the site
2. Clicks on sign in
3. Enter credentials
4. System authenticate the user and redirect to the member area

###Alternative Scenarios
3a. User enter empty username and a password. System respond with "Empty username".<br>
3b. User enter username and empty password. System respond with "Wrong password".<br>
3c. User enter wrong username but right password. System respond with "Wrong username and password".<br>
3d. User enter right username but wrong password. System respond with "Wrong username and password".<br>
5. User want to go back to main page and clicks on "Back to Start".<br>
6. User want to create a new account and click on "Sign up".<br>

##UC4 - Sign up
###Actors
User - Who want to register a new account.
###Preconditions
None
###Main Scenarios
1. User enter the site.
2. Clicks on login.
3. Clicks on "Sign up".
4. User enter credentials.
5. Clicks on "Register"
6. System responds with this message if successful "Register completed! Please use the new credentials"
7. User want to go back to main page and clicks on "Back to Start".
8. User click on sign in and enter the member area.

###Alternative Scenarios
5a. User enter empty username and a password. System respond with "Empty username".<br>
5b. User enter username and empty password. System respond with "Empty password".<br>
5c. User enter username and password but writes wrong password in password retype. System respond with "Password miss match".<br>
5d. User enter a taken username. System responds with "Username taken".<br>

##UC5 - Sign out
###Actors
User - Who want to sign out
###Preconditions
User must be logged in
###Main Scenarios
1. User is logged in and want to sing out.
2. User click on "Sign out".
3. User is redirected to main page.
###Alternative Scenarios
None<br>

##UC6 - Private upload
###Actors
User - Who want to do a private upload
###Preconditions
User must be logged in
###Main Scenarios
1. User click on "Private upload".
3. User choose a file.
4. Clicks on "Upload" button.
5. System responds with a successful message and show information about the uploaded file, and a URL to the file. 
6. User want to upload more files and clicks on "Choose file" and upload it.
7. User clicks on the new URL and look at/download the file.
8. User want to go back to member area and clicks on "Back to member area".

###Alternative Scenarios
4a. System shows error about "A problem occurred while uploading your file, please try again".<br>
4b. System shows error about "Something went wrong...".<br>
4c. System shows error about "File is to large".<br>
7a. If the uploaded file is a image or a mp3 then the web browser loads it. <br>
When user want to get back the system will show an error like "Confirm resubmission".<br>

#Test-Cases
#1.1 Download a file
##Input
* User click on a link

##Output
* The server will show the file if it is a image or mp3.

#1.2 Download a file
##Input
* User click on a broken link

##Output
* If the file is missing the server will show a error page.

#2.1 Successful upload to the public upload list
User want to upload a file to the public file list.
##Input
* User chose a file to upload
* User click on upload

##Output
* System shows a successful message and file information when uploaded.

#2.2 Fail to do a public upload
User want to upload a file to the public file list.
##Input
* User chose a file to upload
* User click on upload

##Output
* If file is to big a error message is shown.
* If a problem occur while uploading file this error message will be shown "A problem occurred while uploading your file, please try again".
* If the system can't detect the specific error it will show this error "Something went wrong...".

#3.1 Successful Sign in
User want to sign in to the member area.
##Input
* User click on "Sign in"
* User enter credentials

##Output
System authenticate and then redirect user to the member area.

#3.2 Failed to Sign in
User want to sign in to the member area.
##Input
* 1. User click on "Sign in"
* 2. User enter empty username and a password.
* 3. User enter username and empty password. 
* 4. User enter wrong username but right password. 
* 5. User enter right username but wrong password. 

##Output
* 2. System respond with "Empty username"
* 3. System respond with "Wrong password"
* 4. System respond with "Wrong username and password".
* 5. System respond with "Wrong username and password".


#4.1 Successful "Sign up"
User want to sign up
##Input
* User click on "Sign up"
* Enter valid credentials

##Output
* System responds with "Register completed! Please use the new credentials"

#4.2 Failed to "Sign up"
User want to Sign up
##Input
* 1. User click on "Sign up"
* 2. User enter empty username and a password.
* 3. User enter username, empty password and  empty Retype password. 
* 4. User enter username, password and no "Retype password". 
* 5. User enter username, password and Retype password. 

##Output
* 2. System respond with "Empty username"
* 3. System respond with "Wrong password"
* 4. System respond with "Password miss match".
* 5. System respond with "Username is taken".

#5.1 Sign out
User want to Sign out
##Input
User click on "Sign out"

##Output
System redirect user to the main page.

#6.2 Failed private file upload
User want to do a private file upload and fail

##Input
* 1. User click on "Private upload"
* 2. Chose a file
* 3. Clicks on "Upload"

##Output
* 3. System shows a successful message and file information when uploaded. 

#6.1 Successful private file upload
User want to do a private file upload

##Input
* 1. User click on "Private upload"
* 2. Chose a file
* 3. Clicks on "Upload"

##Output
* 3.1. If file is to big a error message is shown.
* 3.2. If a problem occur while uploading file this error message will be shown "A problem occurred while uploading your file, please try again".
* 3.3. If the system can't detect the specific error it will show this error "Something went wrong...".
