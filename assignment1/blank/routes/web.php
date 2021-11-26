<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


//homepage
Route::get('/', function()
{
  $sql = "select * from vehicles";
  $vehicles = DB::select($sql);
  //$vehicles = array(); 
  return view("carhomepage")->with('vehicles', $vehicles);
});

//home navigation link
Route::get('/home', function()
{
  $sql = "select * from vehicles";
  $vehicles = DB::select($sql);
  // Remove the line below, and implement your own code.
	//dd("Welcome to PMS, there is a lot to do, so let's get on with it");
  return view("carhomepage")->with('vehicles', $vehicles);
});

//show detail of every vehicle chosen
Route::get('vehicle_detail/{id}', function($id){
  
  $vehicle = get_vehicle($id);
  return view("vehicle_detail_withbookings")->with('vehicle', $vehicle);
  dd($vehiclebookings);
});

//route for getting vehicle bookings
Route::get('vehicle_viewbookings/{id}', function($id){
  $vehiclebookings = get_vehiclebookings($id);
  //dd($vehiclebookings);
  if($vehiclebookings){
    $clientinfos = array();
    $count = 0;
    for ($clientcount = 0; $clientcount < count($vehiclebookings); $clientcount+=1){
      $clientinfosql= "select * from clients where id =?";
      $clientinfo = DB::select($clientinfosql, array($vehiclebookings[$clientcount]->clientbooking_id));
      $clientinfos[] = $clientinfo;
      $count += 1;
    
    }
  //dd($clientinfos[0][0]->clientlicense);
    return view("vehicle_viewbookings")->with('clientinfos', $clientinfos)
    ->with('vehiclebookings', $vehiclebookings)
    ->with('count', $count);
  }
  else{
    return view('vehicle_viewwithoutbookings');
  }

});


//look up vehicle bookings
function get_vehiclebookings($id){
  $sql= "select * from bookings where vehiclebooking_id =?";
  $vehiclebookings = DB::select($sql, array($id));
  //if(count($vehiclebookings) == 0){
  if(count($vehiclebookings) == 1){
    //die("Something has gone wrong, booking does not exi: $sql");
    $vehiclebookings = $vehiclebookings;
    return $vehiclebookings;
  }
  elseif(count($vehiclebookings) > 1){
    $vehiclebookings = $vehiclebookings;
    return $vehiclebookings;
  }    
}

//look up vehicle details
function get_vehicle($id){
  $sql= "select * from vehicles where id =?";
  $vehicles = DB::select($sql, array($id));
  if(count($vehicles) != 1){
    die("Something has gone wrong, invalid query or result: $sql");
  }
  $vehicle = $vehicles[0];
  return $vehicle;
}
//route for returning vehicle
Route::get('vehicle_return/{vehicle_booking_id}/{booking_id}', function($vehicle_booking_id, $booking_id){
  return view('update_vehicle_return')->with('vehicle_booking_id', $vehicle_booking_id)
  ->with('booking_id', $booking_id);
});

//action for returning vehicle form
Route::post("return_vehicle_action", function(){
  $vehicle_id = request('vehicle_id');
  $booking_id = request('booking_id');
  
  $distancetravelled = request('distancetravelled');
  $id = update_odometer($vehicle_id, $distancetravelled);

  $sqlupdatebookingvisibility = "update bookings set bookingreturned = 1 where booking_id=?";
  DB::update($sqlupdatebookingvisibility, array($booking_id));

  return redirect("/");
});

//function for updating car odometer
function update_odometer($vehicle_id, $distancetravelled){
  $sqlupdateodometer = "update vehicles set odometer = ? where id=?";
  //dd($vehicle_id);
  DB::update($sqlupdateodometer, array($distancetravelled, $vehicle_id));
  return $vehicle_id;
}


//show all clients name
Route::get('/clients', function()
{
  $sql = "select * from clients";
  $clients = DB::select($sql);
  // Remove the line below, and implement your own code.
	//dd("Welcome to PMS, there is a lot to do, so let's get on with it");
  return view("clientspage")->with('clients', $clients);
});

//show detail of every client chosen
Route::get('client_detail/{id}', function($id){
  $client = get_client($id);
  return view("client_detail")->with('client', $client);
  //dd($vehicle);
});

//lookup client details
function get_client($id){
  $sql= "select * from clients where id =?";
  $clients = DB::select($sql, array($id));
  if(count($clients) != 1){
    die("Something has gone wrong, invalid query or result: $sql");
  }
  $client = $clients[0];
  return $client;
}

//add vehicle
Route::get('add_vehicle', function(){
    return view("add_vehicle");
});

