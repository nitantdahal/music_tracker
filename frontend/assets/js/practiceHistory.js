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