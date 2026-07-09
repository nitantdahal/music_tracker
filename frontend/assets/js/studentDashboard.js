async function loadStudentDashboard()
{

    try
    {


        const response = await fetch(

            "http://localhost/music-practice-tracker/backend/api/student/dashboard.php"

        );


        const result = await response.json();

        console.log(result);

        if(!result.success)
        {

            console.log(result.message);

            return;

        }



        const data = result.data;



        // Student Information

        document.getElementById("studentName").innerHTML =
        `Welcome ${data.student.name} 👋`;



        document.getElementById("studentInstrument").innerHTML =
        `Instrument: ${data.student.instrument}`;

        document.getElementById("sidebarName").innerHTML =
        data.student.name;


        document.getElementById("sidebarInstrument").innerHTML =
        data.student.instrument;




        // Statistics


        document.getElementById("totalSessions").innerHTML =
        data.statistics.total_sessions;



        document.getElementById("totalHours").innerHTML =
        data.statistics.total_hours + " hrs";



        document.getElementById("currentStreak").innerHTML =
        data.statistics.current_streak;



        document.getElementById("completedGoals").innerHTML =
        data.goals.completed_goals 
        + " / "
        + data.goals.total_goals;




        // Recent Practice Table


        let table = document.getElementById("practiceTable");


        table.innerHTML="";



        if(data.recent_sessions.length === 0)
        {


            table.innerHTML = `

            <tr>

            <td colspan="4">

            No Practice Sessions Found

            </td>

            </tr>

            `;


        }

        else
        {


            data.recent_sessions.forEach(session=>{


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



    }

    catch(error)
    {


        console.log(
            "Dashboard Error:",
            error
        );


    }


}



// Load dashboard

loadStudentDashboard();