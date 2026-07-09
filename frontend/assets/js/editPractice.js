let practice =
JSON.parse(
localStorage.getItem("editPractice")
);



document.getElementById("id").value =
practice.id;


document.getElementById("piece_name").value =
practice.piece_name;


document.getElementById("duration_minutes").value =
practice.duration_minutes;


document.getElementById("session_date").value =
practice.session_date;


document.getElementById("notes").value =
practice.notes;




document
.getElementById("editPracticeForm")
.addEventListener(
"submit",
async function(e)
{


e.preventDefault();



let data = {


id:
document.getElementById("id").value,


piece_name:
document.getElementById("piece_name").value,


duration_minutes:
document.getElementById("duration_minutes").value,


session_date:
document.getElementById("session_date").value,


notes:
document.getElementById("notes").value


};



let response =
await fetch(

"http://localhost/music-practice-tracker/backend/api/student/practice/update.php",

{

method:"POST",

headers:{

"Content-Type":"application/json"

},

body:JSON.stringify(data)

}

);



let result =
await response.json();



document.getElementById("message").innerHTML =
result.message;



if(result.success)
{

setTimeout(()=>{

window.location.href =
"practice-history.html";


},1000);


}


});