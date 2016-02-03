	var channelArray = [];//
	var abc = new Array();
	var nbc = new Array();
	var cbs = new Array();
	var disney = new Array();
	var syfy = new Array();
	var usa = new Array();
	var teennick = new Array();
	var pbs = new Array();
	var tlc = new Array();
	var cnn = new Array();
	var oxygen = new Array();	
	var nat_geo = new Array();
	var diy_network = new Array();
	var investigation_discovery = new Array();
	var discovery = new Array();
	var esquire = new Array();
	var hgtv = new Array();
	var fox_news= new Array();
	var science = new Array();
	var lifetime = new Array();
	var history = new Array();
	var bravo = new Array();
	var fox = new Array();
	var msnbc = new Array();
	var own = new Array();
	var cw = new Array();
	var nick = new Array();
	
	
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
		
		console.log(dayObject.time);
		$.each(dayObject.time, function(){
			//console.log("count");
			time = this["@attributes"].attr;
			$.each(this.show, function(){
				network = this.network;
				//console.log(network);
				addToArray(network, time, this);
			});
		});
	
		//console.log("length: " + disney.length);
		u = document.getElementById("tvGuide");
		s = "";
		for(i=0; i<abc.length; i++){
			t = abc[i][0];
			//console.log(t);
			//console.log(abc[i][1]);
			name = abc[i][1]["@attributes"].name;
			s += t + "  " + name + "</br>";
		}
		console.log(s);
		u.innerHTML = s;
	}	
	
	function addToArray(network, time, showObject){
		//console.log(network);
		if(typeof(network) !== 'undefined'){
		switch(network){
			case "ABC":
				abc.push(new Array(time, showObject));
				break;
			case 'NBC':
				nbc.push(new Array(time, showObject));
				break;
			case 'CBS':
				cbs.push(new Array(time, showObject));
				break;
			case 'Syfy':
				syfy.push(new Array(time, showObject));
				break;
			case 'USA Network':
				usa.push(new Array(time, showObject));
				break;
			case 'Disney Channel':
				disney.push(new Array(time, showObject));
				break;
			case 'Teennick':
				teennick.push(new Array(time, showObject));
				break;
			case 'PBS':
			pbs.push(new Array(time, showObject));
				break;
			case 'TLC':
			tlc.push(new Array(time, showObject));
				break;
			case 'CNN':
			cnn.push(new Array(time, showObject));
				break;
			case 'oxygen':
			oxygen.push(new Array(time, showObject));
				break;
			case 'National Geographic Channel':
			nat_geo.push(new Array(time, showObject));
				break;
			case 'diy network':
			diy_network.push(new Array(time, showObject));
				break;
			case 'Investigation Discovery':
			investigation_discovery.push(new Array(time, showObject));
				break;
			case 'Discovery Channel':
			discovery.push(new Array(time, showObject));
				break;
			case 'Esquire NETWORK':
			esquire.push(new Array(time, showObject));
				break;
			case 'HGTV':
			hgtv.push(new Array(time, showObject));
				break;
			case 'FOX NEWS channel':
			fox_news.push(new Array(time, showObject));
				break;
			case 'Science':
			science.push(new Array(time, showObject));
				break;
			case 'Lifetime':
			lifetime.push(new Array(time, showObject));
				break;
			case 'HISTORY':
			//history.push(new Array(time, showObject));
				break;
			case 'Bravo':
			bravo.push(new Array(time, showObject));
				break;
			case 'FOX':
			fox.push(new Array(time, showObject));
				break;
			case 'msnbc':
			msnbc.push(new Array(time, showObject));
				break;
			case 'OPRAH WINFREY NETWORK':
			own.push(new Array(time, showObject));
				break;
			case 'CW':
			cw.push(new Array(time, showObject));
				break;
			case 'nickelodeon':
			nick.push(new Array(time, showObject));
				break;
			
			default:		
		}
	}
		return true;
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
				
			};
			console.log(obj);
		print(obj);
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
	   
	   
	/*	function selectTime(timeToGet, dayObject){
			for(i=0; i<dayObject.time.length; i++){
				dayTimeObject = dayObject.time[i];
				time = dayTimeObject["@attributes"].attr;
				if(time == timeToGet){
					return dayTimeObject;
				}
			}
			return false; //timeObjectArray;
		}*/


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