//add vehicle form action
Route::post('add_vehicle_action', function(){
  $vehiclemodel = request('vehiclemodel');
  $vehiclerego = request('vehiclerego');
  $vehiclemodelyear = request('vehiclemodelyear');
  $vehicleodometer = request('vehicleodometer');
  $vehiclecolor = request('vehiclecolor');
  if (strlen($vehiclerego) == 6){
    $id = add_vehicle($vehiclemodel, $vehiclerego, $vehiclemodelyear, $vehicleodometer, $vehiclecolor);
    $sqladdregotobookingtimetable = "insert into bookingtimes (rego, hoursbooking) values (?, ?)";
    DB::insert($sqladdregotobookingtimetable, array($vehiclerego, 0));
    
    if ($id){
      return redirect("vehicle_detail/$id");
    } else {
      die("Error while adding item.");
    }
  }
  else{
    //echo ('Invalid Rego Length');
    return view('invalid_vehicle');
  }

});
//function for adding a vehicle

function add_vehicle($vehiclemodel, $vehiclerego, $vehiclemodelyear, $vehicleodometer, $vehiclecolor){
  $initialbookingcount = 0;
  $sql= "insert into vehicles (model, rego, modelyear, odometer, color, bookingcount) values (?, ?, ?, ?, ?, ?)";
  DB::insert($sql, array($vehiclemodel, $vehiclerego, $vehiclemodelyear, $vehicleodometer, $vehiclecolor, $initialbookingcount));
  $id = DB::getPdo()->lastInsertId();
  return($id);
}

//update vehicle route
Route::get('vehicle_update/{id}', function($id){
  $vehicle = get_vehicle($id);
  return view("update_vehicle")->with('vehicle', $vehicle);
  //dd($vehicle);
});


//update vehicle action route
Route::post("update_vehicle_action", function(){
  
  $vehiclemodel = request('vehiclemodel');
  $vehiclerego = request('vehiclerego');
  $vehiclemodelyear = request('vehiclemodelyear');
  $vehicleodometer = request('vehicleodometer');
  $vehiclecolor = request('vehiclecolor');
  $vehicleid = request('id');
  if (strlen($vehiclerego) == 6){
    $id = update_vehicle($vehiclemodel, $vehiclerego, $vehiclemodelyear, $vehicleodometer, $vehiclecolor, $vehicleid);
    if ($id){
      return redirect("/");
    } else {
      die("Error while adding item.");
    }
  } else {
     //echo ('Invalid Rego Length');
     return view('invalid_vehicleupdate') ->with('id', $vehicleid);
  }
  
});

//update vehicle function
function update_vehicle($vehiclemodel, $vehiclerego, $vehiclemodelyear, $vehicleodometer, $vehiclecolor, $vehicleid){
  $sql = "update vehicles set model= ?, rego= ?, modelyear = ?, odometer = ?, color = ? where id=?";
  DB::update($sql, array($vehiclemodel, $vehiclerego, $vehiclemodelyear, $vehicleodometer, $vehiclecolor, $vehicleid));
  return $vehicleid;
}

Route::get('vehicle_delete/{id}/{rego}', function($id, $rego){
  delete_vehicle($id, $rego);
  return redirect("/");
  //dd($vehicle);
});

//Delete vehicle function
function delete_vehicle($vehicleid, $vehiclerego){
  $sqldeletebooking = "delete from bookings where vehiclebooking_id=?";
  DB::delete($sqldeletebooking, array($vehicleid));
  $sql = "delete from vehicles where id=?";
  DB::delete($sql, array($vehicleid));

  $sqldeletebookingtimes = "delete from bookingtimes where rego=?";
  DB::delete($sqldeletebookingtimes, array($vehiclerego));
  
}

//route for booking a vehile
Route::get('vehicle_booking', function(){
  $sql = "select * from vehicles";
  $sqlclients= "select * from clients";
  $vehicles = DB::select($sql);
  $clients = DB::select($sqlclients);
  //$vehicles = array(); 
  return view('vehicle_booking')->with('vehicles',$vehicles)
  ->with('clients',$clients);
});

