console.log("This is script.js");

let settingsManu = document.querySelector(".settingsManu");
// console.log(settingsManu);
function settingsManuToggle(){
    // console.log("clickd");
    settingsManu.classList.toggle("settingsManuHeight");
}

//Dark Mode
let darkBtn = document.getElementById("darkBtn");
darkBtn.onclick = function() {
    darkBtn.classList.toggle("darkBtnOn");
    document.body.classList.toggle("darkTheme");

    if(localStorage.getItem("theme") == "light"){
        localStorage.setItem("theme", "dark");
    }
    else{
        localStorage.setItem("theme", "light");
    }
}

if(localStorage.getItem("theme") == "light"){
    darkBtn.classList.remove("darkBtnOn");
    darkBtn.classList.remove("darkTheme");
}
else if(localStorage.getItem("theme") == "dark"){
    darkBtn.classList.add("darkBtnOn");
    darkBtn.classList.add("darkTheme");
}

else{
    localStorage.setItem("theme", "light");
}