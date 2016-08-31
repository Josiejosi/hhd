var secondary_level_token 	= $('meta[name="secondary_level_token"]').attr('content') ;
var fallback_url 			= $('meta[name="fallback_url"]').attr('content') ;

var individual_channel 		= "user"+secondary_level_token ;

var socket 					= io(fallback_url) ;

socket.on(individual_channel+":App\\Events\\YouHaveBeenReserved", function(message) {

	console.log('Client can get this:') ;
	console.log('--------------------') ;
	console.log(message) ;
});