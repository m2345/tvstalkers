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
	var abc_family = new Array();
	
	
	var validChannelList = new Array("ABC", "ABC Family", "NBC", "CBS", "FOX", "PBS", "Disney Channel", "syfy");
	$.post("./tv_widget_primetime.php",
    {
      onload:"true",
    },
    function(data){
		doSomething(data);
		console.log(data);
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
		weekday[0] =  "Sunday";
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
		$.each(dayObject.time, function(){
			time = this["@attributes"].attr; //get time
			outerObject = this; 			//if only one show in time innerloop doesn't work
			$.each(this.show, function(){
				network = this.network;
				addToArray(network, time, this);
				if(typeof network === 'undefined'){
					network = outerObject.show.network;
					addToArray(network, time, outerObject.show);
				}
			});
		});
	
		console.log(abc_family); //not all are being sorted
		arrayToPrint = loopThroughChannels();
		createTable(arrayToPrint);
		//console.log(arrayToPrint);
	}	

	function loopThroughChannels(){
		var primeTime = new Array();
		var finalArray = new Array();
		semiABC = getReleavntTimes(abc);
		semiABC_Family = getReleavntTimes(abc_family);
		semiCBS = getReleavntTimes(cbs);
		semiNBC = getReleavntTimes(nbc);
		semiUSA = getReleavntTimes(usa);
		semiSyfy = getReleavntTimes(syfy);
		console.log("Result is: ");
		console.log(abc_family);
		console.log(semiABC_Family);
		finalArray.push(calcLength(semiABC));
		finalArray.push(calcLength(semiNBC));
		finalArray.push(calcLength(semiCBS));
		finalArray.push(calcLength(semiABC_Family));
		finalArray.push(calcLength(semiUSA));
		finalArray.push(calcLength(semiSyfy));

		return finalArray;
	}
	
	function createTable(finalA){
		if(typeof a == 'undefined')
		console.log('undefined caught');
		numOfChannels = finalA.length;
		startTime="00:00";
		table = "";
		last = false;
		channels = ["ABC", "NBC", "CBS", "ABC Family", "USA", "SYFY"];
		table += "<div class='row'><div class='_08_00 cell kid timeHeader'>8:00 pm</div><div class='_09_00 cell kid timeHeader'>9:00 pm</div><div class='_10_00 cell kid timeHeader'>10:00 pm</div><div class='_11_00 cell kid timeHeader'>11:00 pm</div></div></br>";
		for(i=0; i< numOfChannels; i++){
			table += "<div class='row'><div class='cell  kid channelName'> " + channels[i] + " </div>";
			if(finalA[i].length == 0)
				table += "<div class='cell kid TBD'>TBD</div></br>";
			else{
				indvChannelLength = finalA[i].length;
				for(j=0;j<finalA[i].length; j++){
					if(i == indvChannelLength)
						last = true;
					if(j==0 || (j==1 && (finalA[i][0][3] == "30")))
						pos = "first";
					else pos = "later";
					startTime = finalA[i][0][2];
					sp = startTime.split(":");
					startTime = sp[0]+"_"+sp[1];
					table += "<div class='kid cell _"+ finalA[i][j][3]+" "+ pos +" _" + startTime + " "+ last+ "'>" + finalA[i][j][1]+"</div>";
				}
			}
			table += "</div></br>";
		}
		
		u = document.getElementById("result_times");
		u.innerHTML = table;
		return true;
	}
	
	function getReleavntTimes(ar){
		//console.log(ar);
		net = false;
		full = "0:00";
		if(ar.length > 0){
			bucket = "00:00 pm"; /*make sure first bucket is invalid. else first element is skipped if it is relevant*/
		}
		var rowArray = new Array();
		for(i=0; i<ar.length; i++){
			/* Keep track of previous time.  
			 *  Duplicate entries have happend*/
			t = ar[i][0];
			if(t != bucket){
				name = ar[i][1]["@attributes"].name;
				num = t.split(" ");
				full = num[0];
				q = num[0].split(":");
				if(num[1] == "pm"){
					if((parseInt(q[0]) >= 8) && (parseInt(q[0]) < 12)){
						rowArray.push(new Array(t, name, full));
					}
				}
			}
			bucket = ar[i][0]; /* Update Bucket*/
		}
		return rowArray;
	}
	
	function calcLength(ar){
		var bucket;
		for(i=1; i<ar.length; i++){	
			bucket = ar[i-1][0];
			n = ar[i][0];
			calc = doTheMath(n, bucket);
			ar[i-1].push(calc);
		}
		return ar;
	}
	
	
	function doTheMath(time1, time2){
		y= 2015;
		d= 4;
		m=2;
		
		//time1
		aa = time1.split(" ");
		ap = aa[0].split(":");
		h = ap[0];
		m = ap[1];
		
		//time2
		aa2 = time2.split(" ");
		ap2 = aa2[0].split(":");
		h2 = ap2[0];
		m2 = ap2[1];
		
		date1 = new Date(y,m,d,h,m);
		date2 = new Date(y,m,d,h2,m2);
		ms = Math.abs(date2 - date1);
		min = (ms/1000/60) << 0;
		return min;
	}
	
	
	function addToArray(network, time, showObject){
		if(time == "09:00 pm" && (showObject.network == "Syfy" || showObject.network == 'syfy')){
			console.log("9:00 found " + network);
			debug = false;
		}else debug = false;

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
			case 'cbs':
				cbs.push(new Array(time, showObject));
				break;
			case 'Syfy':
				syfy.push(new Array(time, showObject));
				break;
			case 'SYFY':
				syfy.push(new Array(time, showObject));
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
			case 'ABC Family':
				abc_family.push(new Array(time, showObject));
				break;
			default:		
				if(debug)
					console.log("debug in default");
				break;
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
			
			if(day == "today")
			if(typeof data.DAY !== 'undefined'){
				for(i=0; i<data.DAY.length; i++){
					dayObject = data.DAY[i];
					day = dayObject["@attributes"].attr;
					//console.log(day);
					if(day == currYear + "-" + currMonth + "-" + currDay){
						return dayObject;
					}
				}
			}else{	
				u = document.getElementById("result_times");
				u.innerHTML = "Error Loading Guide"; 
			}
			return false;
		}

