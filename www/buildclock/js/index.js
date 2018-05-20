//######################################################################################
// Description: displays the amount of time until the "raceDate" entered below.

// NOTE: the month entered must be one less than current month. ie; 0=January, 11=December
// NOTE: the hour is in 24 hour format. 0=12am, 15=3pm etc
// format: raceDate = new Date(year,month-1,day,hour,min,sec)
// example: raceDate = new Date(2003,03,26,14,15,00) = April 26, 2003 - 2:15:00 pm


//KICKOFF: Saturday, January 6, 2018 | 10:00 am - 12:00 pm ET
//This means Jan 6, 2018 @ 9am CST
startBuild = new Date(2019,0,6,9,0,0);

//STOP BUILD: Tuesday, February 20, 2018 - 11:59pm ET
//This means Feb 20, 2018 @ 10:59 CST
stopBuild = new Date(2019,1,20,22,59,0); //Stop Build 2018

function getDiff(ddate){
	dateNow = new Date();	//grab current date
	amount = ddate.getTime() - dateNow.getTime();	//calc milliseconds between dates
	delete dateNow;
	return amount;
}

function GetCount(ddate){

	amount = getDiff(ddate);

	//if startBuild has past, use stopBuild
	if(amount<0){
		amount = getDiff(stopBuild);
	}

	if(amount<0){
		//window.alert(amount);
		$('#stopBuild').show();
		$('#countDown').hide();
	}else{ // else date is still good
		days=0;hours=0;mins=0;secs=0;

		amount = Math.floor(amount/1000);//kill the "milliseconds" so just secs

		days=Math.floor(amount/86400);//days
		amount=amount%86400;

		hours=Math.floor(amount/3600);//hours
		amount=amount%3600;

		mins=Math.floor(amount/60);//minutes
		amount=amount%60;

		secs=Math.floor(amount);//seconds


  //set times into table
  if(days != 0)
  {
    $('#dayCount').html(days);

   if(days == 1)
      $('#days').html('DAY');
   else
      $('#days').html('DAYS');
  }
  else
  {
    $('#dayCount').html('');
    $('#days').html('');
  }

  if (days == 0 && hours == 0)
  {
    $('#hourCount').html('');
    $('#hours').html('');
  }
  else if(hours == 0)
  {
    $('#hourCount').html('0');
    $('#hours').html('HOURS');
  }
  else
  {
    $('#hourCount').html(hours);

    if(hours == 1)
      $('#hours').html('HOUR');
    else
      $('#hours').html('HOURS');
  }

   $('#minCount').html(mins);

        if(mins == 1)
          $('#mins').html('MINUTE');
        else
          $('#mins').html('MINUTES');

    $('#secCount').html(secs);
    $('#secs').html('SECONDS');

		setTimeout(function(){GetCount(ddate)}, 1000); //wait a second
	}
}


window.onload=function(){
	GetCount(startBuild);
};
