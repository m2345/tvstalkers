	var channelArray = [];//
	var abc = new Array();
	
	var validChannelList = new Array("ABC", "ABC Family", "NBC", "CBS", "FOX", "PBS", "Disney Channel", "syfy");
	$.post("./tv_widget_primetime.php",
    {
      onload:"true",
    },
    function(data){
		doSomething(data);
		//console.log(data);
   }, "JSON");
   
 
   function getMonthName(m){
	   var month = new Array();
		month[0] = "January";
		month[1] = "February";
		month[2] = "March";
		month[3] = "April";
		month[4] = "May";
		month[5] = "June";
		month[6] = "July";
		month[7] = "August";
		month[8] = "September";
		month[9] = "October";
		month[10] = "November";
		month[11] = "December";
	return month[m];
   }
   
   function getWeekDay(w){   
		weekday = new Array();
		weekday[0]=  "Sunday";
		weekday[1] = "Monday";
		weekday[2] = "Tuesday";
		weekday[3] = "Wednesday";
		weekday[4] = "Thursday";
		weekday[5] = "Friday";
		weekday[6] = "Saturday";
		
	return weekday[w];
   }
		
   
   function doSomething(data){
		dayObject = selectDate(data, "today");
		
		//loop through everytime and show and sort by channel
		
		//console.log(dayObject.time);
		$.each(dayObject.time, function(){
			//console.log("count");
			time = this["@attributes"].attr;
			$.each(this.show, function(){
				network = this.network;
				//console.log(network);
				addToArray(network, time, this);
			});
		});
	printChannel();
	}	
	
	function printChannel(){
			u = document.getElementById("tvGuide");
		if(abc.length > 0){
		
		s = "";
		for(i=0; i<abc.length; i++){
			t = abc[i][0];
			name = abc[i][1]["@attributes"].name;
			s += "<div class='show'><div class='time'>" +t + "</div> <div clas='showName'></div> " + name + "</div></br>";
		}
		//console.log(s);
		u.innerHTML = s;
	}else 
	u.innerHTML = "Error loading guide";	
	}
	
	function addToArray(network, time, showObject){
		//console.log(network);
		if(typeof(network) !== 'undefined'){
		switch(network){
			case "ABC":
				abc.push(new Array(time, showObject));
				break;
			default:		
		}
	}
		return true;
	}
	
	
	 function parseShow(fullShowObject){
		toReturn = new Array();
		timeToOutput = dayTimeObject["@attributes"].attr;
		time = dayTimeObject["@attributes"].attr;
		fullShowObject = dayTimeObject.show;
		//here filter by network
		for(i=0; i<fullShowObject.length; i++){
			showObject =  fullShowObject[i];
			network = showObject.network;
			ep = showObject.ep;
			show = showObject["@attributes"].name;
			title =  showObject.title;
			sid = showObject.sid;
			_link = showObject.link;
			
			//push the show object into the corresponding array if it is in the array of netwroks 
			div = document.getElementById("output");
			if(validChannelList.indexOf(network) > -1){
				toReturn.push(new Array(network, show, title, ep));
				//div.innerHTML = div.innerHTML + network + " " + show +" "+ title + " " + ep + "</br>"; 
			}		
		}
		return toReturn;
	   }


		function selectDate(data, day){
			var today = new Date();
			currMonth = today.getMonth() +1;
			currDay = today.getDate();
			currYear = today.getFullYear();
			
			
			//console.log("today is: " + currYear + "-" + "-" + currDay);
			if(day == "today")
			for(i=0; i<data.DAY.length; i++){
				dayObject = data.DAY[i];
				day = dayObject["@attributes"].attr;
				//console.log(day);
				if(day == currYear + "-" + currMonth + "-" + currDay){
					return dayObject;
				}
			}
			
			return false;
		}

