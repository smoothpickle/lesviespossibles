//webkitURL is deprecated but nevertheless
URL = window.URL || window.webkitURL;

var gumStream; 						//stream from getUserMedia()
var rec; 							//Recorder.js object
var input; 							//MediaStreamAudioSourceNode we'll be recording

// shim for AudioContext when it's not avb. 
var AudioContext = window.AudioContext || window.webkitAudioContext;
var audioContext //audio context to help us record

var recordButton = document.getElementById("recordButton");
var stopButton = document.getElementById("stopButton");
// var animLoading = document.getElementById("animLoading");
//var pauseButton = document.getElementById("pauseButton");

//add events to those 2 buttons
recordButton.addEventListener("click", startRecording);
stopButton.addEventListener("click", stopRecording);
//pauseButton.addEventListener("click", pauseRecording);



var hours = minutes = seconds = milliseconds = 0;
var prev_hours = prev_minutes = prev_seconds = prev_milliseconds = undefined;
var timeUpdate;

// Start/Pause/Resume button onClick
// $("#start_pause_resume").button().click(function(){
//     // Start button
//     if($(this).text() == "Start"){  // check button label
//         $(this).html("<span class='ui-button-text'>Pause</span>");
//         updateTime(0,0,0,0);
//     }
//     // Pause button
//     else if($(this).text() == "Pause"){
//         clearInterval(timeUpdate);
//         $(this).html("<span class='ui-button-text'>Resume</span>");
//     }
//     // Resume button		
//     else if($(this).text() == "Resume"){
//         prev_hours = parseInt($("#hours").html());
//         prev_minutes = parseInt($("#minutes").html());
//         prev_seconds = parseInt($("#seconds").html());
//         prev_milliseconds = parseInt($("#milliseconds").html());
		
//         updateTime(prev_hours, prev_minutes, prev_seconds, prev_milliseconds);
		
//         $(this).html("<span class='ui-button-text'>Pause</span>");
//     }
// });

// Update time in stopwatch periodically - every 25ms
function updateTime(prev_hours, prev_minutes, prev_seconds, prev_milliseconds){
	var startTime = new Date();    // fetch current time
	
	timeUpdate = setInterval(function () {
		var timeElapsed = new Date().getTime() - startTime.getTime();    // calculate the time elapsed in milliseconds
		
		// calculate hours                
		hours = parseInt(timeElapsed / 1000 / 60 / 60) + prev_hours;
		
		// calculate minutes
		minutes = parseInt(timeElapsed / 1000 / 60) + prev_minutes;
		if (minutes > 60) minutes %= 60;
		
		// calculate seconds
		seconds = parseInt(timeElapsed / 1000) + prev_seconds;
		if (seconds > 60) seconds %= 60;
		
		// calculate milliseconds 
		milliseconds = timeElapsed + prev_milliseconds;
		if (milliseconds > 1000) milliseconds %= 1000;
		
		// set the stopwatch
		setStopwatch(hours, minutes, seconds, milliseconds);
		
	}, 25); // update time in stopwatch after every 25ms
	
}

// Set the time in stopwatch
function setStopwatch(hours, minutes, seconds, milliseconds){
	$("#hours").html(prependZero(hours, 2));
	$("#minutes").html(prependZero(minutes, 2));
	$("#seconds").html(prependZero(seconds, 2));
	$("#milliseconds").html(prependZero(milliseconds, 3));
}

// Prepend zeros to the digits in stopwatch
function prependZero(time, length) {
	time = new String(time);    // stringify time
	return new Array(Math.max(length - time.length + 1, 0)).join("0") + time;
}
        
            // $('.btn-record').on('click', function() {
            //     updateTime(0,0,0,0);
            // });

