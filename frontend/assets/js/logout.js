async function logout()
{


    const response = await fetch(

        "http://localhost/music-practice-tracker/backend/api/auth/logout.php"

    );


    const result = await response.json();



    if(result.success)
    {

        window.location.href="../login.html";

    }


}