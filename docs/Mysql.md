# works with mysql[i]

You can connect to database for add , delete , edit and more.... Now follow me😜

<h5>How to create Mysql Database ? </h5>

<h6>Log into your <sup>cPanel</sup>.

Click the <sup>MySQL Database Wizard</sup> under the Databases heading.


Next to New Database enter a name for your database and click Next Step.

</h6>

<b>WARNING: If you receive an error message regarding the limited number of databases available, you may consider upgrading your Business Class Hosting plan.</b>

<h6>
Next to <sup>Username</sup> enter a username.
Enter a password next to <sup>Password</sup>

enter it again for <sup>Password</sup> (Again) and then click <sup>Create User</sup>.


On the next page, you'll assign privileges for the user to the database. Check the box next to <sup>All Privileges</sup> and then click <sup>Next Step</sup>
</h6>

<img src="http://Antar.SD/files/m2pw_img_20181207_095453.jpg" alt="MySql"/> 

<b>connect to database 🔘</b>
<pre>$AntarM = new ASA_Mysql($host,$username,$password);</pre>
<b>For Example: </b>
<pre>$AntarM = new ASA_Mysql('Antar.SD','Antars_test','123456789');</pre>

<b>Set Table For Work</b>
<pre>$AntarM->SetTable("table_name");</pre>

<b>Create Table</b>
<pre>$AntarM->CreateTable($format="binary");</pre>

<b>Check Exist Table</b>
<pre>$AntarM->TableExists();</pre>

<b> For Example : (Create Table)</b>
<pre>
$AntarM->SetTable("users");
if(!$AntarM->TableExists()){
$AntarM->CreateTable();
}
</pre>

<b>Get all Column Value</b>
<pre>$AntarM->IDS();</pre>

<b>Get value of column</b>
<pre>$AntarM->Get($key, $key2, $value2);</pre>
<b>For Example :</b> (123456789 = chat_id)
<pre>$AntarM->Get("coins", "chat_id", 123456789);</pre>

<b>Put Column value</b>
<pre>$AntarM->Put("coins", 10000, "chat_id", 123456789);</pre>

<b>Adding profile to manage (for example: chat_id)</b>
<pre>$AntarM->AddCustomProfile('chat_id', 123456789);</pre>

<b>Deleting profile (all data profile delete)</b>
<pre>$AntarM->DelCustomProfile('chat_id', 123456789);</pre>

<b>Add column</b>
<pre>$AntarM->AddColumn($columm, $definition);</pre>
<b>For Example :</b>
<pre>
$AntarM->AddColumm('chat_id', 'INT');
$AntarM->AddColumm('name', 'TEXT');
</pre>
<a href="https://www.w3schools.com/sql/sql_datatypes.asp">definition list</a>

<b>Add new value at the beginning of the table (Similar AddCustomProfile)<b>
<pre>$AntarM->PutNoWhere("chat_id", 123456789);</pre>
  
<b>Sum the values of a column</b>
<pre>$AntarM->SUM($column);</pre>

<b>Get Count of a column</b>
<pre>$AntarM->COUNT($column);</pre>

<b>Check if there is a value in the column</b>
<pre>$AntarM->is_column_value($column, $value);</pre>

<b>Sum a value with the previous value of the data😅</b>
<pre>
//coin = 500
$AntarM->PutSum("coin",100,"chat_id",123456789);
//now coin = 600
</pre>


<b>Automatically add a profile for manage</b>
<pre>$AntarM->AddProfile($value);</pre>
<b> For Example : (Add chat id 123456789 and set coin) </b>
<pre>

$chat_id = 123456789;
$mysql->SetTable("users");

if(!$mysql->TableExists()){
$mysql->CreateTable();
$mysql->AddColumn('coin','INT');
}

if(!$mysql->is_column_value('chat_id',$chat_id)){
$mysql->AddProfile($chat_id);
$mysql->Put("coin",100,"chat_id", $chat_id);
}
</pre>
