async function apiRequest(endpoint, method="GET", data=null)
{

    try{

        let options = {

            method: method,

            headers:{
                "Content-Type":"application/json"
            }

        };


        if(data)
        {
            options.body = JSON.stringify(data);
        }


        const response = await fetch(
            API_URL + endpoint,
            options
        );


        return await response.json();


    }
    catch(error)
    {

        return {

            success:false,

            message:"Server connection failed"

        };

    }

}