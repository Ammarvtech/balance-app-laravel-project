<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Web Example</title>
  </head>
  <body>
    <div
      style="display: flex; flex-direction: column; flex: 1; justify-content: center; align-items: center; width: 100%; height: 100%"
    >
      <h1>Client Website!</h1>
      <button
        style="height: 2rem;width: 20rem;background: beige;border: 1px solid black;"
        onclick="clickMe()"
      >
        Link Bank Account
      </button>
      <div id="dapiApi"></div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.dapi.co/connect/v1/connector.js"></script>
    <script>
      var handler = Dapi.create({
        //Intiation Connector with the correct paramteres
        environment: 'sandbox',
        appKey: 'f81a81cd99e890dd7aacaf694f93437ecd1dff7a79d081a729c08b69bf48a182',
        countries: ['AE'],
        onSuccess: function(meta_data) {
          //This is the callback function when the end-user connects succesfully
          /**
           * meta_data contains all the keys required in order to talk to dapi api.
           * meta_data = {
           *  connectionID: "YOUR_CONNECTION_ID",
           *  userSecret: "YOUR_USER_SECRET",
           *  accessCode: "YOUR_ACCESS_CODE"
           * }
           **/
          console.log(meta_data)
        // $("#dapiApi").empty();
        // $("#dapiApi").append("<p>Access Code: "+meta_data.accessCode+"</p><br>");
        // $("#dapiApi").append("<p>User Secret: "+meta_data.userSecret+"<p><br>");
        // $("#dapiApi").append("<p>Connection ID: "+meta_data.connectionID+"</p>");
            
        },
        onFailure: function(err) {
          //This is the callback function when the end-user is unable to connect succesfully
          if (err != null) {
            console.log('Error')
            console.log(err)
          } else {
            console.log('No error')
          }
        },
      })
      var clickMe = function() {
        //function to show the Connect interface
        handler.open()
      }
    </script>
  </body>
</html>