# Woring With Files

You can use class for work with files

<b> Start Work 🔘 </b>
<pre>$AntarF = new ASA_Files();</pre>

<b> if you need create file use this 👇 </b>
<pre>$AntarF->CreateFile($namefile,$value = null);</pre>

<b> Write in file (Deleted previous text) </b>
<pre>$AntarF->PutFile("Hello World 👌");</pre>

<b> Delete File </b>
<pre>$AntarF->UnFile($namefile);</pre>

<b> Read File </b>
<pre>$AntarF->ReadFile($namefile);</pre>

<b> Create Folder </b>
<pre>$AntarF->CreateFolder($name);</pre>

<b> Check Exists File </b>
<pre>$AntarF->FileExists($namefile);</pre>

<b> Check Exists Folder </b>
<pre>$AntarF->FolderExists($namefolder);</pre>
