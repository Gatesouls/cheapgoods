# Readme
This file contains a little tour to architecture of this web-application
auth:
here is the script for user authentication. User can sign up for the first time (their data will be saved in Database, of course) 
or sign in if they have account already. Script here is written in procedural style without including any classes, because 
I didn't know a thing about OOP back then. This all is subject to change.

catalog:
Writtem in OOP style with including DBdriver.php class (located in cheapgoods/include). This is a subject to change as well. 
I still have to implement layers of abstractions here (create some DAOs and etc.). You can see that I have started to implement it already (see include directory)
Script here contains several files. For example, show_cat.php displays all categories as clickable links. show_items.php displays all items in a category, etc.

dist:
just a folder that contains Bootstrap code

engine:
Though there is very little of "engine" here. Contains admin tools allowing to add new categories and items to database

images:
contains images for items and some buttons

include:
DBdriver.php is the main inc. file. It contains script, html output. Yes, it's wrong to store all code in one file, but when I implement
layers of abstraction, everything will be fine. Also you can see that I started to develop new classes like DAO and Singleton which will be used later

index.php:
just redirects to /catalog directory so it's easier for me to work with links and etc.