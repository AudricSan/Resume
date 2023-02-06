<?php
include('include/header.php');

echo "
   <form method='POST' action='submit.php' enctype='multipart/form-data' target='_self'>
";

// INPUT BELOW

echo "
<p>
   <label for='date'>date :</label>
   <input type='date' id='date' name='date'>
</p>
";

echo "
<p>
   <label for='litre'>L input :</label>
   <input type='number' step='0.01' id='litre' name='litre' onkeydown='keydownFunction(this)' onkeyup='keyupFunction(this)' onchange='updateValue(this)'>
</p>";

echo "
<p>
   <label for='km'>Km travelled :</label>
   <input type='number' step='0.01' id='km' name='km'>
</p>";

echo "
<p>
   <label for='price'>€ / L :</label>
   <input type='number' step='0.01' id='price' name='price' onkeydown='keydownFunction(this)' onkeyup='keyupFunction(this)' onchange='updateValue(this)'>

   <a id='total' > Total = 0€ </a>
</p>";

echo "
<p>
    <label for='car'>Choose a car :</label>
    <select id='car' name='car'>
       <option value='1-ARP-235'>1-ARP-235</option>
       <option value='2-APQ-850'>2-APQ-850</option>
       <option value='1-XTC-543'>1-XTC-543</option>
       <option value='M-BDR-750'>M-BDR-750</option>
       <option value='other'>other</option>
    </select>
</p>";

echo "
<p>
   <label for='coms'>comments :</label>
   <input type='text'id='coms' name='coms'>
</p>";

echo "
   <br>
   <input type='submit' value='Submit'>
   </form>
";

include('include/footer.html');