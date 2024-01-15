<div class="">
    <button id="recording-toggle">Start recording</button>
    <script>
        var RECORDING_ONGOING = false;
        var recordingToggle = document.getElementById("recording-toggle"); // The button
    
        recordingToggle.addEventListener("click", function () {
            RECORDING_ONGOING = !RECORDING_ONGOING; // Start / Stop recording
            if (RECORDING_ONGOING) {
                recordingToggle.innerHTML = "Stop Recording";
                startRecording(); // Start the recording
            } else {
                recordingToggle.innerHTML = "Start Recording";
                stopRecording(); // Stop screen recording
            }
        });
    
        var blob, mediaRecorder = null;
        var chunks = [];
    
        async function startRecording() {
            var stream = await navigator.mediaDevices.getDisplayMedia(
                { video: { mediaSource: "screen" }, audio: true }
            );
    
            console.log(MediaRecorder.isTypeSupported("video/webm"))
            console.log(MediaRecorder.isTypeSupported("video/mp4"))
            console.log(MediaRecorder.isTypeSupported("video/mp4;codecs=avc1"))
    
    
            deviceRecorder = new MediaRecorder(stream, { mimeType: "video/webm" });
    
            deviceRecorder.ondataavailable = (e) => {
                if (e.data.size > 0) {
                    chunks.push(e.data);
                }
            }
            deviceRecorder.onstop = () => {
                chunks = [];
            }
            deviceRecorder.start(250)
    
        }
    
        function stopRecording() {
            var filename = window.prompt("File name", "video"); // Ask the file name
    
            deviceRecorder.stop(); // Stopping the recording
            blob = new Blob(chunks, { type: "video/webm" })
            chunks = [] // Resetting the data chunks
            var dataDownloadUrl = URL.createObjectURL(blob);
    
            // Downloadin it onto the user's device
            let a = document.createElement('a')
            a.href = dataDownloadUrl;
            a.download = `${filename}.webm`
            a.click()
    
            URL.revokeObjectURL(dataDownloadUrl)
        }
    </script>
</div>