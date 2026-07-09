async function checkAuth(requiredRole=null)
{


    try{


        const response = await fetch(
            "http://localhost/music-practice-tracker/backend/api/auth/check.php"
        );


        const result = await response.json();



        if(!result.loggedIn)
        {

            window.location.href="../login.html";

            return;

        }



        if(requiredRole !== null)
        {


            if(result.user.role !== requiredRole)
            {

                alert("Access Denied");


                window.location.href="../dashboard.html";


            }


        }



    }

    catch(error)
    {

        console.log(error);

    }


}