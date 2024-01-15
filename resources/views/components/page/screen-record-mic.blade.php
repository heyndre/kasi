<div class="" wire:ignore>

    <div style="float: left">
        <video class="recording" autoplay muted width="500px" height="500px"></video>
    </div>
    <div>
        <h1>OUTPUT</h1>
        <video class="output" autoplay controls width="500px" height="500px"></video>

        {{-- <button class="start-btn" onclick="allow();">Prepare Recording</button> --}}
        <button class="start-btn">Start Recording</button>
        <button class="stop-btn">Stop Recording</button>
        <a href="#" download="output.webm" class="download-anc">Download</a>
    </div>

    <script>
        var video = document.querySelector('.recording'); 
var output = document.querySelector('.output'); 
var start = document.querySelector('.start-btn'); 
var stop = document.querySelector('.stop-btn'); 
var anc = document.querySelector(".download-anc") 
var data = []; 

// In order record the screen with system audio 
// function allow() {

    var recording = navigator.mediaDevices.getDisplayMedia({ 
        video: { 
            mediaSource: 'screen', 
        }, 
        audio: true, 
    }) 
	.then(async (e) => { 
        
        // For recording the mic audio 
		let audio = await navigator.mediaDevices.getUserMedia({ 
            audio: true, video: false }) 
            
		// Assign the recorded mediastream to the src object 
		video.srcObject = e; 

		// Combine both video/audio stream with MediaStream object 
		let combine = new MediaStream( 
			[...e.getTracks(), ...audio.getTracks()]) 

		/* Record the captured mediastream 
		with MediaRecorder constructor */
		let recorder = new MediaRecorder(combine); 

		start.addEventListener('click', (e) => { 

			// Starts the recording when clicked 
			recorder.start(); 
			alert("recording started") 

			// For a fresh start 
			data = [] 
		}); 

		stop.addEventListener('click', (e) => { 

			// Stops the recording 
			recorder.stop(); 
			alert("recording stopped") 
		}); 

		/* Push the recorded data to data array 
		when data available */
		recorder.ondataavailable = (e) => { 
			data.push(e.data); 
		}; 

		recorder.onstop = () => { 

			/* Convert the recorded audio to 
			blob type mp4 media */
			let blobData = new Blob(data, { type: 'video/webm' }); 
            
			// Convert the blob data to a url 
			let url = URL.createObjectURL(blobData) 

			// Assign the url to the output video tag and anchor 
			output.src = url 
			anc.href = url 
		}; 
	}); 
// }

    
    </script>
</div>