CKEditor db driven inline-editing integration demo for Codeigniter 2.14 by Ablitica 2013

setup  
1. clone this repository into your local network  
2. set up your local db params in application/config/database.php  
3. import sql.sql to create the 'content' table  

notes
+ edit js/ckeditor_inline.js to specify controller and POST variables (around line 35)
+ this implementation of the CKEditor employs the source plugin
+ this code should function well into the future with newer versions of jQuery and the CKEditor
+ contact csantala@gmail.com for help
