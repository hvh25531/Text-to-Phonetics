showImage();

function showImage(){
  document.querySelector(".contact").addEventListener("dblclick", function(){
    if (window.matchMedia("(min-width: 667px)").matches){
      document.querySelector("#ascii_img").style.display = 'block';
    }

    window.onresize = function(){
      if (window.matchMedia("(max-width: 666px)").matches){
        document.querySelector("#ascii_img").style.display = 'none';
      }
    };
  });
}

document.querySelector("#convert_btn").addEventListener("click", convertText);

function convertText(){

  var input_text = document.getElementById("input_text").value;
  var output_dialect = document.querySelector('.output_dialect:checked').value;

  var data = JSON.stringify({
    id: "",
    method: "transcribe",
    params: [input_text, output_dialect]
  });

  if(input_text != '') {
    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {

        var res = JSON.parse(xhr.responseText).result;
        // RegExp
        var patt = /<span class="transcr">(.+)?<\/span>/gi;
        var res_filtered_array = res.match(patt);
        var html = res_filtered_array.join('<br>');
        
        var ipa_result = document.getElementById("ipa_result");
        ipa_result.style.display = 'block';
        ipa_result.innerHTML = html;

        var show_hide = document.getElementById("show_hide");
        show_hide.style.display = 'block';
        show_hide.onclick = function(){
          if (ipa_result.style.display == 'block'){
            ipa_result.style.display = 'none';
          } else {
            ipa_result.style.display = 'block';
          }
        }
      }
    };

    xhr.open("POST", "http://www.phonetizer.com/phonetizer/default/call/jsonrpc");
    xhr.send(data);
  }
};

if (document.querySelector('#speak')) {
  var synth = window.speechSynthesis;

  var inputForm = document.querySelector('form');
  var inputTxt = document.getElementById('input_text');
  var voiceSelect = document.querySelector('select');

  var pitch = document.querySelector('#pitch');
  var pitchValue = document.querySelector('.pitch-value');
  var rate = document.querySelector('#rate');
  var rateValue = document.querySelector('.rate-value');

  var voices = [];

  /*inputForm.onsubmit = function(event) {
    event.preventDefault();

    _speak();

    inputTxt.blur();
  }*/

  pitch.onmousemove = function() {
    pitchValue.textContent = pitch.value;
  }

  rate.onmousemove = function() {
    rateValue.textContent = rate.value;
  }

  window.onload = function(){
    synth.cancel();
  };

}

var output_dialects = document.forms["ipaForm"].elements["output_dialect"];

for(var i = 0; i < output_dialects.length; i++) {
  output_dialects[i].onclick = function(){

    if (document.querySelector('#speak')) {
      populateVoiceList();
    }
    convertText();
  };
}

function populateVoiceList() {
  voices = synth.getVoices();

  // Custom voices_filtered
  var voices_filtered = voices.filter(isEN);

  var selectedIndex = voiceSelect.selectedIndex < 0 ? 0 : voiceSelect.selectedIndex;
  voiceSelect.innerHTML = '';
  for(i = 0; i < voices_filtered.length ; i++) {
    var option = document.createElement('option');
    option.textContent = voices_filtered[i].name + ' (' + voices_filtered[i].lang + ')';
    
    if(voices_filtered[i].default) {
      option.textContent += ' -- DEFAULT';
    }

    option.setAttribute('data-lang', voices_filtered[i].lang);
    option.setAttribute('data-name', voices_filtered[i].name);
    voiceSelect.appendChild(option);
  }
  voiceSelect.selectedIndex = selectedIndex;
}

function isEN(value) {
  if (output_dialects.value == 'American')
    return value.lang == 'en-US';
  else
    return value.lang == 'en-GB';
}

if (document.querySelector('#speak')) {
  populateVoiceList();
  if (speechSynthesis.onvoiceschanged !== undefined) {
    speechSynthesis.onvoiceschanged = populateVoiceList;
  }
}

function _speak(){
  if(synth.speaking && !synth.pending) {
    synth.resume();
  } else{
    var utterThis = new SpeechSynthesisUtterance(inputTxt.value);
    var selectedOption = voiceSelect.selectedOptions[0].getAttribute('data-name');
    for(i = 0; i < voices.length ; i++) {
      if(voices[i].name === selectedOption) {
        utterThis.voice = voices[i];
      }
    }
    utterThis.pitch = pitch.value;
    utterThis.rate = rate.value;
    synth.speak(utterThis);
  }
}

function _pause_resume(){
  if(!synth.paused) {
    synth.pause();
  } else{
    synth.resume();
  }
}

function _stop(){
  synth.cancel();
}

/*voiceSelect.onchange = function(){
  _speak();
}*/