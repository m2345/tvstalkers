<html>
<head>
	<!-- All times are eastern time -->
	<title>primetime</title>
	<meta charset="utf-8">
</head>
<body>
	<h2>Loading...</h2>
	<div id="time"></div>
	<div id="output"></div>
	<div id="result_times">
		<table><th></th><th>8:00 pm</th><th>9:00 pm</th></table>
	</div>
<script src="./jquery1.11.js"></script>
<script src="json2.js"></script>
<script>
	var channelArray = [];//
	var validChannelList = new Array("ABC", "ABC Family", "NBC", "CBS", "FOX", "PBS", "Disney Channel");
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

		dayTimeObject = selectTime("08:00 pm", dayObject);
		showsAtEight = parseShow(dayTimeObject);
	
		dayTimeObject = null;
		dayTimeObject = selectTime("09:00 pm", dayObject);
		showsAtNine = parseShow(dayTimeObject);
	
		sortByChannel(showsAtEight, showsAtNine);
	}	
	
	function print(obj){
		var table = $('#result_times table');
		$.each(obj, function(){
			table.append(
				$('<tr></tr>').append(
					$('<td></td>').text(this.channel),
					$('<td></td>').text(this.show1[1]),
					$('<td></td>').text(this.show2[1])
				)
			);
		});
	}
	
	function sortByChannel(eight, nine){
		var validChannelList = new Array("ABC", "ABC Family", "NBC", "CBS", "FOX", "PBS", "Disney Channel");
		var eightFound = [false, false, false, false, false, false, false];
		var nineFound = [false, false, false, false, false, false, false];
		//console.log(eight);
		//console.log(nine);
		
		eightLoop = eight;
		nineLoop = nine;
		
		for(i =0; i < eightLoop.length; i++){
			network = eightLoop[i][0];
			//console.log(network);
			index = validChannelList.indexOf(network);
			eightFound[index] = eightLoop[i];
		}
		
		for(i =0; i < nineLoop.length; i++){
			network = nineLoop[i][0];
			//console.log(network);
			index = validChannelList.indexOf(network);
			nineFound[index] = nineLoop[i];
		}
		
		
		console.log("final sorted ");
		console.log(nineFound);
		createObj(eightFound, nineFound);	
	}
	
	
	function createObj(eight, nine){
		div = document.getElementById("time");
		//var arr = [eight, nine];
		var row1 = eight;//arr[0];
		var row2 = nine; //arr[1];
		//print row1 
		
		//create object,
		var obj = {
			'row1ChannelName' :{
				'channel' : "ABC",
				'show1' : row1[0],
				'show2' : row2[0]
				},
				'row2ChannelName' :{
				'channel': "ABC FAMILY",
				'show1' : row1[1],
				'show2' : row2[1]
				},
				
				'row3ChannelName' :{
				'channel' : "NBC",
				'show1' : row1[2],
				'show2' : row2[2]
				},
				
				
				'row4ChannelName' :{
				'channel':"CBS",
				'show1' : row1[3],
				'show2' : row2[3]
				},
			
			
			'row5ChannelName' :{
				'channel' : "FOX",
				'show1' : row1[4],
				'show2' : row2[4]
				},
				
				'row6ChannelName' :{
				'channel' : "PBS",
				'show1' : row1[5],
				'show2' : row2[5]
				},
				
				
				'row7ChannelName' :{
				'channel' : "Disney Channel",
				'show1' : row1[6],
				'show2' : row2[6]
				},
				
			};
			console.log(obj);
		print(obj);
	}
	
	
	 function parseShow(fullShowObject){
		 toReturn = new Array();
		   timeToOutput = dayTimeObject["@attributes"].attr;
		//document.getElementById("time").innerHTML = timeToOutput;
		//console.log(dayTimeObject);
		
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
	   
	   
		function selectTime(timeToGet, dayObject){
			for(i=0; i<dayObject.time.length; i++){
				dayTimeObject = dayObject.time[i];
				time = dayTimeObject["@attributes"].attr;
				if(time == timeToGet){
					return dayTimeObject;
				}
			}
			return false; //timeObjectArray;
		}
		
		function selectDate(data, day){
			var today = new Date();
			currMonth = today.getMonth() +1;
			currDay = today.getDate();
			currYear = today.getFullYear();
			
			var tomorrow = new Date(today.getTime() + 24 * 60 * 60 * 1000);
			tomMonth = tomorrow.getMonth() +1;
			tomDay = tomorrow.getDate();
			tomYear = tomorrow.getFullYear();
			
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
			else 
				for(i=0; i<data.DAY.length; i++){
				dayObject = data.DAY[i];
				day = dayObject["@attributes"].attr;
				//console.log(day);
				if(day == tomYear + "-" + tomMonth + "-" + tomDay){
					return dayObject;
				}
			}
			
			return false;
		}
	   
	   
	  
   
</script>
</body>
</html>
