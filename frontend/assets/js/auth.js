document
.getElementById("loginForm")
.addEventListener("submit", async function(e)
{


    e.preventDefault();



    const email =
    document.getElementById("email").value;



    const password =
    document.getElementById("password").value;



    const message =
    document.getElementById("message");



    const button =
    document.getElementById("loginBtn");



    button.innerText = "Logging in...";

    button.disabled = true;



    const result = await apiRequest(

        "auth/login.php",

        "POST",

        {
            email:email,
            password:password
        }

    );



    if(result.success)
    {

        message.style.color="green";

        message.innerHTML =
        "Login Successful";


        let role = result.data.role;



        setTimeout(function(){


            if(role==="admin")
            {

                window.location.href =
                "admin/dashboard.html";

            }


            else if(role==="instructor")
            {

                window.location.href =
                "instructor/dashboard.html";

            }


            else if(role==="student")
            {

                window.location.href =
                "student/dashboard.html";

            }


        },1000);


    }

    else
    {

        message.style.color="red";

        message.innerHTML =
        result.message;


        button.innerText="Login";

        button.disabled=false;

    }


});