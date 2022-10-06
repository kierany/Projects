<!doctype html>
<html>
    <head>
        <title>Request-Form</title>
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <body>
        <?php
            // Serverside Form validation
            $forname = $surname =$reference = $email = $mobile = ""; 
            $fornameError = $surnameError = $referenceError = $emailError = $mobileError = "";
            if ($_SERVER["REQUEST_METHOD"] == "POST"){
                //Forename test
                if (empty($_POST["forname"])){
                    $fornameError = "Forname is required";
                }else{
                    $forname = test_input($_POST["forname"]);

                    if (!preg_match("/^[a-zA-Z-' ]*$/",$forname)) {
                        $fornameError = "Only letters and white space allowed";
                        $forname = "";
                      }
                }
                // Surname Test
                if (empty($_POST["surname"])){
                    $surnameError = "Surname is required";
                }else{
                    $surname = test_input($_POST["surname"]);

                    if (!preg_match("/^[a-zA-Z-' ]*$/",$surname)) {
                        $surnameError = "Only letters and white space allowed";
                        $surname = "";
                      }
                }
                // reference number test
                if (empty($_POST["reference"])){
                    $referenceError = "Reference is required";
                }else{
                    $reference = test_input($_POST["partnumber"]);

                    if (!preg_match("/^[a-zA-Z-'0-9 ]*$/",$reference)) {
                        $referenceError = "Only letters and white space allowed";
                        $reference = "";
                      }
                }
                // email test

                if (empty($_POST["email"])){
                    $emailError = "email is required";
                }else{
                    $email = test_input($_POST["email"]);

                    if (!preg_match("/^[a-zA-Z-' ]*$/",$email)) {
                        $emailError = "Only letters and white space allowed";
                        $email = "";
                      }
                }
                // mobile Test

                if (empty($_POST["mobile"])){
                    $mobileError = "mobile number is required";
                }else{
                    $mobile = test_input($_POST["mobile"]);

                    if (!preg_match('/^[0-9]*$/', $mobile)) {
                        $mobileError = "Only letters and white space allowed";
                        $mobile = "";
                      }
                }
            }

            function test_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }

          
        ?>
        <div class="container">
            <div class='header'>
            <div class='navBar'>
                 <ul id='nul'>
                     <li><h3 id='title'>The Motor Store</h3></li>
                     <li><a href='../pages/home.php'>Home Page</a></li>
                     <li><a href='../pages/about-us.php'>About us</a></li>
                     <li><a href='../pages/store.php'>Store</a></li>
                    <li><a href='login'>Request Parts</a></li>
                </ul>
            </div>
            </div>
            <div class="title">
                <h3>Auto-Part's --- Request-Form</h3>
            </div>
            <div class="formWrap">
                <form class="input" id="addData" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" onsubmit="return submitForm()">
                    <!-- name -->
                    <div class="item">
                        <label>Forname:</label>
                        <input type="text" name="forname" class="field">
                        <span class="error">* <?php echo $fornameError ?></span> 
                        <small></small>
                        <br>
                    </div>
                    <!-- surname -->
                    <div class="item">
                        <label>Surname:</label>
                        <input type="text" name="surname" class="field">
                        <span class="error">*<?php echo $surnameError ?></span> 
                        <small></small>
                        <br>
                    </div>
                    <!-- product number -->
                    <div class="item">
                        <label>Reference number:</label>
                        <input type="text" name="reference" class="field">
                        <span class="error">*<?php echo $referenceError ?></span>
                        <small></small>
                        <br>
                    </div>
                    <!-- make -->
                    <div class="email">
                        <label>Email:</label>
                        <input type="text" name="email" class="field">
                        <span class="error">*<?php echo $emailError ?></span>
                        <small></small>
                        <br>
                    </div>
                    <!-- Mobile Number -->
                    <div class="mobile">
                        <label>Mobile:</label>
                        <input type="text" name="mobile" class="field">
                        <span class="error">*<?php echo $mobileError ?></span>
                        <small></small>
                        <br>
                    </div>
                    <!-- submit -->
                    <input type="submit" name="submit" value="submit">
                </form>

                </div>
                <div class="dataTable">
                    <?php 
                // declaring data into a class
                class record {
                    public $forename;
                    public $surname;
                    public $email;
                    public $mobile;

                    function set_reference($reference){
                        $this->reference = $reference;
                    }
                    function get_reference() {
                        return $this->reference;
                    }
                    function set_forename($forename){
                        $this->forename = $forename; 
                    }
                    function get_forename() {
                        return $this->forename;
                    }
                    function set_surname($surname){
                        $this->surname = $surname;
                    }
                    function get_surname() {
                        return $this->surname;
                    }
                    function set_email($email){
                        $this->email = $email;
                    }
                    function get_email(){
                        return $this->email;
                    }
                    function set_mobile($mobile){
                        $this->mobile = $mobile;
                 }
                    function get_mobile() {
                        return $this->mobile;
                    }

                }

                    // <!-- Writing to the csv -->

                    $file = "data.csv";

                    $fh = fopen($file, 'r');
                    $header = fgetcsv($fh);

                    $content = array();
                    while ($line = fgetcsv($fh)) {
                        $entry = new record();
                        $entry->set_reference($line[0]);
                        $entry->set_forename($line[1]);
                        $entry->set_surname($line[2]);
                        $entry->set_email($line[3]);
                        $entry->set_mobile($line[4]);
                        array_push($content,$entry);
                    }

                    fclose($fh);

                    // <!-- Displays data from the file in a table -->

                    echo "<html><body><centre><table>\n\n";

                    $file = fopen("data.csv", "r");

                    while (($displaydata = fgetcsv($file)) !== false) {
                        echo "<tr>";
                        foreach ($displaydata as $i) {
                        echo "<td>" . htmlspecialchars($i)
                             ."</td>";
                            }
                        echo "</tr> \n";
                        }

                        echo "\n</table></center></body></html>";

                        fclose($file);

                    ?>
                    



                </div>
                    <div class='footer'>

                </div>
            </div>
        </div>
        <script src="../validation.js"></script>
    </body>
</html>