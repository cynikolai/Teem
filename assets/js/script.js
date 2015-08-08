$(document).ready(function()  {
	
	// initialize with Parse
	Parse.initialize("ZnhCsGSUhnteG2rwpNijgcEmr5PruwPMW6tIH4yB", "28x8qs8EbqyQikeLU6s38N2zJdU6xbTelmvKSSQb");


	$("#input-zip").click(function() {
		var query = new Parse.Query("sc13prelim");

		query.find("")

		console.log(query);

		var zipschools = new Array();





		//gets one record, Fnkgls is objectid
		query.get("Fnkg1m5AAx", {
			success: function(object) {
	    // object is an instance of Parse.Object.
	    console.log(object.attributes.district_name);
		},

		// error: function(object, error) {
		// 	    // error is an instance of Parse.Error.
		// 	    console.log("error no");
		// 	}
		// });
	});
	


});