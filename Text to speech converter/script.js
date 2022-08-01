// console.log('Included');

const textarea = document.querySelector("textarea"),
voiceList = document.querySelector("select"),
speechBtn = document.querySelector("button");
let isSpeaking = true;

let synth = speechSynthesis;
function voices(){
    for(let voice of synth.getVoices()){
        // console.log(voice);
        //Selecting 'Google US English' voice as default 
        let selected = voice.name === "Google US English" ? "selected" : "";
        //Creating an option tag with passing voice name and voice language
        let option = `<option value="${voice.name}" ${selected}>${voice.name} ${voice.lang}</option>`;
        voiceList.insertAdjacentHTML("beforeend", option) //insert option tag before end of select tag
    }
}
synth.addEventListener("voiceschanged", voices);

function textToSpeech(text){
    let utternance = new SpeechSynthesisUtterance(text);
    for(let voice of synth.getVoices()){
        //If the available device voice name is equal to the user selected voice
        //then set the speech voice to the user selected voice
        if(voice.name === voiceList.value){
            utternance.voice = voice;
        }
    }
    synth.speak(utternance); //speak the speech
}

speechBtn.addEventListener("click", (e)=>{
    // console.log("clicked");
    e.preventDefault();
    if(textarea.value !== ""){
        if (!synth.speaking) {
            //If uternance/speech is not currently in the process of speaking
            textToSpeech(textarea.value);
        }
        if (isSpeaking){
            synth.resume();
            isSpeaking = false;
            speechBtn.innerText = "Pause";
        }
        else{
            synth.pause();
            isSpeaking = true;
            speechBtn.innerText = "Resume";
        }

        // checking is uternance/speech in speaking process or not in every 100 millisecond
        //if not set the value isSpeaking to true and change the btn text
        setInterval(() => {
            if (!synth.speaking && !isSpeaking) {
                isSpeaking = true;
                speechBtn.innerText = "Convet to Speech";
            }
        }, 100);
    }
    else{
        textToSpeech("Please enter something");
    }
});

//Clear the text entered by user
let clearBtn = document.getElementById("clearBtn");
function clearText(){
    textarea.value = "";
    synth.pause();
    synth.removeEventListener;
    speechBtn.innerText = "Convet to Speech";
}
clearBtn.addEventListener("click", clearText);