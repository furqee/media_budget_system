<?php
        
// Start Routes for clients 
Route::resource('clients','ClientsController');
// End Routes for clients 

                    
// Start Routes for digitalads 
Route::resource('digitalads','DigitaladsController');
// End Routes for digitalads 

                    
// Start Routes for others 
Route::resource('others','OthersController');
// End Routes for others 

                    
// Start Routes for adtypes 
Route::resource('adtypes','AdtypesController');
// End Routes for adtypes 

                    
// Start Routes for adplatforms 
Route::resource('adplatforms','AdplatformsController');
// End Routes for adplatforms 

?>