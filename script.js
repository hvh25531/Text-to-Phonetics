// My Script
document.querySelector("#convert_btn").addEventListener("click", convertText);

function convertText(){

  var input_text = document.getElementById("input_text").value;
  var output_dialect = document.querySelector('.output_dialect:checked').value;
  
  /*var data = JSON.stringify({
    input_text: input_text,
    output_dialect: output_dialect
  });*/

  var data = JSON.stringify({
    id: "",
    method: "transcribe",
    params: [input_text, output_dialect]
  });

  if(input_text != '') {
    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {

        var html = JSON.parse(xhr.responseText).result;

        // RegExp
        var patt = /<span class="transcr">(.+)?<\/span>/;
        html_filtered = patt.exec(html);
        //console.log(html_filtered);
        
        document.getElementById("ipa_result").style.display = 'block';
        document.getElementById("ipa_result").innerHTML = html_filtered[0];
      }
    };

    xhr.open("POST", "http://www.phonetizer.com/phonetizer/default/call/jsonrpc");
    xhr.send(data);
  }
};

// End My Script

if (document.querySelector('#play')) {
  var synth = window.speechSynthesis;

  var inputForm = document.querySelector('form');
  var inputTxt = document.getElementById('input_text');
  var voiceSelect = document.querySelector('select');

  var pitch = document.querySelector('#pitch');
  var pitchValue = document.querySelector('.pitch-value');
  var rate = document.querySelector('#rate');
  var rateValue = document.querySelector('.rate-value');

  var voices = [];

  inputForm.onsubmit = function(event) {
    event.preventDefault();

    speak();

    inputTxt.blur();
  }

  pitch.onmousemove = function() {
    pitchValue.textContent = pitch.value;
  }

  rate.onmousemove = function() {
    rateValue.textContent = rate.value;
  }

}

var output_dialects = document.forms["ipaForm"].elements["output_dialect"];

for(var i = 0; i < output_dialects.length; i++) {
  output_dialects[i].onclick = function(){

    if (document.querySelector('#play')) {
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

if (document.querySelector('#play')) {
  populateVoiceList();
  if (speechSynthesis.onvoiceschanged !== undefined) {
    speechSynthesis.onvoiceschanged = populateVoiceList;
  }
}

function speak(){
  if(inputTxt.value !== ''){
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

/*voiceSelect.onchange = function(){
  speak();
}*/