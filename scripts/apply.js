// filename: apply.js
// author: A Luan Luong
// created: 20/04/2023
// last modified: 24/04/2023
// description: js file for apply.html 


//compute the age based on input from user



//Retrieve data from LocalStorage from jobs.js
function fillJobReferenceNumber() {
    if (typeof(Storage) !== undefined) {
        var jobReferenceNumber = localStorage.getItem("nameData");
        var jobReferenceNumberField = document.getElementById("reference_number");
        jobReferenceNumberField.value = jobReferenceNumber;
        jobReferenceNumberField.setAttribute("readonly", true);
        jobReferenceNumberField.style.backgroundColor = "grey";
    }
}  

window.addEventListener("load", fillJobReferenceNumber);
