<?php

if (isset($_POST['submit'])) {

    $lname = $_POST['name'];
    $birthday = $_POST['birthday'];
    $email = $_POST['email'];
    

    $contact_data = array(
        'properties' => array(
            array(
                'property' => 'acceptance',
                'value' => "Undecided"
            ),
            array(
                'property' => 'lastname',
                'value' => $lname
            ),
            // array(
            //     'property' => 'firstname',
            //     'value' => $contact_data["fname"]
            // ),
            array(
                'property' => 'email',
                'value' => $email
            )
        )
    );

    $ans_hubspot = new ans_hubspot();
    $ans_hubspot->contact_create($contact_data);

}

class ans_hubspot {

    private $hapikey = "eu1-6dc4-584b-4185-a867-7277bbb75ffe";

    function contact_create($contact_data) {
        $post_json = json_encode($contact_data);
        $endpoint = 'https://api.hubapi.com/contacts/v1/contact?hapikey=' . $this->hapikey;
        $this->http($endpoint, $post_json);
    }

    function http($endpoint, $post_json) {

        $ch = @curl_init();
        @curl_setopt($ch, CURLOPT_POST, true);
        @curl_setopt($ch, CURLOPT_POSTFIELDS, $post_json);
        @curl_setopt($ch, CURLOPT_URL, $endpoint);
        @curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json'
        ));
        @curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = @curl_exec($ch);
        $status_code = @curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curl_errors = curl_error($ch);
        @curl_close($ch);
        return $response . "";

    }
}
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>hubspot-technical-test</title>
</head>
<body>

    
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <h1 class="text-left">Hire Adrien's form</h1>
                <p class="text-left">You are interested in Adrien's customer attention's skills?  Don't wait anymore and fill this form and press the submit button</p>
            </div>
            <div class="col-md-5">
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="text-left">Fill the fields and press the submit button</h3>
                    </div>
                    <div class="col-md-6">
                        <span class="glyphicon glyphicon-pencil"></span></div> 
                </div>
                <hr>
                <form action="post-form.php" method="post">
                    <div class="row">
                        <label class="label col-md-2 control-label">Name</label>
                        <div class="col-md-10">
                            <input type="name" class="form-control" name="name" placeholder="Name">
                        </div>
                    </div>
                    <div class="row">
                        <label class="label col-md-2 control-label">Birthdate</label>
                        <div class="col-md-10">
                            <input type="date" class="form-control" name="birthday" placeholder="Birthday">
                        </div>
                    </div>
                    <div class="row">
                        <label class="label col-md-2 control-label">E-mail</label>
                        <div class="col-md-10">
                            <input type="email" class="form-control" name="email" placeholder="E-mail">
                        </div>
                    </div>
                    <div class="row">
                        <label class="label col-md-2 control-label">Password</label>
                        <div class="col-md-10">
                            <input type="password" class="form-control" name="password" placeholder="Password">
                        </div>
                    </div>
                    <input type="submit" name="submit" value="Submit" class="btn btn-info">
                </form>
        </div>
    </div>

            
<!-- Start of HubSpot Embed Code -->
<script type="text/javascript" id="hs-script-loader" async defer src="//js-eu1.hs-scripts.com/25833213.js"></script>
<!-- End of HubSpot Embed Code -->

</body>
</html>