//route for booking for submission
Route::post("book_vehicle_action", function() {
  $vehiclerego = request('regos');
  $clientname = request('clients');
  $bookingdate = request('bookingdate');
  $bookingtime = request('bookingtime');
  $returndate = request('returndate');
  $returntime = request('returntime');

  //series for recording hours booked
  $bookingdatetime = $bookingdate." ".$bookingtime;
  $returndatetime = $returndate." ".$returntime;
  $bookingdatetimeconverted = strtotime($bookingdatetime);
  $returndatetimeconverted = strtotime($returndatetime);
  $bookinghours= ($returndatetimeconverted - $bookingdatetimeconverted)/(60*60);

  //retrive existing bookings with the same date from bookings table after getting corresponding vehicle id with the rego chosen in the form
  $sqlretrivevehicleidchosen = "Select id from vehicles where rego=?";
  $vehicleidretrieved = DB::Select($sqlretrivevehicleidchosen, array($vehiclerego));
  //dd(count($vehicleidretrieved));
  if(count($vehicleidretrieved) > 0)
  {
    //dd($vehicleidretrieved);
    $sqlcheckexistingbookings = "Select booking_id from bookings where bookingdate=? and bookingtime=? and vehiclebooking_id=?";
    $collectedbookings = DB::Select($sqlcheckexistingbookings, array($bookingdate, $bookingtime, $vehicleidretrieved[0]->id));
    //dd($collectedbookings);
    if(count($collectedbookings) > 0)
    {
      return view('invalid_vehiclebookingscheduleexisting');
    }
    else
    {
        // date_default_timezone_set('Australia/Melbourne');
      $timenow = date('Y-m-d H:i:s');
      $timenowconverted = strtotime($timenow);
      $bookinghoursfuture = ($bookingdatetimeconverted - $timenowconverted)/(60*60);
      
      //check if booking hours is positive
      if (($bookinghours >= 0) && ($bookinghoursfuture >= 0)){
        //dd($hourdifference);
        computeandaddvehiclebookinghours($vehiclerego, $bookinghours);

        //retrieve id of vehicle booked
        $vehicleidsql = "select * from vehicles where rego =?";
        $vehicleid_booking = DB::select($vehicleidsql, array($vehiclerego));
        $vehicleid_booking_id = $vehicleid_booking[0] ->id;

        //retrive id of client booked
        $clientidsql = "select * from clients where clientname=?";
        $clientid_booking = DB::select($clientidsql, array($clientname));
        $clientid_booking_id = $clientid_booking[0] ->id;

        //add to booking count
        $updatevehiclebookingcountsql = "update vehicles set bookingcount = bookingcount + 1 where rego=?";
        DB::update($updatevehiclebookingcountsql, array($vehiclerego));
        //dd($vehicleid_booking_id, $clientid_booking);
        //dd($vehicleid_booking, $clientid_booking, $bookingdate, $bookingtime, $returndate, $returntime);
        add_booking($vehicleid_booking_id, $clientid_booking_id, $bookingdate, $bookingtime, $returndate, $returntime);

        return redirect ('/');
        
        //dd($vehicleid_booking, $clientid_booking);
      }else{
        return view('invalid_vehiclebookingschedule');
      }    
    }    
  }
  else
  {
    return view('/');
  }
});

function computeandaddvehiclebookinghours($vehiclerego, $bookinghours){
  $updatebookingtimeforvehicle = "update bookingtimes set hoursbooking = hoursbooking + ? where rego=?";
  DB::update($updatebookingtimeforvehicle, array($bookinghours, $vehiclerego));
}

//function for adding booking
function add_booking($vehicleid_booking, $clientid_booking, $bookingdate, $bookingtime, $returndate, $returntime){
  $sql= "insert into bookings (vehiclebooking_id, clientbooking_id, bookingdate, bookingtime, returndate, returntime) values (?, ?, ?, ?, ?, ?)";
  DB::insert($sql, array($vehicleid_booking, $clientid_booking, $bookingdate, $bookingtime, $returndate, $returntime));
  $id = DB::getPdo()->lastInsertId();
  return($id);
}

Route::get('/vehicle_popularity', function(){
  $sql = "SELECT * from vehicles ORDER BY bookingcount DESC";
  $vehicles = DB::select($sql);
  //$vehicles = array(); 
  return view('vehicle_popularity')->with('vehicles', $vehicles);
});


Route::get('hours_list', function(){

  $sqlgethours = "SELECT * from bookingtimes order by hoursbooking DESC";
  $regoandhours = DB::select($sqlgethours);
  return view('vehicle_hours_list')->with('regoandhours', $regoandhours);
});

Route::get('hours_test', function(){
  $bookingdatetime_1 = "2021-09-13 12:00:00";
  $returndatetime_1 = "2021-09-13 11:00:00";
  $bookingdatetimeconverted_1 = strtotime($bookingdatetime_1);
  $returndatetimeconverted_1 = strtotime($returndatetime_1);
  $bookinghours_1= ($returndatetimeconverted_1 - $bookingdatetimeconverted_1) /(60*60);
  dd($bookinghours_1);
});
















Route::get('/test', function(){
  $sql = "select * from vehicles";
  $vehicles = DB::select($sql);
  //dd($vehicles);
});