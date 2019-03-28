
# Work with json

You can work with json for save data

<b> Start Work 🔘 </b>
<pre>$AntarJ = new ASA_JsonData();</pre>

<b> Set Chat ID for work user data</b>
<pre>$AntarJ->SetChatID();</pre>

<b> Set NameFile for save data </b>
<pre>$AntarJ->SetNameFile("users.json");</pre>

<b> Create File (need to set namefile with SetNameFile("NameFile.json") </b>
<pre>$AntarJ->Create();</pre>

<b> add User for save data </b>
<pre>$AntarJ->AddUser();</pre>

<b> Check Exists User </b>
<pre>$AntarJ->ExistsUser();</pre>

<b> Delete User (All data delete) </b>
<pre>$AntarJ->DeleteUser();</pre>

<b> Get all user data </b>
<pre>$AntarJ->GetUser();</pre>

<b> Get value of key </b>
<pre>$AntarJ->GetKey($keyname)</pre>

<b> Add key for set value </b>
<pre>$AntarJ->AddKey("coin");</pre>

<b> Put value in key </b>
<pre>$AntarJ->PutKey($key, $value);</pre>

<b> Delete key (all keys ChatID, delete) </b>
<pre>$AntarJ->DelKey($key);</pre>
