

<?php

if (isset($_POST['submit'])) {
    debug_to_console("heyy");

    $lname = $_POST['name'];
    $birthday = $_POST['birthday'];
    $email = $_POST['email'];

    $contact_data = array(
        // "fname" => $fname,
        "lname" => $lname,
        "email" => $email
    );

    $ans_hubspot = new ans_hubspot();
    $ans_hubspot->contact_create($contact_data);

}

class ans_hubspot {
    //private $hapikey = "59573404-c104-47a6-8f69-c935ed724410";
    //private $hapikey = "305ba431-650b-499e-8b41-9f9e056ffa5b";
    private $hapikey = "eu1-6dc4-584b-4185-a867-7277bbb75ffe";

    function contact_create($contact_data) {
        $arr = array(
            'properties' => array(
                array(
                    'property' => 'acceptance',
                    'value' => "Undecided"
                ) ,
                array(
                    'property' => 'email',
                    'value' => $contact_data["email"]
                ) ,
                array(
                'property' => 'lastname',
                'value' => $contact_data["lname"]
                )
                // array(
                //     'property' => 'firstname',
                //     'value' => $contact_data["fname"]
                // )

            )
        );

        $post_json = json_encode($arr);
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
        return $response . "
";

    }
}
 ?>