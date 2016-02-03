function login(){
	console.log("entered");
	var username = document.getElementById("username");
	var password = document.getElementById("password");
	var token = document.getElementById("token");
	  $.post("http://tvstalkers.com/login.php",
    {
     username: username,
     password: password,
     token:token,
    },
    function(data){
		console.log(data);
    }, "json");
}

