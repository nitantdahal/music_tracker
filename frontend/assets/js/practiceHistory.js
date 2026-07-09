async function loadPracticeHistory()
{


try
{


const response = await fetch(

"http://localhost/music-practice-tracker/backend/api/student/practice/list.php"

);



const result = await response.json();



console.log(result);



if(!result.success)
{

return;

}



let table =
document.getElementById("historyTable");



table.innerHTML="";



result.data.forEach(session=>{


table.innerHTML += `

<tr>

<td>
${session.piece_name}
</td>


<td>
${session.duration_minutes} minutes
</td>


<td>
${session.session_date}
</td>


<td>
${session.notes ?? ""}
</td>


<td>

<button onclick="editPractice(
${session.id},
'${session.piece_name}',
${session.duration_minutes},
'${session.session_date}',
'${session.notes}'
)">

Edit

</button>
<button onclick="deletePractice(${session.id})">

Delete

</button>

</td>


</tr>

`;


});



}

catch(error)
{

console.log(error);

}


}




loadPracticeHistory();

function editPractice(
id,
piece,
duration,
date,
notes
)
{


localStorage.setItem(
"editPractice",
JSON.stringify({

id:id,

piece_name:piece,

duration_minutes:duration,

session_date:date,

notes:notes

})
);



window.location.href =
"practice-edit.html";


}

async function deletePractice(id)
{


let confirmDelete =
confirm(
"Are you sure you want to delete this practice session?"
);



if(!confirmDelete)
{

return;

}



try
{


const response = await fetch(

"http://localhost/music-practice-tracker/backend/api/student/practice/delete.php",

{

method:"POST",

headers:{

"Content-Type":"application/json"

},

body:JSON.stringify({

id:id

})

}

);



const result =
await response.json();



alert(result.message);



if(result.success)
{

loadPracticeHistory();

}


}

catch(error)
{

console.log(error);

}



}