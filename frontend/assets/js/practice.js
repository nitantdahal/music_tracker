document
.getElementById("practiceForm")
.addEventListener("submit", async function(e)
{


    e.preventDefault();



    const piece_name =
    document.getElementById("piece_name").value;



    const duration_minutes =
    document.getElementById("duration_minutes").value;



    const session_date =
    document.getElementById("session_date").value;



    const notes =
    document.getElementById("notes").value;



    const message =
    document.getElementById("message");



    const data = {


        piece_name: piece_name,

        duration_minutes: duration_minutes,

        session_date: session_date,

        notes: notes


    };




    try
    {


        const response = await fetch(

            "http://localhost/music-practice-tracker/backend/api/student/practice/add.php",

            {

                method:"POST",

                headers:{

                    "Content-Type":"application/json"

                },

                body:JSON.stringify(data)

            }

        );



        const result = await response.json();



        console.log(result);



        if(result.success)
        {


            message.style.color="green";


            message.innerHTML =
            result.message;



            document
            .getElementById("practiceForm")
            .reset();


        }

        else
        {


            message.style.color="red";


            message.innerHTML =
            result.message;


        }



    }

    catch(error)
    {


        console.log(error);


        message.style.color="red";


        message.innerHTML =
        "Server connection failed";


    }



});