function startRecording() {
	console.log("recordButton clicked");
	
	
	
	/*
		Simple constraints object, for more advanced audio features see
		https://addpipe.com/blog/audio-constraints-getusermedia/
	*/
    
    var constraints = { audio: true, video: false }

 	/*
    	Disable the record button until we get a success or fail from getUserMedia() 
	*/

	recordButton.disabled = true;
	stopButton.disabled = false;
	// animLoading.disabled = false;
	
	$('.step-1').fadeOut(300, function() {
		$('.step-2').fadeIn(300);
		updateTime(0,0,0,0);
		
		$('html').attr('data-state', 'recording');
	});
	
	//pauseButton.disabled = false

	/*
    	We're using the standard promise based getUserMedia() 
    	https://developer.mozilla.org/en-US/docs/Web/API/MediaDevices/getUserMedia
	*/
	
	console.log(navigator.mediaDevices)

	navigator.mediaDevices.getUserMedia(constraints).then(function(stream) {
		console.log("getUserMedia() success, stream created, initializing Recorder.js ...");

		/*
			create an audio context after getUserMedia is called
			sampleRate might change after getUserMedia is called, like it does on macOS when recording through AirPods
			the sampleRate defaults to the one set in your OS for your playback device

		*/
		audioContext = new AudioContext();

		//update the format 
		document.getElementById("formats").innerHTML="Format: 1 channel pcm @ "+audioContext.sampleRate/1000+"kHz"

		/*  assign to gumStream for later use  */
		gumStream = stream;
		
		/* use the stream */
		input = audioContext.createMediaStreamSource(stream);

		/* 
			Create the Recorder object and configure to record mono sound (1 channel)
			Recording 2 channels  will double the file size
		*/
		rec = new Recorder(input,{numChannels:1})

		//start the recording process
		rec.record()

		console.log("Recording started");

	}).catch(function(err) {
	  	//enable the record button if getUserMedia() fails
    	recordButton.disabled = false;
    	stopButton.disabled = true;
    	//pauseButton.disabled = true
	});
}

function pauseRecording(){
	console.log("pauseButton clicked rec.recording=",rec.recording );
	if (rec.recording){
		//pause
		rec.stop();
		pauseButton.innerHTML="Resume";
	}else{
		//resume
		rec.record()
		pauseButton.innerHTML="Pause";

	}
}

function stopRecording() {
	console.log("stopButton clicked");
	
	$('html').attr('data-state', false);

	//disable the stop button, enable the record too allow for new recordings
	stopButton.disabled = true;
	recordButton.disabled = false;
	//pauseButton.disabled = true;
	
	$('.step-2').fadeOut(300, function() {
		$('.step-3').fadeIn(300);
	});

	//reset button just in case the recording is stopped while paused
	//pauseButton.innerHTML="Pause";
	
	//tell the recorder to stop the recording
	rec.stop();

	//stop microphone access
	gumStream.getAudioTracks()[0].stop();

	//create the wav blob and pass it on to createDownloadLink
	rec.exportWAV(createDownloadLink);
}

//Stop recording after 25 min
setTimeout(stopRecording, 1500000);

function createDownloadLink(blob) {
	
	var url = URL.createObjectURL(blob);
	var au = document.createElement('audio');
	var li = document.createElement('li');
	var link = document.createElement('a');

	//name of .wav file to use during upload and download (without extendion)
	var filename = new Date().toISOString();

	//add controls to the <audio> element
	au.controls = true;
	au.src = url;

	//save to disk link
	link.href = url;
	link.download = filename+".wav"; //download forces the browser to donwload the file using the  filename
	link.innerHTML = "Save to disk";

	//add the new audio element to li
	li.appendChild(au);
	
	//add the filename to the li
	li.appendChild(document.createTextNode(filename+".wav "))

	//add the save to disk link to li
	li.appendChild(link);
	
	//upload link
	var upload = document.createElement('a');
	var sendButton = document.getElementById('sendButton');
	
	upload.href="#";
	upload.innerHTML = "Upload";

	sendButton.addEventListener("click", function(event){
		var xhr=new XMLHttpRequest();
		xhr.onload=function(e) {
			if(this.readyState === 4) {
				console.log("Server returned: ",e.target.responseText);
			}
		};
		var fd=new FormData();
		fd.append("audio_data",blob, filename);
		xhr.open("POST","upload.php",true);
		xhr.send(fd);
	});
	
	li.appendChild(document.createTextNode (" "))//add a space in between
	li.appendChild(upload)//add the upload link to li

	//add the li element to the ol
	recordingsList.appendChild(li);
}


$('#sendButton').on('click', function() {
	$('.step-3').fadeOut(300, function() {
		$('.step-4').fadeIn(300);
	})
});